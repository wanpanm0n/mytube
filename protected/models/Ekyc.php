<?php
class Ekyc extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{ekyc_details}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_number, full_name, dob, gender, id_type, id_image', 'required'),
			array('nationality, country_of_issue, id_expiry_date, post_code, city, state, street_address, military_number, sector, employer, unique_ref_no,selected_sim_no,delivery_method,delivery_address,delivery_phone','default', 'setOnEmpty'=>true,'value'=>null,'on'=>array('insert','update')),
				array (
						'created_at',
						'default',
						'value' => new CDbExpression ( 'NOW()' ),
						'setOnEmpty' => false,
						'on' => 'insert'
                ),
                array(
						'status',
						'default',
						'value'=>1,
						'on'=>'insert'
				),
		);
	}



	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_number' => 'ID Number',
			'full_name' => 'Fullname',
			'dob' => 'Date of Birth',
			'gender' => 'Gender',
			'id_type' => 'Id Type',
			'id_image' => 'ID Image',
			'nationality' => 'Nationality',
			'country_of_issue' => 'Country of issue',
			'id_expiry_date' => 'ID Expiry Date',
			'post_code' => 'Post Code',
			'city' => 'City',
			'state' => 'State',
			'street_address' => 'Street Address',
			'military_number' => 'Military Number',
			'sector' => 'Sector',
			'employer' => 'Employer',
			'unique_ref_no' => 'Unique referance number',
			
		);
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
