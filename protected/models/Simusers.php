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
class Simusers extends CActiveRecord {
	/**
	 *
	 * @return string the associated database table name
	 */
	public function tableName() {
		return '{{sim_users}}';
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
						'sim_no,device_id',
						'required' 
				),

				array('image', 'file','types'=>'jpg, gif, png', 'allowEmpty'=>true, 'on'=>'insert'),
			
				array (
						'sim_no,device_id,activation_code,image',
						'length',
						'max' => 256 
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
			
				
				// The following rule is used by search().
				// @todo Please remove those attributes that should not be searched.
				array (
						'id, sim_no,device_id,is_active,created_date',
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
		return array (
				'id' => 'ID',
				'sim_no' => 'Sim No',	
				'device_id' => 'Device Id',		
				'is_active' => 'Is Active',		
				'activation_code' => 'Activation Code',			
				'created_date' => 'Created Date'
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
		$criteria->compare ( 'id', $this->id );
		$criteria->compare ( 'sim_no', $this->sim_no, true );
		$criteria->compare ( 'device_id', $this->device_id, true );
		$criteria->compare ( 'is_active', $this->is_active, true );
		$criteria->compare ( 'activation_code', $this->activation_code, true );
		$criteria->compare ( 'created_date', $this->created_date, true );		
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
	

	
// 	public function deleteRelatedRecords($id){
// 		$status = $C
// 	}
}
