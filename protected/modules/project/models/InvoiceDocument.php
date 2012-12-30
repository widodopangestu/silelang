<?php

/**
 * This is the model class for table "invoice_document".
 *
 * The followings are the available columns in table 'invoice_document':
 * @property integer $id
 * @property string $document
 * @property string $status
 * @property string $created
 * @property string $updated
 * @property integer $termin_id
 * @property integer $organization_id
 *
 * The followings are the available model relations:
 * @property Organization $organization
 * @property Termin $termin
 * @property InvoiceReview[] $invoiceReviews
 */
class InvoiceDocument extends CActiveRecord {

    public $file;

    const STATUS_DRAFT = 'DRFT';
    const STATUS_SUBMIT = 'SBMT';
    const STATUS_ACCEPT = 'ACPT';
    const STATUS_REJECT = 'RJCT';
    const STATUS_ARCHIEVE = 'ACHV';

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return InvoiceDocument the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'invoice_document';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('termin_id, organization_id', 'required'),
            array('termin_id, organization_id', 'numerical', 'integerOnly' => true),
            array('document', 'length', 'max' => 45),
            array('status', 'length', 'max' => 10),
            array('created, updated', 'safe'),
            array('file', 'file', 'types' => 'pdf', 'allowEmpty' => true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, document, status, created, updated, termin_id, organization_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'organization' => array(self::BELONGS_TO, 'Organization', 'organization_id'),
            'termin' => array(self::BELONGS_TO, 'Termin', 'termin_id'),
            'invoiceReviews' => array(self::HAS_MANY, 'InvoiceReview', 'invoice_document_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'document' => 'Document',
            'status' => 'Status',
            'created' => 'Created',
            'updated' => 'Updated',
            'termin_id' => 'Termin',
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
        $criteria->compare('document', $this->document, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('updated', $this->updated, true);
        $criteria->compare('termin_id', $this->termin_id);
        $criteria->compare('organization_id', $this->organization_id);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    /**
     * Change status
     */
    public function changeStatus($status) {
        $this->status = $status;
        return $this->save();
    }

    public function getStatusOptions() {
        return array(
            self::STATUS_DRAFT => 'DRAFT',
            self::STATUS_SUBMIT => 'SUBMIT',
            self::STATUS_ACCEPT => 'ACCEPT',
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
            self::STATUS_SUBMIT => array(self::STATUS_ACCEPT, self::STATUS_REJECT),
            self::STATUS_ACCEPT => array(self::STATUS_REJECT),
            self::STATUS_REJECT => array(),
            self::STATUS_ARCHIEVE => array(),
        );
    }

    /**
     * Adds a invoiceReview to this issue
     */
    public function addInvoiceReview($invoiceReview) {
        $invoiceReview->invoice_document_id = $this->id;
        return $invoiceReview->save();
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