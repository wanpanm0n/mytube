<?php

/**
 * This is the model class for table "{{Device}}".
 *
 * The followings are the available columns in table '{{Device}}':
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
class Device extends CActiveRecord {
	/**
	 *
	 * @return string the associated database table name
	 */
	public function tableName() {
		return '{{device}}';
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
						'device_id,imsi_id',
						'required' 
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
		
				array(
						'is_expire',
						'default',
						'value'=>0,
						'on'=>'insert'
				),
				
				// The following rule is used by search().
				// @todo Please remove those attributes that should not be searched.
				array (
						'id, device_id, imsi_id',
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

	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 *
	 * @param string $className
	 *        	active record class name.
	 * @return Device the static model class
	 */
	public static function model($className = __CLASS__) {
		return parent::model ( $className );
	}

}
