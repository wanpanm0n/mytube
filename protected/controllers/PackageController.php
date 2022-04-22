<?php

class PackageController extends Controller
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		if(isset($_POST['Package']['id'])) {
			$getIdOfPackage = $_POST['Package']['id'];
			if($getIdOfPackage <= 0){
				$_SESSION["errorMsg"] = "$getIdOfPackage is not a valid Id";
				$this->redirect(array('package/create'));
			}
			$code = Yii::app()->db->createCommand("select * from tbl_package where id= $getIdOfPackage")->queryScalar();
			if($code != ""){
				$_SESSION["errorMsg"] = "ID $getIdOfPackage already exist";
				$this->redirect(array('package/create'));
			}			
		}
		$model=new Package;
		if(isset($_FILES['icon'])){
			$errors= array();
			$file_name = $_FILES['icon']['name'];
			$file_size =$_FILES['icon']['size'];
			$file_tmp =$_FILES['icon']['tmp_name'];
			$file_type=$_FILES['icon']['type'];
			$path = $_FILES['icon']['name'];
			$file_ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
			$extensions= array("jpeg","jpg","png");
			if(in_array($file_ext,$extensions)=== false){
			$errors[]="extension not allowed, please choose a JPEG or PNG file.";
			}
			if($file_size > 2097152){
			$errors[]='File size must be excately 2 MB';
			}
			if(empty($errors)==true){
			$temp = explode(".", $_FILES["icon"]["name"]);
			$newfilename = round(microtime(true)) . '.' . end($temp);
			move_uploaded_file($file_tmp, "uploads/country_image_icon/" . $newfilename);
			$model->icon = Yii::app()->getBaseUrl(true).'/uploads/country_image_icon/'.$newfilename;
			}else{
			die("Error occured wile uploading image, please upload image less than 2 MB and type must be jpeg or png or jpg");
			$model->icon = "";
			}
		}
		$products = array();
		$allProducts = Product::model()->findAll();
		$packageProduct = array();
		foreach($allProducts as $product) {
			$products[$product->id] = $product;
			$packageProduct[$product->id] = new PackageProduct;
		}
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Package'])) {
			$model->attributes=$_POST['Package'];



			if($model->save()) {
				$package_id = $model->id;
				if($model->is_active) {
					Package::model()->updateAll(array('is_active' => 0), 'country_id=:country_id and id != :id', array(':country_id' => $model->country_id, ':id' => $package_id));
				}
				$products = array();
				foreach($_POST['PackageProduct'] as $key=>$val) {
					$temp = array(
						'package_id' => $package_id,
						'product_id' => $key,
						'package_product_title' => $val['package_product_title'],
						'package_product_description' => $val['package_product_description'],
					);
					array_push($products, $temp);
				}
				if(count($products) > 1) {
					$connection = Yii::app()->db->getSchema()->getCommandBuilder();
					$command = $connection->createMultipleInsertCommand('tbl_package_product', $products);
					$command->execute();
				}
				$this->redirect(array('index'));
			}
		}

		$this->render('create',array(
			'model'=>$model,
			'product'=>$products,
			'packageProduct' => $packageProduct
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
		$packageProduct = array();
		$pps = PackageProduct::model()->findAll(array('condition' => 'package_id = :id', 'params' => array(':id' => $id)));

		foreach($pps as $val) {
			$packageProduct[$val->product_id] = $val;
		}

		$products = array();
		$allProducts = Product::model()->findAll();

		foreach($allProducts as $product) {
			$products[$product->id] = $product;
			if(!isset($packageProduct[$product->id])) {
				$packageProduct[$product->id] = new PackageProduct;
			}
		}
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Package']))
		{
			$model->attributes=$_POST['Package'];
				if(isset($_FILES['icon']['name']) && $_FILES['icon']['name'] != "" ){
					$errors= array();
					$file_name = $_FILES['icon']['name'];
					$file_size =$_FILES['icon']['size'];
					$file_tmp =$_FILES['icon']['tmp_name'];
					$file_type=$_FILES['icon']['type'];
					$path = $_FILES['icon']['name'];
					$file_ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
					$extensions= array("jpeg","jpg","png");
					if(in_array($file_ext,$extensions)=== false){
					$errors[]="extension not allowed, please choose a JPEG or PNG file.";
					}
					if($file_size > 2097152){
					$errors[]='File size must be excately 2 MB';
					}
					if(empty($errors)==true){
					$temp = explode(".", $_FILES["icon"]["name"]);
					$newfilename = round(microtime(true)) . '.' . end($temp);
					move_uploaded_file($file_tmp, "uploads/country_image_icon/" . $newfilename);
					$model->icon = Yii::app()->getBaseUrl(true).'/uploads/country_image_icon/'.$newfilename;
					}else{
					die("Error occured wile uploading image, please upload image less than 2 MB and type must be jpeg or png or jpg");
					$model->icon = "";
					}
				}
			if($model->save()) {
				PackageProduct::model()->deleteAll(array('condition' => 'package_id = :id', 'params' => array(':id' => $model->id)));
				if($model->is_active) {
					Package::model()->updateAll(array('is_active' => 0), 'country_id=:country_id and id != :id', array(':country_id' => $model->country_id, ':id' => $model->id));
				}
				$productSaveArray = array();
				foreach($_POST['PackageProduct'] as $key=>$val) {
					$temp = array(
						'package_id' => $model->id,
						'product_id' => $key,
						'package_product_title' => $val['package_product_title'],
						'package_product_description' => $val['package_product_description'],
					);
					array_push($productSaveArray, $temp);
				}
				if(count($productSaveArray) > 1) {
					$connection = Yii::app()->db->getSchema()->getCommandBuilder();
					$command = $connection->createMultipleInsertCommand('tbl_package_product', $productSaveArray);
					$command->execute();
				}
				$this->redirect(array('index'));
			}
		}

		$this->render('update',array(
			'model'=>$model,
			'product'=>$products,
			'packageProduct' => $packageProduct
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete()
	{
		$id = $_POST["Id"];
		$model = Package::model()->findByPk($id);
		// PackageProduct::model()->deleteAll(array('condition' => 'package_id = :id', 'params' => array(':id' => $id)));
		$num = $model->delete();

		header("Content-type: application/json");
		$json = json_encode(array("success"=> $num > 0));
		echo $json;
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Package');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Package('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Package']))
			$model->attributes=$_GET['Package'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Package the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Package::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Package $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='package-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}


	public function actionSelect(){
		$packages = array();
		$dataReader = Yii::app()->db->createCommand( 'SELECT tp.* FROM tbl_package tp ')->queryAll();
		foreach( $dataReader as $row ) :
			$package = array();
			$package["Id"] =$row["id"];
			$package["CountryName"] =$row["title"];
			$package["Code"] = $row['code'];
			$package["Price"] = $row['price'];
			$package["Created"] = $row['created_date'];
			$package["IsActive"] = $row['is_active'] == 1 ? true : false;
			array_push($packages, $package);
			unset( $package );
		endforeach;
		header("Content-type: application/json");
		$json = json_encode($packages);
		echo $json;
	}

	private function batchInsert() {

	}
}
