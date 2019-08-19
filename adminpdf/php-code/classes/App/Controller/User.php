<?php

namespace App\Controller;

class User extends \App\Page {

	public function action_index() {
		$this->view->subview = 'hello';
		$this->view->message = 'Have fun coding';


		$res =	$this->pixie->db->query('select')->table('users')
			->execute()->as_array();

		print_r($res);
	}

	public function action_registration() {

		if ($this->request->method === 'POST') {

			$validator  = $this->pixie->validate->get($this->request->post());
			$validator->field('password')
				->rule('filled')
				->rule('min_length', 8)
				->error('Invalid password (must contain 8+ characters)');

			$validator->field('passwordCheck')
				->rule('filled')
				->rule('same_as', 'password')
				->error('Passwords do not match');

			$validator->field('email')
				->rule('filled')
				->rule('email')
				->error('Invalid email');
			if ($validator->valid()) {
				//Create account
				$this->pixie->orm->get('users')->createUser($this->request->post());

				$this->view->message = 'User created !!';
			} else {

				$this->view->message = $validator->errors();
			}
		}else{
			$this->view->message = 'registration';

		}


		$this->view->post = $this->request->post();


		$this->view->subview = 'registration';




	}

	public function action_login() {
		$auth=  $this->pixie->auth;
		$logged_in = '';

		if($auth->user()){
			$logged_in = $auth->user()->email;
		}




		if ($this->request->method === 'POST') {
			$post = $this->request->post();
			$logged_in = $auth->provider('password')
				->login($post['email'], $post['password']);
		}
		//print_r($res);
		$this->view->post = $this->request->post();

		$this->view->subview = 'login';
		$this->view->message = $logged_in;
	}
}