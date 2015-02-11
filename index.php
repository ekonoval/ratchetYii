<?php

//// include Yii bootstrap file
//require_once(dirname(__FILE__).'/../framework/yii.php');
//
//// create a Web application instance and run
//Yii::createWebApplication()->run();
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

require __DIR__ . '/protected/vendor/autoload.php';
defined('YII_DEBUG') or define('YII_DEBUG',true);

$yii = dirname(__FILE__) . '/../framework/yii.php';
$config = dirname(__FILE__) . '/protected/config/main.php';


// remove the following line when in production mode
// defined('YII_DEBUG') or define('YII_DEBUG',true);

require_once($yii);
Yii::createWebApplication($config)->run();