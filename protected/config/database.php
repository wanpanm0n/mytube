<?php

// This is the database connection configuration.
return array(
	//'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
	// uncomment the following lines to use a MySQL database
	
	//'connectionString' => 'mysql:host=10.0.24.243;dbname=drama',
    // 'connectionString' => 'mysql:host=MTCBJVIPT302;dbname=mytube',
    //     'emulatePrepare' => true,
    //     'username' => 'mytube_api',
    //     'password' => 'mytube_MvN0!@#$',
    //     'charset' => 'utf8',
    //     'tablePrefix' => 'tbl_',
		'connectionString' => 'mysql:host=localhost;dbname=mytube',
		'emulatePrepare' => true,
		'username' => 'root',
		'password' => '',
		'charset' => 'utf8',
		'tablePrefix' => 'tbl_',
);
