<?php

return array(

	'registration' => array('/registration', array(
		'controller' => 'user',
		'action' => 'registration'
	)),
	'login' => array('/login', array(
		'controller' => 'user',
		'action' => 'login'
	)),
	'app_ipad' => array('/app/ipad', array(
		'controller' => 'appService',
		'action' => 'ipad'
	)),
	'app_cms' => array('/app/cms', array(
		'controller' => 'appCms',
		'action' => 'cms'
	)),
	'default' => array(
		function($url){
					return array();
		},
		array(
			'controller' => 'hello',
			'action' => 'index'
		)
	),
);
