<?php

/**
 * This is the model class for table "invoice_review".
 *
 * The followings are the available columns in table 'invoice_review':
 * @property integer $id
 * @property string $review
 * @property string $created
 * @property string $updated
 * @property integer $invoice_document_id
 * @property integer $user_id
 *
 * The followings are the available model relations:
 * @property InvoiceDocument $invoiceDocument
 * @property User $user
 */
class InvoiceReview extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return InvoiceReview the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'invoice_review';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('invoice_document_id, user_id', 'required'),
            array('invoice_document_id, user_id', 'numerical', 'integerOnly' => true),
            array('review, created, updated', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, review, created, updated, invoice_document_id, user_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'invoiceDocument' => array(self::BELONGS_TO, 'InvoiceDocument', 'invoice_document_id'),
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'review' => 'Review',
            'created' => 'Created',
            'updated' => 'Updated',
            'invoice_document_id' => 'Invoice Document',
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
        $criteria->compare('review', $this->review, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('updated', $this->updated, true);
        $criteria->compare('invoice_document_id', $this->invoice_document_id);
        $criteria->compare('user_id', $this->user_id);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public function getTerminOptions() {
        return CHtml::listData(Termin::model()->findAll(), 'id', 'name');
    }

    public function getOrganizationOptions() {
        return CHtml::listData(Organization::model()->findAll(), 'id', 'name');
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