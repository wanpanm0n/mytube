<?php

/**
 * This is the model class for table "{{category}}".
 *
 * The followings are the available columns in table '{{category}}':
 * @property integer $id
 * @property string $name
 * @property integer $language_id
 * @property integer $user_id
 * @property string $icon
 * @property string $created_date
 * @property string $modified_date
 * @property integer $delete_status
 *
 * The followings are the available model relations:
 * @property Language $language
 * @property Users $user
 * @property Content[] $contents
 */
class Category extends CActiveRecord {
	/**
	 *
	 * @return string the associated database table name
	 */
	public function tableName() {
		return '{{category}}';
	}
	
	/**
	 *
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array (
				array (
						'name, language_id, user_id, delete_status, icon',
						'required' 
				),
				array (
						'language_id, user_id',
						'numerical',
						'integerOnly' => true 
				),
				array (
						'name',
						'length',
						'max' => 45 
				),
// 				array (
// 						'created_date, modified_date',
// 						'safe' 
// 				),
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
				array (
						'id, name, language_id, user_id, created_date, modified_date, language_name',
						'safe',
						'on' => 'search' 
				) 
		);
	}
	
	/**
	 *
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array (
				'language' => array (
						self::BELONGS_TO,
						'Language',
						'language_id' 
				),
				'user' => array (
						self::BELONGS_TO,
						'User',
						'user_id' 
				),
				'contents' => array (
						self::HAS_MANY,
						'Content',
						'category_id' 
				) 
		);
	}
	
	/**
	 *
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array (
				'id' => 'ID',
				'name' => 'Name',
				'icon' => 'Icon',
				'language_id' => 'Language',
				'user_id' => 'User',
				'created_date' => 'Created Date',
				'modified_date' => 'Modified Date' 
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
	 *         based on the search/filter conditions.
	 */
	public function search() {
		// @todo Please modify the following code to remove attributes that should not be searched.
		$criteria = new CDbCriteria ();
		$criteria->addInCondition('delete_status', array(0));
		//$criteria->with = array('language');
		$criteria->compare ( 'id', $this->id );
		$criteria->compare ( 'name', $this->name, true );
		$criteria->compare ( 'icon', $this->icon, true );
		$criteria->compare ( 'language_id', $this->language_id );
		//$criteria->compare ( 'language.name', $this->language_name );
		$criteria->compare ( 'user_id', $this->user_id );
		$criteria->compare ( 'created_date', $this->created_date, true );
		$criteria->compare ( 'modified_date', $this->modified_date, true );
		
		return new CActiveDataProvider ( $this, array (
				'criteria' => $criteria,
				'pagination' => array(
						'pageSize' => 30,
				)
		) );
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 *
	 * @param string $className
	 *        	active record class name.
	 * @return Category the static model class
	 */
	public static function model($className = __CLASS__) {
		return parent::model ( $className );
	}
	
	public function getCategories(){
		$language_id = Profile::getLanguageId();
		$user_id = Yii::app()->user->id;
		$categories = Category::model()->findAll('language_id=:param1 and delete_status=0', array(':param1'=>$language_id));
		return $categories;
	}
	
// 	public function deleteRelatedRecords($id){
// 		$status = $C
// 	}
}
