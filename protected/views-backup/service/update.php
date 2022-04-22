<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Update Content <?php echo $model->id; ?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
<div class="col-md-6">
<?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
<div class="col-md-4 pull-right">
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-gear fa-fw"></i> Actions
		</div>
		<!-- /.panel-heading -->
<?php
$this->widget('zii.widgets.CMenu', array(
		'htmlOptions' => array(
				'class'=>'list-group',
		),
		'items'=>array(
	array('label'=>'List Content', 'url'=>array('index'),'itemOptions'=>array('class' => 'list-group-item')),
	array('label'=>'Create Content', 'url'=>array('create'),'itemOptions'=>array('class' => 'list-group-item')),
	array('label'=>'View Content', 'url'=>array('view', 'id'=>$model->id),'itemOptions'=>array('class' => 'list-group-item')),
	array('label'=>'Manage Content', 'url'=>array('admin'),'itemOptions'=>array('class' => 'list-group-item')),
)));
?>
</div>
</div>