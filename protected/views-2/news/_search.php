<?php
/* @var $this ContentController */
/* @var $model Content */
/* @var $form CActiveForm */
?>
<div class="panel panel-default">
<div class="panel-heading">Search News</div>
<div class="panel-body">
<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<div class="form-group col-md-6">
			<?php echo $form->label($model,'title'); ?>
			<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		</div>
	<div class="form-group col-md-6">
			<?php echo $form->label($model,'title_unicode'); ?>
			<?php echo $form->textField($model,'title_unicode',array('class'=>'form-control')); ?>
		</div>
	
		
	</div>
	<div class="row">
		
		<div class="form-group col-md-6">
			<?php echo $form->label($model,'created_date'); ?>
			<?php //echo $form->textField($model,'modified_date', array('class'=>'form-control')); 
$this->widget('zii.widgets.jui.CJuiDatePicker', array(
		'name'=>'created_date',  // name of post parameter
		//'value'=>Yii::app()->request->cookies['created_date']->value,  // value comes from cookie after submittion
		'model'=>$model,
		'attribute'=>'created_date',
		'options'=>array(
				'showAnim'=>'fold',
				'dateFormat'=>'yy-mm-dd',
		),
		'htmlOptions'=>array(
				//'style'=>'height:20px;',
				'class'=>'form-control'
		),
));
?>
		</div>
	</div>
	<div class="form-group">
		<?php echo CHtml::submitButton('Search', array('class'=>'btn btn-success pull-right', 'style'=>'margin-top: 6px;')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
</div>
</div>