<?php
/* @var $this SimController */
/* @var $model SimSerialNo */
$this->menu=array(
	array('label'=>'List SimSerialNo', 'url'=>array('index')),
	array('label'=>'Manage SimSerialNo', 'url'=>array('admin')),
);
?>
<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add Sim Serial Number</h1>
                </div>
                <!-- /.col-lg-12 -->

<div class="col-md-6">
<?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
<div class="col-md-4 offset-md-2">
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-gear fa-fw"></i> Actions
		</div>
		<!-- /.panel-heading -->
		<ul class="list-group">
		  <!-- <li class="list-group-item"><a href="<?php //echo Yii::app()->createUrl('content/index'); ?>">List Content</a></li> -->
		  <li class="list-group-item"><a href="<?php echo Yii::app()->createUrl('sim/admin'); ?>">Manage Content</a></li>
		</ul>
	</div>
</div>
</div>
