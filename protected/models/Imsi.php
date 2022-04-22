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
class Imsi extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{imsi}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('imsi_no,mobile_no', 'required')	);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array();
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array();
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return IntErnetsErvice the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

