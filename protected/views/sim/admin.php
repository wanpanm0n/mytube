<div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Manage Sim Serial Number</h2>
                </div>
                <!-- /.col-lg-12 -->

<div class="col-md-9">
<?php
/* @var $this SimController */
/* @var $model SimSerialNo */



$this->menu=array(
	array('label'=>'List SimSerialNo', 'url'=>array('index')),
	array('label'=>'Create SimSerialNo', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#sim-serial-no-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'sim-serial-no-grid',
	'afterAjaxUpdate' => 'reinstallDatePicker',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		// 'id',
		'serial_number',
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
			),
		// 'modified_date',
		array(
			'class'=>'CButtonColumn',
			'htmlOptions'=>array('class'=>'col-md-2', 'style'=>'text-align:center'),
		),
	),
)); 
Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePicker(id, data) {
        //use the same parameters that you had set in your widget else the datepicker will be refreshed by default
    $('#datepicker_for_created_date').datepicker(jQuery.extend({showMonthAfterYear:false},jQuery.datepicker.regional['en'],{'dateFormat':'yy-mm-dd'}));
}
");
?>
</div>
<div class="col-md-3">
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-gear fa-fw"></i> Actions
		</div>
		<ul class="list-group">
		  <!-- <li class="list-group-item"><a href="<?php //echo Yii::app()->createUrl('sim/index'); ?>">List Sim Serial Numbers</a></li> -->
		  <li class="list-group-item"><a href="<?php echo Yii::app()->createUrl('sim/create'); ?>">Add Sim Serial Numbers</a></li>
		</ul>
	</div>
</div>
</div>


