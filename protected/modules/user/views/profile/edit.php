<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Profile</h1>
                </div>
                <!-- /.col-lg-12 -->

<div class="col-lg-6">

<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
</div>
<?php endif; ?>
<div class="form panel-body">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'profile-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array('enctype'=>'multipart/form-data', 'class'=>''),
)); ?>

	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo $form->errorSummary(array($model,$profile)); ?>

<?php 
		$profileFields=$profile->getFields();
		if ($profileFields) {
			foreach($profileFields as $field) {
			?>
	<div class="form group">
		<?php echo $form->labelEx($profile,$field->varname);
		
		if ($widgetEdit = $field->widgetEdit($profile)) {
			echo $widgetEdit;
		} elseif ($field->range) {
			echo $form->dropDownList($profile,$field->varname,Profile::range($field->range), array('class'=>'form-control'));
		} elseif ($field->field_type=="TEXT") {
			echo $form->textArea($profile,$field->varname,array('rows'=>6, 'cols'=>50, 'class'=>'form-control'));
		} else {
			echo $form->textField($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255), 'class'=>'form-control'));
		}
		echo $form->error($profile,$field->varname); ?>
	</div>	
			<?php
			}
		}
?>
	<div class="form group">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>20,'maxlength'=>20, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="form group">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save'), array('class'=>'btn btn-success pull-right', 'style'=>'margin-top:6px')); ?>
		<?php echo CHtml::button('Cancel',array('onclick'=>'js:history.go(-1);return false;','class'=>'btn btn-primary pull-right','style'=>'margin-right:10px; margin-top:6px'));  ?>
		
	</div>
	<br/>
	<br/>

<?php $this->endWidget(); ?>

</div><!-- form -->
</div>
<div class="col-lg-4 pull-right">
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-gear fa-fw"></i> Actions
		</div>
		<!-- /.panel-heading -->
<!-- 		<div class="panel-body"> -->
<?php 
$this->widget('zii.widgets.CMenu', array(
		'htmlOptions' => array(
				'class'=>'list-group',
		),
    'items'=>array(
	array('label'=>UserModule::t('Manage Users'), 'url'=>array('/user/admin'), 'visible'=>UserModule::isAdmin(),'itemOptions'=>array('class' => 'list-group-item')),
    array('label'=>UserModule::t('List User'), 'url'=>array('/user'),'itemOptions'=>array('class' => 'list-group-item')),
    array('label'=>UserModule::t('Profile'), 'url'=>array('/user/profile'),'itemOptions'=>array('class' => 'list-group-item')),
    array('label'=>UserModule::t('Change password'), 'url'=>array('changepassword'),'itemOptions'=>array('class' => 'list-group-item')),
    array('label'=>UserModule::t('Logout'), 'url'=>array('/user/logout'),'itemOptions'=>array('class' => 'list-group-item')),
)));
?>
<!-- 		</div> -->
	</div>
</div>
</div>