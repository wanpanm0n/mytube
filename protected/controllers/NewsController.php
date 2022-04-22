<?php

class NewsController extends Controller
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
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','view','create','update','admin','delete','select'),
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
		$model=new News;



		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['News']))
		{
			$rnd = rand(0,99999);
			$model->attributes=$_POST['News'];
			$uploadedFile = CUploadedFile::getInstance($model,'image');
			$imgPath = Yii::app()->basePath.'/../uploads/news';
			$model->language_id = Profile::getLanguageId();
			if($uploadedFile){
				if($this->makeDir($imgPath)){
					$fileName = "{$rnd}-{$uploadedFile}";
					$fileName = str_replace(' ', '_', $fileName);
					$model->image = $fileName;
				}
			}
			if($model->save()){
				$path = $imgPath.'/'.$fileName;
				$uploadedFile->saveAs($path);
				$image = Yii::app()->image->load($path);
				$image->resize(171, 171);
				$image->save(); // or $image->save('images/small.jpg');
				$this->redirect(array('view','id'=>$model->id));
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

		if(isset($_POST['News']))
		{
			$old_img_name = $model->image;
			//die();
			$_POST['News']['image'] = $model->image;
			$model->attributes=$_POST['News'];
				$imgPath = Yii::app()->basePath.'/../uploads/news';
			$uploadedFile=CUploadedFile::getInstance($model,'image');
			if($uploadedFile){
					$rnd = rand(0,99999);
				//if($this->makeDir($imgPath)){
					$fileName = "{$rnd}-{$uploadedFile}";
					$fileName = str_replace(' ', '_', $fileName);
					$model->image = $fileName;
				//}
			}else
				$model->image = $old_img_name;

			if($model->validate() && $model->save()){
				if(!empty($uploadedFile)){
					$path = $imgPath.'/'.$model->image;
					$uploadedFile->saveAs($path);
					$image = Yii::app()->image->load($path);
					$image->resize(171, 171);
					$image->save();
					
				}
				$this->redirect(array('view','id'=>$model->id));
			}
			
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete()
	{
		$model=$this->loadModel($_POST["Id"]);
		header("Content-type: application/json"); 
		$num = $model->delete();		
		$json = json_encode(array("success"=> $num > 0));
		echo $json;
		
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new News('search');
   	 	$model->unsetAttributes();  // clear any default values
    	if(isset($_GET['News']))
        	$model->attributes=$_GET['News'];
 
// 		$dataProvider=new CActiveDataProvider('News', array(
// 				'criteria'=>array(
// 						'condition'=>'language_id='.Profile::getLanguageId().' and user_id = '.Yii::app()->user->id.' and delete_status=0',
// 						'order'=>'id DESC',
// 						//'with'=>array('author'),
// 				),
// 		));
		//$dataProvider->pagination->pageSize = 30;
		$this->render('index',array('dataProvider'=>$model->search(),'model'=>$model));
	}
// 	update tbl_category, tbl_content set tbl_category.delete_status=0,tbl_content.delete_status=0 where tbl_content.category_id=tbl_category.id and tbl_category.id=3

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new News('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['News']))
			$model->attributes=$_GET['News'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

		public function actionSelect(){

	

		$news = array();


		$dataReader = Yii::app()->db->createCommand( 'SELECT * FROM tbl_news where user_id ='.Yii::app()->user->id )->queryAll();
		foreach( $dataReader as $row ) :
			$temp = array();
			$temp["Id"] =$row["id"];
			$temp["Title"] = $row['title'];
			$temp["Link"] = $row['link'];			
			array_push($news, $temp);
			unset( $temp );
		endforeach;

		header("Content-type: application/json"); 
		$json = json_encode($news);
		echo $json;

		
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return News the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=News::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param News $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='content-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
