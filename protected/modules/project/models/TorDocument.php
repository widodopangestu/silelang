<?php

/**
 * This is the model class for table "tor_document".
 *
 * The followings are the available columns in table 'tor_document':
 * @property integer $id
 * @property string $document
 * @property string $summary
 * @property string $status
 * @property double $cost
 * @property string $created
 * @property string $updated
 * @property integer $project_id
 *
 * The followings are the available model relations:
 * @property Project $project
 * @property TorReview[] $torReviews
 */
class TorDocument extends CActiveRecord {

    public $file;

    const STATUS_DRAFT = 'DRFT';
    const STATUS_SUBMIT = 'SBMT';
    const STATUS_ACCEPT1 = 'PASS1';
    const STATUS_ACCEPT2 = 'PASS2';
    const STATUS_ACCEPT3 = 'PASS3';
    const STATUS_REJECT = 'RJCT';
    const STATUS_ARCHIEVE = 'ACHV';

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return TorDocument the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tor_document';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('project_id', 'required'),
            array('project_id', 'numerical', 'integerOnly' => true),
            array('cost', 'numerical'),
            array('document', 'length', 'max' => 45),
            array('status', 'length', 'max' => 10),
            array('file_name', 'length', 'max' => 255),
            array('summary, created, updated', 'safe'),
            array('file', 'file', 'types' => 'pdf', 'allowEmpty' => true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, document, summary, status, cost, file_name, created, updated, project_id', 'safe', 'on' => 'search'),
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
            'torReviews' => array(self::HAS_MANY, 'TorReview', 'tor_document_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'document' => 'Document',
            'summary' => 'Summary',
            'status' => 'Status',
            'cost' => 'Cost',
            'file_name' => 'File Name',
            'created' => 'Created',
            'updated' => 'Updated',
            'project_id' => 'Project',
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
        $criteria->compare('document', $this->document, true);
        $criteria->compare('summary', $this->summary, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('cost', $this->cost);
        $criteria->compare('file_name', $this->file_name, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('updated', $this->updated, true);
        $criteria->compare('project_id', $this->project_id);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public function getStatusOptions() {
        return array(
            self::STATUS_DRAFT => 'DRAFT',
            self::STATUS_SUBMIT => 'SUBMIT',
            self::STATUS_ACCEPT1 => 'PASS TECHNICAL',
            self::STATUS_ACCEPT2 => 'PASS FINANCE',
            self::STATUS_ACCEPT3 => 'PASS COORDINATOR',
            self::STATUS_REJECT => 'REJECT',
            self::STATUS_ARCHIEVE => 'ARCHIEVE',
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
            self::STATUS_ACCEPT3 => array(self::STATUS_REJECT),
            self::STATUS_REJECT => array(),
            self::STATUS_ARCHIEVE => array(),
        );
    }

    /**
     * Change status
     */
    public function changeStatus($status) {
        $this->status = $status;
        return $this->save();
    }

    /**
     * Adds a torReview to this issue
     */
    public function addTorReview($torReview) {
        $torReview->tor_document_id = $this->id;
        return $torReview->save();
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