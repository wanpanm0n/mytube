<?php
/* @var $this VideoStatsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Video Stats',
);

$this->menu=array(
	array('label'=>'Create VideoStats', 'url'=>array('create')),
	array('label'=>'Manage VideoStats', 'url'=>array('admin')),
);
?>

<h1>Video Stats</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
