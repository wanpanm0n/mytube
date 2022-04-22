<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">View Internet Service</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
<div class="col-md-8">

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
		'htmlOptions'=>array(
				'class' => 'table table-striped table-bordered table-hover'
		),
	'attributes'=>array(
		//'id',
		'name',
		'code',
		'price',
		
		array(
			'label' => 'Is Active',
			'value'=> ($model->isactive == 1 ? 'yes' : 'no')
		),
	
	),
)); ?>
</div>
<div class="col-md-4">
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-gear fa-fw"></i> Actions
		</div>
		<ul class="list-group">
		
		  <li class="list-group-item"><a href="<?php echo Yii::app()->createUrl('internetservice/create'); ?>">Create Internet Service</a></li>
		  <li class="list-group-item"><a href="<?php echo Yii::app()->createUrl('internetservice/update',array('id'=>$model->id)); ?>">Update Internet Service</a></li>
	
		  <li class="list-group-item"><a href="<?php echo Yii::app()->createUrl('internetservice/admin'); ?>">Manage Internet Service</a></li>
		  	  <li class="list-group-item"><?php echo CHtml::link("Delete", '#', array('submit'=>array('delete', "id"=>$model->id), 'confirm' => 'Are you sure you want to delete?')); ?></li>
		</ul>
		<!-- /.panel-heading -->
<!-- 		<div class="panel-body"> -->
<?php
// $this->widget('zii.widgets.CMenu', array(
// 		'items'=>array(
// 	array('label'=>'List Content', 'url'=>array('index')),
// 	array('label'=>'Create Content', 'url'=>array('create')),
// 	array('label'=>'Update Content', 'url'=>array('update', 'id'=>$model->id)),
// 	array('label'=>'Delete Content', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
// 	array('label'=>'Manage Content', 'url'=>array('admin')),
// )));
?>
<!-- </div> -->
</div>
</div>