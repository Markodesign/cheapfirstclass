<?php
require(dirname(__FILE__) . '/wp-load.php');




$arrayData = array(
    'first_name'  => 'first_name'.rand(999,999999999),
    'lead_source' => 'cheapfirstclass.com',
    'email'       => 'emailtest'.rand(999,999999999).'@gmail.com',
    'phone'       => '44444',
    'from'      => 'Kiev',
    'to'      => 'Uzh'
);
echo "<pre>";
print_r($arrayData);

                  $options = get_option("salesforce2");

                  submit_salesforce_form($arrayData,$options);