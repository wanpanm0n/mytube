<?php
/* @var $this VideoStatsController */
/* @var $model VideoStats */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class='row col-md-12'>
		<div class="form group col-md-6">
			<?php echo $form->label($model,'phone_number'); ?>
			<?php echo $form->textField($model,'phone_number',array('size'=>45,'maxlength'=>45,'class'=>'form-control')); ?>
		</div>

		<div class="form group col-md-6">
			<?php echo $form->label($model,'language_id'); ?>
			<?php //echo $form->textField($model,'language_id',array('class'=>'form-control')); ?>
			<?php echo $form->dropDownList($model,'language_id', CHtml::listData(Language::model()->findAll(), 'id', 'name'), array('empty'=>'All', 'class'=>'form-control')); ?>
		</div>
	</div>	

	<div class='row col-md-12'>

		<div class="form group col-md-6">
		<?php echo $form->labelEx($model,'sim_serial_number'); ?>
		<?php echo $form->textField($model,'sim_serial_number',array('size'=>45,'maxlength'=>45, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'sim_serial_number'); ?>
	</div>

		<div class="form group col-md-6">
				<?php echo $form->label($model,'from_date'); ?>
				<?php //echo $form->textField($model,'from_date', array('class'=>'form-control')); 
	$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'name'=>'from_date',  // name of post parameter
			'model'=>$model,
			'attribute'=>'from_date',
			'options'=>array(
					'showAnim'=>'fold',
					'dateFormat'=>'yy-mm-dd',
					'minDate' => VideoStats::model()->getOldestDate()
			),
			'htmlOptions'=>array(
					//'style'=>'height:20px;',
					'class'=>'form-control',
					'id'=>'export-from_date'
			),
	));

	?>
			</div>
		</div>
		
		<div class='row col-md-12'>	
				<div class="form group col-md-6">
				<?php echo $form->label($model,'to_date'); ?>
				<?php //echo $form->textField($model,'to_date', array('class'=>'form-control')); 
				
	$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'name'=>'to_date',  // name of post parameter
			//'value'=>Yii::app()->request->cookies['created_date']->value,  // value comes from cookie after submittion
			'model'=>$model,
			'attribute'=>'to_date',
			'options'=>array(
					'showAnim'=>'fold',
					'dateFormat'=>'yy-mm-dd',
					'minDate' => VideoStats::model()->getOldestDate()
			),
			'htmlOptions'=>array(
					//'style'=>'height:20px;',
					'class'=>'form-control',
					'id'=>'export-to_date'
			),
	));

	?>
			</div>
	</div>	
	<div class="row">
			<?php echo CHtml::button('Export to CSV', array('id'=>'exportAll-button','class'=>'pull-right','style'=>'margin-right: 60px;margin-top: 8px;')); ?>
		<?php echo CHtml::submitButton('Search', array('class'=>'pull-right','style'=>'margin-right: 12px;margin-top: 8px;')); ?>

	</div>	
	<?php $this->endWidget(); ?>

	<div class='row exportDate' style="display:none">
	<?php 
$form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
));

	?>
		<div class="form group col-md-6">
				<?php echo $form->label($model,'from_date'); ?>
				<?php //echo $form->textField($model,'from_date', array('class'=>'form-control')); 
	$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'name'=>'from_date',  // name of post parameter
			'model'=>$model,
			'attribute'=>'from_date',
			'options'=>array(
					'showAnim'=>'fold',
					'dateFormat'=>'yy-mm-dd',
					'minDate' => VideoStats::model()->getOldestDate()
			),
			'htmlOptions'=>array(
					//'style'=>'height:20px;',
					'class'=>'form-control'
			),
	));

	?>
			</div>
		
				<div class="form group col-md-6">
				<?php echo $form->label($model,'to_date'); ?>
				<?php //echo $form->textField($model,'to_date', array('class'=>'form-control')); 
				
	$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'name'=>'to_date',  // name of post parameter
			//'value'=>Yii::app()->request->cookies['created_date']->value,  // value comes from cookie after submittion
			'model'=>$model,
			'attribute'=>'to_date',
			'options'=>array(
					'showAnim'=>'fold',
					'dateFormat'=>'yy-mm-dd',
					'minDate' => VideoStats::model()->getOldestDate()
			),
			'htmlOptions'=>array(
					//'style'=>'height:20px;',
					'class'=>'form-control'
			),
	));

	?>

	</div>
	<?php echo CHtml::submitButton('Export', array('id'=>'export','class'=>'pull-right','style'=>'margin-right: 12px;margin-top: 8px;')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->