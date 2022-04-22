<?php
/* @var $this VideoStatsController */
/* @var $model VideoStats */

$this->breadcrumbs=array(
	'Video Stats'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List VideoStats', 'url'=>array('index')),
	array('label'=>'Manage VideoStats', 'url'=>array('admin')),
);
?>

<h1>Create VideoStats</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>