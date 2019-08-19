<?php
/*-----------------------------------------------------
        PATH, DB
-----------------------------------------------------*/


/*-----------------------------------------------------
        CMS, Menu Configurations
-----------------------------------------------------*/
//Top Menu CMS


$topMenu['app'] = array(
    'ua' => 'ADMIN PANEL',
    'en' => 'ADMIN PANEL',
    'fr' => 'ADMIN PANEL',
    'controller'    => '',
    'admin_access'  => array('admin')
);

//Top Sub Menu CMS
//-------------------------begin App----------------------------------------------------------------



$menu['app']['pdf'] = array(
    'en' => 'PDF',
    'controller'    => '_pdf.php',
    'admin_access'  => array('admin')
);




//-------------------------end App----------------------------------------------------------------

//users types
$user_levels = array('admin', 'user');

/*-----------------------------------------------------
        CMS OTHER CONFIG
-----------------------------------------------------*/
//Token for session
$_token						    = 'cT6T7Itdgq5fHdRWCSFi0bkbI2n2Jvwxadfv';

// txt Editor
$txtEditorWidth				= array('100%');
$txtEditorHeight			= array('400px','200px');
$txtPublicationHeight       = '550px;';

// other
$defaultItemsPerPage        = 10;
$defaultLang                = 'en';

//$conf_taxes['HST'] = false;

//$conf_taxes['country'] = 'CA';
//$conf_taxes['province'] = 'ON';


/*-----------------------------------------------------
        CMS Functionality Translation
-----------------------------------------------------*/
require_once 'translate.php';