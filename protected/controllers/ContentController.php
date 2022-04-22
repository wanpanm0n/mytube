<?php

class ContentController extends Controller
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Content;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['Content']))
		{
			$rnd = rand(0,99999);
			$model->attributes=$_POST['Content'];
			$uploadedFile = CUploadedFile::getInstance($model,'image');
			$imgPath = Yii::app()->basePath.'/../uploads/contents/'.$model->category_id;
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

		if(isset($_POST['Content']))
		{
			$old_img_name = $model->image;
			//die();
			$_POST['Content']['image'] = $model->image;
			$model->attributes=$_POST['Content'];
			$imgPath = Yii::app()->basePath.'/../uploads/contents/'.$model->category_id;
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
	public function actionDelete($id)
	{
		$model=$this->loadModel($id);
		$model->delete_status = 1;
		if(!$model->save()){
			if(!isset($_GET['ajax']))
				Yii::app()->user->setFlash('delete_failed','An error has occured! Please try again.');
			else
				echo "<div class='alert alert-danger'>An error has occured! Please try again.</div>";
		}	
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new Content('search');
   	 	$model->unsetAttributes();  // clear any default values
    	if(isset($_GET['Content']))
        	$model->attributes=$_GET['Content'];
 
// 		$dataProvider=new CActiveDataProvider('Content', array(
// 				'criteria'=>array(
// 						'condition'=>'language_id='.Profile::getLanguageId().' and user_id = '.Yii::app()->user->id.' and delete_status=0',
// 						'order'=>'id DESC',
// 						//'with'=>array('author'),
// 				),
// 		));
		//$dataProvider->pagination->pageSize = 30;
		$this->render('index',array(
			'dataProvider'=>$model->search(),
			'model'=>$model
		));
	}
// 	update tbl_category, tbl_content set tbl_category.delete_status=0,tbl_content.delete_status=0 where tbl_content.category_id=tbl_category.id and tbl_category.id=3

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Content('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Content']))
			$model->attributes=$_GET['Content'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Content the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Content::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Content $model the model to be validated
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
