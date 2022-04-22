<?php
class ApiController extends Controller {
	private $data = array ();
	
	
	public function filters() {
		return array('accessControl',
		);
	}
	
// 	public function accessRules() {
// 		return array(
// 				array('allow', // allow authenticated user to perform 'create' and 'update' actions
// 						'actions' => array('categories'),
// 						'users' => array('*'),
// 						'expression' => 'Yii::app()->controller->checkCategoriesApiParams(isset($_GET[\'language\'])?$_GET[\'language\']:"")',
// 				),
// 				array('allow', // allow authenticated user to perform 'create' and 'update' actions
// 						'actions' => array('test1'),
// 						'users' => array('*'),
// 						'expression' => '$user->hasCollaborateAccess(isset($_GET[\'appId\'])?$_GET[\'appId\']:false)',
// 				),
// 				array('deny', // deny all users
// 						'users' => array('*'),
// 				),
// 		);
// 	}
	
	public function renderJson() {
		header ( 'Content-Type: application/json' );
		echo json_encode ( $this->data );
	}
	
	public function apiError() {
		header ( 'HTTP/1.1 400 BAD REQUEST' );
		exit ( "BAD REQUEST" );
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
}
