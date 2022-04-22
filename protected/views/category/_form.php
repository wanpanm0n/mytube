<?php
/* @var $this CategoryController */
/* @var $model Category */
/* @var $form CActiveForm */
?>
	<div class="panel panel-default">
<!-- 		<div class="panel-heading"> -->
<!-- 			<i class="fa fa-gear fa-fw"></i> Actions -->
<!-- 		</div> -->
		<!-- /.panel-heading -->
		<div class="panel-body panel-body2">
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'category-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
<?php 
// print_r($model->icon);
?>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model, '','',array('class'=>'alert alert-danger')); ?>

	<div class="form group">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="form group">
		<?php echo $form->labelEx($model,'language_id'); ?>
		<?php //echo $form->textField($model,'language_id'); ?>
		<?php 
		echo $form->dropDownList($model,'language_id', CHtml::listData(Language::model()->findAll(), 'id', 'name'), array('empty'=>'Select Type', 'class'=>'form-control'));
				
		//echo CHtml::dropDownList('language_id', $select,
				//$model_language);
		//echo "<pre>";
		//print_r($model_language);
		//CHtml::listData($model_language,
			//'id', 'name');
		?>
		<?php echo $form->error($model,'language_id'); ?>
	</div>

	<div class="form group">
		<?php //echo $form->labelEx($model,'user_id'); ?>
		<?php //echo $form->hiddenField($model,'user_id', array('value'=>Yii::app()->user->id)); ?>
		<?php //echo $form->error($model,'user_id'); ?>
	</div>

	<div class="form group">
		<?php echo $form->labelEx($model,'icon'); ?>
		<?php echo $form->hiddenField($model,'icon', array('id'=>'icon')); ?>
		<div class="panel-body" style="cursor:hand"  id="caticon">
			<div class="row">
				<div class="col-md-1"><i class="fa fa-music"></i></div>
				<div class="col-md-1"><i class="fa fa-video-camera"></i></div>
				<div class="col-md-1"><i class="fa fa-star"></i></div>
				<div class="col-md-1"><i class="fa fa-film"></i></div>
				<div class="col-md-1"><i class="fa fa-play-circle"></i></div>
				<div class="col-md-1"><i class="fa fa-diamond"></i></div>
				<div class="col-md-1"><i class="fa fa-cart-arrow-down"></i></div>
				<div class="col-md-1"><i class="fa fa-briefcase"></i></div>
				<div class="col-md-1"><i class="fa fa-gear"></i></div>
				<div class="col-md-1"><i class="fa fa-gears"></i></div>
				<div class="col-md-1"><i class="fa fa-envelope"></i></div>
				<div class="col-md-1"><i class="fa fa-copyright"></i></div>
			</div>
			<br />
			<div class="row">
				<div class="col-md-1"><i class="fa fa-flag"></i></div>
				<div class="col-md-1"><i class="fa fa-image"></i></div>
				<div class="col-md-1"><i class="fa fa-inbox"></i></div>
				<div class="col-md-1"><i class="fa fa-info-circle"></i></div>
				<div class="col-md-1"><i class="fa fa-wrench"></i></div>
			</div>
		</div>
		<?php echo $form->error($model,'icon'); ?>
	</div>

	<div class="form group">
		<?php //echo $form->labelEx($model,'created_date'); ?>
		<?php //echo $form->textField($model,'created_date'); ?>
		<?php //echo $form->error($model,'created_date'); ?>
	</div>

	<div class="form group">
		<?php //echo $form->labelEx($model,'modified_date'); ?>
		<?php //echo $form->textField($model,'modified_date'); ?>
		<?php //echo $form->error($model,'modified_date'); ?>
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
<script type="text/javascript">
	$(document).ready(function(){
		var category_icon = '<?php echo !empty($model->icon)?$model->icon:"" ?>';

		if(category_icon != '' || typeof category_icon !== 'undefined'){
			$('#caticon i').each(function(){
				if($(this).attr('class') == 'fa '+category_icon)
					$(this).css({'color': '#c8202e'});
			});
		}

		$('#caticon i').on('click', function(){
			$('.fa').removeAttr('style');
			$(this).css({'color': '#c8202e'});
			var icon = $(this).attr('class').split(' ');
			//icon = icon[1].split(/-(.+)?/)[1];
			//alert(icon);
			$('#icon').attr('value', icon[1]);
		});
	});
</script>