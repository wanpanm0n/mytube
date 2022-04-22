<div class="panel panel-default">
	<div class="panel-body">
		<div class="form">

			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'package-form',
				'enableAjaxValidation'=>false,
			)); ?>

			<p class="note">Fields with
				<span class="required">*</span> are required.</p>

			<?php echo $form->errorSummary($model); ?>

			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<?php echo $form->labelEx($model,'country_id'); ?>
						<?php
							$criteria = new CDbCriteria();
							$criteria->addInCondition("id", array(73,621,409,413,609));
							echo $form->dropDownList($model,'country_id', CHtml::listData(Country::model()->findAll($criteria),'id','name'), array('empty' => 'Select Country'));
						?>
						<?php echo $form->error($model,'country_id'); ?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<?php echo $form->labelEx($model,'id'); ?>
						<?php echo $form->textField($model,'id'); ?>
						<?php echo $form->error($model,'id'); ?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<?php echo $form->labelEx($model,'price'); ?>
						<?php echo $form->textField($model,'price'); ?> RM
						<?php echo $form->error($model,'price'); ?>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<?php echo $form->labelEx($model,'code'); ?>
						<?php echo $form->textField($model,'code'); ?>
						<?php echo $form->error($model,'code'); ?>
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

			<?php
			foreach($packageProduct as $k=>$pp) {
			?>

			<div class="row">
				<div class="col-md-2">
					<div class="form-group">
						<b><?php echo $product[$k]->name ?></b>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<?php echo $form->textField($pp, "[$k]package_product_title", array('placeholder' => 'Title')); ?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<?php echo $form->textArea($pp, "[$k]package_product_description", array('placeholder' => 'Description')); ?>
					</div>
				</div>
			</div>

			<?php
			}
			?>

			<div class="row buttons">
				<div class="col-md-4">
					<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-success')); ?>
					<?php echo CHtml::button('Cancel',array('onclick'=>'js:history.go(-1);return false;','class'=>'btn btn-primary pull-right','style'=>'margin-right:10px'));  ?>
				</div>
			</div>

			<?php $this->endWidget(); ?>

		</div>
		<!-- form -->
	</div>
</div>


<script>
	// $(document).ready(function () {
	// 	var next = 0;
	// 	$("#add-more").click(function (e) {
	// 		e.preventDefault();
	// 		var addto = "#field" + next;
	// 		var addRemove = "#field" + (next);
	// 		next = next + 1;
	// 		var newIn = ' <div class="row" id="field' + next + '" name="field' + next +
	// 			'><!-- Text input--><div class="form-group"> <label class="col-md-4 control-label" for="action_id">Product Name</label> <div class="col-md-5"> <input id="action_id" name="ProductPackage['+next+']name" type="text" placeholder="" class="form-control input-md"> </div></div><br><br> <!-- Text input--><div class="form-group"> <label class="col-md-4 control-label" for="action_name">Product Balance</label> <div class="col-md-5"> <input id="action_name" name="ProductPackage['+next+']balance" type="text" placeholder="" class="form-control input-md"> </div></div></div>';
	// 		var newInput = $(newIn);
	// 		var removeBtn = '<button id="remove' + (next - 1) +
	// 			'" class="btn btn-danger remove-me" >Remove</button></div></div><div id="field">';
	// 		var removeButton = $(removeBtn);
	// 		$(addto).after(newInput);
	// 		$(addRemove).after(removeButton);
	// 		$("#field" + next).attr('data-source', $(addto).attr('data-source'));
	// 		$("#count").val(next);

	// 		$('.remove-me').click(function (e) {
	// 			e.preventDefault();
	// 			var fieldNum = this.id.charAt(this.id.length - 1);
	// 			var fieldID = "#field" + fieldNum;
	// 			$(this).remove();
	// 			$(fieldID).remove();
	// 		});
	// 	});

	// });
</script>