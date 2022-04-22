<?php

class PushnotificationController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
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
				'users'=>array('@'),
				'expression' => '$user->isAdmin()',
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','view','create','update','admin','delete','send'),
				'users'=>array('@'),
				'expression' => '$user->isAdmin()',
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

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array('model'=>$this->loadModel($id)));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new PushNotification;



		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['PushNotification']))
		{
			
			$model->attributes=$_POST['PushNotification'];
			
			if($model->save()){
				
				$this->redirect("/pushnotification");
			}
		}

		$this->render('create',array('model'=>$model,));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PushNotification']))
		{
			
			$model->attributes=$_POST['PushNotification'];
		

			if($model->validate() && $model->save()){
			
				$this->redirect("/pushnotification");
			}
			
		}

		$this->render('update',array('model'=>$model));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete()
	{
		$model=PushNotification::model()->findByPk($_POST["Id"]);

		header("Content-type: application/json"); 

		$num = $model->delete();		
		$json = json_encode(array("success"=> $num > 0));
		echo $json;
		
	}

	/**
	 * Lists all models.
	 */

	public function actionSelect(){

	

		$PushNotifications = array();
		$dataReader = Yii::app()->db->createCommand( 'SELECT * FROM tbl_push_notification' )->queryAll();
		foreach( $dataReader as $row ) :
			$PushNotification = array();
			$PushNotification["Id"] =$row["id"];
				$PushNotification["Title"] = $row['title'];
			$PushNotification["Message"] = $row['message'];
			$PushNotification["CreatedDate"] = $row['created_date'];  
	
			array_push($PushNotifications, $PushNotification);
			unset( $PushNotification );
		endforeach;

		header("Content-type: application/json"); 
		$json = json_encode($PushNotifications);
		echo $json;

		 
	}
	public function actionIndex()
	{
		$model = new PushNotification('search');
   	 	$model->unsetAttributes();  // clear any default values

    	if(isset($_GET['PushNotification']))
        	$model->attributes=$_GET['PushNotification'];

		$this->render('index',array('dataProvider'=>$model->search(),'model'=>$model));
		Yii::app()->clientScript->registerScriptFile('script_file_2.js', CClientScript::POS_END); 
	}

	public function actionAdmin()
	{
		Yii::app()->clientScript->registerScriptFile('script_file_2.js', CClientScript::POS_END);

		$model=new PushNotification('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PushNotification']))
			$model->attributes=$_GET['PushNotification'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return PushNotification the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=PushNotification::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param PushNotification $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='content-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}


    public function actionSend(){
        
		$model = PushNotification::model()->findByPk($_POST["Id"]);

		$criteria = new CDbCriteria;
		$criteria->condition = 'is_expire=:is_expire';
		$criteria->params = array(':is_expire' => 0);
		$devices = Device::model()->findAll($criteria);	

		$deviceIds = array();
		$imsiIds = array();

		foreach($devices as $device):
			array_push($deviceIds,$device->device_id);
			array_push($imsiIds,$device->imsi_id);
		endforeach;

		if(count($deviceIds)== 0):
			header("Content-type: application/json"); 
			$json = json_encode(array("succes"=> false,"message"=>"No device to send."));
			echo $json;
			die();
		endif; 

	

		$fields = array(
		'registration_ids' => $deviceIds,		
		'data' => array(
		"message" =>  $model->message,
		"id" => $model->title, 
		),
		); 

	

		$response = $this->sendPushNotification($fields);

		$notification = json_encode(array("title"=>$model->title,"body"=>$model->message));

		if(strpos(strtolower($response), '"success":0') !== true) :
			$model=new SmsLog;	
			$_POST["SmsLog"] = array("log"=>$response,"notification"=>$notification,"ids"=> json_encode($imsiIds));
			$model->attributes = $_POST["SmsLog"];
			$model->save();	
		endif;

		header ('Content-Type: application/json' );
		echo $response;

		
    }

      // function makes curl request to firebase servers
    private function sendPushNotification($fields) {
         
     
        // Set POST variables
        $url = 'https://fcm.googleapis.com/fcm/send';
 
        $headers = array(
            'Authorization: key=AAAAqmmEEqo:APA91bG2bSPpAl6IUkiAVaGRSJvyFDhxo_TbDGbsU8G_21K_TNlvkjIp6gFGb3e5wrCA7rSUNw_jcsm8-yZuh4VTTxZl2hxgGx1s1GpdMibReCycA6_B9PvF_sc6ZBsOk9kAhQ7jYmNx',
            'Content-Type: application/json'
        );
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);  
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
	
		$result = curl_exec($ch);           
		echo curl_error($ch);
		if ($result === FALSE) {
		die('Curl failed: ' . curl_error($ch));
		}
		curl_close($ch);
		return $result;
    }
}
