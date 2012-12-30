<?php

/**
 * This is the model class for table "tor_review".
 *
 * The followings are the available columns in table 'tor_review':
 * @property integer $id
 * @property string $review
 * @property string $created
 * @property string $updated
 * @property integer $tor_document_id
 * @property integer $user_id
 *
 * The followings are the available model relations:
 * @property TorDocument $torDocument
 * @property User $user
 */
class TorReview extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return TorReview the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tor_review';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('tor_document_id, user_id', 'required'),
            array('tor_document_id, user_id', 'numerical', 'integerOnly' => true),
            array('review, created, updated', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, review, created, updated, tor_document_id, user_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'torDocument' => array(self::BELONGS_TO, 'TorDocument', 'tor_document_id'),
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
            'tor_document_id' => 'Tor Document',
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
        $criteria->compare('tor_document_id', $this->tor_document_id);
        $criteria->compare('user_id', $this->user_id);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
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