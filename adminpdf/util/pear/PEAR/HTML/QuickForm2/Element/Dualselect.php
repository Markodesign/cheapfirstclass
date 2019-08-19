<?php
/*
 * Usage example for HTML_QuickForm2 package: custom element and renderer plugin
 *
 * The example demonstrates a custom element with special rendering needs and
 * shows how it can be output via a renderer plugin. The example element is
 * a (much) simpler version of HTML_QuickForm_advmultiselect.
 *
 * It also demonstrates how to plug in element's javascript and how to use
 * client-side validation with custom element.
 *
 * $Id: Dualselect.php 304176 2010-10-07 10:46:52Z avb $
 */


require_once 'HTML/QuickForm2/Element/Select.php';
require_once 'HTML/QuickForm2/Renderer.php';
require_once 'HTML/QuickForm2/Renderer/Plugin.php';

/**
 * "Dualselect" element
 *
 * This element can be used instead of a normal multiple select. It renders as
 * two multiple selects and two buttons for moving options between them.
 * The values that end up in the "to" select are considered selected.
 */
class HTML_QuickForm2_Element_DualSelect extends HTML_QuickForm2_Element_Select
{
    public function getType()
    {
        return 'dualselect';
    }

    protected $attributes = array('multiple' => 'multiple');

    protected $watchedAttributes = array('id', 'name', 'multiple');

    protected function onAttributeChange($name, $value = null)
    {
        if ('multiple' == $name && 'multiple' != $value) {
            throw new HTML_QuickForm2_InvalidArgumentException(
                "Required 'multiple' attribute cannot be changed"
            );
        }
        parent::onAttributeChange($name, $value);
    }

    public function __toString()
    {
        if ($this->frozen) {
            return $this->getFrozenHtml();
        } else {
            require_once 'HTML/QuickForm2/Renderer.php';

            return $this->render(
                HTML_QuickForm2_Renderer::factory('default')
                    ->setTemplateForId(
                        $this->getId(),
                        "<table class=\"dualselect\">\n" .
                        "    <tr>\n" .
                        "       <td style=\"vertical-align: top;\">{select_from}</td>\n" .
                        "       <td style=\"vertical-align: middle;\">{button_from_to}<br />{button_to_from}</td>\n" .
                        "       <td style=\"vertical-align: top;\">{select_to}</td>\n" .
                        "    </tr>\n" .
                        "</table>"
                    )
            )->__toString();
        }
    }

    public function render(HTML_QuickForm2_Renderer $renderer)
    {
        // render as a normal select when frozen
        if ($this->frozen) {
            $renderer->renderElement($this);
        } else {
            $jsBuilder = $renderer->getJavascriptBuilder();
            foreach ($this->rules as $rule) {
                if ($rule[1] & HTML_QuickForm2_Rule::CLIENT) {
                    $jsBuilder->addRule($rule[0]);
                }
            }
            $jsBuilder->addLibrary('dualselect', 'quickform-dualselect.js');
            $jsBuilder->addElementJavascript("qf.elements.dualselect.init('{$this->getId()}-to');");
            $renderer->renderDualSelect($this);
        }
        return $renderer;
    }

    public function toArray()
    {
        $id    = $this->getId();
        $name = $this->getName();
        $keepSorted = empty($this->data['keepSorted'])? 'false': 'true';
        $selectFrom = new HTML_QuickForm2_Element_Select(
            "_{$name}", array('id' => "{$id}-from", 'ondblclick' => "qf.elements.dualselect.moveOptions('{$id}-from', '{$id}-to', {$keepSorted})" ) + $this->attributes
        );
        $selectTo   = new HTML_QuickForm2_Element_Select(
            $name, array('id' => "{$id}-to", 'ondblclick' => "qf.elements.dualselect.moveOptions('{$id}-to', '{$id}-from', {$keepSorted})") + $this->attributes
        );
        $strValues = array_map('strval', $this->values);
        foreach ($this->optionContainer as $option) {
            // We don't do optgroups here
            if (!is_array($option)) {
                continue;
            }
            $value = $option['attr']['value'];
            unset($option['attr']['value']);
            if (in_array($value, $strValues, true)) {
                $selectTo->addOption($option['text'], $value,
                                     empty($option['attr'])? null: $option['attr']);
            } else {
                $selectFrom->addOption($option['text'], $value,
                                       empty($option['attr'])? null: $option['attr']);
            }
        }


        $buttonFromTo = HTML_QuickForm2_Factory::createElement(
            'button', "{$name}_fromto",
            array('type' => 'button', 'onclick' => "qf.elements.dualselect.moveOptions('{$id}-from', '{$id}-to', {$keepSorted})") +
                (empty($this->data['from_to']['attributes'])? array(): self::prepareAttributes($this->data['from_to']['attributes'])),
            array('content' => (empty($this->data['from_to']['content'])? ' &gt;&gt; ': $this->data['from_to']['content']))
        );
        $buttonToFrom = HTML_QuickForm2_Factory::createElement(
            'button', "{$name}_tofrom",
            array('type' => 'button', 'onclick' => "qf.elements.dualselect.moveOptions('{$id}-to', '{$id}-from', {$keepSorted})") +
                (empty($this->data['to_from']['attributes'])? array(): self::prepareAttributes($this->data['to_from']['attributes'])),
            array('content' => (empty($this->data['to_from']['content'])? ' &lt;&lt; ': $this->data['to_from']['content']))
        );
        return array(
            'select_from'    => $selectFrom->__toString(),   'select_to'      => $selectTo->__toString(),
            'button_from_to' => $buttonFromTo->__toString(), 'button_to_from' => $buttonToFrom->__toString()
        );
    }

   /**
    * Returns Javascript code for getting the element's value
    *
    * All options in "to" select are considered dualselect's values,
    * we need to use an implementation different from that for a standard
    * select-multiple. When returning a parameter for getContainerValue()
    * we should also provide the element's name.
    *
    * @param  bool  Whether it should return a parameter for qf.form.getContainerValue()
    * @return   string
    */
    public function getJavascriptValue($inContainer = false)
    {
        if ($inContainer) {
            return "{name: '{$this->getName()}[]', value: qf.elements.dualselect.getValue('{$this->getId()}-to')}";
        } else {
            return "qf.elements.dualselect.getValue('{$this->getId()}-to')";
        }
    }
}

/**
 * Renderer plugin for outputting dualselect
 *
 * A plugin is needed since we want to control outputting the selects and
 * buttons via the template. Also default template contains placeholders for
 * two additional labels.
 */
class HTML_QuickForm2_Renderer_Default_DualSelectPlugin
    extends HTML_QuickForm2_Renderer_Plugin
{
    public function setRenderer(HTML_QuickForm2_Renderer $renderer)
    {
        parent::setRenderer($renderer);
        if (empty($this->renderer->templatesForClass['html_quickform2_element_dualselect'])) {
            $this->renderer->templatesForClass['html_quickform2_element_dualselect'] = <<<TPL
<div class="row">
    <label for="{id}-from" class="element"><qf:required><span class="required">* </span></qf:required>{label}</label>
    <div class="element<qf:error> error</qf:error>">
        <qf:error><span class="error">{error}</span><br /></qf:error>
        <table class="dualselect">
            <tr>
                <td style="vertical-align: top;">{select_from}</td>
                <td style="vertical-align: middle;">{button_from_to}<br />{button_to_from}</td>
                <td style="vertical-align: top;">{select_to}</td>
            </tr>
            <qf:label_2>
            <qf:label_3>
            <tr>
                <th>{label_2}</th>
                <th>&nbsp;</th>
                <th>{label_3}</th>
            </tr>
            </qf:label_3>
            </qf:label_2>
        </table>
    </div>
</div>
TPL;
        }
    }

    public function renderDualSelect(HTML_QuickForm2_Node $element)
    {
        $elTpl = $this->renderer->prepareTemplate($this->renderer->findTemplate($element), $element);
        foreach ($element->toArray() as $k => $v) {
            $elTpl = str_replace('{' . $k . '}', $v, $elTpl);
        }
        $this->renderer->html[count($this->renderer->html) - 1][] = str_replace('{id}', $element->getId(), $elTpl);
    }
}
/*
// Now we register both the element and the renderer plugin
HTML_QuickForm2_Factory::registerElement('dualselect', 'HTML_QuickForm2_Element_DualSelect');
HTML_QuickForm2_Renderer::registerPlugin('default', 'HTML_QuickForm2_Renderer_Default_DualSelectPlugin');
*/
?>
