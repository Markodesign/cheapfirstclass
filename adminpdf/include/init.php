<?php
header ('Content-type: text/html; charset=utf-8');
require_once "include/config.inc.php";



/*-----------------------------------------------------
        Including Classes, Functions, etc...
-----------------------------------------------------*/


define('PATH', $config['paths']['path']);
define('PATHHOME', $config['paths']['path']);
define('URL', $config['paths']['cms_url']);
define('URLADM', $config['paths']['user_url']);
define('PATHADM', $config['paths']['cms_path']);
define('PATHUPLOADS', $config['paths']['cms_path'] . 'uploads' . DIRECTORY_SEPARATOR);
define('PATHUPLOADS_ADMIN', str_replace('superadmin','admin',$config['paths']['cms_path']) . 'uploads' . DIRECTORY_SEPARATOR);

// include pear path
set_include_path(
    get_include_path() . '.' . PATH_SEPARATOR .
    PATHADM . 'include' . PATH_SEPARATOR .
    PATHADM . 'util' . PATH_SEPARATOR .
    PATHADM . 'util/pear/PEAR/' . PATH_SEPARATOR .
     $config['paths']['lib_path'] .'vendor/'
);
//Require_once Function
require_once 'functions.php';//Include Function File
require_once 'quickform-callbacks.php';
require_once 'class.phpmailer.php';


require_once 'class.sectionWrapper.php';
require_once 'HTML/QuickForm2.php';
require_once  "autoload.php";




/*-----------------------------------------------------
        Connect To Mysql
-----------------------------------------------------*/
//$main_db = new PDO('mysql:host='.  $config['db']['host'] .';dbname='. $config['db']['db'], $config['db']['login'],  $config['db']['password']);
try {
    $main_db = new Zend_Db_Adapter_Pdo_Mysql( array(
        'host'     => $config['db']['host'],
        'username' => $config['db']['login'],
        'password' =>  $config['db']['password'] ,
        'dbname'   =>  $config['db']['db']
    ));
   $main_db->query("SET NAMES 'utf8'");


} catch ( Exception $e){
    echo 'wrong db connect' ;
      print_r($e->getMessage());
    exit;
}


$authAdapter = new Zend_Auth_Adapter_DbTable(
    $main_db,
    'admins',
    'email',
    'password',
    'SHA1(CONCAT(?, password_salt)) and active = 1');
$auth = Zend_Auth::getInstance();

//$auth->getStorage()->write('dravci@ya.ru');
if ($auth->hasIdentity()) {
    $identity = $auth->getIdentity();



    $_access_type = 'admin';
    require_once "include/config.php";
    define('URLSADM', $config['paths']['user_url'] . key($topMenu) . '/');
}


// add menu
$_lang = 'en';

/*-----------------------------------------------------
        Other Init
-----------------------------------------------------*/
$field      = array();
$warnTotal	= 0;
if(!(isset($size) && $size)){$size = 'full-sm';}

if (!(isset($selectedTop) && $selectedTop))   $selectedTop  = '';
if (!(isset($selectedMenu) && $selectedMenu)) $selectedMenu = '';
if (!(isset($selectedSub) && $selectedSub))   $selectedSub  = '';

/*-----------------------------------------------------
        Smarty
-----------------------------------------------------*/

    $smarty = new Smarty;
    $smarty->setTemplateDir(PATHADM . 'templates/')
     ->setCompileDir(PATHADM . 'templates_c/');
//$smarty->compile_check = false;
//$registry->set('smarty', $smarty);
    $smarty->assign('url', URLADM);
    $smarty->assign('url_site', URL);
    $smarty->assign('urls', URLSADM);
    $smarty->assign('lang', $_lang);
    $smarty->assign('size', $size);
    $smarty->assign('topMenu', $topMenu);
    $smarty->assign('menu', $menu);
    $smarty->assign('user_levels', $user_levels);
    $smarty->assign('home', $home);
    $smarty->assign('quit', $quit);
    $smarty->assign('copy', $copy);
    $smarty->assign('btn', $btn);
    $smarty->assign('loginLang', $loginLang);
    $smarty->assign('siteUrl', $siteUrl);
    $smarty->assign('siteName', $siteName);
    $smarty->assign('default_text_center', $default_text_center);
    $smarty->assign('siteConfig',  $result_connections);

    $smarty->assign('_name', $_name);
    $smarty->assign('access_type', $_access_type);
    $smarty->assign('user_id',   $_user_id);


