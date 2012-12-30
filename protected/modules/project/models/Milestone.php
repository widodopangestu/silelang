<?php

/**
 * This is the model class for table "milestone".
 *
 * The followings are the available columns in table 'milestone':
 * @property integer $id
 * @property string $name
 * @property string $document
 * @property string $start_date
 * @property string $end_date
 * @property string $actual_start_date
 * @property string $actual_end_date
 * @property integer $percentage
 * @property string $created
 * @property string $updated
 * @property integer $project_id
 *
 * The followings are the available model relations:
 * @property Project $project
 */
class Milestone extends CActiveRecord {

    public $file;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Milestone the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'milestone';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('project_id', 'required'),
            array('percentage, project_id', 'numerical', 'integerOnly' => true),
            array('name, document', 'length', 'max' => 255),
            array('file_name', 'length', 'max' => 45),
            array('start_date, end_date, actual_start_date, actual_end_date, created, updated', 'safe'),
            array('file', 'file', 'types' => 'pdf', 'allowEmpty' => true), array(
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
            array('id, name, document, file_name, start_date, end_date, actual_start_date, actual_end_date, percentage, created, updated, project_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'completionDocuments' => array(self::HAS_MANY, 'CompletionDocument', 'milestone_id'),
            'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'document' => 'Document',
            'file_name' => 'File Name',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'actual_start_date' => 'Actual Start Date',
            'actual_end_date' => 'Actual End Date',
            'percentage' => 'Percentage',
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
        $criteria->compare('name', $this->name, true);
        $criteria->compare('document', $this->document, true);
        $criteria->compare('file_name', $this->file_name, true);
        $criteria->compare('start_date', $this->start_date, true);
        $criteria->compare('end_date', $this->end_date, true);
        $criteria->compare('actual_start_date', $this->actual_start_date, true);
        $criteria->compare('actual_end_date', $this->actual_end_date, true);
        $criteria->compare('percentage', $this->percentage);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('updated', $this->updated, true);
        $criteria->compare('project_id', $this->project_id);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public function getProjectOptions() {
        return CHtml::listData(Project::model()->findAll(), 'id', 'name');
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

    protected function afterSave() {
        parent::afterSave();
        if ($this->percentage == 0) {
            $this->project->actual_start_date = $this->actual_start_date;
            $this->project->save();
        } else if ($this->percentage == 100) {
            $this->project->actual_end_date = $this->actual_end_date;
            $this->project->save();
        }
    }

}