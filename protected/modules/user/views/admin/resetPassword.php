<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Reset password of <?php echo $model->username; ?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
<div class="row">
<div class="col-md-4">
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->request->baseUrl.'/user/admin/resetPassword/id/'.$model->id,
	'id'=>'user-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
));
?>

	<div class="form group">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>20,'maxlength'=>20, 'class'=>'form-control', 'value'=>'')); ?>
		<?php echo $form->error($model,'password', array('class'=>'control-label')); ?>
	</div>


<!-- 	<div class="row buttons"> -->
		<?php echo CHtml::submitButton('Reset Password', array('class'=>'btn btn-danger pull-right', 'style'=>"margin-top:4px")); ?>
		<?php echo CHtml::link('Cancel',Yii::app()->createUrl('/user/admin/view', array('id'=>$model->id)),array('class'=>'btn btn-primary pull-right','style'=>'margin-right:10px; margin-top:4px'));  ?>
<!-- 	</div> -->

<?php $this->endWidget(); ?>

</div><!-- form -->
</div>
<div class="col-md-4 pull-right">
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-gear fa-fw"></i> Actions
		</div>
		<!-- /.panel-heading -->
<!-- 		<div class="panel-body"> -->
<?php
// $this->breadcrumbs=array(
// 	UserModule::t('Users')=>array('admin'),
// 	$model->username,
// );


$this->widget('zii.widgets.CMenu', array(
		'htmlOptions' => array(
				'class'=>'list-group',
		),
    'items'=>array(
    array('label'=>UserModule::t('Create User'), 'url'=>array('create'),'itemOptions'=>array('class' => 'list-group-item')),
    //array('label'=>UserModule::t('Update User'), 'url'=>array('update','id'=>$model->id),'itemOptions'=>array('class' => 'list-group-item')),
    //array('label'=>UserModule::t('Reset Password'), 'url'=>array('resetPassword','id'=>$model->id),'itemOptions'=>array('class' => 'list-group-item')),
    //array('label'=>UserModule::t('Delete User'), 'url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>UserModule::t('Are you sure to delete this item?')),'itemOptions'=>array('class' => 'list-group-item')),
    array('label'=>UserModule::t('Manage Users'), 'url'=>array('admin'),'itemOptions'=>array('class' => 'list-group-item')),
    //array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('profileField/admin')),
    //array('label'=>UserModule::t('List User'), 'url'=>array('/user')),
)));
?>
<!-- </div> -->
</div>
</div>
</div>
<script>
$(function(){
	if($("#User_superuser").val() == 1){
		$("#Profile_language_id").attr('disabled', true);
	}
	$("#User_superuser").on('change', function(){
		var su = ($(this).val() == 1)?true:false;
		//alert($(this).val());
		$("#Profile_language_id").attr('disabled', su);
	});
})
</script>