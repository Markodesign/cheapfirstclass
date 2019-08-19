<?php
exit();
$res = $main_db->fetchAll("SELECT * from admins");
show($res);
exit;
$email = 'maxcfc';
$password = '2702test!';
$password_salt = sha1('sdaufwer*%#(*&#)!yhowerw7er66r');


$main_db->insert('admins', array(
    'email'         => $email,
    'password'      => sha1($password . $password_salt),
    'password_salt' => $password_salt,
    'role'          => 'user',
    'active'          => '1',

));
exit;


$auth = Zend_Auth::getInstance();
if ($auth->hasIdentity()) {
} else {
}

//print_r(Tools::hashPassword('123')); exit;
$arr_errors = array();
if ($_POST) {
	$email = isset($_POST['email']) ? strip_tags(strtolower($_POST['email'])) : '';
	$password = isset($_POST['password']) ? strip_tags($_POST['password']) : '';
	$email_validator = new Zend_Validate_EmailAddress();
	if ($email_validator->isValid($email)) {
		$sql = $main_db->select()->from('admins')->where('email = ?', $email);
		$user = $main_db->fetchRow($sql);
		if ($user) {
			$arr_errors[] = 'user already exist';
		} else {
			$activation_hash = sha1(Tools::randomPassword(40));
			$password_salt = Tools::randomPassword(40);


			$main_db->insert('admins', array(
				'email'         => $email,
				'password'      => sha1($password . $password_salt),
				'password_salt' => $password_salt,
				'role'          => 'user',
				'active'          => '1',

			));


		}
	} else {
		foreach ($email_validator->getMessages() as $message) {
			$arr_errors[] = $message;
		}
	}


//$acl = new Zend_Acl();

}
$smarty->assign('message', $message);

$smarty->display('header_login.tpl');
$smarty->display('login.tpl');
$smarty->display('footer_login.tpl');
