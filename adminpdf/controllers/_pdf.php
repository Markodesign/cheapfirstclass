<?php


//file_put_contents(PATHUPLOADS .'111.pdf',$output); exit;

/*-----------------------------------------------------
        Sections
-----------------------------------------------------*/
$sections = new SectionWrapper();
$sections->addSection('request', array(
    'box_enabled' => true,
    'box_can_add' => false,
    'box_type' => 'select', // 'select', 'hierarchi'
    'box_title' => 'Requests',
    'box_description' => 'Select request',
    'box_elements' => array(),
    'form_title' => 'Custom Request',
    'form_description' => '',
    'box_add_title' => 'Add a new message',
    'box_sortable' => true
));
$sections->addSection('pdf', array(
    'box_parent' => 'request',
    'box_enabled' => true,
    'box_can_add' => true,
    'box_type' => 'select', // 'select', 'hierarchi'
    'box_title' => 'Available Itineraries',
    'box_description' => 'Select item',
    'box_elements' => array(),
    'form_title' => 'Item',
    'form_description' => '',
    'box_add_title' => 'Add a new item',
    'box_sortable' => true,
));
/*-----------------------------------------------------
        Get section data
-----------------------------------------------------*/

// get parrameters
foreach ($sections as $section) {
    $section->box_value = ((isset($_GET[$section->name]) && (intval($_GET[$section->name]) >= 0)) ? intval($_GET[$section->name]) : null);
}
/*-----------------------------------------------------
        Sort
-----------------------------------------------------*/

// get section a list

$sql = "
    select
        *
    from
        request
      --  WHERE rq_type != 'roundtrip' 
        order by rq_id DESC 
";
$selected_rq['data'] = array();
$res_arr = $main_db->fetchAll($sql);

foreach ($res_arr as $item) {
    $json = json_decode($item['rq_flights'], true);
    $desc = '';
    if (is_array($json)) {
        foreach ($json as $v) {
            $desc .= $v['from'] . ' ' . $v['departure'] . ' - ' . $v['to'] . ' ' . $v['return'] . ' ';
        }
        $sections['request']->addBoxElement($item['rq_id'], $desc);
    }
}
$pdfs = array();
if ($sections['request']->box_value > 0) {
    $sql = "
        select
            *
        from
            request
        where
            rq_id = '" . $sections['request']->box_value . "'
    ";
    $selected_rq = $main_db->fetchRow($sql);

    $sections['request']->loadFormData($selected_rq);
    $json = json_decode($selected_rq['rq_flights'], true);
    $desc = '';
    $selected_rq['data'] = $json;
    if (is_array($json)) {
        foreach ($selected_rq['data'] as $k => $v) {
            $desc .= $v['from'] . ' ' . $v['departure'] . ' - ' . $v['to'] . ' ' . $v['return'] . ' ';
            $from_code = explode('-', $v['from']);
            $to_code = explode('-', $v['to']);

            $from_code_str = trim($from_code[count($from_code) - 1]);
            unset($from_code[count($from_code) - 1]);
            $from_name_str = trim(implode('-', $from_code));

            $to_code_str = trim($to_code[count($to_code) - 1]);
            unset($to_code[count($to_code) - 1]);
            $to_name_str = trim(implode('-', $to_code));

            $selected_rq['data'][$k]['from'] = $from_name_str;
            $selected_rq['data'][$k]['from_code'] = $from_code_str;

            $selected_rq['data'][$k]['to'] = $to_name_str;
            $selected_rq['data'][$k]['to_code'] = $to_code_str;
            $selected_rq['data'][$k]['class'] = $selected_rq['rq_cabin'];
            if ($selected_rq['data'][$k]['return']) {
                $selected_rq['data'][$k]['return_from'] = $to_name_str;;
                $selected_rq['data'][$k]['return_from_code'] = $to_code_str;

                $selected_rq['data'][$k]['return_to'] = $from_name_str;
                $selected_rq['data'][$k]['return_to_code'] = $from_code_str;
                $selected_rq['data'][$k]['return_class'] = $selected_rq['rq_cabin'];
            }
        }
    }
    $sections['request']->form_description = $desc;
    $sql = "
        select
           *
        from
            pdf
        where
            request_id = '" . $sections['request']->box_value . "'
            order by sort
    ";
    $pdfs = $main_db->fetchAll($sql);
    foreach ($pdfs as &$pdf) {
        $sections['pdf']->addBoxElement($pdf['id'], $pdf['title']);
        $pdf['data'] = $pdf['text'] ? json_decode($pdf['text'], true) : array();
    }


}
if ($sections['pdf']->box_value > 0) {
    $sql = "
        select
           *
        from
            pdf
        where
            id = '" . $sections['pdf']->box_value . "'
    ";
    $arr_selected_item = array();
    $arr_selected_item = $main_db->fetchRow($sql);
    if ($arr_selected_item) {
        $sections['pdf']->loadFormData($arr_selected_item);
        $sections['pdf']->form_description = $arr_selected_item['title'];
        $arr_selected_item['data'] = json_decode($arr_selected_item['text'], true);
    }

//showx($arr_selected_item);


}

if ($_GET['send_email'] && $_GET['request']) {
    $request_id = $_GET['request'];

    $file_path = PATHUPLOADS . sha1($request_id) . '.pdf';
    $email = 'mystylename@gmail.com';
    $subject = 'Request pdf';
    $message = 'Request pdf';

    $mail = new PHPMailer();
    $mail->SMTPDebug = 1;
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Host = "159.203.246.11";
    $mail->Port = 587;
    $mail->Username = "noreply@cheapfirstclass.com";
    $mail->Password = "35CNi6BI5o";
    $mail->AddReplyTo("noreply@cheapfirstclass.com");
    $mail->SetFrom('noreply@cheapfirstclass.com', "Request - Price from $2197");
    $mail->Subject = $subject;
    $sended = true;
    $mail->MsgHTML($message);
    $mail->AddAddress(trim($email));
    $mail->AddAttachment($file_path);
    if (!$mail->Send()) $sended = false;
    $mail->ClearAddresses();
    $mail->ClearAttachments();
    movePage('303', URLADM . $selectedUrl . "?" . $sections->generateUrlParams() . "#mess_s_8");
    exit();
}

//-------------------------------------------
if ($_GET['show_pdf'] && $_GET['request']) {

    $request_id = $_GET['request'];


    define('DOMPDF_ENABLE_AUTOLOAD', false);
    define("DOMPDF_DPI", 300);

    require_once $config['paths']['lib_path'] . 'vendor/dompdf/dompdf/dompdf_config.inc.php';

    $dompdf = new DOMPDF();

    $dompdf->set_paper("A4");

    $smarty->assign('selected_rq', $selected_rq);
    $smarty->assign('pdfs', $pdfs);
    $smarty->assign('cms_url', URL);
    $smarty->assign('path', PATHADM);

    $html = $smarty->fetch('pdf.tpl');
 //  echo $html ; exit();
    $dompdf->load_html($html);
    $dompdf->render();


    header("Content-type:application/pdf");
    $output = $dompdf->output();
    $file_path = PATHUPLOADS . sha1($request_id) . '.pdf';
    if (file_exists($file_path)) {
        unlink($file_path);
    }
    file_put_contents($file_path, $output);
    echo $output;
    exit;
}

/*-----------------------------------------------------
        Form (home) (generated by quickform2)
-----------------------------------------------------*/
// init $form2 object (instance of quickform2 class)
// $form2 = new HTML_QuickForm2('news', 'post', 'action="' . URLADM . $selectedUrl . '?section_a=' . $section_a . '&section_b=' . $section_b . '&section_c=' . $section_c . '"',array('id'=>'news'));

$action = URLADM . $selectedUrl . '?' . $sections->generateUrlParams();
$form2 = new HTML_QuickForm2('pdf', 'post', 'action="' . $action . '"', array('id' => $sections['pdf']->name));

//$fieldset['main'] = $form2->addElement('fieldset');

// Now we register both the element and the renderer plugin
HTML_QuickForm2_Factory::registerElement('delete', 'HTML_QuickForm2_Element_InputDelete');
//HTML_QuickForm2_Factory::registerElement('fileImage', 'HTML_QuickForm2_Element_InputFileImage');

// set fields

$arr_from = array(
    'from' => 'From',
    'from_code' => 'From airport code',
    'departure' => 'Departure date',
    'departure_time' => 'Departure time',

    'to' => 'To',
    'to_code' => 'To airport code',
    'duration' => 'Flight duration',

    'arrival_date' => 'Arrival date',
    'arrival_time' => 'Arrival time',
    'travel_time' => 'Total Travel Time',
    'class' => 'Class',
    'layover_time' => 'Layover time',
    'stop' => 'stop',

);
$arr_return = array(

    'return_from' => 'Return From',
    'return_from_code' => 'Return From airport code',
    'return' => 'Return date',
    'return_departure_time' => 'Return Departure time',

    'return_to' => 'Return To',
    'return_to_code' => 'Return To airport code',
    'return_duration' => 'Return Flight duration',

    'return_arrival_date' => 'Return Arrival date',
    'return_arrival_time' => 'Return Arrival time',
    'return_travel_time' => 'Total Return Travel Time',
    'return_class' => 'Class',
    'return_layover_time' => 'Layover time',
    'stop' => 'stop',

);


foreach ($selected_rq['data'] as $k => $v) {
    $fieldset['main' . $k] = $form2->addElement('fieldset')->addClass('from from' . $k);
    $fields['top'] = $fieldset['main' . $k]
        ->addElement('static', 'top')
        ->setContent('<div class="title-element">Request<input type="hidden" name="id" value="' . $selected_rq['rq_id'] . '"></div>');

    // if ()
    if ($k) {

        $fields['top'] = $fieldset['main' . $k]
            ->addElement('static', 'top')
            ->setContent('<div class="title-element"><hr></div>');
    }

    /*
        $from_code = explode('-', $v['from']);
        $to_code = explode('-', $v['to']);

        $from_code_str = trim($from_code[count($from_code) - 1]);
        unset($from_code[count($from_code) - 1]);
        $from_name_str = trim(implode('-', $from_code));

        $to_code_str = trim($to_code[count($to_code) - 1]);
        unset($to_code[count($to_code) - 1]);
        $to_name_str = trim(implode('-', $to_code));*/


    foreach ($arr_from as $key => $val) {
        $count_stop_from = 0;

        if ($key == 'stop') {
            if ($arr_selected_item['data']['values'][$k]['stops_from']) {
                $count_stop_from = count($arr_selected_item['data']['values'][$k]['stops_from']);
                foreach ($arr_selected_item['data']['values'][$k]['stops_from'] as $s_key => $s_val) {
                    foreach ($s_val as $s_k => $s_v) {
                        $fields['stop_' . $s_key . '_' . $s_k . '_' . $k] = $fieldset['main' . $k]
                            ->addElement('text', 'stop_' . $s_key . '_' . $s_k . '_' . $k, array('value' => $s_v))
                            ->addClass('stop_element')
                            ->setLabel("Stop " . ($s_key + 1) . ' ' . $arr_from[$s_k]);
                    }
                }
            }
            $html_input = '';
            for ($i = 0; $i <= $count_stop_from; $i++) {
                $html_input = $html_input . '<input type="hidden" name="stops[]" value="' . $i . '">';
            }

            $fields['top'] = $fieldset['main' . $k]
                ->addElement('static', 'top')
                ->setContent('<div class="title-element"><button data-stop="' . $count_stop_from . '" class="btn btn-default js-add-stop-btn">Add stop' . $html_input . '</button></div>');

        } else {
            $add_class = '';
            if ($key == 'layover_time') {
                $add_class = 'hidden_block layover-time';
            }

            $fields[$key . '_' . $k] = $fieldset['main' . $k]
                ->addElement('text', $key . '_' . $k)
                ->addClass($add_class)
                ->setLabel($val);


        }

    }


    if ($v['return']) {
        $fieldset['main_return' . $k] = $form2->addElement('fieldset')->addClass('return return_' . $k);

        $fields['top'] = $fieldset['main_return' . $k]
            ->addElement('static', 'top')
            ->setContent('<div class="title-element">Return</div>');

        foreach ($arr_return as $key => $val) {
            $count_stop_return = 0;
            if ($key == 'stop') {
                if ($arr_selected_item['data']['values'][$k]['stops_return']) {
                    $count_stop_return = count($arr_selected_item['data']['values'][$k]['stops_return']);
                    foreach ($arr_selected_item['data']['values'][$k]['stops_return'] as $s_key => $s_val) {
                        foreach ($s_val as $s_k => $s_v) {

                            $fields['stop_' . $s_key . '_' . $s_k . '_' . $k] = $fieldset['main_return' . $k]
                                ->addElement('text', 'stop_' . $s_key . '_' . $s_k . '_' . $k, array('value' => $s_v))
                                ->addClass('stop_element')
                                ->setLabel("Stop " . ($s_key + 1) . ' ' . $arr_return[$s_k]);
                        }

                    }
                }
                $html_input = '';
                for ($i = 0; $i <= $count_stop_return; $i++) {
                    $html_input = $html_input . '<input type="hidden" name="stops[]" value="' . $i . '">';
                }

                $fields['top'] = $fieldset['main_return' . $k]
                    ->addElement('static', 'top')
                    ->setContent('<div class="title-element"><button data-stop="' . $count_stop_return . '" class="btn btn-default js-add-stop-btn">Add stop' . $html_input . '</button></div>');

            } else {
                $add_class = '';
                if ($key == 'return_layover_time') {
                    $add_class = 'hidden_block layover-time';
                }


                $fields[$key . '_' . $k] = $fieldset['main_return' . $k]
                    ->addElement('text', $key . '_' . $k)
                    ->addClass($add_class)
                    ->setLabel($val);

            }

        }
    }
}
unset($arr_return['stop']);
unset($arr_from['stop']);
$fieldset['main2'] = $form2->addElement('fieldset');
$fields['rq_name'] = $fieldset['main2']
    ->addElement('text', 'rq_name')
    ->setLabel('Code');

$fields['price'] = $fieldset['main2']
    ->addElement('text', 'price')
    ->setLabel('Price');


/*$fields['class' ] = $fieldset['main2']
    ->addElement('text', 'class')//->setValue($selected_rq['rq_cabin'])
    ->setLabel('Class');*/

// set submit buttons
$fieldset['buttons'] = $form2->addElement('fieldset')->addClass('buttons');
$fields['submit_buttons'] = $fieldset['buttons']->addGroup('submit_buttons')->setSeparator('&nbsp;');
if ($sections['pdf']->box_value == 0) {
    $fields['submit_buttons']->addElement('submit', 'add', array('value' => 'Add', 'class' => "btn btn-success"));
} else {
    $fields['submit_buttons']->addElement('submit', 'save', array('value' => "Save", 'class' => "btn btn-success"));
    $fields['submit_buttons']->addElement('submit', 'delete', array('value' => 'Delete', 'class' => "btn btn-danger"));
}

// set filters and rules
$form2->addRecursiveFilter('trim');

$fields['price']->addRule('required', 'You must enter a title.', null, HTML_QuickForm2_Rule::ONBLUR_CLIENT_SERVER);
$fields['rq_name']->addRule('required', 'You must enter a title.', null, HTML_QuickForm2_Rule::ONBLUR_CLIENT_SERVER);
//$fields['class']->addRule('required', 'You must enter a text.', null, HTML_QuickForm2_Rule::ONBLUR_CLIENT_SERVER);
//$fields['travel_time']->addRule('required', 'You must enter a text.', null, HTML_QuickForm2_Rule::ONBLUR_CLIENT_SERVER);

if ($form2->validate()) {

    $values['rq_name'] = $fields['rq_name']->getValue();
    $values['price'] = $fields['price']->getValue();
    // $values['travel_time'] = $fields['travel_time']->getValue();
    //  $values['class'] = $fields['class']->getValue();
    $values['stops'] = 0;
    foreach ($selected_rq['data'] as $k => $v) {

        foreach ($arr_from as $key => $val) {
            $values['values'][$k][$key] = $fields[$key . '_' . $k]->getValue();
            if ($_REQUEST['stops']) {
                foreach ($_REQUEST['stops'] as $s) {
                    if (isset($_REQUEST['stop_' . $s . '_' . $key . '_' . $k])) {
                        $values['values'][$k]['stops_from'][$s][$key] = $_REQUEST['stop_' . $s . '_' . $key . '_' . $k];
                    }
                }
            }
        }

        if (isset($fields['return_' . $k])) {
            foreach ($arr_return as $key => $val) {
                $values['values'][$k][$key] = $fields[$key . '_' . $k]->getValue();
                if ($_REQUEST['stops']) {
                    foreach ($_REQUEST['stops'] as $s) {
                        if (isset($_REQUEST['stop_' . $s . '_' . $key . '_' . $k])) {
                            $values['values'][$k]['stops_return'][$s][$key] = $_REQUEST['stop_' . $s . '_' . $key . '_' . $k];
                        }
                    }
                }
            }
        }
        $values['stops'] = $values['stops'] + count($values['values'][$k]['stops_from']) + count($values['values'][$k]['stops_return']);

    }

    $values['submit_buttons'] = $fields['submit_buttons']->getValue();

    if ($values['submit_buttons']['add']) {

        unset($values['submit_buttons']);
        $id = $sections['pdf']->box_value;
        $main_db->insert('pdf', array(
            'title' => $values['rq_name'],
            'text' => json_encode($values),
            'request_id' => $sections['request']->box_value
        ));
        movePage('303', URLADM . $selectedUrl . "?" . $sections->generateUrlParams() . "#mess_s_8");

    } elseif ($values['submit_buttons']['save'] && $sections['pdf']->box_value > 0) {
        $id = $sections['pdf']->box_value;
        unset($values['submit_buttons']);
        $main_db->update('pdf', array(
            'title' => $values['rq_name'],
            'text' => json_encode($values),
        ), array(
            'id = ' . $sections['pdf']->box_value
        ));


        movePage('303', URLADM . $selectedUrl . "?" . $sections->generateUrlParams() . "#mess_s_8");

    } elseif ($values['submit_buttons']['delete'] && $sections['pdf']->box_value > 0) {

        $id = $sections['pdf']->box_value;
        unset($values['submit_buttons']);
        $main_db->delete('pdf', array(
            'id = ' . $sections['pdf']->box_value
        ));


        movePage('303', URLADM . $selectedUrl . "?" . $sections->generateUrlParams() . "#mess_s_8");

    }
}

if (is_array($sections['pdf']->form_data) && count($sections['pdf']->form_data) || 1) {
    $tmp = array(
        'rq_name' => $arr_selected_item['data']['title'],
        'price' => $arr_selected_item['data']['price'],
        'class' => $arr_selected_item['data']['class'],
        //'travel_time' => $arr_selected_item['data']['travel_time'],

    );
    if ($arr_selected_item) {

        foreach ($arr_selected_item['data'] as $k => $val) {
            $tmp[$k] = $val;

        }

    }
//showx($arr_selected_item['data']);

    foreach ($selected_rq['data'] as $k => $v) {

        foreach ($arr_from as $key => $val) {
            $tmp[$key . '_' . $k] = $arr_selected_item['data']['values'][$k][$key] ? $arr_selected_item['data']['values'][$k][$key] : $v[$key];
        }
        if ($v['return']) {
            foreach ($arr_return as $key => $val) {
                $tmp[$key . '_' . $k] = $arr_selected_item['data']['values'][$k][$key] ? $arr_selected_item['data']['values'][$k][$key] : $v[$key];
            }
        }

    }
    $form2->addDataSource(new HTML_QuickForm2_DataSource_Array($tmp));
}
/*-----------------------------------------------------
            Form Renderer
-----------------------------------------------------*/
//require_once 'HTML/QuickForm2/Renderer/Cms.php';
require_once 'HTML/QuickForm2/Renderer.php';
//require_once 'HTML/QuickForm2/Renderer/Cms.php';

HTML_QuickForm2_Renderer::register('cms', 'HTML_QuickForm2_Renderer_Cms');

$renderer = HTML_QuickForm2_Renderer::factory('cms');
$renderer->setOption('required_note', null);
$form2->render($renderer);
$form2JS = $renderer->getJavascriptBuilder()->getLibraries(true, true);

$sections['pdf']->loadForm($renderer);
$sections['pdf']->loadFormJs($form2JS);
if ($sections['request']->box_value) {
    $file_path = PATHUPLOADS . sha1($sections['request']->box_value) . '.pdf';
    if (file_exists($file_path)) {
        $smarty->assign('show_send_email', true);
    }
}


$smarty->assign('sections', $sections);
$smarty->assign('selected_rq', $selected_rq);
$smarty->display('header.tpl');
$smarty->display('view_3_sections.tpl');
$smarty->display('footer.tpl');