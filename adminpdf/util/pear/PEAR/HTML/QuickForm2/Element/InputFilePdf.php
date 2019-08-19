<?php
require_once 'HTML/QuickForm2/Element/InputFile.php';

class HTML_QuickForm2_Element_InputFileImage extends HTML_QuickForm2_Element_InputFile
{
    protected $description = null;

    public function setDescription($description) {
        if (isset($description)) {
            $this->description = $description;
        }
    }

    protected function updateValue()
    {
        $container = $this->getContainer();
        while (!empty($container)) {
            if ($container instanceof HTML_QuickForm2) {
                if ('get' == $container->getAttribute('method')) {
                    throw new HTML_QuickForm2_InvalidArgumentException(
                        'File upload elements can only be added to forms with post submit method'
                    );
                }
                if ('multipart/form-data' != $container->getAttribute('enctype')) {
                    $container->setAttribute('enctype', 'multipart/form-data');
                }
                break;
            }
            $container = $container->getContainer();
        }
        
        foreach ($this->getDataSources() as $ds) {

            if ($ds instanceof HTML_QuickForm2_DataSource_Submit) {
                $value = $ds->getUpload($this->getName());
                if (null !== $value) {
                    $this->value = $value;
                    return;
                }
            } elseif ($ds instanceof HTML_QuickForm2_DataSource_Array && null !== ($value = $ds->getValue($this->getName()))) {
                $this->value = $value;
                return;
            }
        }
    }

    public function render(HTML_QuickForm2_Renderer $renderer)
    {
        $renderer->setTemplateForClass(get_class(), '<div class="row"><label for="{id}" class="element"><qf:required><span class="required">* </span></qf:required>{label}' . (!empty($this->description) ? '<br /><small>' . $this->description . '</small>' : '') . '</label>' . (!empty($this->value) ? '<img class="image_preview" src=" '.$this->value.'" />' : '') . '<div class="element<qf:error> error</qf:error>"><qf:error><span class="error">{error}<br /></span></qf:error>{element}</div></div>');
        parent::render($renderer);
        return $renderer;
    }
}
?>
