<?php
/**
 * Class for <textarea> elements
 */
require_once 'HTML/QuickForm2/Element/Textarea.php';

class HTML_QuickForm2_Element_CkEditor extends HTML_QuickForm2_Element_Textarea
{



    protected $options = array(
        'toolbar'                => 'cms_minimum',
        'resize_enabled'         => false,
        'toolbarCanCollapse'     => false,
        'forcePasteAsPlainText'  => true,
        'language'               => 'en',
        'height'                 => '200',
        'removePlugins'          => 'elementspath'
    );


    public function __construct($name = null, $attributes = null, array $data=array() )
    {
        parent::__construct($attributes);
        $this->setName($name);
        // Autogenerating the id if not set on previous steps
        if ('' == $this->getId()) {
            $this->setId();
        }
        if (!empty($data)) {
            $this->options = array_merge($this->options, $data);
        }
    }

    private function _generateInitScript()
    {
        HTML_QuickForm2_Loader::loadClass('HTML_QuickForm2_JavascriptBuilder');

        $data = json_encode( $this->options);


        return 'qf.elements.ckeditor.init(' . HTML_QuickForm2_JavascriptBuilder::encode($this->getId())
               . ", {$data}"
               . (empty($this->jsCallback)? '': ", {$this->jsCallback}") . ");";
    }

    public function render(HTML_QuickForm2_Renderer $renderer) {
        
        $jsBuilder = $renderer->getJavascriptBuilder();

        //$jsBuilder->addLibrary('CkEditorLib', 'ckeditor.js', 'js/ckeditor/', PATHADM . 'js' . DIRECTORY_SEPARATOR . 'ckeditor' . DIRECTORY_SEPARATOR);
        //$jsBuilder->addLibrary('CkEditorAdapters', 'jquery.js', 'js/ckeditor/adapters/', PATHADM . 'js' . DIRECTORY_SEPARATOR . 'ckeditor' . DIRECTORY_SEPARATOR . 'adapters' . DIRECTORY_SEPARATOR);

        $jsBuilder->addLibrary('CkEditor', 'quickform-ckeditor.js');
        $jsBuilder->addElementJavascript($this->_generateInitScript());

        /*
        $script = $this->appendChild(new HTML_QuickForm2_Element_Script('script'))
                       ->setContent($this->_generateInlineScript());
        */

        parent::render($renderer);
        
        return $renderer;
    }
}
?>
