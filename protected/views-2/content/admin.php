<div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Manage Contents</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
<div class="col-md-9">

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
					'name' => 'title',
					'type'=>'raw',
					'value' => 'CHtml::link(UHtml::markSearch($data,"title"),array("content/view","id"=>$data->id))',
			),
			'title_unicode',
// 			array(
// 					'header' => 'Title (Unicode)',
// 					'type'=>'html',
// 					'value' => 'CHtml::link($data->title_unicode,array("content/view","id"=>$data->id))',
// 			),
			array(
					'name' => 'description',
					//'filter'=>'',
					//'type'=>'raw',
					'value'=>'mb_substr($data->description, 0, 20, "utf-8")."..."'
),
			array(
					'name' => 'image',
					'filter'=>'',
					'type'=>'raw',
					'value'=>'(!empty($data->image))?CHtml::image(Yii::app()->request->baseUrl."/uploads/contents/".$data->category_id."/".$data->image,"",array("style"=>"max-height:100px")):""',
					'htmlOptions' => array('style'=>'text-align: center')
					//'htmlOptions'=>array('style'=>'max-width:20%')
					//'type'=>'raw',
					//'value'=>'description'
			),
			array(
					'name' => 'duration',
					//'filter'=>''
					//'type'=>'raw',
					//'value'=>'description'
			),
			array(
					'name' => 'created_date',
					'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
							'model'=>$model,
							'attribute'=>'created_date',
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
					//'filter'=>''
					//'type'=>'raw',
					//'value'=>'description'
			),
		//'description',
		//'image',
		//'duration',
		//'user_id',
		
		//'language_id',
		//'category_id',
		//'created_date',
		//'modified_date',
		
		array(
			'class'=>'CButtonColumn',
			'htmlOptions'=>array('class'=>'col-md-2', 'style'=>'text-align:center'),
			'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',
		),
	),
)); ?>
</div>
<div class="col-md-3">
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-gear fa-fw"></i> Actions
		</div>
		<ul class="list-group">
		  <li class="list-group-item"><a href="<?php echo Yii::app()->createUrl('content/index'); ?>">List Content</a></li>
		  <li class="list-group-item"><a href="<?php echo Yii::app()->createUrl('content/create'); ?>">Create Content</a></li>
		</ul>
		<!-- /.panel-heading -->
<!-- 		<div class="panel-body"> -->
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
<!-- </div> -->
</div>
</div>