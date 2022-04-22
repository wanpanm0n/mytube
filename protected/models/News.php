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
class News extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{news}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, title_unicode, user_id, language_id, link, delete_status', 'required'),
			array('user_id, language_id', 'numerical', 'integerOnly'=>true),
			array('title, title_unicode, image', 'length', 'max'=>255, 'on'=>'insert, update'),
			//array('image', 'file','types'=>'jpg, gif, png', 'allowEmpty'=>true, 'on'=>'update'),
			array('image', 'file','types'=>'jpg, gif, png', 'allowEmpty'=>false, 'on'=>'insert'),
			array('link', 'url', 'defaultScheme' => 'http'),
			//array('duration', 'length', 'max'=>45),
			//array('description, cast', 'safe'),
			//array('description, created_date, modified_date', 'safe'),
				array (
						'created_date',
						'default',
						'value' => new CDbExpression ( 'NOW()' ),
						'setOnEmpty' => false,
						'on' => 'insert'
				),
				array (
						'modified_date',
						'default',
						'value' => new CDbExpression ( 'NOW()' ),
						'setOnEmpty' => false,
						'on' => 'insert, update'
				),
				array(
						'delete_status',
						'default',
						'value'=>0,
						'on'=>'insert'
				),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, title_unicode, 
			
				image, 
			
				user_id, language_id, created_date, modified_date', 'safe', 'on'=>'search'),
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
			//'category' => array(self::BELONGS_TO, 'Category', 'category_id'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'title_unicode' => 'Title (Unicode)',
			'link' => 'Link',
			//'description' => 'Description',
			'image' => 'Image',
			//'duration' => 'Duration (Minutes)',
			//'cast' => 'Cast',
			'user_id' => 'User',
			'language_id' => 'Language',
			//'category_id' => 'Category',
			'created_date' => 'Created Date',
			'modified_date' => 'Modified Date',
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
		$criteria->addInCondition('user_id',array(Yii::app()->user->id));
		$criteria->addInCondition('language_id',array(Profile::getLanguageId()));
		$criteria->addInCondition('delete_status', array(0));
		//$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('title_unicode',$this->title_unicode,true);
		//$criteria->compare('description',$this->description,true);
		//$criteria->compare('image',$this->image,true);
		//$criteria->compare('duration',$this->duration,true);
		//$criteria->compare('user_id',$this->user_id);
		//$criteria->compare('language_id',$this->language_id);
		//$criteria->compare('category_id',$this->category_id);
		$criteria->compare('created_date',$this->created_date,true);
		//$criteria->compare('modified_date',$this->modified_date,true);
		$criteria->order = 'id desc';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
				'pagination' => array(
						'pageSize' => 30, 
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
