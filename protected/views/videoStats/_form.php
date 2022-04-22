<?php
/* @var $this VideoStatsController */
/* @var $model VideoStats */
/* @var $form CActiveForm */
?>

	<div class="panel panel-default">
<!-- 		<div class="panel-heading"> -->
<!-- 			<i class="fa fa-gear fa-fw"></i> Actions -->
<!-- 		</div> -->
		<!-- /.panel-heading -->
		<div class="panel-body">
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'video-stats-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form group">
		<?php echo $form->labelEx($model,'device_id'); ?>
		<?php echo $form->textField($model,'device_id',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'device_id'); ?>
	</div>

	<div class="form group">
		<?php echo $form->labelEx($model,'device_model'); ?>
		<?php echo $form->textField($model,'device_model',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'device_model'); ?>
	</div>

	<div class="form group">
		<?php echo $form->labelEx($model,'phone_number'); ?>
		<?php echo $form->textField($model,'phone_number',array('size'=>45,'maxlength'=>45, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'phone_number'); ?>
	</div>

	<div class="form group">
		<?php //echo $form->labelEx($model,'content_id'); ?>
		<?php //echo $form->textField($model,'content_id',array('class'=>'form-control')); ?>
		<?php //echo $form->error($model,'content_id'); ?>
	</div>

	<div class="form group">
		<?php echo $form->labelEx($model,'count'); ?>
		<?php echo $form->textField($model,'count', array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'count'); ?>
	</div>

			<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-success pull-right','style'=>'margin-top:4px')); ?>
		<?php echo CHtml::button('Cancel',array('onclick'=>'js:history.go(-1);return false;','class'=>'btn btn-primary pull-right','style'=>'margin-right:10px; margin-top:4px'));  ?>


<!--	<div class="row buttons"> -->
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
<!--	</div> -->

<?php $this->endWidget(); ?>

</div><!-- form -->