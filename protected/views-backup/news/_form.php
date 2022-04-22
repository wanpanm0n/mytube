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
		<div class="col-md-4">
			<div class="form-group">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
		<?php echo $form->labelEx($model,'title_unicode'); ?>(<?php echo Profile::getLanguage(); ?>)
		<?php echo $form->textField($model,'title_unicode',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'title_unicode'); ?>
	</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
		<?php echo $form->labelEx($model,'link'); ?>
		<?php echo $form->textField($model,'link', array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'link'); ?>
	</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-4"><div class="form-group">
		<?php echo $form->labelEx($model,'image'); ?>
		<?php //echo $form->textField($model,'image',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo CHtml::activeFileField($model, 'image', array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'image'); ?>
	</div></div>
		<div class="col-md-4"></div>
		<div class="col-md-4"></div>
	</div>

	
	
	
	
	
	
	



	
	
	<?php if($model->isNewRecord!='1'){ ?>
		<br />
		<div class="form-group">
		     <?php //echo CHtml::image(Yii::app()->request->baseUrl.'/uploads/'.$model->image,"image",array("width"=>200, 'class'=>'form-control')); ?>  
			<img src="<?php echo $this->imageNewsPath().$model->image; ?>" alt="..." class="img-rounded" />
		</div>
		<br />
	<?php 
	}
	?>


	<div class="row">
			<?php echo $form->hiddenField($model,'user_id', array('value'=>Yii::app()->user->id)); ?>
	
		<?php //echo $form->labelEx($model,'user_id'); ?>
		<?php //echo $form->textField($model,'user_id'); ?>
		<?php //echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'language_id'); ?>
		<?php 		//echo $form->dropDownList($model,'language_id', CHtml::listData(Language::model()->findAll(), 'id', 'name'), array('empty'=>'select Type'));
		?>
		<?php //echo $form->textField($model,'language_id'); ?>
		<?php //echo $form->error($model,'language_id'); ?>
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
	<br />
<!-- 	<div class="row buttons"> -->
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-success pull-right')); ?>
		<?php echo CHtml::button('Cancel',array('onclick'=>'window.location.href="/news"','class'=>'btn btn-primary pull-right','style'=>'margin-right:10px'));  ?>
<!-- 	</div> -->

<?php $this->endWidget(); ?>

</div><!-- form -->
</div>
</div>