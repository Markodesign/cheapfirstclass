<?php

$message = null;
if (isset($_REQUEST['cms_login_submit']) && $_REQUEST['cms_login_submit']) {
    $message['type'] = 'w';
    $message['code'] = 1;
    //Get Forms Values
    $pass = trim(strip_tags($_REQUEST["password"]));
    //Get Data from DB
    $email = isset($_POST['email']) ? strip_tags(strtolower($_POST['email'])) : '';
    if ($email && $pass !='') {
          $res =  $main_db->fetchAll('select * from admins');
        $authAdapter->setIdentity($email);
        $authAdapter->setCredential($pass);
        $auth   = Zend_Auth::getInstance();
        $result = $auth->authenticate($authAdapter);
        if ($result->isValid()) {
            header('Location: '. URL );
        }else{
        }
    }
}
$smarty->assign('message', $message);

$smarty->display('header_login.tpl');
$smarty->display('login.tpl');
$smarty->display('footer_login.tpl');



