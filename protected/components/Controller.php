<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';

	
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
	public function init(){
		if(!Yii::app()->user->isGuest){
			$this->layout = "//layouts/column2";
		}
	}
	
	public function imagePath(){
		//return Yii::app()->basePath.'/../uploads/contents/';
		return Yii::app()->getBaseUrl(true).'/uploads/contents/';
	}
		public function imagePromotion(){
		//return Yii::app()->basePath.'/../uploads/contents/';
		return Yii::app()->getBaseUrl(true).'/uploads/promotion/';
	}

	public function imageFlagPath($size = "16x16",$image){
		//return Yii::app()->basePath.'/../uploads/contents/';
		return Yii::app()->getBaseUrl(true).'/uploads/flags/'.$size."/".$image.".png";
	}

	public function imageNewsPath(){
		//return Yii::app()->basePath.'/../uploads/contents/';
		return Yii::app()->getBaseUrl(true).'/uploads/news/';
	}

	public function imageInternetServicePath(){
		//return Yii::app()->basePath.'/../uploads/contents/';
		return Yii::app()->getBaseUrl(true).'/uploads/internetservice/';
	}
	
	public function imagePromotionPath(){
		//return Yii::app()->basePath.'/../uploads/contents/';
		return Yii::app()->getBaseUrl(true).'/uploads/promotion/';
	}
	
	public function makeDir($dir) {
		if (! file_exists ( $dir ) and ! is_dir ( $dir )) {
			if (mkdir ( $dir, 0777, true ))
				return true;
		}else 
			return true;
		return true;
	}

	
}