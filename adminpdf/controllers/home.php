<?php

//Initial Data
$selectBd					= 'str';

//exit;
//include 'include/session.php';

//include_once(PATHADM."js/fckeditor/fckeditor.php") ; 

//header('location: ' . URLSADM );

//Basic Vars
$success						= false; 
$size							= 'full-sm';

$smarty->assign('success', $success);
$smarty->assign('size', $size);

$smarty->display('header.tpl');
$smarty->display('home.tpl');
$smarty->display('footer.tpl');