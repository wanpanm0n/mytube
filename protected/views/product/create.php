<?php
/* @var $this ProductController */
/* @var $model Product */
?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Add Product</h1>
		<a href="<?php echo Yii::app()->request->baseUrl.'/product'; ?>" class="btn btn-default">List</a>
		<br/>
		<br/>
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
	<!-- /.col-lg-12 -->
	</div>
</div>