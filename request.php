<?php
    Error_Reporting(E_ALL);
    ini_set('display_errors', 1);



    $_POST = array_map_recursive('htmlspecialchars', array_map_recursive('addslashes', $_POST));
    if(!empty($_REQUEST['action']))
    {
        $action = $_REQUEST['action'];
        require_once $_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/cheapfirstclasstheme/request/Request.class.php';
        $request = new Request();
        //session_start();

        switch($action)
        {
              case 'send' :
                  $_SESSION['request'] = $_POST;

                  $data_salesforce = array(
                      'oid' => '00D0b000000R3c6',
                      'first_name' => $_POST['name'],
                      'last_name' => ' ',
                      'email' => $_POST['email'],
                      'phone' => $_POST['mobile'],
                      'lead_source' => 'cheapfirstclass.com',
                      '00N0b00000BWNUL' => $_POST['from'], //From city
                      '00N0b00000BWNUG' => $_POST['to'], //To City
                      '00N0b00000BWNUf' => $_POST['departure'], //Departure
                      '00N0b00000BWNUk' => $_POST['return'], //Return
                      '00N0b00000BWNU6' => $_POST['traveler_count'], //Count people
                      '00N0b00000BWNVE' => $_POST['type'] //Type
                  );

                  $ch = curl_init();

                  curl_setopt($ch, CURLOPT_URL,"https://webto.salesforce.com/servlet/servlet.WebToLead");
                  curl_setopt($ch, CURLOPT_POST, 1);
                  curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data_salesforce));

                  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                  $server_output = curl_exec($ch);

                  curl_close ($ch);


                  echo $request->send($_POST);
                  break;
            case 'send_from_session' :
               print_r($_SESSION['request']) ; exit;
                echo $request->send($_SESSION['request']);
                break;
            case 'autocomplete' : echo $request->autocomplete($_POST); break;
            case 'autocompleteCountryCode' : echo $request->autocompleteCountryCode($_POST); break;
            case 'unsubscribe' : $request->unsubscribe($_REQUEST['rq_hash']); break;
        }

    }
    else echo json_encode(array('message' => 'Invalid action', 'status' => 'error'));



    function array_map_recursive($callback, $array)
    {
        foreach($array as $key => $value)
        {
            if(is_array($array[$key])) $array[$key] = array_map_recursive($callback, $array[$key]);
            else $array[$key] = call_user_func($callback, $array[$key]);
        }
        return $array;
    }

    exit();
?>
