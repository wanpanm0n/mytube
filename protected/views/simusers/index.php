<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Manage Sim Users</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
<div class="col-lg-8">
                    <div class="panel panel-default">
<!--                         <div class="panel-heading"> -->
<!--                         	<i class="fa fa-user fa-w"></i> -->
<!--                             Manage Categories -->
<!--                         </div> -->
                        <!-- /.panel-heading -->
                        <div class="panel-body">
<!-- <p> -->
<!-- You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> -->
<!-- or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done. -->
<!-- </p> -->

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<div id="statusMsg">
	<?php if(Yii::app()->user->hasFlash('delete_failed')): ?>
		<div class="alert alert-danger">
		    <?php echo Yii::app()->user->getFlash('delete_failed'); ?>
		</div>
	<?php endif; ?>
</div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'category-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'afterAjaxUpdate' => 'reinstallDatePicker',
	'columns'=>array(
		
		'sim_no',
			array(
					'name' => 'sim_no',
					'type'=>'raw',
					'value' => 'CHtml::link(UHtml::markSearch($data,"sim_no"),array("simusers/view","id"=>$data->id))',
			)
	),
)); ?>
</div>
</div>
</div>
<div class="col-lg-4">
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-gear fa-fw"></i> Actions
		</div>
		<ul class="list-group">
		  <li class="list-group-item"><a href="<?php echo Yii::app()->createUrl('category/create'); ?>">Create Category</a></li>
		</ul>


</div>
</div>
