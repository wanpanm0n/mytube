<style>
	body{ background : #C8202E!important}
	.login-container {
    max-width: 960px;
    margin: 0 auto;
}

form{
    position: relative;
    padding: 30px;
    margin-bottom: 20px;
	margin-top :150px;
}

form {
    box-shadow: 0 16px 28px 0 rgba(0, 0, 0, 0.22), 0 25px 55px 0 rgba(0, 0, 0, 0.21);
    background: #fff;
}

.form-group {
    position: relative;
    margin-bottom: 20px;
}

.form-group .form-control {
    height: 40px;
}

.logo{font-size:60px; margin-bottom :10px;}
</style>



<?php if(Yii::app()->user->hasFlash('loginMessage')): ?>

<div class="success">
	<?php echo Yii::app()->user->getFlash('loginMessage'); ?>
</div>

<?php endif; ?>

<p><?php //echo UserModule::t("Please fill out the following form with your login credentials:"); ?></p>
<div class="login-container">
<div class="row">
	<div class="col-md-6 offset-md-3">
		<?php echo CHtml::beginForm(); ?>


	
	<?php echo CHtml::errorSummary($model, '','',array('class'=>'alert alert-danger')); ?>

	<div class="login-header">
                    <!--<app-Logo></app-Logo>-->
                    <div class="logo">
                         mytube
                    </div>
                    <p>Please provide your login details to continue</p>
                </div>

<div class="input-group form-group">
<div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
            </div>
                   <?php echo CHtml::activeTextField($model,'username', array('class'=>'form-control','placeHolder'=>'Email'))?>
                </div>



		<?php //echo CHtml::activeLabelEx($model,'password'); ?>

		<div class="input-group form-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon2"><i class="fa fa-key"></i></span>
            </div>
                   <?php echo CHtml::activePasswordField($model,'password', array('class'=>'form-control','placeHolder'=>'Password'))?>
                </div>
	
		<div class="checkBox rememberMe">
		<label><?php echo CHtml::activeCheckBox($model,'rememberMe'); ?>Remember Me</label>
		<?php //echo CHtml::activeLabelEx($model,'rememberMe'); ?>
	</div>

		<?php echo CHtml::submitButton(UserModule::t("Login"), array('class'=>'btn btn-lg btn-danger btn-block', 'style'=>'background-color:#C8202E')); ?>

	
<?php echo CHtml::endForm(); ?>
	</div>
</div>

</div>
<!-- form -->


<?php
// $form = new CForm(array(
// 'elements'=>array(
// 'username'=>array(
// 'type'=>'text',
// 'maxlength'=>32,
// ),
// 'password'=>array(
// 'type'=>'password',
// 'maxlength'=>32,
// ),
// 'rememberMe'=>array(
// 'type'=>'checkbox',
// )
// ),

// 'buttons'=>array(
// 'login'=>array(
// 'type'=>'submit',
// 'label'=>'Login',
// ),
// ),
// ), $model);
?>
<!-- <div class="row"> -->
<!-- 	<div class="col-md-4 col-md-offset-4"> -->
<!-- 		<div class="login-panel panel panel-default"> -->
<!-- 			<div class="panel-heading"> -->
<!-- 				<h3 class="panel-title">Please Sign In</h3> -->
<!-- 			</div> -->
<!-- 			<div class="panel-body"> -->
<!-- 				<form role="form"> -->
<!-- 					<fieldset> -->
<!-- 						<div class="form-group"> -->
<!-- 							<input class="form-control" placeholder="E-mail" name="email" -->
<!-- 								type="email" autofocus> -->
<!-- 						</div> -->
<!-- 						<div class="form-group"> -->
<!-- 							<input class="form-control" placeholder="Password" -->
<!-- 								name="password" type="password" value=""> -->
<!-- 						</div> -->
<!-- 						<div class="checkbox"> -->
<!-- 							<label> <input name="remember" type="checkbox" -->
<!-- 								value="Remember Me">Remember Me -->
<!-- 							</label> -->
<!-- 						</div> -->
<!-- Change this to a button or input when using this as a form -->
<!-- 						<a href="index.html" class="btn btn-lg btn-success btn-block">Login</a> -->
<!-- 					</fieldset> -->
<!-- 				</form> -->
<!-- 			</div> -->
<!-- 		</div> -->
<!-- 	</div> -->
<!-- </div> -->
