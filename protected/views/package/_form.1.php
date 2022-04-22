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
				<?php echo $form->labelEx($model,'country_id'); ?>
				<?php
					$criteria = new CDbCriteria();
					$criteria->addInCondition("id", array(73,621,409,413,609));
					echo $form->dropDownList($model,'country_id', CHtml::listData(Country::model()->findAll($criteria),'id','name'));
				?>
					<?php echo $form->error($model,'country_id'); ?>
			</div>

			<div class="row">
				<?php echo $form->labelEx($model,'code'); ?>
				<?php echo $form->textField($model,'code'); ?>
				<?php echo $form->error($model,'code'); ?>
			</div>

			<div class="row">
				<?php echo $form->labelEx($model,'price'); ?>
				<?php echo $form->textField($model,'price'); ?>
				<?php echo $form->error($model,'price'); ?>
			</div>

			<!-- <div class="row add-product-field">
				<div class="entry">
					<?php //echo $form->labelEx($product,'name'); ?>
					<?php //echo $form->textField($product,'name'); ?>
					<?php //echo $form->error($product,'name'); ?>
					<?php //echo $form->labelEx($product,'description'); ?>
					<?php //echo $form->textField($product,'description'); ?>
					<?php //echo $form->error($product,'description'); ?>
					<span class="input-group-btn">
						<button class="btn btn-success btn-add" type="button">
							<span class="glyphicon glyphicon-plus"></span>
						</button>
					</span>
				</div>
			</div> -->
			<div class="row">
				<label for="Product_name" class="required">Enter Product Details <span class="required">*</span></label>
				<?php echo $form->error($product,'name'); ?>
			</div>


			<div class="row product-row">
				<div class="control-group" id="fields">
					<!-- <label class="control-label" for="field1">Add Package Product</label> -->
					<div class="controls">
						<div class="entry input-group">
							<div class="col-md-4">
								<input class="form-control" name="Product[name][]" type="text" placeholder="Name" />
							</div>
							<div class="col-md-4">
								<input class="form-control" name="Product[description][]" type="text" placeholder="Description" />
							</div>

							<button class="btn btn-success btn-add" type="button">
								<span class="glyphicon glyphicon-plus"></span>
							</button>
						</div>
						<br>
						<!-- <small>Press
							<span class="glyphicon glyphicon-plus gs"></span> to add another form field :)</small> -->
					</div>
				</div>
			</div>

			<div class="row buttons">
				<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
			</div>

			<?php $this->endWidget(); ?>

		</div>
		<!-- form -->
	</div>
</div>

<script>
	$(function () {
		$(document).on('click', '.btn-add', function (e) {
			e.preventDefault();

			var controlForm = $('#package-form'),
				currentEntry = $(this).parents('.product-row:first'),
				newEntry = $(currentEntry.clone()).insertBefore('#package-form .buttons');
			newEntry.find('input').val('');
			controlForm.find('.entry:not(:last) .btn-add')
				.removeClass('btn-add').addClass('btn-remove')
				.removeClass('btn-success').addClass('btn-danger')
				.html('<span class="glyphicon glyphicon-minus"></span>');
		}).on('click', '.btn-remove', function (e) {
			$(this).parents('.product-row:first').remove();

			e.preventDefault();
			return false;
		});
	});
	// $(function () {
	// 	$(document).on('click', '.btn-add', function (e) {
	// 		e.preventDefault();

	// 		var controlForm = $('#package-form');
	// 		var newEntry = $('.entry:first').clone().appendTo(controlForm);
	// 		// var controlForm = $('#package-form form:first'),
	// 		// 	// currentEntry = $(this).parents('.entry:first'),
	// 		// 	currentEntry = $('.entry');
	// 		// 	newEntry = $(currentEntry.clone()).appendTo(controlForm);
	// 		// console.log(currentEntry);
	// 		newEntry.find('input').val('');
	// 		controlForm.find('.entry:not(:last) .btn-add')
	// 			.removeClass('btn-add').addClass('btn-remove')
	// 			.removeClass('btn-success').addClass('btn-danger')
	// 			.html('<span class="glyphicon glyphicon-minus"></span>');
	// 	}).on('click', '.btn-remove', function (e) {
	// 		$(this).parents('.entry:first').remove();

	// 		e.preventDefault();
	// 		return false;
	// 	});
	// });
</script>