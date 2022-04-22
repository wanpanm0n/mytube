<?php

class ReportController extends Controller
{
		public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array(),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','view','create','update','admin','delete'),
				'users'=>array('@'),
				//'expression' => '$user->checkAccess()',
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('*'),
				'users'=>array('@'),
				'expression' => '$user->isAdmin()',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}


	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionLanguagepreference()
	{
		$languages = Language::model()->findAll();

		$rows =array(array("id"=> "", "name"=> "Select Language"));

		foreach($languages as $language):
			
			$rows[] =array("id"=> $language->id, "name"=> $language->name);
		endforeach;

		$rows = json_encode($rows);

		$this->render('languagepreference',array('languages'=>$rows));
	}

	public function actionBrowsingpreference()
	{	
		$actions  = json_encode(array( array("id"=>"" , "name"=> "Select Feature"),array("id"=>1 , "name"=> "Promotion"),array("id"=>2 , "name"=> "News"),array("id"=>3 , "name"=> "Video")));
		$this->render('browsingpreference',array('browingActions'=>$actions));
	}

	public function actionActivecustomer()
	{	
		$this->render('activecustomer');
	}

	public function actionSubscribers()
	{	
		$this->render('subscribers');
	}




	public function actionGetBrowsingpreference(){

		header ('Content-Type: application/json' );
	
		
		if(isset($_POST)):

			$service = empty($_POST["service_id"]) ? "" :  " and tal.service_id=".$_POST["service_id"]."";
$sql="";
			if($_POST["report_type"] == "1"):

				$sql = "	

				select convert(created_date,date) as Date , 
				count(distinct sim_users_id) as unique_user,
				count(case when service_id = 1 THEN 1 END) Promotion,
				count(case when service_id = 2 THEN 1 END) News,
				count(case when service_id = 3 THEN 1 END) Video,
				count(1) as Total_txn

				from tbl_action_log 


				where service_id in (1,2,3) and convert(created_date,date) between '".$_POST["from_date"]."' and '".$_POST["to_date"]."' group by convert(created_date,date)  order by created_date;
				
				
				";

			else:			

				$sql = "					

				select  imsi.name as customer_name,imsi.mobile_no,tal.created_date, case when service_id = 1 then 'Promotion' when service_id = 2 then 'News' when service_id = 3 then 'Video' end as service
				from tbl_action_log tal
				inner join tbl_sim_users tsu  on tal.sim_users_id = tsu.id
				inner join tbl_imsi imsi on imsi.imsi_no = tsu.device_id and imsi.mobile_no =tsu.sim_no
				where (service_id = 1 or service_id = 2 or service_id = 3) 
				and convert(tal.created_date,date) between '".$_POST["from_date"]."' and '".$_POST["to_date"]."' ".$service." group by tal.service_id,imsi.name,tal.created_date";
		
			
			endif;

			$result = Yii::app()->db->createCommand($sql)->queryAll();
			echo json_encode($result); 
		else:
			echo json_encode(array());
		endif;	

	}


		public function actionGetlanguagepreference() {

		header ('Content-Type: application/json' );
	
		
		if(isset($_POST)):

			$language = empty($_POST["language_id"]) ? "" :  " and tl.id=".$_POST["language_id"]."";
$sql="";
			if($_POST["report_type"] == "1"):

				$sql = "


select 

convert(tsu.created_date,date) as date,
count(case when tl.id = 1 THEN 1 END) Nepali,
count(case when tl.id = 2 THEN 1 END) Bangladeshi,
count(case when tl.id = 3 THEN 1 END) Indian,
count(case when tl.id = 4 THEN 1 END) Indonesian,
count(case when tl.id = 5 THEN 1 END) Malaysian,
count(case when tl.id = 6 THEN 1 END) Tamil,
count(case when tl.id = 7 THEN 1 END) English,
count(1) as Total

 from tbl_language tl 
left join tbl_sim_users tsu  on tsu.language_id = tl.id 
inner join tbl_imsi imsi on imsi.mobile_no = tsu.sim_no
where tsu.sim_no != '' and convert(tsu.created_date,date) between '".$_POST["from_date"]."' and '".$_POST["to_date"]."'
group by convert(tsu.created_date,date) order by tsu.created_date


				";

			else:			

				$sql = "				
				
				SELECT tsu.sim_no,imsi.name as customer_name,tl.name as prefered_language,convert(tsu.created_date,date) as created_date FROM tbl_sim_users tsu 
				inner join tbl_language tl on tsu.language_id = tl.id
				inner join tbl_imsi imsi on  imsi.mobile_no =tsu.sim_no
				where  convert(tsu.created_date,date) between '".$_POST["from_date"]."' and '".$_POST["to_date"]."' and sim_no != '' ".$language."
				group by tl.id,tl.name,tsu.sim_no
				order by tsu.id;";

	

			endif;

			$result = Yii::app()->db->createCommand($sql)->queryAll();
			echo json_encode($result); 
		else:
			echo json_encode(array());
		endif;	

	}




		public function actionGetactivecustomerbyday() {

		header ('Content-Type: application/json' );
	
		
		if(isset($_POST)):

			
$sql="";
			if($_POST["report_type"] == "1"):

				$sql = "

				select count(distinct sim_users_id) as Unique_user , count(*) as Total_Txn, convert(created_date,date) as Date from tbl_action_log tal 
				where convert(tal.created_date,date) between '".$_POST["from_date"]."' and '".$_POST["to_date"]."'
				group by convert(created_date,date) 			
 
				";


			else:			

				$sql = "				
				
				select imsi.name as customer_name, imsi.mobile_no,tal.created_date  from tbl_action_log  tal
inner join tbl_sim_users tsu on tsu.id = tal.sim_users_id
inner join tbl_imsi imsi on imsi.imsi_no = tsu.device_id and imsi.mobile_no =tsu.sim_no where  convert(tal.created_date,date) between '".$_POST["from_date"]."' and '".$_POST["to_date"]."' group by imsi.name,tal.created_date";
			
			
			endif;

			$result = Yii::app()->db->createCommand($sql)->queryAll();
			echo json_encode($result); 
		else:
			echo json_encode(array());
		endif;	

	}

	public function actionGetactivecustomerbyhour() {

		header ('Content-Type: application/json' );
	
		
		if(isset($_POST)):

			
$sql="";
	$from_date = $_POST["from_date"]." ".$_POST["from_time"];
			$to_date = $_POST["to_date"]." ".$_POST["to_time"];

			if($_POST["report_type"] == "1"):

		
			/*	$sql = "


				select count(distinct sim_users_id) as unique_user,frequency,count(frequency) as Total_Txn,created_date from (select created_date,
case 
when convert(created_date,time) >= '00:00' && convert(created_date,time) < '01:00' then '12:00 AM - 01:00 AM' 
when convert(created_date,time) >= '01:00' && convert(created_date,time) < '02:00' then '01:00 AM - 02:00 AM' 
when convert(created_date,time) >= '02:00' && convert(created_date,time) < '03:00' then '02:00 AM - 03:00 AM' 
when convert(created_date,time) >= '03:00' && convert(created_date,time) < '04:00' then '03:00 AM - 04:00 AM' 
when convert(created_date,time) >= '04:00' && convert(created_date,time) < '05:00' then '04:00 AM - 05:00 AM' 
when convert(created_date,time) >= '05:00' && convert(created_date,time) < '06:00' then '05:00 AM - 06:00 AM' 
when convert(created_date,time) >= '06:00' && convert(created_date,time) < '07:00' then '06:00 AM - 07:00 AM' 
when convert(created_date,time) >= '07:00' && convert(created_date,time) < '08:00' then '07:00 AM - 08:00 AM' 
when convert(created_date,time) >= '08:00' && convert(created_date,time) < '09:00' then '08:00 AM - 09:00 AM' 
when convert(created_date,time) >= '09:00' && convert(created_date,time) < '10:00' then '09:00 AM - 10:00 AM' 
when convert(created_date,time) >= '10:00' && convert(created_date,time) < '11:00' then '10:00 AM - 11:00 AM' 
when convert(created_date,time) >= '11:00' && convert(created_date,time) < '12:00' then '11:00 AM - 12:00 PM'

when convert(created_date,time) >= '12:00' && convert(created_date,time) < '13:00' then '12:00 PM - 01:00 PM' 
when convert(created_date,time) >= '13:00' && convert(created_date,time) < '14:00' then '01:00 PM - 02:00 PM' 
when convert(created_date,time) >= '14:00' && convert(created_date,time) < '15:00' then '02:00 PM - 03:00 PM' 
when convert(created_date,time) >= '15:00' && convert(created_date,time) < '16:00' then '03:00 PM - 04:00 PM' 
when convert(created_date,time) >= '16:00' && convert(created_date,time) < '17:00' then '04:00 PM - 05:00 PM' 
when convert(created_date,time) >= '17:00' && convert(created_date,time) < '18:00' then '05:00 PM - 06:00 PM' 
when convert(created_date,time) >= '18:00' && convert(created_date,time) < '19:00' then '06:00 PM - 07:00 PM' 
when convert(created_date,time) >= '19:00' && convert(created_date,time) < '20:00' then '07:00 PM - 08:00 PM' 
when convert(created_date,time) >= '20:00' && convert(created_date,time) < '21:00' then '08:00 PM - 09:00 PM' 
when convert(created_date,time) >= '21:00' && convert(created_date,time) < '22:00' then '09:00 PM - 10:00 PM' 
when convert(created_date,time) >= '22:00' && convert(created_date,time) < '23:00' then '10:00 PM - 11:00 PM' 
when convert(created_date,time) >= '23:00' && convert(created_date,time) < '24:00' then '11:00 PM - 12:00 PM' 
end as frequency, sim_users_id from tbl_action_log where convert(created_date,date) between '".$_POST["from_date"]."' and '".$_POST["to_date"]."') c group by frequency order by created_date asc
				

				";*/

				$sql ="SELECT count(distinct sim_users_id) as unique_user, name as frequency, count(1) as Total_Txn FROM tbl_time_frequency ttf
inner  join tbl_action_log tbl on 
convert(tbl.created_date,time) >= ttf.start_time && convert(tbl.created_date,time) < ttf.end_time

where convert(created_date,date) between '".$_POST["from_date"]."' and '".$_POST["to_date"]."' group by ttf.name order by ttf.id";


			else:			

				$sql = "				
				
				select imsi.name as customer_name, imsi.mobile_no,tal.created_date  from tbl_action_log  tal
inner join tbl_sim_users tsu on tsu.id = tal.sim_users_id
inner join tbl_imsi imsi on imsi.imsi_no = tsu.device_id and imsi.mobile_no =tsu.sim_no where 
 tal.created_date between '".$from_date."' and '".$to_date."'
  group by imsi.name,tal.created_date";
			
			
			endif;

			$result = Yii::app()->db->createCommand($sql)->queryAll();
			echo json_encode($result); 
		else:
			echo json_encode(array());
		endif;	

	}


			public function actionGetsubscribers() {

		header ('Content-Type: application/json' );
	
		
		if(isset($_POST)):

			
$sql="";
			if($_POST["report_type"] == "1"):

				$sql = "SELECT convert(tsu.created_date,date) as created_date ,count(1) as subscribers FROM tbl_sim_users tsu 
				inner join tbl_language tl on tsu.language_id = tl.id
				inner join tbl_imsi imsi on imsi.imsi_no = tsu.device_id and imsi.mobile_no =tsu.sim_no
				where  convert(tsu.created_date,date) between '".$_POST["from_date"]."' and '".$_POST["to_date"]."' and sim_no != '' group by convert(tsu.created_date,date)
				
				";

			else:			

				$sql = "				
				
				SELECT tsu.sim_no,imsi.name as customer_name, convert(tsu.created_date,date) as created_date FROM tbl_sim_users tsu 			
				inner join tbl_imsi imsi on imsi.imsi_no = tsu.device_id and imsi.mobile_no =tsu.sim_no
				where  convert(tsu.created_date,date) between '".$_POST["from_date"]."' and '".$_POST["to_date"]."' and sim_no != '' order by tsu.id;";
			endif;

			$result = Yii::app()->db->createCommand($sql)->queryAll();
			echo json_encode($result); 
		else:
			echo json_encode(array());
		endif;	

	}


	public function actionExportexcel(){

		$filename = $_POST["FileName"];

		header("Content-Type: application/xls");    
		header("Content-Disposition: attachment; filename=$filename.xls");  
		header("Pragma: no-cache"); 
		header("Expires: 0");
		echo $_POST["Content"];
	}


	
	}