<?php

namespace App;

/**
 * Base controller
 *
 * @property-read \App\Pixie $pixie Pixie dependency container
 */
class Page extends \PHPixie\Controller {

	//protected $auth = $this->auth;

	protected $view;

	public function before() {
		$this->view = $this->pixie->view('main');
	}

	public function after() {
		$this->response->body = $this->view->render();
	}


	//This method will redirect the user to the login page

	//if he is not logged in yet, or present him with a message

	//if he lacks the required role.

	protected function logged_in($role = null){

		if($this->pixie->auth->user() == null){

			$this->redirect('login');

			return false;

		}

		if($role && !$this->pixie->auth->has_role($role)){

			$this->response->body = "You don't have the permissions to access this page";

			$this->execute=false;

			return false;

		}

		return true;

	}
}
