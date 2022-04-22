<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Update Category <?php //echo $model->id; ?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

<div class="col-md-8">

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
<div class="col-md-4">
<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->widget('zii.widgets.CMenu', array(
	'htmlOptions' => array(
				'class'=>'list-group',
		),
		'items'=>array(
	//array('label'=>'List Category', 'url'=>array('index'),'itemOptions'=>array('class' => 'list-group-item')),
	array('label'=>'Create Category', 'url'=>array('create'),'itemOptions'=>array('class' => 'list-group-item')),
	array('label'=>'View Category', 'url'=>array('view', 'id'=>$model->id),'itemOptions'=>array('class' => 'list-group-item')),
	array('label'=>'Manage Category', 'url'=>array('admin'),'itemOptions'=>array('class' => 'list-group-item')),
)));
?>
</div>