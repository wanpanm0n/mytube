<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Manage Feedbacks</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
<div class="col-md-12">
<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php 
// $this->renderPartial('_search',array(
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
	'id'=>'feedback-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'afterAjaxUpdate' => 'reinstallDatePicker',
	'columns'=>array(
		//'id',
		'feedback',
// 		array(
// 			'name'=>'feedback_date',
// 			'type'=>'raw',
// 			'value'=>'date("Y-m-d H:i:s", $data->feedback_date)'		
// 		),
			array(
					'name' => 'feedback_date',
					'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
							'model'=>$model,
							'attribute'=>'feedback_date',
							'language' => 'en',
							'i18nScriptFile' => 'jquery.ui.datepicker-ja.js',
							'htmlOptions' => array(
									'id' => 'datepicker_for_created_date',
									'size' => '10',
							),
							'defaultOptions' => array(  // (#3)
									'showOn' => 'focus',
									'dateFormat' => 'yy-mm-dd',
									'showOtherMonths' => true,
									'selectOtherMonths' => true,
									'changeMonth' => true,
									'changeYear' => true,
									//'showButtonPanel' => true,
							)
					),
							
							true),
					'type' => 'raw',
					'value'=>'$data->feedback_date'
					//'filter'=>''
					//'type'=>'raw',
					//'value'=>'description'
			),
		//'feedback_date',
		'feedback_user_email',
		'device_model',
		//'language_id',
		//'status',
		array(
			'class'=>'CButtonColumn',
			'htmlOptions'=>array('class'=>'col-md-2', 'style'=>'text-align:center'),
			'template'=>'{view},{delete}',
			'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }'
				
		),
	),
)); ?>
</div>
<!--  
<div class="col-md-4">
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-gear fa-fw"></i> Actions
		</div>
<?php
Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePicker(id, data) {
        //use the same parameters that you had set in your widget else the datepicker will be refreshed by default
    $('#datepicker_for_created_date').datepicker(jQuery.extend({showMonthAfterYear:false},jQuery.datepicker.regional['en'],{'dateFormat':'yy-mm-dd'}));
}
");
// $this->widget('zii.widgets.CMenu', array(
// 		'htmlOptions' => array(
// 				'class'=>'list-group',
// 		),
// 	'items' => 	array(
// 		array('label'=>'Create Feedback', 'url'=>array('create'),'itemOptions'=>array('class' => 'list-group-item')),
// 	)	
// ));
// Yii::app()->clientScript->registerScript('search', "
// $('.search-button').click(function(){
// 	$('.search-form').toggle();
// 	return false;
// });
// $('.search-form form').submit(function(){
// 	$('#feedback-grid').yiiGridView('update', {
// 		data: $(this).serialize()
// 	});
// 	return false;
// });
// ");
?></div>
-->
</div>
