<?php

namespace App\Controller;

class AppCms extends \App\Page
{

	public function action_cms()
	{
		$arr_connections =array();
		if (isset($_REQUEST['t23']) && $_REQUEST['t23'] == 5 ) {

			//if ()
			$connections = $this->pixie->orm->get('connections')->find_all();
			$arr_connections =array();
			$arr_db_select = array();

			if($this->request->post()) {
				$data = $this->request->post();
				$sql =  $data['text'];
				if (isset($data['db'])	){
					foreach ($data['db'] as $k=>$v){
						$arr_db_select[$k] = $k;
					}
				}




			}
			foreach ($connections as $result_connections) {
				$arr_connections[] = $result_connections = $result_connections->as_array();
				try {

					if ($this->request->post() && in_array($result_connections['db_login'],$arr_db_select)){
						$db1 =   \Tools::getDB($result_connections);
						$res =  $db1->query($sql)->fetch(\PDO::FETCH_ASSOC);
						echo '<pre>';
						print_r($res );
						echo '</pre>';
					}

				} catch (\Exception $e)  {
					print_r($result_connections['db_name'] . '<br>');
				print_r(	$e->getMessage());
				}

			}


		}

//echo '<pre>';
//print_r($result_arr) ;
//echo '</pre>';
		$this->view->subview = 'cms';
		$this->view->connections = $arr_connections;
		$this->view->text = isset($data['text']) ? $data['text'] : ''  ;

	}

// ?json={"action":"getConfig","code":"ABCDEF1234567890ABCD","device_id":"ABCDEF1234567890ABCD","device_type":"master"}
}