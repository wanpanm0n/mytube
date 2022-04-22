<?php
/* @var $this FeedbackController */
/* @var $model Feedback */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'feedback-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'feeback'); ?>
		<?php echo $form->textArea($model,'feeback',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'feeback'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'feedback_date'); ?>
		<?php echo $form->textField($model,'feedback_date'); ?>
		<?php echo $form->error($model,'feedback_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'feeback_user_name'); ?>
		<?php echo $form->textField($model,'feeback_user_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'feeback_user_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'language_id'); ?>
		<?php echo $form->textField($model,'language_id'); ?>
		<?php echo $form->error($model,'language_id'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'status'); ?>
		<?php //echo $form->textField($model,'status'); ?>
		<?php //echo $form->error($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->