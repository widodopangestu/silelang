<?php

/**
 * This is the model class for table "organization".
 *
 * The followings are the available columns in table 'organization':
 * @property integer $id
 * @property string $name
 * @property integer $is_vendor
 * @property string $created
 * @property string $updated
 * @property integer $major_id
 *
 * The followings are the available model relations:
 * @property InvoiceDocument[] $invoiceDocuments
 * @property Major $major
 * @property Project[] $projects
 * @property User[] $users
 */
class Organization extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Organization the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'organization';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('major_id', 'required'),
            array('is_vendor, major_id', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 255),
            array('created, updated', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, is_vendor, created, updated, major_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'invoiceDocuments' => array(self::HAS_MANY, 'InvoiceDocument', 'organization_id'),
            'major' => array(self::BELONGS_TO, 'Major', 'major_id'),
            'projects' => array(self::HAS_MANY, 'Project', 'organization_id'),
            'users' => array(self::HAS_MANY, 'User', 'organization_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'is_vendor' => 'Is Vendor',
            'created' => 'Created',
            'updated' => 'Updated',
            'major_id' => 'Major',
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
        $criteria->compare('is_vendor', $this->is_vendor);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('updated', $this->updated, true);
        $criteria->compare('major_id', $this->major_id);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public function getMajorOptions() {
        return CHtml::listData(Major::model()->findAll(), 'id', 'name');
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