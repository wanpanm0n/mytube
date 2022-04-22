<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">View Notification #<?php echo $model->id; ?></h1>
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
		'id',
		'title',
		'title_unicode',
		'description',
		//'start_date',
		//'end_date',
		array(
			'label' => 'Language',
			'value'=> $model->language->name		
		),
		//'user_id',
		'created_date',
		'modified_date',
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
	//array('label'=>'List Notification', 'url'=>array('index'),'itemOptions'=>array('class' => 'list-group-item')),
	array('label'=>'Create Notification', 'url'=>array('create'),'itemOptions'=>array('class' => 'list-group-item')),
	array('label'=>'Update Notification', 'url'=>array('update', 'id'=>$model->id),'itemOptions'=>array('class' => 'list-group-item')),
	array('label'=>'Delete Notification', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?'),'itemOptions'=>array('class' => 'list-group-item')),
	array('label'=>'Manage Notification', 'url'=>array('admin'),'itemOptions'=>array('class' => 'list-group-item')),
)));
?>
</div>
</div>