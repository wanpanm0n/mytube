<?php
/* @var $this FeedbackController */
/* @var $data Feedback */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('feeback')); ?>:</b>
	<?php echo CHtml::encode($data->feeback); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('feedback_date')); ?>:</b>
	<?php echo CHtml::encode($data->feedback_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('feeback_user_name')); ?>:</b>
	<?php echo CHtml::encode($data->feeback_user_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('language_id')); ?>:</b>
	<?php echo CHtml::encode($data->language_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />


</div>