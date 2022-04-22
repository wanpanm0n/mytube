<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">View User <?php echo $model->username; ?></h1>
                </div>
                <!-- /.col-lg-12 -->
            
<div class="col-md-8">
<?php if(Yii::app()->user->hasFlash('resetsuccess')): ?>
 
<div class="alert alert-success">
    <?php echo Yii::app()->user->getFlash('resetsuccess'); ?>
</div>
 
<?php endif; ?>
<?php

 
	$attributes = array(
		//'id',
		'username',
	);
	
	$profileFields=ProfileField::model()->forOwner()->sort()->findAll();
	if ($profileFields) {
		foreach($profileFields as $field) {
			if($field->varname == 'language_id' &&  $model->profile->getAttribute($field->varname)==0){
				//echo  ;
				continue;
			}
			array_push($attributes,array(
					'label' => UserModule::t($field->title),
					'name' => $field->varname,
					'type'=>'raw',
					'value' => (($field->widgetView($model->profile))?$field->widgetView($model->profile):(($field->range)?Profile::range($field->range,$model->profile->getAttribute($field->varname)):$model->profile->getAttribute($field->varname))),
				));
		}
	}
	
	array_push($attributes,
		//'password',
		'email',
		'activkey',
		'create_at',
		'lastvisit_at',
		array(
			'name' => 'superuser',
			'value' => User::itemAlias("AdminStatus",$model->superuser),
		),
		array(
			'name' => 'status',
			'value' => User::itemAlias("UserStatus",$model->status),
		)
	);
	
	$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>$attributes,
		'htmlOptions'=>array(
			'class' => 'table table-striped table-bordered table-hover'		
		)
	));
	

?>
</div>
<div class="col-md-4">
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-gear fa-fw"></i> Actions
		</div>
		<!-- /.panel-heading -->
<!-- 		<div class="panel-body"> -->
<?php
// $this->breadcrumbs=array(
// 	UserModule::t('Users')=>array('admin'),
// 	$model->username,
// );


$this->widget('zii.widgets.CMenu', array(
		'htmlOptions' => array(
				'class'=>'list-group',
		),
    'items'=>array(
    array('label'=>UserModule::t('Create User'), 'url'=>array('create'),'itemOptions'=>array('class' => 'list-group-item')),
    array('label'=>UserModule::t('Update User'), 'url'=>array('update','id'=>$model->id),'itemOptions'=>array('class' => 'list-group-item')),
    array('label'=>UserModule::t('Reset Password'), 'url'=>array('resetPassword','id'=>$model->id),'itemOptions'=>array('class' => 'list-group-item')),
    array('label'=>UserModule::t('Delete User'), 'url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>UserModule::t('Are you sure to delete this item?')),'itemOptions'=>array('class' => 'list-group-item')),
    array('label'=>UserModule::t('Manage Users'), 'url'=>array('admin'),'itemOptions'=>array('class' => 'list-group-item')),
    //array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('profileField/admin')),
    //array('label'=>UserModule::t('List User'), 'url'=>array('/user')),
)));
?>
<!-- </div> -->
</div>
</div>
</div>
