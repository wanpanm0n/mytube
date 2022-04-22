<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">View Feedback #<?php echo $model->id; ?></h1>
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
		'feedback',
		'feedback_date',
		'feedback_user_email',
		'device_model',
		//'language_id',
		//'status',
	),
)); ?>
</div>
<div class="col-md-4">
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-gear fa-fw"></i> Actions
		</div>
<?php

 $this->widget('zii.widgets.CMenu', array(
 		'htmlOptions' => array(
 				'class'=>'list-group',
 		),
		'items'=>array(
	//array('label'=>'List Feedback', 'url'=>array('index'),'itemOptions'=>array('class' => 'list-group-item')),
	//array('label'=>'Create Feedback', 'url'=>array('create'),'itemOptions'=>array('class' => 'list-group-item')),
	//array('label'=>'Update Feedback', 'url'=>array('update', 'id'=>$model->id),'itemOptions'=>array('class' => 'list-group-item')),
	array('label'=>'Delete Feedback', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?'),'itemOptions'=>array('class' => 'list-group-item')),
	array('label'=>'Manage Feedback', 'url'=>array('admin'),'itemOptions'=>array('class' => 'list-group-item')),
)));
?>
</div>
</div>