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
	<div class="col-md-6">
		<div class="form-group">
		<?php echo $form->labelEx($model,'company'); ?>
		<?php echo $form->textField($model,'company',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'company'); ?>
	</div>
	</div>

	<div class="col-md-6">
		<div class="row">
		<div class="col-md-6">
		<div class="form-group">
		<?php echo $form->label($model,'from_date'); 
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'name'=>'from_date','model'=>$model,'attribute'=>'from_date','options'=>array('showAnim'=>'fold','dateFormat'=>'yy-mm-dd'),
			'htmlOptions'=>array('class'=>'form-control'),
			));
		?>
		</div></div>
		<div class="col-md-6">
		<div class="form-group">
		<?php echo $form->label($model,'to_date'); 
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'name'=>'to_date','model'=>$model,'attribute'=>'to_date','options'=>array('showAnim'=>'fold','dateFormat'=>'yy-mm-dd'),
			'htmlOptions'=>array('class'=>'form-control'),
			));
		?>
		</div></div>
		</div>


	</div>
</div>
	
	<div class="row">
		<div class="col-md-4">
			<div class="form group">
		<?php echo $form->labelEx($model,'language_ids'); ?>
		<?php //echo $form->textField($model,'language_id'); ?>
		<?php 
		echo $form->dropDownList($model,'language_ids', CHtml::listData(Language::model()->findAll(), 'id', 'name'), array('empty'=>'Select Language', 'class'=>'form-control',"multiple"=>"multiple", "id"=>"language_ids"));
				
	
		?>
		<?php echo $form->error($model,'language_ids'); ?>
	</div>
		</div>
			<div class="col-md-4">
		<div class="form-group">
		<?php echo $form->labelEx($model,'display_order'); ?>
		<?php echo $form->textField($model,'display_order',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'display_order'); ?>
	</div>
	</div>
		</div>
	

	<div class="row">
		<div class="col-md-4">
			<div class="form group">
		<?php echo $form->labelEx($model,'language_id'); ?>
		<?php //echo $form->textField($model,'language_id'); ?>
		<?php 
		echo $form->dropDownList($model,'language_id', CHtml::listData(Language::model()->findAll(), 'id', 'name'), array('empty'=>'Select Language', 'class'=>'form-control'));
				
	
		?>
		<?php echo $form->error($model,'language_id'); ?>
	</div>
		</div>
			<div class="col-md-4">
		<div class="form-group">
		<?php echo $form->labelEx($model,'image'); ?>
		<?php //echo $form->textField($model,'image',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo CHtml::activeFileField($model, 'image', array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'image'); ?>
	</div>
		</div>
		<div class="col-md-4">
		<div class="form-group">
		<?php echo $form->labelEx($model,'is_active'); ?>
		<br/>
		<?php echo $form->checkBox($model,'is_active',  array('checked'=> ($model != null ? ($model->is_active == 1 ? 'checked' : '') : ''))); ?>
		
	</div>
		</div>
	
	</div>
		
		<div class="row">
	

			</div>
	
	<?php if($model->isNewRecord!='1'){ ?>
		<br />
		<div class="form-group">
		     <?php //echo CHtml::image(Yii::app()->request->baseUrl.'/uploads/'.$model->image,"image",array("width"=>200, 'class'=>'form-control')); ?>  
			<img src="<?php echo $this->imagePromotion().$model->image; ?>" alt="..." class="img-rounded" />
		</div>
		<br />
	<?php 
	}
	?>
	


	
	<br />
<!-- 	<div class="row buttons"> -->
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-success pull-right')); ?>
		<?php echo CHtml::button('Cancel',array('onclick'=>'window.location.href="/promotion"','class'=>'btn btn-primary pull-right','style'=>'margin-right:10px'));  ?>
<!-- 	</div> -->

<?php $this->endWidget(); ?>

</div><!-- form -->
</div>
</div>


<script>
$(function(){
 	var language_ids = $("#language_ids").kendoMultiSelect();
	 var ids = [];

	<?php
	
		if(isset($_POST['Promotion']["language_ids"]) && !empty($_POST['Promotion']["language_ids"])) :
			echo "\n";
			echo '$("#language_ids").getKendoMultiSelect().value(['.$_POST['Promotion']["language_ids"].']);';
		else:
			echo "\n";
			echo '$("#language_ids").getKendoMultiSelect().value(['.$model->language_ids.']);';
		endif;
	?>
})
      

</script>