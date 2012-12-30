<?php

/**
 * This is the model class for table "proposal_comment".
 *
 * The followings are the available columns in table 'proposal_comment':
 * @property integer $id
 * @property string $comment
 * @property string $created
 * @property string $updated
 * @property integer $proposal_id
 * @property integer $user_id
 *
 * The followings are the available model relations:
 * @property Proposal $proposal
 * @property User $user
 */
class ProposalComment extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ProposalComment the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'proposal_comment';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('proposal_id, user_id', 'required'),
            array('proposal_id, user_id', 'numerical', 'integerOnly' => true),
            array('comment, created, updated', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, comment, created, updated, proposal_id, user_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'proposal' => array(self::BELONGS_TO, 'Proposal', 'proposal_id'),
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'comment' => 'Comment',
            'created' => 'Created',
            'updated' => 'Updated',
            'proposal_id' => 'Proposal',
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
        $criteria->compare('comment', $this->comment, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('updated', $this->updated, true);
        $criteria->compare('proposal_id', $this->proposal_id);
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