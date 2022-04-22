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
<div class="col-md-4"><div class="form-group">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'name'); ?>
	</div></div>
<div class="col-md-4"><div class="form-group">
		<?php echo $form->labelEx($model,'detail'); ?>
		<?php echo $form->textField($model,'detail',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'detail'); ?>
	</div></div>
<div class="col-md-4"><div class="form-group">
		<?php echo $form->labelEx($model,'code'); ?>
		<?php echo $form->textField($model,'code',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'code'); ?>
	</div></div>
</div>

<div class="row">
<div class="col-md-4"><div class="form-group">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price',array('size'=>60,'maxlength'=>255, 'class'=>'form-control only-number')); ?>
		<?php echo $form->error($model,'price'); ?>
	</div></div>
	<div class="col-md-4"><div class="form-group">
		<?php echo $form->labelEx($model,'product_id'); ?>
		<?php echo $form->textField($model,'product_id',array('size'=>60,'maxlength'=>255, 'class'=>'form-control only-number')); ?>
		<?php echo $form->error($model,'product_id'); ?>
	</div></div>

<div class="col-md-4">	<div class="form-group">
		<?php echo $form->labelEx($model,'image'); ?>
		<?php //echo $form->textField($model,'image',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo CHtml::activeFileField($model, 'image', array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'image'); ?>
	</div></div>
</div>

<div class="row">
<div class="col-md-4"><div class="form-group">
		<?php echo $form->labelEx($model,'is_active'); ?>
		<br/>
		<?php echo $form->checkBox($model,'is_active',  array('checked'=> ($model != null ? ($model->is_active == 1 ? 'checked' : '') : ''))); ?>
		
	</div></div>
</div>
	
	
	
	
	
	
	

	
	
	<?php if($model->isNewRecord!='1'){ ?>
		<br />
		<div class="form-group">
		     <?php //echo CHtml::image(Yii::app()->request->baseUrl.'/uploads/'.$model->image,"image",array("width"=>200, 'class'=>'form-control')); ?>  
			<img src="<?php echo $this->imageInternetServicePath().$model->image; ?>" alt="..." class="img-rounded" />
		</div>
		<br />
	<?php 
	}
	?>
	


	
	<br />
<!-- 	<div class="row buttons"> -->
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-success pull-right')); ?>
		<?php echo CHtml::button('Cancel',array('onclick'=>'js:history.go(-1);return false;','class'=>'btn btn-primary pull-right','style'=>'margin-right:10px'));  ?>
<!-- 	</div> -->

<?php $this->endWidget(); ?>

</div><!-- form -->
</div>
</div>