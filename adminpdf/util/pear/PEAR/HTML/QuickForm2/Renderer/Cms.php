<?php

require_once 'HTML/QuickForm2/Renderer/Default.php';


class HTML_QuickForm2_Renderer_Cms extends HTML_QuickForm2_Renderer_Default
{
    protected function exportMethods()
    {
        $t = parent::exportMethods();
        $t[] = 'findtemplate';

        return $t;
    }

    public function __construct() {
        parent::__construct();
        $this->setTemplateForClass('html_quickform2_element_inputcheckbox', '<div class="row"><label style="display: inline;" for="{id}" class="element"><qf:required><span class="required">* </span></qf:required>{label}</label><div class="element<qf:error> error</qf:error>"><qf:error><span class="error">{error}<br /></span></qf:error>{element}</div></div>');
    }

}
?>