<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Manage Users</h1>
                </div>
                <!-- /.col-lg-12 -->
			</div>
<div class="row">
<div class="col-md-8">

<?php //echo CHtml::link(UserModule::t('Search'),'#',array('class'=>'search-button')); ?>
<!--
<div class="search-form" style="display:none">
// <?php //$this->renderPartial('_search',array(
//     'model'=>$model,
// )); ?>
</div>
-->
<!-- search-form -->
<div id="statusMsg">
	<?php if(Yii::app()->user->hasFlash('delete_failed')): ?>
		<div class="alert alert-danger">
		    <?php echo Yii::app()->user->getFlash('delete_failed'); ?>
		</div>
	<?php endif; ?>
</div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'afterAjaxUpdate' => 'reinstallDatePicker',
	'columns'=>array(
// 		array(
// 			'name' => 'id',
// 			'type'=>'raw',
// 			'value' => 'CHtml::link(CHtml::encode($data->id),array("admin/update","id"=>$data->id))',
// 		),
		array(
			'name' => 'username',
			'type'=>'raw',
			'value' => 'CHtml::link(UHtml::markSearch($data,"username"),array("admin/view","id"=>$data->id))',
		),
		array(
			'name'=>'email',
			'type'=>'raw',
			'value'=>'CHtml::link(UHtml::markSearch($data,"email"), "mailto:".$data->email)',
		),
		//'create_at',
			array(
					'name' => 'create_at',
					'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
							'model'=>$model,
							'attribute'=>'create_at',
							'language' => 'en',
							'i18nScriptFile' => 'jquery.ui.datepicker-ja.js',
							'htmlOptions' => array(
									'class' => 'datepicker_for_created_date',
									'size' => '10',
							),
							'defaultOptions' => array(  // (#3)
									'showOn' => 'focus',
									'dateFormat' => 'yy-mm-dd',
									'showOtherMonths' => true,
									'selectOtherMonths' => true,
									'changeMonth' => true,
									'changeYear' => true,
									'showButtonPanel' => true,
							)
					),
							true),
					//'filter'=>''
					//'type'=>'raw',
					//'value'=>'description'
			),
		//'lastvisit_at',
			array(
					'name' => 'lastvisit_at',
					'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
							'model'=>$model,
							'attribute'=>'lastvisit_at',
							'language' => 'en',
							'i18nScriptFile' => 'jquery.ui.datepicker-ja.js',
							'htmlOptions' => array(
									'class' => 'datepicker_for_created_date',
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
		array(
			'name'=>'superuser',
			'value'=>'User::itemAlias("AdminStatus",$data->superuser)',
			'filter'=>User::itemAlias("AdminStatus"),
		),
// 		array(
// 			'name'=>'status',
// 			'value'=>'User::itemAlias("UserStatus",$data->status)',
// 			'filter' => User::itemAlias("UserStatus"),
// 		),
		array(
			'class'=>'CButtonColumn',
			'htmlOptions'=>array('class'=>'col-md-2', 'style'=>'text-align:center'),
			'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',
		),
	),
)); ?>
</div>
<div class="col-md-4">
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-gear fa-fw"></i> Actions
		</div>
<?php
$this->widget('zii.widgets.CMenu', array(
		'htmlOptions' => array(
				'class'=>'list-group',
		),
    'items'=>array(
    array('label'=>UserModule::t('Create User'), 'url'=>array('create'),'itemOptions'=>array('class' => 'list-group-item')),
    //array('label'=>UserModule::t('Manage Users'), 'url'=>array('admin')),
    //array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('profileField/admin')),
   // array('label'=>UserModule::t('List User'), 'url'=>array('/user')),
)));

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});	
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('user-grid', {
        data: $(this).serialize()
    });
    return false;
});
");
Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePicker(id, data) {
        //use the same parameters that you had set in your widget else the datepicker will be refreshed by default
    $('.datepicker_for_created_date').datepicker(jQuery.extend({showMonthAfterYear:false},jQuery.datepicker.regional['en'],{'dateFormat':'yy-mm-dd'}));
}
");
?>
<!-- </div> -->
</div>
</div>
</div>
