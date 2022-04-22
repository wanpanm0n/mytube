<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">View Category #<?php echo $model->id; ?></h1>
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
		array(
			'label'=>'Icon',
			'type'=>'raw',
			'value'=>'<div class="fa '.$model->icon.'"></div>'
		),
		//'language_id',
			array(
					'label' => 'Category',
					'value'=> $model->language->name
			),
			array(
					'label' => 'User',
					'value'=> $model->user->username
			),
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
		  <li class="list-group-item"><a href="<?php echo Yii::app()->createUrl('category/create'); ?>">Create Category</a></li>
		  <li class="list-group-item"><a href="<?php echo Yii::app()->createUrl('category/update',array('id'=>$model->id)); ?>">Update Category</a></li>
		  <li class="list-group-item"><?php echo CHtml::link("Delete", '#', array('submit'=>array('delete', "id"=>$model->id), 'confirm' => 'Are you sure you want to delete?')); ?></li>
		  <li class="list-group-item"><a href="<?php echo Yii::app()->createUrl('category/admin'); ?>">Manage Category</a></li>
		</ul>
		<!-- /.panel-heading -->
<!-- 		<div class="panel-body"> -->
<?php
// $this->widget('zii.widgets.CMenu', array(
// 		'items'=>array(
// 	//array('label'=>'List Category', 'url'=>array('index')),
// 	array('label'=>'Create Category', 'url'=>array('create')),
// 	array('label'=>'Update Category', 'url'=>array('update', 'id'=>$model->id)),
// 	array('label'=>'Delete Category', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
// 	array('label'=>'Manage Category', 'url'=>array('admin')),
// )));
?>
<!-- </div> -->
</div>
</div>