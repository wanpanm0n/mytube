<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Add Package</h1>
		<a href="<?php echo Yii::app()->request->baseUrl.'/package'; ?>" class="btn btn-default">List</a>
		<br/>
		<br/>
		<?php $this->renderPartial('_form', array('model'=>$model, 'product'=>$product, 'packageProduct' => $packageProduct)); ?>
	</div>
	<!-- /.col-lg-12 -->
	</div>
</div>