<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Manage Category</h1>
                </div>
                <!-- /.col-lg-12 -->

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
		//'id',
		//'name',
			array(
					'name' => 'name',
					'type'=>'raw',
					'value' => 'CHtml::link(UHtml::markSearch($data,"name"),array("category/view","id"=>$data->id))',
			),
			array(
			'name'=>'icon',
			'type'=>'raw',
			 'htmlOptions'=>array('style'=>'text-align:center'),
			'value'=>'CHtml::tag("div", array("class"=>"fa $data->icon"))'
			//'value'=>'CHtml::tag("<div class=\'fa fa-$data->icon\'></div>")'
		),
		//'language_id',
// 		array(
// 			'name'=>'language_id',
// 			'value'=>'$data->language->name',
// 			//'type' => 'raw'		
// 		),
		//'user_id',
		//'created_date',
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
								
							true)
					//'filter'=>''
					//'type'=>'raw',
					//'value'=>'description'
			),
		//'modified_date',
		array(
			'class'=>'CButtonColumn',
			'htmlOptions'=>array('class'=>'col-md-2', 'style'=>'text-align:center'),
			'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',
		),
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
		<!-- /.panel-heading -->
<!-- 		<div class="panel-body"> -->
<?php 
// $this->widget('zii.widgets.CMenu', array(
// 		'items'=>array(
// 				//array('label'=>'List Category', 'url'=>array('index')),
// 				array('label'=>'Create Category', 'url'=>array('create')),
// 		))
// );

Yii::app()->clientScript->registerScript('search', "
// $('.search-button').click(function(){
// 	$('.search-form').toggle();
// 	return false;
// });
$('.search-form form').submit(function(){
	$('#category-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
$('#Category_language_id').on('change', function(){
    $('#category-grid').yiiGridView('update', {
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
</div>
