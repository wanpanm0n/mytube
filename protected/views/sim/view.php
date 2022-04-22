<?php
/* @var $this SimController */
/* @var $model SimSerialNo */

// $this->breadcrumbs=array(
// 	'Sim Serial Nos'=>array('index'),
// 	$model->id,
// );

// $this->menu=array(
// 	array('label'=>'List SimSerialNo', 'url'=>array('index')),
// 	array('label'=>'Create SimSerialNo', 'url'=>array('create')),
// 	array('label'=>'Update SimSerialNo', 'url'=>array('update', 'id'=>$model->id)),
// 	array('label'=>'Delete SimSerialNo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
// 	array('label'=>'Manage SimSerialNo', 'url'=>array('admin')),
// );
?>
<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">View Sim Serial Number #<?php echo $model->id; ?></h1>
                </div>
                <!-- /.col-lg-12 -->

<div class="col-md-8">
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'htmlOptions'=>array(
				'class' => 'table table-striped table-bordered table-hover'
		),
	'attributes'=>array(
		// 'id',
		'serial_number',
		'created_date',
		'modified_date',
	),
)); ?>
</div>
<div class="col-md-4">
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-gear fa-fw"></i> Actions
		</div>
		<ul class="list-group">
		  <li class="list-group-item"><a href="<?php echo Yii::app()->createUrl('sim/create'); ?>">Add Sim Serial Number</a></li>
		  <li class="list-group-item"><a href="<?php echo Yii::app()->createUrl('sim/update',array('id'=>$model->id)); ?>">Update Sim Serial Number</a></li>
		  <li class="list-group-item"><?php echo CHtml::link("Delete", '#', array('submit'=>array('delete', "id"=>$model->id), 'confirm' => 'Are you sure you want to delete?')); ?></li>
		  <li class="list-group-item"><a href="<?php echo Yii::app()->createUrl('sim/admin'); ?>">Manage Sim Serial Number</a></li>
		</ul>
	</div>
</div>
</div>
