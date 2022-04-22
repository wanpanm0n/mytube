
<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo UserModule::t("Create User"); ?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
<div class="row">
<div class="col-md-6">

<?php
	echo $this->renderPartial('_form', array('model'=>$model,'profile'=>$profile));
?>
</div>
<div class="col-md-4 pull-right">
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-gear fa-fw"></i> Actions
		</div>
		<!-- /.panel-heading -->
<!-- 		<div class="panel-body"> -->
<?php
// $this->breadcrumbs=array(
// 	UserModule::t('Users')=>array('admin'),
// 	UserModule::t('Create'),
// );

$this->widget('zii.widgets.CMenu', array(
		'htmlOptions' => array(
				'class'=>'list-group',
		),
    'items'=>array(
    array('label'=>UserModule::t('Create User'), 'url'=>array('create'),'itemOptions'=>array('class' => 'list-group-item')),
    array('label'=>UserModule::t('Manage Users'), 'url'=>array('admin'),'itemOptions'=>array('class' => 'list-group-item')),
    //array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('profileField/admin')),
    //array('label'=>UserModule::t('List User'), 'url'=>array('/user')),
)));
?>
<!-- </div> -->
</div>
</div>
</div>