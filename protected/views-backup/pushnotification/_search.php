<?php
/* @var $this ContentController */
/* @var $model Content */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<div class="form group col-md-6">
			<?php echo $form->label($model,'company'); ?>
			<?php echo $form->textField($model,'company',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		</div>	
	</div>
	<div class="row">		
		<div class="form group col-md-6">
		<?php echo $form->label($model,'from_date'); 
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'name'=>'from_date','model'=>$model,'attribute'=>'from_date','options'=>array('showAnim'=>'fold','dateFormat'=>'yy-mm-dd'),
			'htmlOptions'=>array('class'=>'form-control'),
			));
		?>
		</div>
		<div class="form group col-md-6">
		<?php echo $form->label($model,'to_date'); 
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'name'=>'to_date','model'=>$model,'attribute'=>'to_date','options'=>array('showAnim'=>'fold','dateFormat'=>'yy-mm-dd'),
			'htmlOptions'=>array('class'=>'form-control'),
			));
		?>
		</div>
	</div>
	<div class="form group">
		<?php echo CHtml::submitButton('Search Promotion', array('class'=>'btn btn-success pull-right', 'style'=>'margin-top: 6px;')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->