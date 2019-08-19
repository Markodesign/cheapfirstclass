<?php
/**
 * Class for <input type="submit" /> elements
 *
 * PHP version 5
 *
 * LICENSE:
 *
 * Copyright (c) 2006-2011, Alexey Borzov <avb@php.net>,
 *                          Bertrand Mansion <golgote@mamasam.com>
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *    * Redistributions of source code must retain the above copyright
 *      notice, this list of conditions and the following disclaimer.
 *    * Redistributions in binary form must reproduce the above copyright
 *      notice, this list of conditions and the following disclaimer in the
 *      documentation and/or other materials provided with the distribution.
 *    * The names of the authors may not be used to endorse or promote products
 *      derived from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS
 * IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO,
 * THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR
 * PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR
 * CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 * EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO,
 * PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR
 * PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY
 * OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 * NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * @category   HTML
 * @package    HTML_QuickForm2
 * @author     Alexey Borzov <avb@php.net>
 * @author     Bertrand Mansion <golgote@mamasam.com>
 * @license    http://opensource.org/licenses/bsd-license.php New BSD License
 * @version    SVN: $Id: InputSubmit.php 311435 2011-05-26 10:30:06Z avb $
 * @link       http://pear.php.net/package/HTML_QuickForm2
 */

/**
 * Base class for <input> elements
 */
require_once 'HTML/QuickForm2/Element/InputSubmit.php';

/**
 * Class for <input type="submit" /> elements
 *
 * @category   HTML
 * @package    HTML_QuickForm2
 * @author     Alexey Borzov <avb@php.net>
 * @author     Bertrand Mansion <golgote@mamasam.com>
 * @version    Release: 0.6.0
 */
class HTML_QuickForm2_Element_InputDelete extends HTML_QuickForm2_Element_InputSubmit
{
    private function _generateInitScript()
    {
        HTML_QuickForm2_Loader::loadClass('HTML_QuickForm2_JavascriptBuilder');

        return 'qf.elements.delete.init(' . HTML_QuickForm2_JavascriptBuilder::encode($this->getId())
               . (empty($this->jsCallback)? '': ", {$this->jsCallback}") . ');';
    }
    
    public function render(HTML_QuickForm2_Renderer $renderer)
    {

        $template = $renderer->findTemplate($this);
     /*   $template .=
            '<div class="warn_delete hide" id="warn_delete" style="margin-top:20px;" style="display: none;">
                <div class="submit">
                <div class="warn-bx" id="warning">
                     <div class="warn-bx-text">
                    <strong>Warning!</strong><br/>
                    Do you really want to delete this entry?
                    </div>
                    <div style="padding-top: 10px;">
                        <input name="' . $this->getName() . '" type="submit" value="Yes" />
                        <input type="submit" onclick="$(this).parents(\'.warn_delete\').hide();return false;" value="No" name="fSubmit" />
                    </div>
                </div>
                </div>
            </div>';*/
        $renderer->setTemplateForId($this->getId(), $template);

        $jsBuilder = $renderer->getJavascriptBuilder();
        $jsBuilder->addLibrary('delete', 'quickform-delete.js');
        $jsBuilder->addElementJavascript($this->_generateInitScript());

        parent::render($renderer);
        return $renderer;
    }
}
?>
