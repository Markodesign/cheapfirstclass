<?php

    Error_Reporting(E_ALL);
    ini_set('display_errors', 1);

    class Request
    {
        private
            $_db = null;

        public function __construct()
        {
            require_once $_SERVER['DOCUMENT_ROOT'] . '/wp-config.php';
            $this->_db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD);
            if($this->_db)
            {
                $this->_db->query('use `'.DB_NAME.'`;');
                $this->_db->query('set names utf8;');
            }
        }

        public function clearRequestEmails() {
            $this->_db->query('DELETE FROM request WHERE (1=1)');
            return $this;
        }

        public function getWidgetData()
        {
            $data_html = '<form action="" method="post">';
            if(!$this->_db) return 'Failed to connect to database. <a href="mailto:yaroslav429@gmail.com">Report</a>.';
            $emails_res = $this->_db->query('select `rq_email` from `request` group by `rq_email`;');
            if($emails_res)
            {
                $data_html .= '<div class="rq_email"><div><b>Emails</b></div><textarea style="max-height: 300px ! important; min-height: 100px; min-width: 100% ! important; max-width: 100% ! important; resize: vertical; width: 100% ! important;">';
                while($email = $emails_res->fetch_assoc())
                {
                    $data_html .= $email['rq_email'] . "\r\n";
                }
                $data_html .= '</textarea></div>';
            }
            else return 'Query error. <a href="mailto:yaroslav429@gmail.com">Report</a>.';
            $data_html .= '<div style="float:left">';
            $summary_res = $this->_db->query('select (select count(*) from `request`) as `total_request`, (select count(*) from `airports`) as `total_airports` from `request` limit 1;');
            if($summary_res)
            {
                $summary = $summary_res->fetch_assoc();
                $data_html .= '<br /><div class="rq_summary"><div><b>Summary</b></div><div>Total requests : <b>' . $summary['total_request'] . '</b></div><div>Total airports : <b>' . $summary['total_airports'] . '</b></div></div>';
            }
            else return 'Query error. <a href="mailto:yaroslav429@gmail.com">Report</a>.';
            $last_res = $this->_db->query('select * from `request` order by `rq_id` desc limit 1;');
            if($last_res)
            {
                $last = $last_res->fetch_assoc();
                $data_html .= '<br /><div class="rq_last"><div><b>Last request</b></div><div><b>' . $last['rq_name'] . '</b></div><div>' . $last['rq_email'] . '</div><div>' . $last['rq_mobile'] . '</div></div>';
            }
            else return 'Query error. <a href="mailto:yaroslav429@gmail.com">Report</a>.';
            $data_html .= '</div><div style="text-align: right;"><br><input type="submit" name="dashboard_request_widget_clear" value="Clear" class="btn button button-success"></div><div style="clear: both"></div>';
            $data_html .= '</form>';
            return $data_html;
        }

        public function buildForm()
        {
            $traveler_select = '<select class="traveler_count" name="traveler_count"><option value="1" selected="selected">1 Traveller</option><option value="2">2 Travellers</option><option value="3">3 Travellers</option><option value="4">4 Travellers</option><option value="5">5 Travellers</option><option value="6">6 Travellers</option></select>';
            $cabin_select = '<select class="cabin" name="cabin"><option selected="selected" value="Business Class">Business Class</option><option value="First Class">First Class</option></select>';
            $html = str_replace(array('[[traveler_select]]', '[[cabin_select]]'), array($traveler_select, $cabin_select), file_get_contents(__DIR__ . '/form.htm'));
            return $html;
        }

        private function _sendEmail($email, $subject, $message,$from = null,$from_email)
        {
            if  ($from === null){
                $from = "Request - Price from $2381";
            }
            if  ($from_email === null){
                $from_email = 'noreply@cheapfirstclass.com';
            }
            require_once 'class.phpmailer.php';
            $mail             = new PHPMailer();
            $mail->SMTPDebug  = 1;
            $mail->IsSMTP();
            $mail->SMTPAuth   = true;
            $mail->SMTPSecure = 'tls';
            $mail->Host       = "159.203.246.11";
            $mail->Port       = 587;
            $mail->Username   = "noreply@cheapfirstclass.com";
            $mail->Password   = "35CNi6BI5o";
            $mail->AddReplyTo($from_email);
            $mail->SetFrom($from_email,$from );
            $mail->Subject    = $subject;
            $sended = true;
            $mail->MsgHTML($message);
            $mail->AddAddress(trim($email));
            if(!$mail->Send()) $sended = false;
            $mail->ClearAddresses();
            $mail->ClearAttachments();

            return $sended;
        }

        private function _replace($html, $data)
        {
            $matches = array();
            $ret = preg_match_all('/\\{\\[([A-Za-z0-9_]+)\\]\\}/i', $html, $matches);
            foreach($matches[1] as $ph)
            {
                $value = $ph . '*';
                if(isset($data[$ph])) $value = $data[$ph];
                $html = str_replace('{[' . $ph . ']}', $value, $html);
            }
            return $html;
        }

        private function _flightDetails($post)
        {
            $text = '';
            switch($post['type'])
            {
                case 'roundtrip':
                {
                    $text = 'From : <b>' . $post['from'] . '</b><br />To : <b>' . $post['to'] .  '</b><br />Depart Date : <b>' . $post['departure'] . '</b><br /> Return Date : <b>' . $post['return'] . '</b><br />';
                    break;
                }
                case 'oneway':
                {
                    $text = 'From : <b>' . $post['from'] . '</b><br />To : <b>' . $post['to'] . '</b><br />Depart Date : <b>' . $post['departure'] . '</b><br />';
                    break;
                }
                case 'multicity':
                {
                    foreach($post as $k => $v)
                    {
                        if(strpos($k, 'from') !== false || strpos($k, 'to') !== false || strpos($k, 'departure') !== false)
                        {
                            $number = 0;
                            $key = '';
                            if(strpos($k, 'from') !== false) { $number = intval(str_replace('from', '', $k)); $key = 'from'; }
                            if(strpos($k, 'to') !== false) { $number = intval(str_replace('to', '', $k)); $key = 'to'; }
                            if(strpos($k, 'departure') !== false) { $number = intval(str_replace('departure', '', $k)); $key = 'departure'; }
                            $flights[$number][$key] = $v;
                        }
                    }
                    foreach($flights as $k => $flight)
                    {
                        $text .= 'From : <b>' . $flight['from'] . '</b><br />To : <b>' . $flight['to'] . '</b><br />Depart Date : <b>' . $flight['departure'] . '</b><br />';
                    }
                    break;
                }
                default:break;
            }
            return $text;
        }

        private function _crypto_rand_secure($min, $max)
        {
            $range = $max - $min;
            if($range < 0) return $min;
            $log = log($range, 2);
            $bytes = (int)($log / 8) + 1;
            $bits = (int)$log + 1;
            $filter = (int)(1 << $bits) - 1;
            do
            {
                $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
                $rnd = $rnd & $filter;
            }
            while($rnd >= $range);
            return $min + $rnd;
        }

        public function getRandomToken($length, $type = 'all')
        {
            $token = "";
            $codeAlphabet = '';
            if(in_array($type, array('all', 'uppercase', 'alphabet'))) $codeAlphabet .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            if(in_array($type, array('all', 'lowercase', 'alphabet'))) $codeAlphabet .= 'abcdefghijklmnopqrstuvwxyz';
            if(in_array($type, array('all', 'number'))) $codeAlphabet .= '0123456789';
            for($i=0; $i < $length; $i++)
            {
                $token .= $codeAlphabet[$this->_crypto_rand_secure(0, strlen($codeAlphabet))];
            }
            return $token;
        }

        public function send($post)
        {
            if(!$this->_db) return json_encode(array('status' => 'error', 'message' => 'connection error'));
            $reference = '';
            $manager_message = '';
            $traveler_message = '';
            $ret_array = array('status' => 'error', 'message' => '');
            $check_result = $this->_checkFields($post);
            if($check_result === true)
            {
                $reference = $this->getRandomToken(5, 'uppercase') . '-' . $this->getRandomToken(2, 'number');
                $_SESSION['reference'] = $reference;
                $page_url = $post['page_url'];
                unset($post['page_url']);
                $post['hash'] = $this->getRandomToken(12);
                $post['reference'] = $reference;
                $query = $this->_buildRequestQuery($post);
                $flights_finder_page = strpos($page_url,"/business-class-flights-finder/") ;
                if ($flights_finder_page !==false){
                    $ret_array['status'] = 'success';
                }else{
                    if($query !== false)
                    {
                        $ret_array['status'] = 'success';
                        if($query === 'ALREADY_EXISTS')
                        {
                            $ret_array['message'] = 'ALREADY_EXISTS';
                        }
                        else
                        {
                            $insert_res = $this->_db->query($query);
                            if($insert_res)
                            {
                                if($this->_db->affected_rows === 1)
                                {
                                    $type = $post['type'];
                                    switch($type)
                                    {
                                        case 'roundtrip' : $type = 'Round Trip'; break;
                                        case 'oneway' : $type = 'One Way'; break;
                                        case 'multicity' : $type = 'Multi City'; break;
                                        default: break;
                                    }
                                    $price = 2381;
                                    $flight = $this->_flightDetails($post);
                                    $cabin = $post['cabin'];
                                    $email_data = array(
                                        'name' => $post['name'],
                                        'email' => $post['email'],
                                        'phone' => $post['mobile'],
                                        'date' => date('d.m.Y H:i:s'),
                                        'flight_type' => $type,
                                        'flight' => $flight,
                                        'travelers' => $post['traveler_count'],
                                        'cabin' => $cabin,
                                        'reference' => $reference,
                                        'price' => $price,
                                    );
                                    $traveler_message = $this->_replace(file_get_contents(__DIR__ . '/email_templates/traveler.htm'), $email_data);
                                    $manager_message = $this->_replace(file_get_contents(__DIR__ . '/email_templates/manager.htm'), $email_data);
                                    $ret_array['status'] = 'success';
                                    $ret_array['reference'] = $reference;
                                    $ret_array['message'] = 'Sucessfully added';
                                }
                                else $ret_array['message'] = 'query_ok_but_not_added';
                            }
                            else
                            {
                                $ret_array['status'] = 'error';
                                $ret_array['message'] = 'query_error ' . $query;
                            }
                        }
                    }
                }


            }
            else
            {
                $ret_array['message'] = 'Required fields are invalid';
                $ret_array['extended'] = $check_result;
            }
            echo json_encode($ret_array);

            $subject = "Request " . $reference." - Price $". $price ."*";
            $this->_sendEmail($post['email'], $subject, $traveler_message);
            $this->_sendEmail('adv.cheapfirstclass@gmail.com', 'QUOTE REQUEST ' . $reference, $manager_message);
            $this->_sendEmail('lana@flybusinesscheap.com', 'QUOTE REQUEST ' . $reference, $manager_message);
            $this->_sendEmail('max@flybusinesscheap.com', 'QUOTE REQUEST ' . $reference, $manager_message);



            return '';
        }

        private function _buildRequestQuery($post)
        {
            $query_str = '';
            $flights = array();
            $type = $post['type'];
            unset($post['action']);
            $fields_str = '';
            $values_str = '';
            $exists_str = '';
            foreach($post as $k => $v)
            {
                if(strpos($k, 'from') !== false || strpos($k, 'to') !== false || strpos($k, 'departure') !== false || strpos($k, 'return') !== false)
                {
                    $number = 0;
                    $key = '';
                    if(strpos($k, 'from') !== false) { $number = intval(str_replace('from', '', $k)); $key = 'from'; }
                    if(strpos($k, 'to') !== false) { $number = intval(str_replace('to', '', $k)); $key = 'to'; }
                    if(strpos($k, 'departure') !== false) { $number = intval(str_replace('departure', '', $k)); $key = 'departure'; }
                    if(strpos($k, 'return') !== false) { $number = intval(str_replace('return', '', $k)); $key = 'return'; }
                    $flights[$number][$key] = $v;
                }
                else
                {
                    $fields_str .= '`rq_' . $k . '`, ';
                    $values_str .= '\'' . $v . '\', ';
                    $exists_str .= '`rq_' . $k . '` = \'' . $v . '\' and ';
                }
            }
            $tmp_flights = array();
            foreach($flights as $key => $flight)
            {
                $tmp_flights[] = $flight;
            }
            $flights_str = json_encode($tmp_flights);
            $fields_str .= '`rq_flights`, `rq_browser`, `rq_ip`, `rq_insert_date`';
            $values_str .= '\'' . $flights_str . '\', \'' . $_SERVER['HTTP_USER_AGENT'] . '\', \'' . $_SERVER['HTTP_X_REAL_IP'] . '\', CURRENT_TIMESTAMP';
            $query_str = 'insert into `request` (' . $fields_str . ') values(' . $values_str . ');';
            $exists_query_str = 'select * from `request` where ' . $exists_str . ' `rq_insert_date` > date_sub(curdate(), interval 1 hour)';
            $exists_res = $this->_db->query($exists_query_str);
            if($exists_res)
            {
                if($exists_res->num_rows > 1) return 'ALREADY_EXISTS';
                else return $query_str;
            }
            else return false;
        }

        private function _checkFields($post)
        {
            $error_fields = array();
            $type = isset($post['type']) ? $post['type'] : '';
            if(!in_array($type, array('roundtrip', 'oneway', 'multicity'))) return false;
            $traveler_count = isset($post['traveler_count']) ? intval($post['traveler_count']) : 0;
            $cabin = isset($post['cabin']) ? $post['cabin'] : '';
            $name = isset($post['name']) ? $post['name'] : '';
            $email = isset($post['email']) ? $post['email'] : '';
            $country_code = isset($post['country_code']) ? $post['country_code'] : '';
            $mobile = isset($post['mobile']) ? $post['mobile'] : '';
            if($traveler_count === 0) $error_fields[] = '#type_' . $type . ' select[name="traveler_count"]';
            if(empty($cabin)) $error_fields[] = '#type_' . $type . ' select[name="cabin"]';
            if(empty($name)) $error_fields[] = '#type_' . $type . ' input[name="name"]';
            if(empty($email)){
                $error_fields[] = '#type_' . $type . ' input[name="email"]';
            } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error_fields[] = '#type_' . $type . ' input[name="email"]';
            }


            if(empty($mobile)) $error_fields[] = '#type_' . $type . ' input[name="mobile"]';
            $airports_and_dates_res = $this->_checkAirportsAndDates($type, $post);
            if($airports_and_dates_res !== true) $error_fields = array_merge($error_fields, (array)$airports_and_dates_res);
            return count($error_fields) === 0 ? true : implode(',', $error_fields);
        }

        private function _checkAirportsAndDates($type, $post)
        {
            $error_fields = array();
            switch($type)
            {
                case 'roundtrip':
                {
                    $from = isset($post['from']) ? $post['from'] : '';
                    $to = isset($post['to']) ? $post['to'] : '';
                    $departure = isset($post['departure']) ? $post['departure'] : '';
                    $return = isset($post['return']) ? $post['return'] : '';
                    if(empty($from)) $error_fields[] = '#type_' . $type . ' input[name="from"]';
                    if(empty($to)) $error_fields[] = '#type_' . $type . ' input[name="to"]';
                    if(empty($departure) || !preg_match('/\\d{2}\\/\\d{2}\\/\\d{4}/i', $departure)) $error_fields[] = '#type_' . $type . ' input[name="departure"]';
                    if(empty($return) || !preg_match('/\\d{2}\\/\\d{2}\\/\\d{4}/i', $return)) $error_fields[] = '#type_' . $type . ' input[name="return"]';
                    return count($error_fields) === 0 ? true : $error_fields;
                }
                case 'oneway':
                {
                    $from = isset($post['from']) ? $post['from'] : '';
                    $to = isset($post['to']) ? $post['to'] : '';
                    $departure = isset($post['departure']) ? $post['departure'] : '';
                    if(empty($from)) $error_fields[] = '#type_' . $type . ' input[name="from"]';
                    if(empty($to)) $error_fields[] = '#type_' . $type . ' input[name="to"]';
                    if(empty($departure) || !preg_match('/\\d{2}\\/\\d{2}\\/\\d{4}/i', $departure)) $error_fields[] = '#type_' . $type . ' input[name="departure"]';
                    return count($error_fields) === 0 ? true : $error_fields;
                    break;
                }
                case 'multicity':
                {
                    foreach($post as $k => $v)
                    {
                        if(strpos($k, 'from') !== false || strpos($k, 'to') !== false) if(empty($v)) $error_fields[] = '#type_' . $type . ' input[name="' . $k . '"]';
                        if(strpos($k, 'departure') !== false) if(!preg_match('/\\d{2}\\/\\d{2}\\/\\d{4}/i', $v)) $error_fields[] = '#type_' . $type . ' input[name="' . $k . '"]';
                    }
                    return count($error_fields) === 0 ? true : $error_fields;
                    break;
                }
            }
            return true;
        }

        public function autocomplete($post)
        {
            if(!$this->_db) return json_encode(array('status' => 'error', 'message' => 'connection error'));

/*if ($_GET['test']){
    $airports_res = $this->_db->query('select *  from `airports`');
    if($airports_res)
    {
        while($airport = $airports_res->fetch_assoc())
        {
            $airports[] = $airport;
        }
        echo '<pre>';
        print_r($airports);
        echo '</pre>';
    }
    exit;
}*/
            $results = array('results' => array());
            $airports_res = $this->_db->query('select `ap_id`, `ap_name`, `ap_order`,`country_id`, `when` from (select *, \'1\' as `when` from `airports` where `ap_name` like \'' . $post['term'] . '%\' union select *, \'2\' as `when` from `airports` where `ap_name` like \'%' . $post['term'] . '%\') `t` group by `t`.`ap_name` order by `t`.`when`, `t`.`ap_order` desc, `t`.`ap_name` limit 13;');

            if($airports_res)
            {
                while($airport = $airports_res->fetch_assoc())
                {
                    if ($airport['country_id'] == ''){
                        $airport['country_id'] = 'no' ;
                    }
                    $results['results'][] = array('title' => $airport['ap_name'], 'order' => $airport['ap_order'], 'country' => $airport['country_id']);
                }
            }
            else return json_encode(array('status' => 'error', 'message' => 'query error'));
            return json_encode($results);
        }

        public function autocompleteCountryCode($post)
        {
            if(!$this->_db) return json_encode(array('status' => 'error', 'message' => 'connection error'));
            $results = array('results' => array());
            $cc_res = $this->_db->query('select * from `country_phone_codes` where `cc_name` like \'%' . $post['term'] . '%\' order by `cc_name` limit 10;');
            if($cc_res)
            {
                while($cc = $cc_res->fetch_assoc())
                {
                    $results['results'][] = array('title' => $cc['cc_name'], 'code' => '+' . $cc['cc_code'], 'mask' => $cc['cc_mask']);
                }
            }
            else return json_encode(array('status' => 'error', 'message' => 'query error'));
            return json_encode($results);
        }

        public function resendEmail(){
            $date = new DateTime();
            $date2 = new DateTime();
            $date->modify('-2 day');
            $date2->modify('-1 day');
           // $time = '2018-01-22 16';
            $time = $date->format('Y-m-d');
            $time2 = $date2->format('Y-m-d');

            $time_from = $time . ' 00:00:00';
            $time_to = $time2 . ' 23:59:59';

            $sql = "select * from `request`
                      WHERE rq_unsubscribed = 0 and rq_insert_date >= '$time_from'
                          and
                        rq_insert_date <= '$time_to'
                        order by `rq_id` desc ";

           // $res = $this->_db->query($sql);
			$res = array();
          //  print_r($sql);
            $arr_names = array(
               "John Stefancik","Simon Curran","Mike Hooker","Lucy Jonson"
            );

            if($res)
            {
                while($cc = $res->fetch_assoc())
                {
                    $r_id = rand(0,3);
                   // print_r($cc);
                    $email = $cc['rq_email'];
                    $email_data = array(
                        'name' => $cc['rq_name'],
                        'rq_hash' => $cc['rq_hash'],
                        'manager_name' => $arr_names[$r_id],
                        'manager_photo' => 'm-'.$r_id . '.jpg',
                    );
                    $traveler_message = $this->_replace(file_get_contents(__DIR__ . '/email_templates/resend_request.htm'), $email_data);
                    $subject = "Request #" . $cc['rq_id'] ;
                    $this->_sendEmail($email, $subject, $traveler_message,'Cheapfirstclass.com','max@flybusinesscheap.com' );

                }
            }
        }

        public function unsubscribe($hash){
            $cc['rq_name'] = '';
            if (!preg_match('/[^A-Za-z0-9]/', $hash)) // '/[^a-z\d]/i' should also work.
            {
                $res=  $this->_db->query("Select *  FROM request WHERE rq_hash='".$hash ."'");
                $cc = $res->fetch_assoc();
                $this->_db->query('UPDATE request SET rq_unsubscribed = 1 WHERE rq_id = ' . $cc['rq_id']);

            }
            header("Location: /unsubscribe/?rq_name=".$cc['rq_name']);
        }


    }

?>
