<?php
/* @var $this CategoryController */
/* @var $model Category */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'=>array(
			'class'=>'form-inline', 'style'=>'display:block;'
)
)); ?>

	<div class="row">
		<?php //echo $form->label($model,'id'); ?>
		<?php //echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'name'); ?>
		<?php //echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45)); ?>
	</div>
	
	<div class="form-group">
		<?php echo $form->label($model,'language_id'); ?>
		<?php //echo $form->textField($model,'language_id'); ?>
		<?php echo $form->dropDownList($model,'language_id', CHtml::listData(Language::model()->findAll(), 'id', 'name'), array('empty'=>'All', 'class'=>'form-control'));
		?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'user_id'); ?>
		<?php //echo $form->textField($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'created_date'); ?>
		<?php //echo $form->textField($model,'created_date'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'modified_date'); ?>
		<?php //echo $form->textField($model,'modified_date'); ?>
	</div>

	<div class="row buttons">
		<?php //echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->