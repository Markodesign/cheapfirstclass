<?php

namespace App;

/**
 * Pixie dependency container
 *
 * @property-read \PHPixie\DB $db Database module
 * @property-read \PHPixie\ORM $orm ORM module
 */
class Pixie extends \PHPixie\Pixie {

	public $basepath='/pixie-web/';

	public $devices_type = array('master', 'rover', 'barista');

	public $account_type_configuration = array(
		"basic" => array('master'=> 1),
		"pro" => array('master'=> 1,'rover'=>1 ,'barista'=>1),
		"multi" => array('master'=> 3,'rover'=>1 ,'barista'=>2),
	);
	public $error_message_arr = array(
		"invalid_key"         => array(
			'status'  => 'invalid',
			'message' => array(
				'title' => 'Key is invalid',
				'body'  => 'The key is not found, maybe you made a mistake',
			),
		),

		"deactivated_key"     => array(
			'status'  => 'deactivated',
			'message' => array(
				'title' => 'Key is deactivated',
				'body'  => 'Your key was deactivated due to insufficient balance',
			),
		),
		"invalid_device_id"   => array(
			'status'  => 'invalid',
			'message' => array(
				'title' => 'Device id empty or invalid',
				'body'  => 'Device id empty or invalid',
			),

		),
		"invalid_device_type" => array(
			'status'  => 'invalid',
			'message' => array(
				'title' => 'Wrong device type',
				'body'  => 'Device type is  empty or invalid',
			),
		),
		"deactivated_device"  => array(
			'status'  => 'valid',
			'message' => array(
				'title' => 'Device deactivated',
				'body'  => 'Your device was deactivated',
			),
			'logout'  => array(
				'need_logout' => true,
				'title'       => 'Device deactivated',
				'message'     => 'Your device was deactivated',
			),
		),
		"count_devices"       => array(
			'status'  => 'valid',
			'message' => array(
				'title' => 'Exceeded amount of devices',
				'body'  => "Your account doesn't allow to connect *available_devices* devices",
			),
			'logout'  => array(
				'need_logout' => true,
				'title'       => 'Exceeded amount of devices',
				'message'     => "Your account doesn't allow to connect *available_devices* devices",
			)

		),

	);

	protected $modules = array(
		'db' => '\PHPixie\DB',
		'orm' => '\PHPixie\ORM',

		 'auth' => '\PHPixie\Auth',
		'email' => '\PHPixie\Email',
		'validate' => '\PHPixie\Validate'

	);

	protected function after_bootstrap() {
		// Whatever code you want to run after bootstrap is done.

	//
	}

}
