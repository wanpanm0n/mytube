<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Profile</h1>
                </div>
                <!-- /.col-lg-12 -->
			</div>
<div class="row">
<div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        	<i class="fa fa-user fa-w"></i>
                            <?php echo UserModule::t('Your profile'); ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
<!--                                     <thead> -->
<!--                                         <tr> -->
<!--                                             <th>#</th> -->
<!--                                             <th>First Name</th> -->
<!--                                             <th>Last Name</th> -->
<!--                                             <th>Username</th> -->
<!--                                         </tr> -->
<!--                                     </thead> -->
                                    <tbody>
                                        <tr>
                                            <th><?php echo CHtml::encode($model->getAttributeLabel('username')); ?></th>
                                            <td><?php echo CHtml::encode($model->username); ?></td>
                                        </tr>
                                       <?php
										$profileFields = ProfileField::model ()->forOwner ()->sort ()->findAll ();
										if ($profileFields) {
											foreach ( $profileFields as $field ) {
												if($field->varname == 'language_id' &&  $model->profile->getAttribute($field->varname)==0){
													//echo  ;
													continue;
												}
												?>
										<tr>
											<th><?php echo CHtml::encode(UserModule::t($field->title)); ?></th>
											<td><?php echo (($field->widgetView($profile))?$field->widgetView($profile):CHtml::encode((($field->range)?Profile::range($field->range,$profile->getAttribute($field->varname)):$profile->getAttribute($field->varname)))); ?></td>
										</tr>
												<?php
											} // $profile->getAttribute($field->varname)
										}
										?>
										<tr>
											<th><?php echo CHtml::encode($model->getAttributeLabel('email')); ?></th>
											<td><?php echo CHtml::encode($model->email); ?></td>
										</tr>
										<tr>
											<th><?php echo CHtml::encode($model->getAttributeLabel('create_at')); ?></th>
											<td><?php echo $model->create_at; ?></td>
										</tr>
										<tr>
											<th><?php echo CHtml::encode($model->getAttributeLabel('lastvisit_at')); ?></th>
											<td><?php echo $model->lastvisit_at; ?></td>
										</tr>
										<tr>
											<th><?php echo CHtml::encode($model->getAttributeLabel('status')); ?></th>
											<td><?php echo CHtml::encode(User::itemAlias("UserStatus",$model->status)); ?></td>
										</tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
<div class="col-lg-4">
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
				array (
						'label' => UserModule::t ( 'Manage Users' ),
						'url' => array (
								'/user/admin'
						),
						'visible' => UserModule::isAdmin (),
 						'itemOptions'=>array('class' => 'list-group-item')
						
				),
				array (
						'label' => UserModule::t ( 'Create User' ),
						'url' => array (
								'/user/admin/create'
						),
						'visible' => UserModule::isAdmin (),
						'itemOptions'=>array('class' => 'list-group-item')
				),
				array (
						'label' => UserModule::t ( 'Edit' ),
						'url' => array (
								'edit'
						),
						'itemOptions'=>array('class' => 'list-group-item')
				),
				array (
						'label' => UserModule::t ( 'Change password' ),
						'url' => array (
								'changepassword'
						),
						'itemOptions'=>array('class' => 'list-group-item')
				),
				array (
						'label' => UserModule::t ( 'Logout' ),
						'url' => array (
								'/user/logout'
						),
						'itemOptions'=>array('class' => 'list-group-item')
				)
		)));
//die ();
//$this->pageTitle = Yii::app ()->name . ' - ' . UserModule::t ( "Profile" );
// $this->breadcrumbs = array (
// 		UserModule::t ( "Profile" ) 
// );
// $this->widget('zii.widgets.CMenu', array(
//     'items'=>array(
// 		((UserModule::isAdmin ()) ? array (
// 				'label' => UserModule::t ( 'Manage Users' ),
// 				'url' => array (
// 						'/user/admin' 
// 				) 
// 		) : array ()),
//     	((UserModule::isAdmin ()) ? array (
//     				'label' => UserModule::t ( 'Create User' ),
//     				'url' => array (
//     						'/user/admin/create'
//     				)
//     	) : array ()),
// // 		((UserModule::isAdmin ()) ?array (
// // 				'label' => UserModule::t ( 'List User' ),
// // 				'url' => array (
// // 						'/user' 
// // 				) 
// // 		):array()),
// 		array (
// 				'label' => UserModule::t ( 'Edit' ),
// 				'url' => array (
// 						'edit' 
// 				) 
// 		),
// 		array (
// 				'label' => UserModule::t ( 'Change password' ),
// 				'url' => array (
// 						'changepassword' 
// 				) 
// 		),
// 		array (
// 				'label' => UserModule::t ( 'Logout' ),
// 				'url' => array (
// 						'/user/logout' 
// 				) 
// 		) 
// )));
?>
<!-- 		</div> -->
		<!-- /.panel-body -->
	</div>
</div>
</div>


<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
<div class="success">
	<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
</div>
<?php endif; ?>
