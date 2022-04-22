<?php
/* @var $this NotificationController */
/* @var $model Notification */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'notification-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model, '','',array('class'=>'alert alert-danger')); ?>

	<div class="form group">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="form group">
		<?php echo $form->labelEx($model,'title_unicode'); ?>(<?php echo Profile::getLanguage(); ?>)
		<?php echo $form->textField($model,'title_unicode',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'title_unicode'); ?>
	</div>

	<div class="form group">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'start_date'); ?>
		<?php //echo $form->textField($model,'start_date'); ?>
		<?php //echo $form->error($model,'start_date'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'end_date'); ?>
		<?php //echo $form->textField($model,'end_date'); ?>
		<?php //echo $form->error($model,'end_date'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'language_id'); ?>
		<?php //echo $form->textField($model,'language_id'); ?>
		<?php //echo $form->error($model,'language_id'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'user_id'); ?>
		<?php //echo $form->textField($model,'user_id'); ?>
		<?php //echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'created_date'); ?>
		<?php //echo $form->textField($model,'created_date'); ?>
		<?php //echo $form->error($model,'created_date'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'modified_date'); ?>
		<?php //echo $form->textField($model,'modified_date'); ?>
		<?php //echo $form->error($model,'modified_date'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'status'); ?>
		<?php //echo $form->textField($model,'status'); ?>
		<?php //echo $form->error($model,'status'); ?>
	</div>

	<div class="row buttons" style="margin-top:10px">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-success pull-right')); ?>
		<?php echo CHtml::button('Cancel',array('onclick'=>'js:history.go(-1);returnFalse;','class'=>'btn btn-primary pull-right','style'=>'margin-right:10px'));  ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->