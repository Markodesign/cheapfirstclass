<?php
namespace App\Model;

class Role extends \PHPixie\ORM\Model{


	protected $has_many=array(
		'users'=>array(
			'model'=>'role',
			'key'=>'id_role',
			'foreign_key' => 'id_user',
			'through' => 'users_roles'
		)
	);
}