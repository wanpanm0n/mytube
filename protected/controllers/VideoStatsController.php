<?php

class VideoStatsController extends Controller
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
				'actions'=>array(),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				//'actions'=>array('index','view','create','update','admin','delete'),
				'actions'=>array('admin','delete','export','exportAll','exportFile'),
				'users'=>array('$user->isAdmin()'),
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
	/*
	public function actionCreate()
	{
		$model=new VideoStats;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['VideoStats']))
		{
			$model->attributes=$_POST['VideoStats'];
			if($model->validate()){
				//if($content->count('device_id=:did and delete_status=0', array(':did'=>$model->device_id))>0){
				$stats = VideoStats::model()->find('device_id=:did and delete_status=0', array(':did'=>$model->device_id));
				if(!empty($stats)){
					$stats->attributes = $_POST['VideoStats'];
					$stats->count = $stats->count+1;
					$stats->save();
				}else{
					if($model->save())
						$this->redirect(array('view','id'=>$model->id));
				}
			}

		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
*/
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	/*
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['VideoStats']))
		{
			$model->attributes=$_POST['VideoStats'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
*/
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		//$this->loadModel($id)->delete();
		$model = $this->loadModel($id);
		$model->delete_status = 1;
		$model->save();
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('VideoStats');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new VideoStats('search');

		$model->unsetAttributes();  // clear any default values
		$model->from_date = date('Y-m-d');
		$model->to_date = date('Y-m-d');
		if(isset($_GET['VideoStats']))
			$model->attributes=$_GET['VideoStats'];

		if(Yii::app()->request->getParam('exportAll')) {
   			 $this->actionExport(
				 $headers = array(
				     'phone_number',
				     'sim_serial_number',
				     'language.name',
				     'count',
				 ), $model
			  );
   			Yii::app()->end();
		}

		//if(Yii::app()->request->getParam('exportAll')) {
   		//	 $this->actionExportAll();
   		//	 Yii::app()->end();
		//}
		$this->render('admin',array(
			'model'=>$model,
		));
	}


public function actionExport($headers, $model)
{
    $fp = fopen('php://temp', 'w');

    // $headers = array(
    //     'phone_number',
    //     'sim_serial_number',
    //     'language.name',
    //     'count',
    // );
    $row = array();
    foreach($headers as $header) {
        $row[] = VideoStats::model()->getAttributeLabel($header);
    }
    fputcsv($fp,$row);

    // $model=new VideoStats('search');
    // $model->unsetAttributes();  // clear any default values
    // if(isset($_GET['VideoStats'])) {
    //     $model->attributes=$_GET['VideoStats'];
    // }
  		$dp = $model->search();
		$dp->setPagination(false);



		$models = $dp->getData();

		foreach($models as $model) {
		    $row = array();
		    foreach($headers as $head) {
		        $row[] = CHtml::value($model,$head);
		    }
		    fputcsv($fp,$row);
		}

    rewind($fp);
    Yii::app()->user->setState('export',stream_get_contents($fp));
    fclose($fp);
    //$this->actionExportFile();
}


public function actionExportAll(){



	$fp = fopen('php://temp', 'w');
 	$headers = array(
        'phone_number',
        'sim_serial_number',
        'language.name',
        'count',
    );
    $row = array();
    foreach($headers as $header) {
        $row[] = VideoStats::model()->getAttributeLabel($header);
    }
    fputcsv($fp,$row);
 	$model = new VideoStats();
 	$models = $model->getAllData();
		foreach($models as $model) {
		    $row = array();
		    foreach($headers as $head) {
		        $row[] = CHtml::value($model,$head);
		    }
		    fputcsv($fp,$row);
		}


    rewind($fp);
    Yii::app()->user->setState('export',stream_get_contents($fp));
    fclose($fp);



}

public function actionExportFile()
{
	//echo "<pre>";
	//print_r(Yii::app()->user->getState('export'));
    Yii::app()->request->sendFile('export.csv',Yii::app()->user->getState('export'));
    Yii::app()->user->setState('export',null);
    //Yii::app()->user->clearState('export');
}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return VideoStats the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=VideoStats::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param VideoStats $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='video-stats-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionTotalSubscribers()
	{
		$model=new VideoStats('search');

		$model->unsetAttributes();  // clear any default values
		$model->from_date = date('Y-m-d');
		$model->to_date = date('Y-m-d');
		if(isset($_GET['VideoStats']))
			$model->attributes=$_GET['VideoStats'];

		$model->search_type = 'total_new_subscibers';

		if(Yii::app()->request->getParam('exportAll')) {
				 $this->actionExport(
					 $headers = array(
			         'device_id',
							 'device_model',
							 'phone_number',
			         'sim_serial_number'
						 ), $model
			  );
				Yii::app()->end();
		}
		//echo "<pre>";
		//print_r($model);
		$this->render('totalSubscribers',array(
			'model'=>$model,
		));
	}

	public function actionTotalMta()
	{
		$model=new VideoStats('search');

		$model->unsetAttributes();  // clear any default values
		$model->from_date = date('Y-m-d');
		$model->to_date = date('Y-m-d');
		if(isset($_GET['VideoStats']))
			$model->attributes=$_GET['VideoStats'];

		$model->search_type = 'total_mta';

		if(Yii::app()->request->getParam('exportAll')) {
				 $this->actionExport(
					 $headers = array(
			         'device_id',
							 'device_model',
							 'phone_number',
			         'sim_serial_number'
						 ), $model
			  );
				Yii::app()->end();
		}
		//echo "<pre>";
		//print_r($model);
		$this->render('totalSubscribers',array(
			'model'=>$model,
		));
	}
}
