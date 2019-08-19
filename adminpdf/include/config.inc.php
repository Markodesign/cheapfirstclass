<?php


	ini_set('display_errors', true);
	error_reporting( E_ALL & ~E_NOTICE & ~E_STRICT );

if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1') {
    /*-----------------------------------------------------
        PATH
-----------------------------------------------------*/
    $config['paths']['url'] = 'http://' . $_SERVER["SERVER_NAME"] . "/";
    $config['paths']['path'] = realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..') . DIRECTORY_SEPARATOR;
    $config['paths']['lib_path'] = realpath($config['paths']['path'] . '..' . DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'php-code' . DIRECTORY_SEPARATOR;
    $config['paths']['cms'] = basename(dirname(__DIR__));
    $config['paths']['cms_url'] = $config['paths']['url'] . $config['paths']['cms'] . '/';
    $config['paths']['user_url'] = $config['paths']['url'] . $config['paths']['cms'] . '/';
    $config['paths']['cms_path'] = $config['paths']['path'] . $config['paths']['cms'] . DIRECTORY_SEPARATOR;

    $config['paginator']['itemsPerPage'] = 10;


    /*-----------------------------------------------------
            DB
    -----------------------------------------------------*/

    $config['db']['host'] = 'localhost';
    $config['db']['port'] = '3306';
    $config['db']['login'] = 'root';
    $config['db']['password'] = '';
    $config['db']['db'] = 'cheapfirst';
    $config['db']['encoding'] = 'utf8';

}else{
    /*-----------------------------------------------------
        PATH
-----------------------------------------------------*/
    $config['paths']['url'] = 'http://' . $_SERVER["SERVER_NAME"] . "/";
    $config['paths']['path'] = realpath(dirname(__FILE__) ) . DIRECTORY_SEPARATOR;
    $config['paths']['lib_path'] = realpath($config['paths']['path'] . '..' . DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'php-code' . DIRECTORY_SEPARATOR;
    $config['paths']['cms'] = basename(dirname(__DIR__));
    $config['paths']['cms_url'] = $config['paths']['url'] . $config['paths']['cms'] . '/';
    $config['paths']['user_url'] = $config['paths']['url'] . $config['paths']['cms'] . '/';
    $config['paths']['cms_path'] = $config['paths']['path'] .  '..' . DIRECTORY_SEPARATOR;

    $config['paginator']['itemsPerPage'] = 10;


    /*-----------------------------------------------------
            DB
    -----------------------------------------------------*/

    $config['db']['host'] = 'localhost';
    $config['db']['port'] = '3306';
    $config['db']['login'] = 'admin_cheapfirst';
    $config['db']['password'] = 'gQkIUVcnet';
    $config['db']['db'] = 'admin_cheapfirst';
    $config['db']['encoding'] = 'utf8';


}






