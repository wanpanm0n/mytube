<div class="panel panel-default">
<!-- 		<div class="panel-heading"> -->
<!-- 			<i class="fa fa-gear fa-fw"></i> Actions -->
<!-- 		</div> -->
		<!-- /.panel-heading -->
		<div class="panel-body">
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'content-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
		'htmlOptions' => array(
				'enctype' => 'multipart/form-data',
		),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model, '','',array('class'=>'alert alert-danger')); ?>

<div class="row">
	<div class="col-md-12"> 
		<div class="form group">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>50, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>
	</div>
<div class="col-md-12">
		<div class="form-group">
		<?php echo $form->labelEx($model,'message'); ?>
		<?php echo $form->textArea($model,'message',array('class'=>'form-control','maxlength'=>180)); ?>
		<?php echo $form->error($model,'message'); ?>
	</div>
	</div>

	
</div>
	
	


		
	
	


	
	<br />
<!-- 	<div class="row buttons"> -->
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-success pull-right')); ?>
		<?php echo CHtml::button('Cancel',array('onclick'=>'window.location.href="/pushnotification"','class'=>'btn btn-primary pull-right','style'=>'margin-right:10px'));  ?>
<!-- 	</div> -->

<?php $this->endWidget(); ?>

</div><!-- form -->
</div>
</div>