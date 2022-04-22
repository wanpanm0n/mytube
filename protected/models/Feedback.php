<?php

/**
 * This is the model class for table "{{feedback}}".
 *
 * The followings are the available columns in table '{{feedback}}':
 * @property integer $id
 * @property string $feedback
 * @property string $feedback_date
 * @property string $feedback_user_email
 * @property string $device_model
 * @property integer $language_id
 * @property integer $status
 * @property integer $delete_status
 *
 * The followings are the available model relations:
 * @property Language $language
 */
class Feedback extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{feedback}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('feedback, feedback_date, language_id, device_model', 'required'),
			array('language_id, status', 'numerical', 'integerOnly'=>true),
			array('feedback_user_email', 'safe'),
			array('feedback_user_email', 'length', 'max'=>255),
				array(
						'delete_status',
						'default',
						'value'=>0,
						'on'=>'insert'
				),
				array(
						'status',
						'default',
						'value'=>1,
						'on'=>'insert'
				),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, feedback, feedback_date, feedback_user_email, language_id, status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'language' => array(self::BELONGS_TO, 'Language', 'language_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'feedback' => 'Feedback',
			'feedback_date' => 'Feedback Date',
			'feedback_user_email' => 'Feedback User Email',
			'device_model'=>'Device Model',
			'language_id' => 'Language',
			'status' => 'Status',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$criteria->addInCondition('language_id',array(Profile::getLanguageId()));
		$criteria->addInCondition('delete_status', array(0));
		$criteria->compare('id',$this->id);
		$criteria->compare('feedback',$this->feedback,true);
		$criteria->compare('feedback_date',$this->feedback_date,true);
		$criteria->compare('feedback_user_email',$this->feedback_user_email,true);
		$criteria->compare('language_id',$this->language_id);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
				'pagination' => array(
						'pageSize' => 30,
				)
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Feedback the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
