<?php
/* @var $this CategoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Categories',
);
$this->widget('zii.widgets.CMenu', array(
		'items'=>array(
			array('label'=>'Create Category', 'url'=>array('create')),
			array('label'=>'Manage Category', 'url'=>array('admin'))
		),
		'htmlOptions'=>array('class'=>'operations'),
));

?>

<h1>Categories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
