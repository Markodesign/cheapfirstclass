<?php

namespace App\Controller;

class AppService extends \App\Page
{


	public function action_ipad()
	{
		$result_arr = array();
		$arr_error = array();
		if (isset($_REQUEST['json'])) {
			$json = $_REQUEST['json'];
			$input_arr = json_decode($json, true);
			$action = isset($input_arr['action']) ? $input_arr['action'] : '';
			switch ($action) {
				case 'getConfig':
					$connections = array();

					$code = isset($input_arr['code']) ? $input_arr['code'] : '';
					$is_alpha_numeric = $this->pixie->validate->ruleset()->rule_alpha_numeric($code);

					// validate key
					if (!$is_alpha_numeric) {
						$arr_error[] = 'invalid_key';

					}

					//find key
					if (count($arr_error) == 0) {
						$connections = $this->pixie->orm->get('connections')->where('key', $code)->find()->as_array(true);
						if (!$connections) {
							$arr_error[] = 'invalid_key';
						}
					}

					// validate  account active // payment
					if (count($arr_error) == 0) {
						if ($connections['key_active'] != '1') {
							$arr_error[] = 'deactivated_key';
						}
					}

					//validate device id
					if (count($arr_error) == 0) {
						$device_id = isset($input_arr['device_id']) ? $input_arr['device_id'] : '';
						$device_id_temp = str_replace('-','',$device_id);
						if (!ctype_alnum($device_id_temp)) {
							$arr_error[] = 'invalid_device_id';
						}
					}
					// validate device type
					if (count($arr_error) == 0) {
						$device_type = isset($input_arr['device_type']) ? $input_arr['device_type'] : '';
						if (!in_array($device_type, $this->pixie->devices_type)) {
							$arr_error[] = 'invalid_device_type';
						}
					}

					// validate device active
					if (count($arr_error) == 0) {
						//$db = ne
						$db = \Tools::getDB($connections);
						var_dump($db);

						$sql = "SELECT	* FROM devices ";
						$device = $db->fetchAll($sql);
						//$device = $db->fetchRow($sql,$device_id);
						if ($device && $device['active'] != '1') {
							$arr_error[] = 'deactivated_device';
						}
					}

					// validate count available devices
					if (count($arr_error) == 0) {
						if (empty($device)) {
							$sql = "SELECT COUNT(id) as total  FROM devices WHERE active = 1 and token !='' and device_type = '".$device_type ."'";
							$count_device = $db->query($sql)->fetch(\PDO::FETCH_ASSOC);
							if ($connections['device_config'] == ''){
								$account_config= $this->pixie->account_type_configuration[$connections['configuration']];
							}else {
								$account_config = json_decode($connections['device_config'],true);
							}

							if (isset( $account_config[$device_type] )){
									$available_devices = $account_config[$device_type] ;
							} else{
								$available_devices = 0;
							}
							if ($available_devices <= $count_device['total']) {
								$arr_error[] = 'count_devices';
								$arr_error['var'] = array('*available_devices*' => $available_devices +1);
							}
						}

					}


					///----------------------------------------

					if (count($arr_error) > 0) {
						$result_mess =  $this->pixie->error_message_arr[$arr_error[0]];
						if (isset($arr_error['var'])){
							foreach ($arr_error['var'] as $k=> $v){
								foreach($result_mess as   &$message){
									if (is_array($message)){
										foreach ($message as  &$text){
											if (is_string($text))
												$text = str_replace($k,$v,$text);
										}
									}
								}
							}
						}

						$result_arr = $result_mess;

					} else {

						if (!$device) {
							$registration_date = date('Y-m-d H:i:s');
							$active = 1;
							$token = \Tools::generateDeviceToken($code, $device_id, $registration_date);
							$stmt = $db->prepare("INSERT INTO devices (device_id, device_type,active,token,time)
													VALUES
											(:device_id, :device_type, :active, :token, :time)");
							$stmt->bindParam('device_id', $device_id);
							$stmt->bindParam('device_type', $device_type);
							$stmt->bindParam('active', $active);
							$stmt->bindParam('token', $token);
							$stmt->bindParam('time', $registration_date);
							$stmt->execute();
							$device['token'] = $token;


						} elseif ($device['token'] == '' && $device['id']) {
							$registration_date = date('Y-m-d H:i:s');
							$token = \Tools::generateDeviceToken($code, $device_id, $registration_date);
							$stmt = $db->prepare("UPDATE devices SET token=:token,time=:time
													WHERE id = :id");
							$stmt->bindParam('token', $token);
							$stmt->bindParam('time', $registration_date);
							$stmt->bindParam('id', $device['id']);
							$stmt->execute();
							$device['token'] = $token;

						}

						$result_arr['status'] = 'valid';
						$result_arr['message']['title'] = 'Key is ok';
						$result_arr['message']['body'] = 'Everything is O.K';
						$result_arr['config'] = array(
							'token'         => $device['token'],
							'service_url'   => $connections['app_service_url'],
							'configuration' => $connections['configuration'],
							'print_system'  => $connections['print_system'],

						);
						$result_arr['logout']['need_logout'] = false;
						$result_arr['logout']['title'] = '';
						$result_arr['logout']['message'] = '';

					}

					break;
			}


		}

		$this->view->render_json = true;
		$this->view->json_result = json_encode($result_arr);

	}

// ?json={"action":"getConfig","code":"ABCDEF1234567890ABCD","device_id":"ABCDEF1234567890ABCD","device_type":"master"}


// ALTER TABLE `connections`
//CHANGE COLUMN `multi_masters` `configuration`  varchar(20) NOT NULL AFTER `print_system`
}