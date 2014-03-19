<?php
/**
 * @author
 * @version
 * @see
 * @link
 * @license
 */

return array(
	'preload' => array(
		'bootstrap'
	),
	
	'controllerNamespace' => 'backend\controllers',

	'controllerMap' => array(
		'site' => array('class' => 'backend\controllers\SiteController'),
	),
	
	// bind new aliases
	'aliases' => array(
		'bootstrap' => 'webroot.vendor.clevertech.yii-booster.src',
		'scope' => 'backend',
		'compiled' => 'webroot.temp.backend',
		'actions' => 'application.extensions.actions',
	),
	
	'modules' => array(
		'structure' => array(
			'actions' => array(
				'clearimages' => array(
					'class' => 'actions.ClearImageAction',
					'placement'=>'grid'
				)
			),
		),
		'menu',
		'media',
		'dataset'
	),
	
	'components'=>array(
		// bootstrap component
        'bootstrap'=>array(
            'class'=>'bootstrap.components.Bootstrap',
			'responsiveCss' => true
        ),
		
		// backend cache component
		'cache' => array(
			'class' => 'CDbCache',
			'cacheTableName' => '{{cache}}',
			'connectionID' => 'db',
		),
    ),
	
	'class' => 'backend\Backend',
);
