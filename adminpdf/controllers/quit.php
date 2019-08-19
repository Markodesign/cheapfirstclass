<?php
//Start Session
Zend_Auth::getInstance()->clearIdentity();
//Redirection
header("location: " . URLADM); 
?>