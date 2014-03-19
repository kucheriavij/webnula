<?php

error_reporting(0);

// change the following paths if necessary
$yii=dirname(__FILE__).'/../yii/1.14/yii.php';
$config=dirname(__FILE__).'/common/config.php';


define ('APP_PATH', dirname(__FILE__).'/frontend/');

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

// composer autoloader
include_once('vendor/autoload.php');

// yii base
require_once($yii);
// run web application
Yii::createWebApplication($config)->run();
