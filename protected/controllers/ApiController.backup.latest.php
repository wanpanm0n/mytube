<?php
class ApiController extends Controller {
	private $data = array();
	private $appKey ='$1$prCdygma$SR.CpTzszj.ImSeBrgrMy/';
	private $actionName = "";
	private $encrytionKey = "";
	private $authenticateActions = array("service",
	"getpasscode","changepasscode","currentplan","passcode","currentdetail","contents","changelanguage","preferedlanguage",
	"news","profileimage","promotion","promotionnew","countries","amounts",
	"mtabranches","purchase","balancetransfer","imttransactionhistory","internetservicetransactionhistory",
	"internetbundlerequest","changepasscode","logger","categories","myorders");
	private $authenticationToken = "";


	private $actionLogs = array("promotion",
	"news","categories","currentdetail",
	"service",
	"countries","mtabranches");
	
	private $sim_no = "";
	private $sim_users_id = "";

	private $token = null;

	public function init() {        
		parent::init();
		Yii::app()->errorHandler->errorAction='api/error';
	}	

	protected function beforeAction($event) {		

		if(!array_key_exists("HTTP_APIKEY", $_SERVER) || (array_key_exists("HTTP_APIKEY", $_SERVER) && $_SERVER["HTTP_APIKEY"] != $this->appKey)):
			$this->apiError("Access denied.");	
		endif;


		$this->actionName = Yii::app()->controller->action->id;

		if(in_array($this->actionName, $this->authenticateActions)) :		
			if(!array_key_exists("HTTP_X_TOKEN", $_SERVER) || 
			($this->token = Identity::model()->find('token=:token',array('token' => $_SERVER["HTTP_X_TOKEN"]))) == null):						
				$this->apiError("Invalid access.Key doesnot exists.");				
			else:
				$this->sim_no = $this->token->sim_users->sim_no;
				$this->sim_users_id = $this->token->sim_users->id;

				if(in_array($this->actionName, $this->actionLogs)):
					$service_id = array_search($this->actionName, $this->actionLogs);
					$this->saveActionLogs(($service_id + 1));
				endif;


			endif;		
		endif;	

		return parent::beforeAction($event);	
	}
	
	public function filters() {
		return array('accessControl');
	}

	public function renderJson() {
		header ('Content-Type: application/json' );
		echo json_encode ( $this->data );
	}
	
	public function apiError($message = "BAD REQUEST") {
		header ('HTTP/1.1 400 BAD REQUEST' );
		header ('Content-Type: application/json' );
		echo json_encode ( array("message" => $message, "success" => false ) );
	}

	public function actionError(){
		$error=Yii::app()->errorHandler->error;	
		$this->apiError($error ? $error['message'] : "BAD REQUEST");
	}
	
	public function actionLanguages(){
		$languages = Language::model()->findAll();
		foreach($languages as $language){
			$temp = array();
			$temp['id'] = $language->id;
			$temp['name'] = $language->name;
			array_push($this->data, $temp);
		}
		$this->renderJson();	
	}
	
	public function actionCategories($language) {
		if(empty($language))
			$this->apiError();
		$categories = Category::model ()->findAll ( 'language_id=:param and delete_status=0', array (
				':param' => $language 
		) );
		foreach ( $categories as $c ) {
			$temp = array();
			$temp['id'] = $c->id;
			$temp['name'] = $c->name;
			if(!empty($c->icon)){
				$icon = explode('-', $c->icon, 2);
				$icon = $icon[1];
			}else
				$icon = 'video-camera';
			//$icon = !empty($c->icon)?explode('-', $c->icon, 2):'video-camera';
			$temp['icon'] = $icon;
			array_push($this->data, $temp);
		}
		$this->renderJson ();
	}

	public function actionContents($category, $language) {
		if(empty($category) && empty($language))
			$this->apiError();
		if ($category == 'featured')
			$this->getFeaturedContents ( $language );
		else
			$this->getContents ( $category, $language );
	}
	
	public function getFeaturedContents($language) {
		$criteria=new CDbCriteria;
		$criteria->condition='language_id=:postID and delete_status=0';
		$criteria->params=array(':postID'=>$language);
		$criteria->limit=100;
		$criteria->order='id desc';
		$contents=Content::model()->findAll($criteria); // $params is not needed
		foreach ( $contents as $c ) {
			$temp = array ();
			$temp ['id'] = $c->id;
			$temp ['title'] = $c->title;
			$temp ['title_unicode'] = $c->title_unicode;
			$temp ['image'] = $this->imagePath().$c->category_id.'/'.$c->image;
			$temp ['description'] = $c->description;
			$temp ['cast'] = $c->cast;
			$temp ['duration'] = $c->duration;
			$temp ['link'] = $c->link;
			array_push ( $this->data, $temp );
		}
		$this->renderJson();
	}
	
	public function getContents( $category, $language ){
		$criteria=new CDbCriteria;
		$criteria->condition='category_id=:param1 and language_id=:param2 and delete_status=0';
		$criteria->params=array(':param1'=>$category, ':param2'=>$language);
		$criteria->limit=100;
		$criteria->order='id desc';
		$contents=Content::model()->findAll($criteria); // $params is not needed
		foreach ( $contents as $c ) {
			$temp = array ();
			$temp ['id'] = $c->id;
			$temp ['title'] = $c->title;
			$temp ['title_unicode'] = $c->title_unicode;
			$temp ['image'] = $this->imagePath().$c->category_id.'/'.$c->image;
			$temp ['description'] = $c->description;
			$temp ['cast'] = $c->cast;
			$temp ['duration'] = $c->duration;
			$temp ['link'] = $c->link;
			array_push ( $this->data, $temp );
		}
		$this->renderJson();
	}
	
	public function actionSearch($category, $language, $title){
		$criteria=new CDbCriteria;
		$criteria->addInCondition('language_id',array($language));
		$criteria->addInCondition('category_id',array($category));
		$criteria->addInCondition('delete_status', array(0));
		$criteria->addSearchCondition('title_unicode', $title, true, "AND", "LIKE");
		$criteria->addSearchCondition('title', $title, true, "OR");
		$criteria->order = 'id desc';
		$contents = Content::model()->findAll($criteria);
		foreach ( $contents as $c ) {
			$temp = array ();
			$temp ['id'] = $c->id;
			$temp ['title'] = $c->title;
			$temp ['title_unicode'] = $c->title_unicode;
			$temp ['image'] = $this->imagePath().$c->category_id.'/'.$c->image;
			$temp ['description'] = $c->description;
			$temp ['cast'] = $c->cast;
			$temp ['duration'] = $c->duration;
			$temp ['link'] = $c->link;
			array_push ( $this->data, $temp );
		}
		$this->renderJson();
	}
	
	public function actionNotifications($language){
		$criteria=new CDbCriteria;
		$criteria->condition='language_id=:postID and delete_status=0';
		$criteria->params=array(':postID'=>$language);
		$criteria->limit=30;
		$criteria->order='id desc';
		$notifications = Notification::model()->findAll($criteria);
		foreach ( $notifications as $c ) {
			$temp = array ();
			$temp ['id'] = $c->id;
			$temp ['title'] = $c->title;
			$temp ['title_unicode'] = $c->title_unicode;
			$temp ['created_date'] = $c->created_date;
			array_push ( $this->data, $temp );
		}
		$this->renderJson();
	}
	
	public function actionCreateFeedback(){
			$this->data = array('status'=>false);
			$model=new Feedback;
			if(isset($_POST['Feedback'])){
				$model->attributes=$_POST['Feedback'];
				$model->feedback_date = date('Y-m-d', time());
				if($model->save())
					$this->data = array('status'=>true);
			}else 
				$this->apiError();
			$this->renderJson();
	}

	public function actionSaveVideoStats()
	{
		$this->data = array('status'=>false);
		$model=new VideoStats;
		if(isset($_POST['VideoStats']))
		{
			$model->attributes=$_POST['VideoStats'];
			if($model->validate()){
				$model->save();
				$this->data = array('status'=>true);
			}
		}
		$this->renderJson();
	}

public function actionGetFeaturedContentsWithPagination($language){
		if(empty($_GET['page']))
			$this->apiError();
		$page = $_GET['page'];
		$criteria=new CDbCriteria;
		$criteria->condition='language_id=:postID and delete_status=0';
		$criteria->params=array(':postID'=>$language);
		//$criteria->limit=100;
		$criteria->order='id desc';
	
		$count=Content::model()->count($criteria);
		$pages=new CPagination($count);
		$pages->pageSize = 30;
		$pages->applyLimit($criteria);
	
		$this->data['contents'] = array();
		if($page<=$pages->pageCount){
			$contents=Content::model()->findAll($criteria); // $params is not needed
			foreach ( $contents as $c ) {
				$temp = array ();
				$temp ['id'] = $c->id;
				$temp ['title'] = $c->title;
				$temp ['title_unicode'] = $c->title_unicode;
				$temp ['image'] = $this->imagePath().$c->category_id.'/'.$c->image;
				$temp ['description'] = $c->description;
				$temp ['cast'] = $c->cast;
				$temp ['duration'] = $c->duration;
				$temp ['link'] = $c->link;
				array_push ( $this->data['contents'], $temp );
			}
		}
		$this->data['pagination'] = array();
		$this->data['pagination'] = array(
				'totalPages' => $pages->pageCount,
				'pageSize' => $pages->pageSize,
				'currentPage' => ++$pages->currentPage
		);
	
		$this->renderJson();
	}
	
	public function actionGetContentsWithPagination($category, $language){
		if(empty($_GET['page']))
			$this->apiError();
		$page = $_GET['page'];
		$criteria=new CDbCriteria();
		$criteria->condition='category_id=:param1 and language_id=:param2 and delete_status=0';
		$criteria->params=array(':param1'=>$category, ':param2'=>$language);
		//$criteria->limit=30;
		$criteria->order='id desc';
		$count=Content::model()->count($criteria);
		$pages=new CPagination($count);
	
		// results per page
		$pages->pageSize = 30;
		$pages->applyLimit($criteria);
		$this->data['contents'] = array();
		if($page<=$pages->pageCount){
			$contents=Content::model()->findAll($criteria);
			foreach ( $contents as $c ) {
				$temp = array ();
				$temp ['id'] = $c->id;
				$temp ['title'] = $c->title;
				$temp ['title_unicode'] = $c->title_unicode;
				$temp ['image'] = $this->imagePath().$c->category_id.'/'.$c->image;
				$temp ['description'] = $c->description;
				$temp ['cast'] = $c->cast;
				$temp ['duration'] = $c->duration;
				$temp ['link'] = $c->link;
				array_push ( $this->data['contents'], $temp );
			}
		}
		$this->data['pagination'] = array();
		$this->data['pagination'] = array(
				'totalPages' => $pages->pageCount,
				'pageSize' => $pages->pageSize,
				'currentPage' => ++$pages->currentPage
		);
		$this->renderJson();
	}
	
	public function actionSearchWithPagination($category, $language, $title){
		if(empty($_GET['page']))
			$this->apiError();
		$page = $_GET['page'];
		$criteria=new CDbCriteria;
		$criteria->addInCondition('language_id',array($language));
		$criteria->addInCondition('category_id',array($category));
		$criteria->addInCondition('delete_status', array(0));
		$criteria->addSearchCondition('title_unicode', $title, true, "AND", "LIKE");
		$criteria->addSearchCondition('title', $title, true, "OR");
		$criteria->order = 'id desc';
		$count=Content::model()->count($criteria);
		$pages=new CPagination($count);
	
		// results per page
		$pages->pageSize = 30;
		$pages->applyLimit($criteria);
		$this->data['contents'] = array();
		if($page<=$pages->pageCount){
			$contents = Content::model()->findAll($criteria);
			foreach ( $contents as $c ) {
				$temp = array ();
				$temp ['id'] = $c->id;
				$temp ['title'] = $c->title;
				$temp ['title_unicode'] = $c->title_unicode;
				$temp ['image'] = $this->imagePath().$c->category_id.'/'.$c->image;
				$temp ['description'] = $c->description;
				$temp ['cast'] = $c->cast;
				$temp ['duration'] = $c->duration;
				$temp ['link'] = $c->link;
				array_push ( $this->data['contents'], $temp );
			}
		}
		$this->data['pagination'] = array();
		$this->data['pagination'] = array(
				'totalPages' => $pages->pageCount,
				'pageSize' => $pages->pageSize,
				'currentPage' => ++$pages->currentPage
		);
		$this->renderJson();
	}

	public function actionGetSimNumber(){
		$sim = SimSerialNo::model()->findAll();
		foreach($sim as $s){
			array_push($this->data, $s['serial_number']);
		}
		$this->renderJson();
	}


	private function saveActionLogs($service_id){
		//$currentDate = date('Y-m-d H:i:s');
		$id = $this->gen_uuid();
		$sql = "INSERT INTO tbl_action_log (id,sim_users_id, service_id) 
		VALUES ('".$id ."',".$this->sim_users_id.", ".$service_id.");";
		Yii::app()->db->createCommand($sql)->execute();


	}


	public function actionPreferedlanguage($language_id){
	

		$currentDate = date('Y-m-d');
		$sql = "update tbl_sim_users set language_id=".$language_id." where id =".$this->sim_users_id;
		Yii::app()->db->createCommand($sql)->execute();

		$this->data = array("success"=> true,"message"=> "Language saved successully");
		$this->renderJson();


	}


	public function actionService()
	{
		$criteria=new CDbCriteria;
		$criteria->condition='is_active=:param1';
		$criteria->params=array(':param1'=>1);	
		$criteria->order='id asc';
		$services= Internetservice::model()->findAll($criteria); 
		foreach ( $services as $c ):
			$temp = array ();
			$temp ['id'] = $c->id;
			$temp ['price'] = $c->price;
			$temp ['name'] = $c->name;
			$temp ['code'] = $c->code;	
			$temp ['detail'] = $c->detail;	
			$temp ['image'] = $this->imageInternetServicePath().$c->image;				
			array_push ($this->data,$temp);
		endforeach;
		$this->renderJson();
	}	

	public function actionNews($language)
	{

		

		$criteria=new CDbCriteria;
		$criteria->condition='language_id=:param1 and delete_status=0';
		$criteria->params=array(':param1'=>$language);	
		$criteria->order='id asc';
		$services=News::model()->findAll($criteria);
		
		foreach ( $services as $c ) {
			$temp = array ();
			$temp ['id'] = $c->id;
			$temp ['title'] = $c->title;
			$temp ['title_unicode'] = $c->title_unicode;
			$temp ['image'] = $this->imageNewsPath().'/'.$c->image;	
			
			$temp ['link'] = $c->link;
		
			array_push ( $this->data, $temp );
		}
		
		$this->renderJson();
	}

	private function randomCode($number=6){
		return str_pad(rand(0, pow(10, $number)-1), $number, '0', STR_PAD_LEFT);
	}


	public function actionSignUp()
	{
		$this->data = array('status'=>false);					
		if(isset($_POST)):
			
			$activation_code =$this->randomCode();
			$model = Simusers::model()->find('sim_no=:sim_no',array('sim_no' => $_POST['sim_no']));					
			
			if(is_null($model)):					
				$model=new Simusers;	
				$_POST["Simusers"] = array("sim_no"=>$_POST['sim_no'],
				"device_id"=>$_POST['device_id'],
				"is_active"=>0,"activation_code"=> $activation_code);
				$model->attributes = $_POST["Simusers"];				
			else:
				$model->is_active = 0;
				$model->pin_no = "";
				$model->activation_code =$activation_code;	
			endif;

		
			if($model->validate()):				
				$model->save();
				$this->data = array('status'=>true, 'activation_code' =>$activation_code);
			else:
				$this->data = array('status'=>false, 'validation' =>"false");
			endif;	
		else:
			$this->apiError();			
		endif;

		$this->renderJson();
	}

	public function actionResendsms()
	{
		$this->data = array('status'=>false);
		if(isset($_POST)):
			$model = Simusers::model()->find('sim_no=:sim_no',array('sim_no' => $_POST['sim_no']));	
			if(!is_null($model)):	
				$activation_code =	$this->randomCode();		
				$model->activation_code = $activation_code;
				$model->save();
				$this->data = array('status'=>true, 'activation_code' =>$activation_code);
			else:
				$this->appError("Invalid mobile number.");
			endif;
		else:
			$this->apiError();	
		endif;			
		$this->renderJson();
	}

	public function actionActivate()
	{
		$this->data = array('status'=>false);
		if(isset($_POST)):
			$model = Simusers::model()->find('sim_no=:sim_no and activation_code =:activation_code',array('sim_no' => $_POST['sim_no'],"activation_code" =>$_POST['activation_code']));	
			if(!is_null($model)):
				$model->is_active = 1;
				$model->save();				
				$this->data = array('status'=>true);
			else:
				$this->appError("Invalid activation code.");
			endif;
		else:
			$this->apiError();	
		endif;			
		$this->renderJson();
	}

	private function generateToken($sim_no){
		$token = crypt($sim_no.strtotime(date('Y-m-d H:i:s')), '$6$rounds=5000$4froI0spc7rbm1nb$');
		return str_replace("rounds=5000", strrev(strtotime(date('Y-m-d H:i:s'))), $token);	
	}

	public function actionOtpbymobile(){		
		if(isset($_POST)):

		$mobile_no = $_POST['mobile_no'];
		$model = Simusers::model()->find('sim_no=:sim_no',array('sim_no' => $mobile_no));

		$code = Yii::app()->db->createCommand("select code from tbl_otp where sim_users_id=$model->id order by created_date desc LIMIT 1")->queryScalar();
		$this->data = array("success"=>true,"code"=> $code);
		$this->renderJson();
		endif;
	}

	public function actionRequestotp(){		
		if(isset($_POST)):
		
			$mobile_no = $_POST['mobile_no'];

			

			$simUsers = Simusers::model()->find('sim_no=:sim_no',array('sim_no' => $mobile_no));
			
			if(is_null($simUsers)):							
				$simUsers=new Simusers;	
				$_POST["Simusers"] = array("sim_no"=>$mobile_no,
				"device_id"=>'N/A',
				"is_active"=>0);
				$simUsers->attributes = $_POST["Simusers"];	
				$simUsers->save();
			endif;

			$randomNumber = $this->randomCode();
			$msisdn = (substr($mobile_no,0,1) == "0" ? "6".$mobile_no : $mobile_no);
			//$smsResponse = $this->sendMessageBackup($msisdn,"Your OTP code: ".$randomNumber);

			//var_dump($smsResponse);

			//if(!strpos(strtolower($smsResponse), 'success') !== false) :
			if(true == true):
				$model=new Otp;	
				$reference_number = $this->gen_uuid();
				$_POST["Otp"] = array("sim_users_id"=>$simUsers->id,
				"code"=> $randomNumber,
				"reference_number"=> $reference_number);				
				$model->attributes = $_POST["Otp"];
				if($model->save()):
					$this->data = array("success"=>true,"reference_number"=> $reference_number);
				else:
					$this->apiError("Fail to save.");
				endif;				
			else:
				$this->apiError("Unable to send the sms.");
			endif;
		endif;

		
		$this->renderJson();
	}

	public function actionLogIn(){
		$this->data = array('status'=>false);
		if(isset($_POST)):
			$otpModel = Otp::model()->find('code=:code and reference_number=:reference_number',	array('code' => $_POST['code'],	'reference_number' => $_POST['reference_number']));			
			
			if(is_null($otpModel)):				
				$this->apiError("Invalid OTP");
				die();
			else:			
				$otpModel->is_userd = 1;
				$otpModel->save();		
				$this->data = array('status'=>true);
				$this->renderJson(); 
			endif;	
		endif;

		
	}

	public function actionotpmobile(){

		$mobile = ltrim($_POST['mobile_no'],'6');	
		$sql = "select code from tbl_otp o inner join tbl_sim_users i on i.id = o.sim_users_id where i.sim_no='".$mobile."' order by o.id limit 1";
		
		$imsiDetail = Yii::app()->db->createCommand($sql)->queryScalar();

		$this->data = array('status'=>true,"otp" => $imsiDetail);
		$this->renderJson(); 

		
	}

	private function getIMSINumberByMobileNumber($mobile_no){

		return Imsi::model()->findByAttributes(array('mobile_no'=> $mobile_no));

	}





	public function actionSignNewIn(){	
	
		$this->data = array('status'=>false);
			

		if(isset($_POST)):
			$mobile = ltrim($_POST['sim_no'],'6');	
			$isMerchantradeNumber = true;	
			$model = null;
			$deviceType = $_POST['device_type'];
			$argMessage ='sim_no=:sim_no';
			$arg = array('sim_no' => $mobile);
			$hasIMSI = true;
			$isValid =preg_match( "/^(?:601)[0-9]{8,9}$/m","6".$mobile);		

			$sendOTP = false;
			$isUserExists = true;

			if ($isValid):
				$_POST['device_id'] = "TESTDEVICE";
				$imsiExists = $this->getIMSINumberByMobileNumber($mobile);
				$isActive = 0;
				
				if(is_null($imsiExists)):
					$isMerchantradeNumber = false;
					$_POST['device_id'] = "TESTDEVICE";
					$hasIMSI = false;
					$isActive =1;
				endif;	

				$activation_code =$this->randomCode();
				$model = Simusers::model()->find($argMessage,$arg);	
				$activation_code =$this->randomCode();		
						
	
				if(is_null($model)):
					$model=new Simusers;	
					$_POST["Simusers"] = array("sim_no"=>$mobile,"device_id"=>$_POST['device_id'],"is_active"=> $isActive,"activation_code"=> $activation_code);
					$model->attributes = $_POST["Simusers"];	
					$model->save();						
					$sendOTP = $isActive == 0;					
				else:
					if($model->is_active == 0 && $isActive == 0):
						$sendOTP = true;
					endif;					
				endif;

				$token = "";

				if(!is_null($model) && $model->is_active == 1 && !$sendOTP) :

					$modelToken = Identity::model()->find('sim_users_id=:sim_users_id',array('sim_users_id' => $model->id));	
					$token = $this->generateToken($_POST['sim_no']);			

					if(is_null($modelToken)):				
						$modelToken = new Identity;					
						$_POST["Identity"] = array("sim_users_id"=>$model->id,"token"=>$token);
						$modelToken->attributes =$_POST["Identity"];
					else:
						$modelToken->token =$token;
					endif;

					$modelToken->save();

				endif;


				$isSmsSend = false;
				$reference_number = null;

				if($sendOTP && $isMerchantradeNumber):
					$randomNumber = $this->randomCode();				
						$msisdn = (substr($imsiExists->mobile_no,0,1) == "0" ? "6".$imsiExists->mobile_no : $imsiExists->mobile_no);						
						$smsResponse = $this->sendSMSToMobile($msisdn,"Set Password Code: ".$randomNumber);						
					
						if(strpos(strtolower($smsResponse), 'success') !== false) :		
							$modelOtp=new Otp;	
							$reference_number = $this->gen_uuid();
							$_POST["Otp"] = array("sim_users_id"=>$model->id,"code"=> $randomNumber,	"reference_number"=> $reference_number);				
							$modelOtp->attributes = $_POST["Otp"];
							if($modelOtp->save()):
								$isSmsSend = true;							
							endif;		
						endif;						
				endif;
	
				$this->data = array('status'=>true, "token" => $token,
				"pin_no"=> is_null($model->pin_no) ? '' : $model->pin_no, 
				'hasimsi'=>$hasIMSI ,
				'isMerchantradeNumber' => $isMerchantradeNumber, 
				'device_type' => $deviceType, 
				'is_sms_send' => $isSmsSend,
				"reference_number" => $reference_number);	
			else:
				$this->apiError("Invalid mobile number.");
				die();
			endif;
		endif;
		$this->renderJson(); 


	}

	public function actionResendOTP(){

		$mobile = ltrim($_POST['mobile_no'],'6');

		$modelSimUser = Simusers::model()->find('sim_no=:sim_no',array('sim_no' => $mobile));
		$randomNumber = $this->randomCode();

		$msisdn = (substr($modelSimUser->sim_no,0,1) == "0" ? "6".$modelSimUser->sim_no : $modelSimUser->sim_no);	
		
	

		$smsResponse = $this->sendSMSToMobile($msisdn,"Set Password Code: ".$randomNumber);

		if(strpos(strtolower($smsResponse), 'success') !== false) :			
			$modelOtp=new Otp;	
			$reference_number = $this->gen_uuid();
			$_POST["Otp"] = array("sim_users_id"=>$modelSimUser->id,"code"=> $randomNumber,	"reference_number"=> $reference_number);				
			$modelOtp->attributes = $_POST["Otp"];

			if($modelOtp->save()):					
				$this->data = array('status'=>true,"reference_number"=> $reference_number);								
			endif;	
		else:		
			$this->data = array('status'=>false);	
		endif;		

		$this->renderJson(); 					

	}

	public function actionSignIn(){					
		$this->data = array('status'=>false);
		if(isset($_POST)):

		$activation_code =$this->randomCode();
			$model = Simusers::model()->find('sim_no=:sim_no and device_id=:device_id',array('sim_no' => $_POST['sim_no'],'device_id' => $_POST['device_id']));
			if(is_null($model)):							
				$model=new Simusers;	
				$_POST["Simusers"] = array("sim_no"=>$_POST['sim_no'],"device_id"=>$_POST['device_id'],"is_active"=>0,"activation_code"=> $activation_code);
				$model->attributes = $_POST["Simusers"];	
				$model->save();
			endif;

			$modelToken = Identity::model()->find('sim_users_id=:sim_users_id',array('sim_users_id' => $model->id));	
			$token = $this->generateToken($_POST['sim_no']);			
			
			if(is_null($modelToken)):				
				$modelToken = new Identity;					
				$_POST["Identity"] = array("sim_users_id"=>$model->id,"token"=>$token);
				$modelToken->attributes =$_POST["Identity"];
			else:
				$modelToken->token =$token;
			endif;

			$modelToken->save();

			$this->data = array('status'=>true, "token" => $token, "pin_no"=> $model->pin_no);

		endif;			
		$this->renderJson(); 
	}

	/// First time passcode change or change password
	public function actionPasscode()
	{
		if(isset($_POST) && !is_null($_POST["pin_no"]) && !empty($_POST["pin_no"])):
			$this->data = array('status'=>false);			
			$model = Simusers::model()->find('sim_no=:sim_no',array('sim_no' => $this->sim_no));			
			if(!is_null($model)):
				$model->is_active = 1;
				$model->pin_no = $_POST['pin_no'];
				if($model->save())
					$this->data = array('status'=>true);				
			endif;
		else:
			$this->apiError();
		endif;			
		$this->renderJson();
	}	


	/// First time passcode change or change password
	public function actionInitialPasscode()
	{
		if(isset($_POST) && !is_null($_POST["pin_no"]) && !empty($_POST["pin_no"]) && !is_null($_POST["mobile_no"]) && !empty($_POST["mobile_no"])):

			$mobile = ltrim($_POST['mobile_no'],'6');

			$this->data = array('status'=>false);			
			$model = Simusers::model()->find('sim_no=:sim_no',array('sim_no' => $mobile));	

			if(!is_null($model)):
				$model->is_active = 1;
				$model->pin_no = $_POST['pin_no'];

				if($model->save()):
					$token = $this->generateToken($model->sim_no);						
					$modelToken = new Identity;					
					$_POST["Identity"] = array("sim_users_id"=>$model->id,"token"=>$token);
					$modelToken->attributes = $_POST["Identity"];
					$modelToken->save();
					$this->data = array('status'=>true,'token'=> $token);	
				else:
					$this->apiError("Fail to save passcode");
				endif;
			else:
				$this->apiError("User doesnot exists.");
			endif;			
		else:
			$this->apiError();
		endif;			
		$this->renderJson();
	}	

	/// First time passcode change or change password
	public function actionForgotpasscode()
	{

		$randomNumber = $this->randomCode(5);	
		$model=new ActivationCode;	

		$_POST["ApplicationCode"] = array("activation_code"=>$randomNumber,"imsi_no"=>$_POST["imsi_id"]);
		$model->attributes = $_POST["ApplicationCode"];	

		if($model->save()):
		 	$this->data = array('status'=>true,'activation_code' => $randomNumber);	
		 	else:			
			$this->apiError();
		endif;			
		$this->renderJson();


	}	

	public function actionResetpasscode(){

		$activationCodeExists = ActivationCode::model()->findByAttributes(array('imsi_no'=>$_POST["imsi_id"],"activation_code"=>$_POST["activation_code"],"is_used"=>0));

		if($activationCodeExists == null):
			$this->apiError("Invalid activation code.");
		else:

		$activationCodeExists->is_used = 1;
		$activationCodeExists->save();
		$this->data = array('status'=>true,"message" => "successfull");			

		endif;

		$this->renderJson();
	}

	public function actionCurrentplan()
	{	
		$model = Simusers::model()->find('sim_no=:sim_no',array('sim_no' => $this->sim_no));
		$this->data = array("mobile_no"=>$this->sim_no , "current_plan"=> "MY SMART PLAN XI",
			"credit_balance" => "RM50", "valid_till" => "19/02/2017","internet_package_valid_till" => "19/02/2017",
			"volume_left"=> "500MB","profile_image"=>is_null($model->image) ? "" : ("https://stream.mtradeasia.com".$model->image) );
		$this->renderJson();
	}

	public function actionPurchase()
	{	
		
		if(!isset($_POST)):
			 $this->apiError();
		endif;

		$simUserModel = Simusers::model()->find('sim_no=:sim_no',array('sim_no' => $this->sim_no));
		$internetServiceModel = Internetservice::model()->find('id=:id',array('id' => $_POST["id"]));

		if(!$internetServiceModel):
			$this->apiError("Invalid internet service");
		endif;

		$model=new Transaction;	
		$_POST["Transaction"] = array("sim_users_id"=>$simUserModel["id"],"internet_service_id"=>$_POST["id"]);
		$model->attributes = $_POST["Transaction"];	

		$model->save();
		$this->data = array("status"=>true);

		/*if(!$model->validate()):			
		else:			
			$errors = $model->getErrors();
			$messages = $this->getErrorMessages($errors);
			$this->apiError($messages);
		endif;*/

		$this->renderJson();
	}

	public function getErrorMessages($errors){
		foreach ($errors as $value):
			array_push($value,$array);
		endforeach;
		return implode(",", $array);
	}




	public function actionPromotion($language_id = 5){

		/*$criteria=new CDbCriteria;
		$criteria->condition="from_date <=:param1 and to_date >= :param2 and is_active=1 and language_id=:language_id";
		$criteria->params=array(':param1'=>date("Y-m-d"),':param2'=> date("Y-m-d"),'language_id'=> $language_id);	
		$criteria->order='from_date asc';
		$services=Promotion::model()->findAll($criteria);
*/
		
		$services = Yii::app()->db->createCommand( "SELECT t1.* FROM mytube.tbl_promotion t1  where find_in_set($language_id,t1.language_ids) order by display_order;")->queryAll();


	
		foreach($services as $c ):
			$temp = array ();		
			$temp ['image'] = $this->imagePromotionPath().'/'.$c["image"];			
			array_push ($this->data, $temp );
		endforeach;		
		$this->renderJson();

	}

	public function actionPromotionnew($language_id = 5){


		
		$services = Yii::app()->db->createCommand( "SELECT t1.* FROM mytube.tbl_promotion t1  where find_in_set($language_id,t1.language_ids) order by display_order;")->queryAll();


	
		foreach($services as $c ):
			$temp = array ();		
			$temp ['image'] = $this->imagePromotionPath().'/'.$c["image"];			
			array_push ($this->data, $temp );
		endforeach;		
		$this->renderJson();

	}

	public function actionCountries(){

		$criteria=new CDbCriteria;
		$criteria->condition="is_active=:param1";
		$criteria->params=array(':param1'=>1);	
		$criteria->order='name asc';
		$services=Country::model()->findAll($criteria);	

		$countries = Yii::app()->db->createCommand( 'SELECT * FROM tbl_iats_country group by country_id,id order by id' )->queryAll();

	
	
	
		foreach($services as $c ):
			$temp = array ();		
			$temp ['id'] = $c->id;		
			$temp ['name'] = $c->name;		
			$temp ['code'] = $c->code;		
			$temp ['image'] =$this->imageFlagPath("32x32",$c->alpha_2);	

		

			$iats_countries = array();

			foreach($c->iatscountries as $country ):

			
					array_push($iats_countries,array("id"=> $country->id,"name"=> $country->name,"amount"=> $country->amount));
				
			endforeach;
		
			$temp ['iats_countries'] = $iats_countries;
			array_push ($this->data, $temp );
		endforeach;		
		$this->renderJson();

	}


	public function actionAmounts(){

		$criteria=new CDbCriteria;	
		$amounts=Amount::model()->findAll($criteria);	
	
		foreach($amounts as $c ):
			$temp = array ();		
			$temp ['id'] = $c->id;		
			$temp ['amount'] = $c->amount;		
				
			array_push ($this->data, $temp );
		endforeach;		
		$this->renderJson();

	}

	public function actionImttransactionhistory(){


		$simUserModel = Simusers::model()->find('sim_no=:sim_no',array('sim_no' => $this->sim_no));

		$criteria=new CDbCriteria;	
		$criteria->condition="sim_users_id=:param1";
		$criteria->params=array(':param1'=>$simUserModel["id"]);
		$transaction=Imttransaction::model()->findAll($criteria);

	
		foreach($transaction as $c ):
			$temp = array ();	
			$temp["amount"]=	$c->amount;
			$temp["mobile_no"]=	$c->mobile_no;
			$temp["date"]=	$c->created_date;
			$temp["country"]=	$c->Country["name"];
			$temp["country_image"]=$this->imageFlagPath("64x64",$c->Country["alpha_2"]);						
			array_push ($this->data, $temp );
		endforeach;		
		$this->renderJson();

	}

	private function getSimDetail(){
		return Simusers::model()->find('sim_no=:sim_no',array('sim_no' => $this->sim_no));
	}

	public function actionInternetservicetransactionhistory(){

		$simUserModel =$this->getSimDetail();
		$criteria=new CDbCriteria;	
		$criteria->condition="sim_users_id=:param1";
		$criteria->params=array(':param1'=>$simUserModel["id"]);
		$transaction=Transaction::model()->findAll($criteria);	
	
		foreach($transaction as $c ):
			$temp = array ();	
		
			$temp["code"]=	$c->InternetService["code"];	
			$temp["date"]=	$c->created_date;
			$temp["name"]=	$c->InternetService["name"];
			$temp["price"]=	$c->InternetService["price"];
			$temp["detail"]=	$c->InternetService["detail"];	
			$temp["image"]=	$this->imageInternetServicePath().$c->InternetService["image"];	
					
				
			array_push ($this->data, $temp );
		endforeach;		
		$this->renderJson();

	}

	public function actionBalancetransfer(){

		if(!isset($_POST)):
		$this->apiError();
		endif;

		$simUserModel = Simusers::model()->find('sim_no=:sim_no',array('sim_no' => $this->sim_no));

		$model=new Imttransaction;	
		$_POST["Imttransaction"] = array("sim_users_id"=>$simUserModel["id"],
		"country_id"=>$_POST["country_id"],"mobile_no"=>$_POST["mobile_no"],"amount"=>$_POST["amount"]);
		$model->attributes = $_POST["Imttransaction"];	

		if($model->validate()):
			$model->save();
			$this->data = array("status"=> true);
		else:
			$this->apiError();
		endif;
		
		$this->renderJson();
	}
	

	public function actionMtabranches($search){

		$criteria=new CDbCriteria;	
		if(isset($search) && !empty($search)):
			$criteria->condition = "(name LIKE concat('%',:search,'%') or address LIKE concat('%',:search,'%'))";
			$criteria->params = array (':search' =>$search);
		endif;		
		$departments=Mtabranch::model()->findAll($criteria);		
		foreach($departments as $c ):
			$temp = array ();		
			$temp ['id'] = $c->id;		
			$temp ['name'] =strtoupper($c->name);	
			$temp ['address'] = $c->address;	
			$temp ['phone'] = $c->phone;	
			$temp ['latitude'] = $c->latitude;	
			$temp ['longitude'] = $c->longitude;	
			$temp ['business_hour'] = $c->business_hour;				
			array_push ($this->data, $temp );
		endforeach;		
		$this->renderJson();

	}
 
	
	public function  actionProfileimage(){	 			
		
	$uploadedFile = CUploadedFile::getInstanceByName('profile_image');
	$model = Simusers::model()->find('sim_no=:sim_no',array('sim_no' => $this->sim_no));
	$imgPath = Yii::app()->basePath.'/../uploads/profileimage/'.$this->sim_no;		

	if(!file_exists($imgPath) && !is_dir($imgPath)):
		$this->makeDir($imgPath);
	endif;		

	if($uploadedFile):
		$rnd = rand(0,99999);			
		$fileName = "{$rnd}-{$uploadedFile}";
		$fileName = str_replace(' ', '_', $fileName);
		$model->image = '/uploads/profileimage/'.$this->sim_no."/".$fileName;
		$model->save();

		$path = $imgPath.'/'.$fileName;
		$uploadedFile->saveAs($path);
		$image = Yii::app()->image->load($path);
		$image->resize(400, 400);
		$image->save();
		$this->data = array("profile_image"=> Yii::app()->getBaseUrl(true)."/".$model->image);
		$this->renderJson();
	else:
		$this->apiError();
	endif;
			

	}

	public function actionCurrentdetail(){

		
		$simnumber =$this->sim_no;
		$transaction_id = time();
	//	$simnumber ="0192227225";
	$sql = "https://10.0.2.232/data_bundle/profile.php?msisdn=".$simnumber."&txId=".$transaction_id;


		$output = Yii::app()->curl->get($sql, $params= array(),true);


		$imsiDetail = Imsi::model()->findByAttributes(array('mobile_no'=>$this->sim_no));
		
		$output  = str_replace('{},','"",',$output);	
	
		$decodeJson = json_decode($output);

		if(isset($decodeJson->balanceInfo) && is_object($decodeJson->balanceInfo)):

			$decodeJson->balanceInfo = array($decodeJson->balanceInfo);
		endif;

		$ids = Yii::app()->db->createCommand("select group_concat(`product_id` separator ',')  as ids from tbl_internetservice")->queryScalar();
		$decodeJson->internet_services = explode(",",$ids);
		$decodeJson->customer_name = $imsiDetail != null ? $imsiDetail->name  : "N/A";

		
				
		header ('Content-Type: application/json' );
	//	
		echo json_encode($decodeJson); 

		//echo $output;

	}



	private function getAccessToken() {
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"https://celcom-test.apigee.net/v1/oauth/token");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,"grant_type=client_credentials&client_id=p99HcWNW0xTlPbnE7nVvmGKjG6nfhdIb&client_secret=17XdGzYqlQCXArgN");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec ($ch);
		curl_close ($ch);
		return json_decode($result);
	}

	private function XML2JSON($xml) {

        function normalizeSimpleXML($obj, &$result) {
            $data = $obj;
            if (is_object($data)) {
                $data = get_object_vars($data);
            }
            if (is_array($data)) {
                foreach ($data as $key => $value) {
                    $res = null;
                    normalizeSimpleXML($value, $res);
                    if (($key == '@attributes') && ($key)) {
                        $result = $res;
                    } else {
                        $result[$key] = $res;
                    }
                }
            } else {
                $result = $data;
            }
		}
		
        normalizeSimpleXML(simplexml_load_string($xml), $result);
        return json_encode($result);
    }



	
	public function actionMyorders(){  

		$response = $this->getAccessToken();

		//echo $response->access_token;

		$transaction_id = time();
		$imsiDetail = Yii::app()->db->createCommand("select pr_id from tbl_imsi where mobile_no='".$this->sim_no."'")->queryScalar();
		$url = "https://celcom-test.apigee.net/mvnoregistration/v1/getsubscriberlinescount?customerId=".$imsiDetail."&transactionId=".$transaction_id;		

		//echo $url;
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$response->access_token));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec ($ch);
		curl_close ($ch);
		echo $this->XML2JSON($result);
	}


	
	public function actionInternetbundlerequest(){

		$transaction_id = time();
		$originator = $this->sim_no;
		header ('Content-Type: application/json' );
		///01141683412

		$url = "http://10.0.2.232/data_bundle/data_bundle_ha.php?transaction_id=".$transaction_id."&keyword=&message=".$_POST["Code"]."&originator=".$originator."&telco_id=&DestAddr=60006";



		Yii::app()->curl->get( $url, $params= array(),true);
		echo json_encode(array("success"=> true,"message" => "API called successfully."));

	}


	public function actionRegisterdevice(){

		if(!isset($_POST)):
			$this->apiError();
		endif;

		$exists = Device::model()->findByAttributes(array('imsi_id'=>$_POST["imsi_id"]));

		if(!is_null($exists)):
			$exists->device_id = $_POST["device_id"];
			$exists->save();
			$this->data = array("success"=>true,"message"=> "Successfully saved.");
			
		else:

			$model=new Device;	
			$_POST["Device"] = array("imsi_id"=>$_POST["imsi_id"],"device_id"=>$_POST["device_id"]);
			$model->attributes = $_POST["Device"];	
			if($model->save()):
			$this->data = array("success"=>true,"message"=> "Successfully saved.");

			else:
			$this->apiError();
			endif;

		endif;	

		$this->renderJson();

	}


	public function actionChangelanguage($language_id){

				$currentDate = date('Y-m-d');
		$sql = "INSERT INTO tbl_selected_language (sim_users_id, language_id, created_date) 
		VALUES (".$this->sim_users_id.", ".$language_id.", '".$currentDate."')
		ON DUPLICATE KEY UPDATE sim_users_id= VALUES(sim_users_id),
		language_id = VALUES(language_id),
		created_date = VALUES(created_date)";
		Yii::app()->db->createCommand($sql)->execute();

		$this->data = array("success"=>true,"message"=> "Saved successfully");
		$this->renderJson();
	}

	public function actionIsmvnosim(){

		$exists = Imsi::model()->findByAttributes(array('imsi_no'=>$_POST["imsi_id"],"mobile_no"=>$_POST["mobile_no"]));
		if($exists != null):
			$this->data = array("success"=>true,"message"=> "Successfully saved.");
			$this->renderJson();
		else:
			$this->apiError("Mobile number doesnot exists.");
		endif;

	}

		public function actionGetnumberbyimsino(){

		$exists = Imsi::model()->findByAttributes(array('imsi_no'=>$_POST["imsi_id"]));
		if($exists != null):
			$this->data = array("success"=>true,"message"=> $exists->mobile_no);
			$this->renderJson();
		else:
			$this->apiError("Mobile number doesnot exists.");
		endif;

	}

	



public function actionResetpassword(){ 

	$simUsers = Simusers::model()->find('device_id=:device_id',array('device_id' => $_POST["imsi_id"]));	
	if(!is_null($simUsers)):
		$model = ForgotPassword::model()->findByAttributes(array('code'=>$_POST["code"],"sim_users_id"=>$simUsers->id, "is_used"=>0));
		if(!is_null($model)):
			$model->is_used = 1;
			$model->save();
			$this->data = array("success"=>true,"message"=> "Successfully saved.");
		else:
			$this->apiError("Invalid code or already been used.");
		endif;
	else:
		$this->apiError("Invalid mobile no.");
	endif;

	$this->renderJson();
	
}


public function actionForgotpasswordNew() {

	$this->data = array("success"=>false);

	$mobile = ltrim($_POST['mobile_no'],'6');
	$imsiExists = $this->getIMSINumberByMobileNumber($mobile);


	if(is_null($imsiExists)):
		$this->apiError("Invalid mobile number.");
	else:
		$randomNumber = $this->randomCode();
		$simUser = Simusers::model()->findByAttributes(array('sim_no'=>$mobile));
		
		if($simUser != null):
			$msisdn = (substr($simUser->sim_no,0,1) == "0" ? "6".$simUser->sim_no : $simUser->sim_no);
			
			$smsResponse = $this->sendSMSToMobile($msisdn,"Reset Password Code: ".$randomNumber);
	
			if(strpos(strtolower($smsResponse), 'success') !== false) :		
			
				$simUsers = Simusers::model()->find('sim_no=:sim_no',array('sim_no' =>$mobile));		
				$modelOtp=new Otp;	
				$reference_number = $this->gen_uuid();
				$_POST["Otp"] = array("sim_users_id"=>$simUsers->id,"code"=> $randomNumber,	"reference_number"=> $reference_number);				
				$modelOtp->attributes = $_POST["Otp"];
				$modelOtp->save();

				$this->data = array("success"=>true,"reference_number"=>  $reference_number);
				$this->renderJson();
								
			else:
				$this->apiError("Unable to send the sms.");
			endif;
		else:
			$this->apiError("Mobile number doesnot exists.");
		endif;
		
	endif;	
}


public function actionForgotpassword() {

	$this->data = array("success"=>false);
	$randomNumber = $this->randomCode();

	$exists = Imsi::model()->findByAttributes(array('imsi_no'=>$_POST["imsi_id"]));

	if($exists != null):
		$msisdn = (substr($exists->mobile_no,0,1) == "0" ? "6".$exists->mobile_no : $exists->mobile_no);
		
		$smsResponse = $this->sendMessageBackup($msisdn,"Reset Password Code: ".$randomNumber);

		if(strpos(strtolower($smsResponse), 'success') !== false) :

			$simUsers = Simusers::model()->find('device_id=:device_id',array('device_id' => $exists->imsi_no));		
			$model=new ForgotPassword;	
			$_POST["ForgotPassword"] = array("sim_users_id"=>$simUsers->id,"code"=> $randomNumber);
			$model->attributes = $_POST["ForgotPassword"];

			if($model->save()):
				$this->data = array("success"=>true,"message"=> "SMS send successfully");
			else:
				$this->apiError("Fail to save.");
			endif;	
			$this->renderJson();
		else:
			$this->apiError("Unable to send the sms.");
		endif;
	else:
		$this->apiError("Mobile number doesnot exists.");
	endif;

	//return $this->sendMessageBackup("601141609192");
}



private function sendMessageBackup($originator,$message) {

				$transaction_id = time();
				$telco_id = "";
                $ip="MTCBJUMGWEB01";
				$invalid=0;
				$shortcode=60006;
                $port=7000;
                $msgencoded = base64_encode($message);
                $client_tx_id = $transaction_id;
                //$msisdn = (substr($originator,0,1) == "0" ? "6".$originator : $originator);
				$msisdn = ( $originator);
                $datacoding=0;
                $umg_username="mytube";
                $umg_password="MyTub3";
                $umg_tx_id="";
                $svr_tx_id="";
                
                $data=$umg_tx_id.",".$svr_tx_id.",".$client_tx_id.",".$umg_username.",".$umg_password.",".$msgencoded.",".$shortcode.",".$msisdn.",".$datacoding;
                $fp = fsockopen($ip, $port);
                stream_set_timeout($fp,10);
                if ($fp) {
				fputs($fp, $data);
				$buf = fgets($fp, 4096);
				fclose($fp);

				
            
	
                }
    echo $buf;   
}

private function sendSMSToMobile($originator,$message) {

		$transaction_id = time();
		$telco_id = "";
		$ip="MTCBJUMGWEB01";
		$invalid=0;
		$shortcode=60006;
		$port=7000;
		$msgencoded = base64_encode($message);
		$client_tx_id = $transaction_id;
		//$msisdn = (substr($originator,0,1) == "0" ? "6".$originator : $originator);
		$msisdn = ( $originator);
		$datacoding=0;
		$umg_username="mytube";
		$umg_password="MyTub3";
		$umg_tx_id="";
		$svr_tx_id="";
		
		$data=$umg_tx_id.",".$svr_tx_id.",".$client_tx_id.",".$umg_username.",".$umg_password.",".$msgencoded.",".$shortcode.",".$msisdn.",".$datacoding;
		$fp = fsockopen($ip, $port);
		stream_set_timeout($fp,10);
		if ($fp) {
		fputs($fp, $data);
		$buf = fgets($fp, 4096);
		fclose($fp);
	}
return $buf;   
}


private function gen_uuid() {
    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        // 32 bits for "time_low"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

        // 16 bits for "time_mid"
        mt_rand( 0, 0xffff ),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand( 0, 0x0fff ) | 0x4000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand( 0, 0x3fff ) | 0x8000,

        // 48 bits for "node"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
}

	

	
}
