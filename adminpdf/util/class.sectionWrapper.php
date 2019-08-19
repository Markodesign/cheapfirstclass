<?php
require_once 'class.section.php';
Class SectionWrapper implements IteratorAggregate, Countable, arrayaccess {

    protected $_sections = array();

    public function __construct(){
    }

    public  function addSection($name, array $options = array()){
      $name = strval($name);
      $this->_sections[$name] = new Section($name, $options);
    }

    public  function  generateUrlParams(){
        $params = array();
        foreach ($this->_sections as $section) {
            if (is_numeric($section->box_value) && $section->box_value >= 0) {
                $params[] = $section->name . '=' . $section->box_value;
            }
        }
        $params = implode('&', $params);
        return $params;
    }

    public function showOnlyForm(){
        $ok = true;
        foreach ($this->_sections as $section) {
            if ($section->box_enabled) {
                $ok = false;
            }
        }
        return $ok;
    }
    public  function getSelectedSection() {
        $selected_section = null;
        foreach ($this as $section) {
            if (!is_numeric($section->box_value)) {
                break;
            }
            $selected_section = $section;
        }
        return $selected_section;
    }
    public  function getSelectedSectionChild($section_parent) {
        $section_children = array();
        foreach ($this as $section) {
            if ($section->box_parent == $section_parent->name) {
                $section_children[] = $section;
            }
        }
        return $section_children;
    }
    public  function getMainSection() {
        foreach ($this as $section) {
            if (empty($section->box_parent)) {
                return $section;
            }
        }
        return null;
    }
    public  function __set($offset, $value) {
    }
    public function __isset($offset) {
        return isset($this->_sections[$offset]);
    }
    public function __unset($offset) {
        unset($this->_sections[$offset]);
    }
    public function __get($offset) {
        return $this->_sections[$offset];
    }
    public function count() {
        return count($this->_sections);
    }
    public function getIterator() {
        return new ArrayIterator($this->_sections);
    }
    public function offsetSet($offset, $value) {
        return $this->__set($offset, $value);
    }
    public function offsetExists($offset) {
        return $this->__isset($offset);
    }
    public function offsetUnset($offset) {
        return $this->__unset($offset);
    }
    public function offsetGet($offset) {
        return $this->__get($offset);
    }
    protected function _adgvsgrtg($section, $selected_section) {
        if ($selected_section  == null || $section->box_parent == $selected_section->name || $section->box_value === 0) {
            return strval($section);
        }
        $children = $this->getSelectedSectionChild($section);
        $return_str = strval($section);
        foreach ($children as $child_section) {
            $return_str .= strval($this->_adgvsgrtg($child_section, $selected_section));
        }
        return $return_str;
    }
    public function __toString() {
        $main_section = $this->getMainSection();
        $selected_section = $this->getSelectedSection();
        
        return $this->_adgvsgrtg($main_section, $selected_section);

        //$return_string = strval($main_section);
    }
}