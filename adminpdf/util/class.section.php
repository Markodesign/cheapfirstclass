<?php

Class Section {

    protected $_name = '';

    protected $_box_enabled = true;

    protected $_box_type    = 'select';

    protected $_box_value = null;

    protected $_box_can_add = true;

    protected $_box_add_title   = '';

    protected $_box_elements = array();

    protected $_box_title   = '';

    protected $_box_description = '';

    protected $_box_parent = null;

    protected $_box_sortable = false;

    protected $_form_title  = '';

    protected $_form_description = '';

    protected $_form_data = array();

    protected $_form;

    protected $_form_js;

    public function __construct($name, array $options = array()) {
        $this->_name = strval($name);
        if (isset($options['box_enabled'])) {
            $this->_box_enabled = (bool) $options['box_enabled'];
        }
        if (isset($options['box_type']) && $this->_checkBoxType($options['box_type'])) {
            $this->_box_type = (string) $options['box_type'];
        }
        if (isset($options['box_can_add'])) {
            $this->_box_can_add = (bool) $options['box_can_add'];
        }
        if (isset($options['box_title'])) {
            $this->_box_title = (string) $options['box_title'];
        }
        if (isset($options['box_add_title'])) {
            $this->_box_add_title = (string) $options['box_add_title'];
        }
        if (isset($options['box_description'])) {
            $this->_box_description = (string) $options['box_description'];
        }
        if (isset($options['box_sortable'])) {
            $this->_box_sortable = (bool) $options['box_sortable'];
        }
        if (isset($options['form_title'])) {
            $this->_form_title = (string) $options['form_title'];
        }
        if (isset($options['form_description'])) {
            $this->_form_description = (string) $options['form_description'];
        }
        if (isset($options['box_parent'])) {
            $this->_box_parent = (string) $options['box_parent'];
        }
    }

    protected function _checkBoxType($type) {
        if (in_array($type, array('select', 'hierarchy'))) {
            return true;
        }
        return false;
    }
    public function loadBoxElements(array $list = array()) {
        foreach ($list as $key=>$value) {
            $this->_box_elements[$key] = $value;
        }

    }
    public function addBoxElement($key, $value) {
        $this->_box_elements[$key] = $value;
    }
    public function loadFormData(array $form = array()) {
       foreach ($form as $key=>$value) {
            $this->_form_data[$key] = $value;
        }
    }
    public function loadForm($form) {
        $this->_form = $form;
    }
    public function loadFormJs($formJs) {
        $this->_form_js = $formJs;
    }

    public function __set($offset, $value) {
        if ($offset == 'box_value' || $offset == 'form_description' ) {
            $property_name = '_' . $offset;
            $this->$property_name = $value;
            return true;
        }
        return false;
    }
    public function __isset($offset) {
        $property_name = '_' . $offset;
        return isset($this->$property_name);
    }
    public function __unset($offset) {
        return false;
    }
    public function __get($offset) {
        $property_name = '_' . $offset;
        return isset($this->$property_name) ? $this->$property_name : null;
    }
    public function __call($name, $arguments) {
        return $this->offsetGet($name);
    }
    public function __toString() {
        global $smarty;
        if ($this->_box_enabled) {
            if ($this->_box_type == 'select') {
                $arr = $this->_box_elements;
                reset($arr);
                $smarty->assign('first_id',key($arr));

                end($arr);
                $last_key = key($arr);
                $smarty->assign('last_id',$last_key);

                $smarty->assign('section', $this);
                return $smarty->fetch('section_select.tpl');
            }
        }
        return '';
    }
}