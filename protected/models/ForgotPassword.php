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
class ForgotPassword extends CActiveRecord {
	/**
	 *
	 * @return string the associated database table name
	 */
	public function tableName() {
		return '{{forgotpassword}}';
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
						'code, sim_users_id',
						'required' 
				),
				array (
						'created_date',
						'default',
						'value' => new CDbExpression ( 'NOW()' ),
						'setOnEmpty' => false,
						'on' => 'insert' 
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
		return array ();
	}
	
	/**
	 *
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array();
	}
	

	
	
	public static function model($className = __CLASS__) {
		return parent::model ( $className );
	}
	

}
