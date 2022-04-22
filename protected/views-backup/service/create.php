<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add Contents</h1>
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
		<ul class="list-group">
		  <li class="list-group-item"><a href="<?php echo Yii::app()->createUrl('content/index'); ?>">List Content</a></li>
		  <li class="list-group-item"><a href="<?php echo Yii::app()->createUrl('content/admin'); ?>">Manage Content</a></li>
		</ul>
<!-- 		<div class="panel-body"> -->
<?php

// $this->widget('zii.widgets.CMenu', array(
// 		'items'=>array(
// 	array('label'=>'List Content', 'url'=>array('index')),
// 	array('label'=>'Manage Content', 'url'=>array('admin')),
// )));
?>
<!-- </div> -->
</div>
</div>