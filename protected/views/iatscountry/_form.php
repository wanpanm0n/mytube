<div class="panel panel-default">
<!-- 		<div class="panel-heading"> -->
<!-- 			<i class="fa fa-gear fa-fw"></i> Actions -->
<!-- 		</div> -->
		<!-- /.panel-heading -->
		<div class="panel-body panel-body2">
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
	<div class="col-md-4"><div class="form-group">
		<?php echo $form->labelEx($model,'country_id'); ?>
	<select id="country_uid" name ="Iatscountry[country_id]" class="form-control"><?php
		foreach($this->countryList as $country):
	?>	

		<option <?php echo $country["id"] == $model->country_id ? 'selected="selected"' : "";  ?> value='<?php echo $country["id"]; ?>'><?php echo $country["name"]; ?></option>  
		<?php
		
		endforeach;
		
		
		?></select>
		<?php echo $form->error($model,'country_id'); ?>
	</div></div>
<div class="col-md-4"><div class="form-group">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'name'); ?>
	</div></div>
<div class="col-md-4"><div class="form-group">
		<?php echo $form->labelEx($model,'amount'); ?>
		<?php echo $form->textField($model,'amount',array('size'=>60,'maxlength'=>255, 'class'=>'form-control decimal-number')); ?>
		<?php echo $form->error($model,'amount'); ?>
	</div></div>

</div>


	


	
	<br />
<!-- 	<div class="row buttons"> -->
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-success pull-right')); ?>
		<?php echo CHtml::button('Cancel',array('onclick'=>'js:history.go(-1);return false;','class'=>'btn btn-primary pull-right','style'=>'margin-right:10px'));  ?>
<!-- 	</div> -->

<?php $this->endWidget(); ?>

</div><!-- form -->
</div>
</div>