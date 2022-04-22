<?php

/**
 * This is the model class for table "{{content}}".
 *
 * The followings are the available columns in table '{{content}}':
 * @property integer $id
 * @property string $title
 * @property string $title_unicode
 * @property string $link
 * @property string $description
 * @property string $image
 * @property string $duration
 * @property string $cast
 * @property integer $user_id
 * @property integer $language_id
 * @property integer $category_id
 * @property string $created_date
 * @property string $modified_date
 * @property integer $delete_status
 *
 * The followings are the available model relations:
 * @property Language $language
 * @property Category $category
 * @property Users $user
 */
class Promotion extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{promotion}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		
		return array(
			array('company, from_date, to_date, is_active, image,language_id,display_order,language_ids', 'required'),			
			array('language_id,display_order', 'numerical', 'integerOnly'=>true),
			array('company,image', 'length', 'max'=>255, 'on'=>'insert, update'),			
			array('image', 'file','types'=>'jpg, gif, png', 'allowEmpty'=>false, 'on'=>'insert'),		
			array('id,company, from_date, to_date', 'safe', 'on'=>'search'),
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
			'language' => array(self::BELONGS_TO, 'Language', 'language_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'company' => 'Company',
			'image' => 'Image',
			'from_date' => 'From Date',
			'to_date' => 'To Date',
			'is_active' => "Is Active",
			'display_order' => "Display Order",
			'language_ids' => "Choose Language",
			

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

		//$criteria->compare('id',$this->id);
		$criteria->compare('company',$this->company,true);
		$criteria->compare('from_date',$this->from_date,true);
		$criteria->compare('to_date',$this->to_date,true);	

		$criteria->order = 'id desc';

		return new CActiveDataProvider($this, array('criteria'=>$criteria,'pagination' => array('pageSize' => 30, 
				),
		));
	} 

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return News the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
}
