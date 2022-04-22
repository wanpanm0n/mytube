<?php
/* @var $this VideoStatsController */
/* @var $model VideoStats */

$this->breadcrumbs=array(
	'Video Stats'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List VideoStats', 'url'=>array('index')),
	array('label'=>'Create VideoStats', 'url'=>array('create')),
	array('label'=>'Update VideoStats', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete VideoStats', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage VideoStats', 'url'=>array('admin')),
);
?>

<h1>View VideoStats #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'device_id',
		'device_model',
		'phone_number',
		'content_id',
		'count',
	),
)); ?>
