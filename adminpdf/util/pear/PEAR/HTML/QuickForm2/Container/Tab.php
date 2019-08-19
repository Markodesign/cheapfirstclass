<?php
require_once 'HTML/QuickForm2/Container/Group.php';

class HTML_QuickForm2_Container_Tab extends HTML_QuickForm2_Container_Group
{

    public function getType()
    {
        return 'tab';
    }

   /**
    * Generates a javascript function call to initialize tab behaviour
    *
    * @return string
    */
    private function _generateInitScript()
    {
        HTML_QuickForm2_Loader::loadClass('HTML_QuickForm2_JavascriptBuilder');

        return 'qf.elements.tab.init(' . HTML_QuickForm2_JavascriptBuilder::encode($this->getId())
               . (empty($this->jsCallback)? '': ", {$this->jsCallback}") . ');';
    }

   /**
    * Renders the group using the given renderer
    *
    * @param    HTML_QuickForm2_Renderer    Renderer instance
    * @return   HTML_QuickForm2_Renderer
    */
    public function render(HTML_QuickForm2_Renderer $renderer)
    {
        $renderer->setTemplateForClass(get_class(), '<div{attributes}>{content}</div>');

        $renderer->startGroup($this);
        foreach ($this as $element) {
            $element->render($renderer);
        }
        $this->renderClientRules($renderer->getJavascriptBuilder());
        $renderer->finishGroup($this);

        $jsBuilder = $renderer->getJavascriptBuilder();
        $jsBuilder->addLibrary('tabs', 'quickform-tab.js');
        $jsBuilder->addElementJavascript($this->_generateInitScript());
        
        //$script = $this->appendChild(new HTML_QuickForm2_Element_Script('script'))
        //               ->setContent($this->_generateInlineScript());
        //$this->removeChild($script);

        return $renderer;
    }
}
?>