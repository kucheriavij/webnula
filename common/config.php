<?php
/**
 * 
 *
 * @author 
 * @link 
 * @copyright 
 * @license 
 */

error_reporting(E_ALL &~(E_WARNING|E_NOTICE));

return array(
	'basePath' => APP_PATH,
	'name' => 'My Web Application',
	
	'preload'=>array('log'),

	'timeZone' => 'Europe/Moscow',
	
	'language' => 'ru',
	
	'controllerNamespace' => 'application\controllers',

	'controllerMap' => array(
		'site' => array('class' => 'application\controllers\SiteController'),
	),
	
	'aliases' => array(
		'kernel' => 'webroot.vendor.webnula.kernel',
		'backend' => 'webroot.vendor.webnula.backend',
		'scope' => 'application',
		'compiled' => 'webroot.temp.app',
		'common' => 'webroot.common',
	),
	
	'modules' => array(
		/*'gii' => array(
			'class' => 'system.gii.GiiModule',
			'password' => '123456',
			'ipFilters' => array('*')
		),*/
		'cms' => require("backend.php"),
	),
	
	'components' => array(
		'user' => array(
			'class' => 'kernel\components\WebUser',
			'userModel' => 'common\storage\User',
			'allowAutoLogin'=>true,
		),
		
		'mailer' => array(
			'class' => 'application.extensions.Mailer',
			'robot' => array(
				'debugMail' => 'mail@domain.tld',
				'name' => 'NoReply',
				'mail' => 'mail@domain.tld'
			),
		),
		
		'authManager' => array(
			'class'=>'CDbAuthManager',
            'connectionID'=>'db',
            'itemTable'=>'{{authitem}}',
            'itemChildTable'=>'{{authitemchild}}',
            'assignmentTable'=>'{{authassignment}}',
		),
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName' => false,
			'appendParams' => true,
			'rules'=>array(
				'gii'=>'gii',
	            'gii/<controller:\w+>'=>'gii/<controller>',
	            'gii/<controller:\w+>/<action:\w+>'=>'gii/<controller>/<action>',
				array('class' => 'backend\components\WebRouter'),
				array('class' => 'kernel\components\WebRouter'),
			),
		),
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=db_test',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'tablePrefix' => 'tbl__'
		),
		
		'viewRenderer' => array(
			'class'=>'application\extensions\SmartyViewRenderer',
			'fileExtension' => '.tpl',
			'directoryPermission' => 0777,
			'pluginsDir' => 'scope.views.plugins',
			'postfilters' => array(),
			'config'=>array(
			    'force_compile' => YII_DEBUG,
				'compile_dir' => 'compiled',
			)
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		
		'messages' => array(
			'extensionPaths' => array(
				'kernel' => 'kernel.messages'
			)
		),
		
		'log' => array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
	),
	
	'params' => array(
		'projectName' => 'WebNula',
		
		'handlers' => array(
			'site' => 'Главная страница',
		),
		
		'styles' => array(
			array('title' => 'lightbox', 'classes' => 'lightbox'),
		),
		
		'sizes' => array(
		),
	)
);
