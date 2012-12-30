<?php

/**
 * This is the model class for table "project".
 *
 * The followings are the available columns in table 'project':
 * @property integer $id
 * @property string $name
 * @property string $start_date
 * @property string $end_date
 * @property string $contracts
 * @property string $status
 * @property string $created
 * @property string $updated
 * @property integer $major_id
 * @property integer $user_id
 * @property integer $departement_id
 * @property integer $organization_id
 *
 * The followings are the available model relations:
 * @property CompletionDocument[] $completionDocuments
 * @property Milestone[] $milestones
 * @property Departement $departement
 * @property Major $major
 * @property Organization $organization
 * @property User $user
 * @property Proposal[] $proposals
 * @property Termin[] $termins
 * @property TorDocument[] $torDocuments
 */
class Project extends CActiveRecord {

    const STATUS_DRAFT = 'DRFT';
    const STATUS_SUBMIT = 'SBMT';
    const STATUS_CLOSE = 'CLSD';
    const STATUS_ARCHIEVE = 'ACHV';

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Project the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'project';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('major_id, user_id, departement_id', 'required'),
            array('major_id, user_id, departement_id, organization_id', 'numerical', 'integerOnly' => true),
            array('name, contracts', 'length', 'max' => 255),
            array('status', 'length', 'max' => 10),
            array('start_date, end_date, actual_start_date, actual_end_date, created, updated', 'safe'),
            array(
                'end_date',
                'compare',
                'compareAttribute' => 'start_date',
                'operator' => '>',
                'allowEmpty' => false,
                'message' => '{attribute} must be greater than "{compareValue}".'
            ),
            array(
                'actual_end_date',
                'compare',
                'compareAttribute' => 'actual_start_date',
                'operator' => '>',
                'allowEmpty' => true,
                'message' => '{attribute} must be greater than "{compareValue}".'
            ),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, start_date, end_date, actual_start_date, actual_end_date, contracts, status, created, updated, major_id, user_id, departement_id, organization_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'milestones' => array(self::HAS_MANY, 'Milestone', 'project_id'),
            'departement' => array(self::BELONGS_TO, 'Departement', 'departement_id'),
            'major' => array(self::BELONGS_TO, 'Major', 'major_id'),
            'organization' => array(self::BELONGS_TO, 'Organization', 'organization_id'),
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
            'proposals' => array(self::HAS_MANY, 'Proposal', 'project_id'),
            'termins' => array(self::HAS_MANY, 'Termin', 'project_id'),
            'torDocuments' => array(self::HAS_MANY, 'TorDocument', 'project_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'actual_start_date' => 'Actual Start Date',
            'actual_end_date' => 'Actual End Date',
            'contracts' => 'Contracts',
            'status' => 'Status',
            'created' => 'Created',
            'updated' => 'Updated',
            'major_id' => 'Major',
            'user_id' => 'User',
            'departement_id' => 'Departement',
            'organization_id' => 'Organization',
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
        $criteria->compare('start_date', $this->start_date, true);
        $criteria->compare('end_date', $this->end_date, true);
        $criteria->compare('actual_start_date', $this->actual_start_date, true);
        $criteria->compare('actual_end_date', $this->actual_end_date, true);
        $criteria->compare('contracts', $this->contracts, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('updated', $this->updated, true);
        $criteria->compare('major_id', $this->major_id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('departement_id', $this->departement_id);
        $criteria->compare('organization_id', $this->organization_id);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public function getTotalCost() {
        $sql = "SELECT SUM(t.cost) AS total_cost FROM termin t
            LEFT JOIN payment_document p ON t.id = p.termin_id
            WHERE p.id <> '' AND t.project_id = $this->id";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $results = $command->queryAll();
        return $results[0]['total_cost'];
    }

    public function getProjectCost() {
        $val = 'N/A';
        foreach ($this->torDocuments as $torDocuments) {
            if ($torDocuments->status == TorDocument::STATUS_ACCEPT3) {
                $val = $torDocuments->cost;
                break;
            }
        }
        return $val;
    }

    /**
     * Change status
     */
    public function changeStatus($status) {
        $this->status = $status;
        return $this->save();
    }

    public function getUserOptions() {
        return CHtml::listData(User::model()->findAll(), 'id', 'username');
    }

    public function getMajorOptions() {
        return CHtml::listData(Major::model()->findAll(), 'id', 'name');
    }

    public function getOrganizationOptions() {
        return CHtml::listData(Organization::model()->findAll(), 'id', 'name');
    }

    public function getDepartementOptions() {
        return CHtml::listData(Departement::model()->findAll(), 'id', 'name');
    }

    public function getStatusOptions() {
        return array(
            self::STATUS_DRAFT => 'DRAFT',
            self::STATUS_SUBMIT => 'SUBMIT',
            self::STATUS_CLOSE => 'CLOSE',
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
            self::STATUS_SUBMIT => array(self::STATUS_CLOSE, self::STATUS_ARCHIEVE),
            self::STATUS_CLOSE => array(self::STATUS_ARCHIEVE),
            self::STATUS_ARCHIEVE => array(),
        );
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