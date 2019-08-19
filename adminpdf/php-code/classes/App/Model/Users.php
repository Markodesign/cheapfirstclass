<?php
namespace App\Model;

class Users extends \PHPixie\ORM\Model{

	public $id_field='id';	//Name of the column with the id user
	public $table='users';	//Name of the user table

	protected $has_many=array(
		'roles'=>array(					//Use this name for orm->get() in $this->pixie->orm->get('roles')
			'model'=>'role',			//The model class "targeted"
			'key'=>'id_user',			//The user key in the relation table
			'foreign_key' => 'id_role',	//The role key in the relation table
			'through' => 'users_roles'	//The relation table
		)
	);

	public function createUser($data)
	{
		$user = $this->pixie->orm->get('users')->where('email',$data['email'])->find();
		if ($user->loaded()){
			//throw new \Exception('User with email:'.$data['email'].' already exists');
			return ('User with email:'.$data['email'].' already exists');
		}


		$user = $this->pixie->orm->get('users');
		$user->email = $data['email'];
		$user->registration_date = date('Y-m-d H:i:s');

	/*	$role=$this->pixie->orm->get('role')

			->where('name','user')

			->find();

		//Add the 'pixie' role to the user

		$user->add('roles',$role);*/

		$user->password = $this->pixie->auth->provider('password')->hash_password($data['password']);
		$user->save();
	}
}