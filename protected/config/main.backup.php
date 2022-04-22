<?php

// uncomment the following to define a path alias
// yii::setpathofalias('local','path/to/local-folder');

// this is the main web application configuration. any writable
// cwebapplication properties can be configured here.
return array (
		'basepath' => dirname ( __file__ ) . DIRECTORY_SEPARATOR . '..',
		'name' => 'my web application',
		
		// preloading 'log' component
		'preload' => array (
				'log' 
		),
		
		// autoloading model and component classes
		'import' => array (
				'application.models.*',
				'application.components.*',
				'application.modules.user.models.*',
				'application.modules.user.components.*',
				'application.helpers.*',
		),
		
		'modules' => array (
				
				// uncomment the following to enable the gii tool
				
				'gii' => array (
						'class' => 'system.gii.giimodule',
						'password' => 'stuxbot26',
						
						// if removed, gii defaults to localhost only. edit carefully to taste.
						'ipFilters' => array (
								'127.0.0.1',
								'::1' 
						) 
				),
				'user' => array (
						
						// encrypting method (php hash function)
						'hash' => 'md5',
						
						// send activation email
						'sendActivationMail' => false,
						
						// allow access for non-activated users
						'loginNotActiv' => false,
						
						// activate user on registration (only sendActivationMail = false)
						'activeAfterRegister' => true,
						
						// automatically login from registration
						'autoLogin' => true,
						
						// registration path
						'registrationUrl' => array (
								'/user/registration' 
						),
						
						// recovery password path
						'recoveryUrl' => array (
								'/user/recovery' 
						),
						
						// login form path
						'loginUrl' => array (
								'/user/login' 
						),
						
						// page after login
						'returnUrl' => array (
								'/user/profile' 
						),
						
						// page after logout
						'returnLogoutUrl' => array (
								'/user/login' 
						) 
				) 
		),
		
		// application components
		'components' => array (
			 'curl' => array(
        'class' => 'ext.curl.Curl',
        'options' => array(/* additional curl options */),
    ),
				
				'user' => array (
						
						// enable cookie-based authentication
						'class' => 'WebUser',
						'allowAutoLogin' => true,
						'loginUrl' => array (
								'/user/login' 
						) 
				),
				
				// uncomment the following to enable urls in path-format
				
				'urlManager' => array (
						'urlFormat' => 'path',
						'showScriptName' => false,
						'rules' => array (
								'' => 'user/login',
								'<controller: w="">/<id: d="">' => '<controller>/view',
								'<controller: w="">/<action: w="">/<id: d="">' => '<controller>/<action>',
								'<controller: w="">/<action: w="">' => '<controller>/<action>' 
						) 
				),
				
				// database settings are configured in database.php
				'db' => require (dirname ( __file__ ) . '/database.php'),
				
				'errorhandler' => array (
						
						// use 'site/error' action to display errors
						'erroraction' => 'site/error' 
				),
				'image'=>array(
						'class'=>'application.extensions.image.CImageComponent',
						// GD or ImageMagick
						'driver'=>'GD',
						// ImageMagick setup path
						//'params'=>array('directory'=>'/opt/local/bin'),
				)
				),
		
		// 'log'=>array(
		// 'class'=>'CLogRouter',
		// 'routes'=>array(
		// array(
		// 'class'=>'CFileLogRoute',
		// 'levels'=>'error, warning',
		// ),
		// // uncomment the following to show log messages on web pages
		
		// array(
		// 'class'=>'CWebLogRoute',
		// ),
		
		// ),
		// ),
		
		
		
		// application-level parameters that can be accessed
		// using yii::app()->params['paramname']
		'params' => array (
				
				// this is used in contact page
				'adminemail' => 'webmaster@example.com' 
		) 
);
