<?php

/**
 * This is the model class for table "{{ActivationCode}}".
 *
 * The followings are the available columns in table '{{ActivationCode}}':
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
class ActivationCode extends CActiveRecord {
	/**
	 *
	 * @return string the associated database table name
	 */
	public function tableName() {
		return '{{activation_code}}';
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
						'activation_code, imsi_no',
						'required' 
				),

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
		return array ();
	}
	
	
	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 *
	 * @param string $className
	 *        	active record class name.
	 * @return ActivationCode the static model class
	 */
	public static function model($className = __CLASS__) {
		return parent::model ( $className );
	}
	

}
