<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Create Category</h1>
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
<!-- 		<div class="panel-body"> -->
<?php
$this->widget('zii.widgets.CMenu', array(
		'htmlOptions' => array(
				'class'=>'list-group',
		),
		'items'=>array(
	//array('label'=>'List Category', 'url'=>array('index')),
	array('label'=>'Manage Category', 'url'=>array('admin'),'itemOptions'=>array('class' => 'list-group-item')),
)));
?>
<!-- </div> -->
</div>