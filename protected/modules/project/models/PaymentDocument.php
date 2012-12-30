<?php

/**
 * This is the model class for table "payment_document".
 *
 * The followings are the available columns in table 'payment_document':
 * @property integer $id
 * @property string $document
 * @property string $timestamp
 * @property string $created
 * @property string $updated
 * @property integer $user_id
 * @property integer $termin_id
 *
 * The followings are the available model relations:
 * @property Termin $termin
 * @property User $user
 */
class PaymentDocument extends CActiveRecord {

    public $file;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return PaymentDocument the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'payment_document';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id, termin_id', 'required'),
            array('user_id, termin_id', 'numerical', 'integerOnly' => true),
            array('document', 'length', 'max' => 45),
            array('timestamp, created, updated', 'safe'),
            array('file', 'file', 'types' => 'pdf', 'allowEmpty' => true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, document, timestamp, created, updated, user_id, termin_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'termin' => array(self::BELONGS_TO, 'Termin', 'termin_id'),
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'document' => 'Document',
            'timestamp' => 'Timestamp',
            'created' => 'Created',
            'updated' => 'Updated',
            'user_id' => 'User',
            'termin_id' => 'Termin',
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
        $criteria->compare('timestamp', $this->timestamp, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('updated', $this->updated, true);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('termin_id', $this->termin_id);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public function getUserOptions() {
        return CHtml::listData(User::model()->findAll(), 'id', 'username');
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