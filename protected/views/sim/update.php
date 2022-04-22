<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Update Sim Serial Number <?php //echo $model->id; ?></h1>
                </div>
                <!-- /.col-lg-12 -->


<div class="col-md-8">
<?php $this->renderPartial('_form', array('model'=>$model)); ?>
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
	array('label'=>'Add Sim Serial Number', 'url'=>array('create'),'itemOptions'=>array('class' => 'list-group-item')),
	//array('label'=>'View SimSerialNo', 'url'=>array('view', 'id'=>$model->id),'itemOptions'=>array('class' => 'list-group-item')),
	array('label'=>'Manage Sim Serial Number', 'url'=>array('admin'),'itemOptions'=>array('class' => 'list-group-item')),
)));
?>
</div>
</div>
</div>
