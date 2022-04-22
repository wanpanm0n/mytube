<?php

class IatscountryController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
    public $countryList = array();

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

    public function getCountries(){


        $criteria=new CDbCriteria;
		$criteria->condition="is_active=:param1";
		$criteria->params=array(':param1'=>1);	
		$criteria->order='name asc';
		$countries = Country::model()->findAll($criteria);	

     

         	foreach($countries as $c ):
			$temp = array ();		
			$temp ['id'] = $c->id;		
			$temp ['name'] = $c->name;	
				
			array_push ($this->countryList, $temp );
		endforeach;	
    }


	public function actionSelect(){


		$criteria=new CDbCriteria;	
	
		$country=Iatscountry::model()->findAll($criteria);
$promotions = array();
	
		foreach($country as $c ):
			$temp = array ();	
			$temp["Id"]=	$c->id;
			$temp["Name"]=	$c->name;
			$temp["Amount"]=	$c->amount;
			$temp["Country"]=	$c->Country["name"];						
			array_push ($promotions, $temp );
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
		$model=new Iatscountry;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Iatscountry']))
		{
		
			
			$model->attributes=$_POST['Iatscountry'];
			
			if($model->save()){
			
				$this->redirect("/Iatscountry");
			}

		}

        $this->getCountries();
		$this->render('create',array('model'=>$model));
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


		if(isset($_POST['Iatscountry']))
		{
			
			$model->attributes=$_POST['Iatscountry'];
		

			if($model->validate() && $model->save()){			
				$this->redirect("/iatscountry");
				die();
			}
		}

        $this->getCountries();

		$this->render('update',array('model'=>$model));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
public function actionDelete()
	{
		$model=Iatscountry::model()->findByPk($_POST["Id"]);

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
		$this->render('index');
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Iatscountry('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Iatscountry']))
			$model->attributes=$_GET['Iatscountry'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Iatscountry the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Iatscountry::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Iatscountry $model the model to be validated
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

