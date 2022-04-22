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
class Mtabranch extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{mta_branch}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name,address,latitude,longitude,is_active', 'required'),
			array('id,price,isactive', 'numerical', 'integerOnly'=>true),
			array('name,address', 'length', 'max'=>255),
	
			array('id, name, address, is_active', 'safe', 'on'=>'search')
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
			'name' => 'Name',
			'address' => 'Address',
            'phone' => 'Phone',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'is_active' => 'Is Active',
			
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
        $criteria->compare('name',$this->name,true);
        $criteria->compare('address',$this->address,true);
        $criteria->compare('phone',$this->phone,true);
        $criteria->compare('latitude',$this->latitude,true);
        $criteria->compare('longitude',$this->longitude,true);
        $criteria->compare('is_active',$this->is_active,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
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

