
<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Create Notification</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
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
			//array('label'=>'List Notification', 'url'=>array('index'),'itemOptions'=>array('class' => 'list-group-item')),
			array('label'=>'Manage Notification', 'url'=>array('admin'),'itemOptions'=>array('class' => 'list-group-item')),
	)));
	?>
</div>
</div>