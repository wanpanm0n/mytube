<?php

/**
 * This is the model class for table "{{sim_serial_no}}".
 *
 * The followings are the available columns in table '{{sim_serial_no}}':
 * @property integer $id
 * @property string $serial_number
 * @property string $created_date
 * @property string $modified_date
 */
class SimSerialNo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{sim_serial_no}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('serial_number', 'required'),
			array('id', 'numerical', 'integerOnly'=>true),
			array('serial_number', 'length', 'max'=>255),
			array('modified_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, serial_number, created_date, modified_date', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'serial_number' => 'Serial Number',
			'created_date' => 'Created Date',
			'modified_date' => 'Modifited Date',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('serial_number',$this->serial_number,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('modified_date',$this->modified_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SimSerialNo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

