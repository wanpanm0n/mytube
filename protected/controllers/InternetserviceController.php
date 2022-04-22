<?php

class InternetserviceController extends Controller
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
		  array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','view','create','update','admin','delete','select'),
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}


	public function actionSelect(){

	

		$promotions = array();
		$dataReader = Yii::app()->db->createCommand( 'SELECT * FROM tbl_internetservice' )->queryAll();
		foreach( $dataReader as $row ) :
			$promotion = array();
			$promotion["Id"] =$row["id"];
			$promotion["Name"] = $row['name'];
			$promotion["Detail"] = $row['detail'];		
			$promotion["IsActive"] = $row['is_active'] == 1 ? true : false;
			array_push($promotions, $promotion);
			unset( $promotion );
		endforeach;

		header("Content-type: application/json"); 
		$json = json_encode($promotions);
		echo $json;

		
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Internetservice;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Internetservice']))
		{
		
			$rnd = rand(0,99999);
			$model->attributes=$_POST['Internetservice'];
			$uploadedFile = CUploadedFile::getInstance($model,'image');
			$imgPath = Yii::app()->basePath.'/../uploads/internetservice';
			
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
				$image->save(); 
				$this->redirect("/internetservice");
			}

		}

		$this->render('create',array(
			'model'=>$model,
		));
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


		if(isset($_POST['Internetservice']))
		{
			
			$old_img_name = $model->image;
			//die();
			$_POST['Internetservice']['image'] = $model->image;
			$model->attributes=$_POST['Internetservice'];
			
			$imgPath = Yii::app()->basePath.'/../uploads/internetservice';
			$uploadedFile=CUploadedFile::getInstance($model,'image');

			$this->makeDir($imgPath); 

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
				$this->redirect("/internetservice");
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
		$model=Internetservice::model()->findByPk($_POST["Id"]);

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
		$dataProvider=new CActiveDataProvider('Internetservice');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Internetservice('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Internetservice']))
			$model->attributes=$_GET['Internetservice'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return InternetService the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Internetservice::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param InternetService $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='sim-serial-no-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

