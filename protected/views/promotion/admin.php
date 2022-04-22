<div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Manage Promotion</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="col-md-12"><a href="/promotion/create" class="btn btn-default"> Add</a></div>
<div class="col-md-12">

<!-- <p> -->
<!-- You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> -->
<!-- or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done. -->
<!-- </p> -->

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
 <?php 
 //$this->renderPartial('_search',array(
// 	'model'=>$model,
// )); 
 		?>
</div><!-- search-form -->
<div id="statusMsg">
	<?php if(Yii::app()->user->hasFlash('delete_failed')): ?>
		<div class="alert alert-danger">
		    <?php echo Yii::app()->user->getFlash('delete_failed'); ?>
		</div>
	<?php endif; ?>
</div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'content-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'afterAjaxUpdate' => 'reinstallDatePicker',
	//'itemsCssClass' => 'table table-bordered table-stripped',
	'columns'=>array(
		//'id',
		//'title',
			array(
					'name' => 'company',
					'type'=>'raw',
					'value' => 'CHtml::link(UHtml::markSearch($data,"company"),array("promotion/view","id"=>$data->id))',
			),
			

			array(
					'name' => 'from_date',
				
					'value'=>'$data->from_date'
),			array(
					'name' => 'to_date',
				
					'value'=>'$data->from_date'
),
		

		array(
			'class'=>'CButtonColumn',
			'htmlOptions'=>array('class'=>'col-md-2', 'style'=>'text-align:center'),
			'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',
		),
	),
)); ?>
</div>

<?php
// $this->widget('zii.widgets.CMenu', array(
// 		'items'=>array(
// 	array('label'=>'List Content', 'url'=>array('index')),
// 	array('label'=>'Create Content', 'url'=>array('create')),
// )));

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#content-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePicker(id, data) {
        //use the same parameters that you had set in your widget else the datepicker will be refreshed by default
    $('#datepicker_for_created_date').datepicker(jQuery.extend({showMonthAfterYear:false},jQuery.datepicker.regional['en'],{'dateFormat':'yy-mm-dd'}));
}
");
?>
</div>
