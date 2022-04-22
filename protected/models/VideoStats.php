<?php

/**
 * This is the model class for table "{{video_stats}}".
 *
 * The followings are the available columns in table '{{video_stats}}':
 * @property integer $id
 * @property string $device_id
 * @property string $device_model
 * @property integer $content_id
 * @property string $count
 *
 * The followings are the available model relations:
 * @property Content $content
 */
class VideoStats extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public $count;
	public $from_date;
	public $to_date ;
	public $search_type;

	public function tableName()
	{
		return '{{video_stats}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('device_id, content_id, language_id', 'required'),
			array('device_id, language_id', 'required'),
			//array('count', 'numerical', 'integerOnly'=>true),
			array('device_id, device_model', 'length', 'max'=>255),
			array('phone_number,sim_serial_number', 'safe'),
			array(
						'delete_status',
						'default',
						'value'=>0,
						'on'=>'insert, update'
				),
			array (
						'created_date',
						'default',
						'value' => new CDbExpression ( 'NOW()' ),
						'setOnEmpty' => false,
						'on' => 'insert, update'
				),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, device_id, sim_serial_number, language_id, device_model, from_date, to_date', 'safe', 'on'=>'search'),
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
			//'content' => array(self::BELONGS_TO, 'Content', 'content_id'),
			'language' => array(self::BELONGS_TO, 'Language', 'language_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'device_id' => 'Device ID',
			'language_id'=>'Language',
			'device_model' => 'Device Model',
			'phone_number' => 'Phone Number',
			//'content_id' => 'Views',
			'count' => 'No of Views',
			'sim_serial_number' => 'Sim IMSI Number',
			'language.name' => 'Language'
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

		if($this->search_type == 'total_new_subscibers'){
			$criteria->select = "DISTINCT device_id, device_model, phone_number, sim_serial_number, DATE(created_date) as created_date";
			//$criteria->group  = "sim_serial_number, language_id';
		}else if($this->search_type == 'total_mta'){
			$criteria->select = "DISTINCT device_id, device_model, phone_number, sim_serial_number, DATE(created_date) as created_date";
			$criteria->addCondition("substring(sim_serial_number,1,7)='5021996' OR
			substring(sim_serial_number,1,7)='5021995' OR
			substring(sim_serial_number,1,7)='5021994' OR
			substring(sim_serial_number,1,7)='5021931' OR
			substring(sim_serial_number,1,7)='5021913' OR
			substring(sim_serial_number,1,7)='3021932' OR
			substring(sim_serial_number,1,7)='3021832' OR
			substring(sim_serial_number,1,7)='1320111' OR
			substring(sim_serial_number,1,7)='3021832' OR
			substring(sim_serial_number,1,7)='1000000' OR
			substring(sim_serial_number,1,7)='5021999' OR
			substring(sim_serial_number,1,7)='5021932' OR
			substring(sim_serial_number,1,7)='5021986' OR
			substring(sim_serial_number,1,7)='5021953' OR
			substring(sim_serial_number,1,7)='5021952'");
		}else {
			$criteria->select = 'id,phone_number, language_id, COUNT( * ) AS count, sim_serial_number, created_date';
			$criteria->group  = 'sim_serial_number, language_id';
			$criteria->compare('phone_number',$this->phone_number, true);
			$criteria->compare('sim_serial_number',$this->sim_serial_number, true);
			$criteria->compare('language_id',$this->language_id, true);
			$criteria->addCondition("sim_serial_number <> ''");
		}
		$criteria->order = 'id desc';

		$now = date('Y-m-d');
		$criteria->addBetweenCondition('DATE(created_date)', !empty($this->from_date)? date('Y-m-d', strtotime($this->from_date)):$this->getOldestDate(), !empty($this->to_date)? date('Y-m-d',strtotime($this->to_date)):$now, 'AND');


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
// 			'sort'=>array(
//         		'attributes'=>array(
//              		'id'//'phone_number', 'language_id', 'count',
//        			),
//     		),
    		'pagination'=>array(
        		'pageSize'=>100
   	 		),
		));
	}

	public function getOldestDate(){
		$data = VideoStats::model()->findBySql("select created_date from tbl_video_stats where sim_serial_number <> '' order by created_date asc limit 1");
		if(!empty($data->created_date))
			return  date('Y-m-d', strtotime($data->created_date));
		else
			return date('Y-m-d');
		//echo $data->created_date;
		//die();
		//echo "<pre>";
		//print_r($data);
		//die();
	}

	public function getAllData(){
		$criteria=new CDbCriteria;
		$criteria->select = 'id,phone_number, language_id, COUNT( * ) AS count, sim_serial_number';
		$criteria->group  = 'sim_serial_number, language_id';
		$criteria->addCondition("sim_serial_number <> ''");
		$result = $this->findAll($criteria);
		return $result;
	}


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VideoStats the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
//SELECT COUNT(DISTINCT language_id) AS TotalRows, phone_number, language_id
//FROM tbl_video_stats group by phone_numbera
/*
SELECT DISTINCT (
phone_number
), COUNT( DISTINCT language_id ) AS count, language_id
FROM tbl_video_stats
GROUP BY language_id
LIMIT 0 , 30
*/
