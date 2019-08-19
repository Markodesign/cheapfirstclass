<?php
/*
Plugin Name: Request
Description: redentu.com
Version: 1.0.0
Author: Levgenij
Author URI: redentu.com

Copyright 2016  redentu.com (email : office {at} redentu.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
*/

add_option("request_version", "1.0.0");
//register_activation_hook(__FILE__, 'request_install');
//register_deactivation_hook(__FILE__, 'request_uninstall');

//add_menu_page('Request', 'Request', 1,false, false, false, 5 );

function register_request_page(){
	add_menu_page( 
		'Requests', 'Requests', 'manage_options', 'requests', 'request_page', 'dashicons-list-view', 6 
	); 
}

function request_page(){
  
	global $wpdb;  
 
    $countresults = $wpdb->get_var("SELECT COUNT(*) FROM request"); 

	if($search = $_POST['search']){
         $newtable = requests_search($search);
    }else{
    	$newtable = $wpdb->get_results( "SELECT * FROM request ORDER by rq_id DESC LIMIT 100");
    }


	include_once("request-table.php");
  
}

session_start();

add_action( 'admin_menu', 'register_request_page' );


function requests_search($search){
	global $wpdb;	
	$arr = $wpdb->get_results("SHOW COLUMNS FROM request", ARRAY_A);

	foreach($arr as $column){
		if($column['Type']=="timestamp")continue;
		$sql .= $sql ? " OR `$column[Field]` LIKE '%$search%'":"WHERE `$column[Field]` LIKE '%$search%'";		
	}
	
	$arr = $wpdb->get_results("SELECT * FROM request $sql");	
	
	return $arr;
}


function request_install(){
	  global $wpdb;
	  $table_name = $wpdb->prefix . "requests";
	  // создание таблицы данных плагина в базе данных
	  if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
	 $sql = "CREATE TABLE " . $table_name . " (
	  id mediumint(9) NOT NULL AUTO_INCREMENT,
	  cabin tinytext NOT NULL COLLATE utf8_general_ci,
	  departure date NOT NULL COLLATE utf8_general_ci,
	  return date NULL COLLATE utf8_general_ci,
	  email tinytext NOT NULL COLLATE utf8_general_ci,
	  from tinytext NOT NULL COLLATE utf8_general_ci,
	  to tinytext NOT NULL COLLATE utf8_general_ci,
	  mobile tinytext NOT NULL COLLATE utf8_general_ci,
	  cabin tinytext NOT NULL COLLATE utf8_general_ci,
	  name tinytext NOT NULL COLLATE utf8_general_ci,
	  traveler_count int(1) NOT NULL COLLATE utf8_general_ci,
	  type tinytext NOT NULL COLLATE utf8_general_ci,
	  UNIQUE KEY id (id)
	 );";
	  require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	  dbDelta($sql);
	 // добавление записи в таблицу
/* 	  $the_name="name";
	  $the_text="text";
	  $x = $wpdb->insert( $table_name,
	                      array('time' => current_time('mysql'),
	                             'name' => $the_name,
	                             'text' => $the_text ) );
 */	 
	 }

}



?>