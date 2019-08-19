<?php
return array(
	'default' => array(
		'model' => 'users',  //Name of the user table
		'login' => array(
			'password' => array(
				'login_field' => 'email',       //Column used as the login field
				'password_field' => 'password' //Column used as the password field
			)
		),
		'roles' => array(
			'driver' => 'relation',
			'type' => 'has_many',
			'name_field' => 'name', //Column for the name of the roles
			'relation' => 'roles'   //Name of the role table
		)
	)
);