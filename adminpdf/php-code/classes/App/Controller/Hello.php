<?php

namespace App\Controller;

class Hello extends \App\Page {

	public function action_index() {
//print_r(json_decode('{"status":"valid","message":{"title":"Key is ok","body":"Everything is O.K"},"config":{"token":"1d3537d1714834ffa26bb71f0e450e0d8b2e6b81","service_url":"http:\/\/www.platform-pos.com\/v2\/uat\/admin\/platform_dev\/ipad\/","multi_masters":false,"print_system":""},"logout":{"need_logout":"No","title":"Device is ok","message":"Everything is O.K"}}',true)); exit;
		$this->view->subview = 'hello';
		$this->view->message = 'Have fun coding';



	}

}