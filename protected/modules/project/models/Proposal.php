<?php

/**
 * This is the model class for table "proposal".
 *
 * The followings are the available columns in table 'proposal':
 * @property integer $id
 * @property string $name
 * @property string $summary
 * @property double $cost
 * @property string $document
 * @property string $status
 * @property string $created
 * @property string $updated
 * @property integer $project_id
 * @property integer $user_id
 *
 * The followings are the available model relations:
 * @property Project $project
 * @property User $user
 * @property ProposalComment[] $proposalComments
 */
class Proposal extends CActiveRecord {

    public $file;

    const STATUS_DRAFT = 'DRFT';
    const STATUS_SUBMIT = 'SBMT';
    const STATUS_ACCEPT1 = 'PASS1';
    const STATUS_ACCEPT2 = 'PASS2';
    const STATUS_ACCEPT3 = 'PASS3';
    const STATUS_ACCEPT4 = 'PASS4';
    const STATUS_REJECT = 'RJCT';

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Proposal the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'proposal';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('project_id, user_id', 'required'),
            array('project_id, user_id', 'numerical', 'integerOnly' => true),
            array('cost', 'numerical'),
            array('name, summary, file_name', 'length', 'max' => 255),
            array('document', 'length', 'max' => 45),
            array('status', 'length', 'max' => 10),
            array('created, updated', 'safe'),
            array('file', 'file', 'types' => 'pdf', 'allowEmpty' => true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, summary, cost, document, status, file_name, created, updated, project_id, user_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
            'proposalComments' => array(self::HAS_MANY, 'ProposalComment', 'proposal_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'summary' => 'Summary',
            'cost' => 'Cost',
            'document' => 'Document',
            'status' => 'Status',
            'file_name' => 'File Name',
            'created' => 'Created',
            'updated' => 'Updated',
            'project_id' => 'Project',
            'user_id' => 'User',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('summary', $this->summary, true);
        $criteria->compare('cost', $this->cost);
        $criteria->compare('document', $this->document, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('file_name', $this->file_name, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('updated', $this->updated, true);
        $criteria->compare('project_id', $this->project_id);
        $criteria->compare('user_id', $this->user_id);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public function getUserOptions() {
        return CHtml::listData(User::model()->findAll(), 'id', 'username');
    }

    /**
     * Change status
     */
    public function changeStatus($status) {
        $this->status = $status;
        if ($this->status == self::STATUS_ACCEPT4) {
            $this->project->organization_id = $this->user->organization_id;
            $this->project->save();
        }

        return $this->save();
    }

    public function getStatusOptions() {
        return array(
            self::STATUS_DRAFT => 'DRAFT',
            self::STATUS_SUBMIT => 'SUBMIT',
            self::STATUS_ACCEPT1 => 'PASS ADMINISTRATION',
            self::STATUS_ACCEPT2 => 'PASS TECHNICAL',
            self::STATUS_ACCEPT3 => 'PASS FINANCE',
            self::STATUS_ACCEPT4 => 'PASS FINAL',
            self::STATUS_REJECT => 'REJECT',
        );
    }

    public function getStatusText($status = null) {
        $value = ($status === null) ? $this->status : $status;
        $statusOptions = $this->getStatusOptions();
        return isset($statusOptions[$value]) ?
                $statusOptions[$value] : "unknown status ({$value})";
    }

    public function getStatusValue($status = null) {
        $statusOptions = $this->getStatusOptions();
        return array_search($status, $statusOptions);
    }

    public function statusFlow() {
        return array(
            self::STATUS_DRAFT => array(self::STATUS_SUBMIT),
            self::STATUS_SUBMIT => array(self::STATUS_ACCEPT1, self::STATUS_REJECT),
            self::STATUS_ACCEPT1 => array(self::STATUS_ACCEPT2, self::STATUS_REJECT),
            self::STATUS_ACCEPT2 => array(self::STATUS_ACCEPT3, self::STATUS_REJECT),
            self::STATUS_ACCEPT3 => array(self::STATUS_ACCEPT4, self::STATUS_REJECT),
            self::STATUS_ACCEPT4 => array(self::STATUS_REJECT),
            self::STATUS_REJECT => array(),
        );
    }

    /**
     * Adds a proposalComment to this issue
     */
    public function addProposalComment($proposalComment) {
        $proposalComment->proposal_id = $this->id;
        return $proposalComment->save();
    }

    public function behaviors() {
        return array(
            'timestamps' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'created',
                'updateAttribute' => 'updated',
                'setUpdateOnCreate' => true,
            ),
        );
    }

}