/**
 * @namespace Functions for hierselect elements
 */
qf.elements.ckeditor = (function(){
    /**
     * Returns 'onload' handler for page containing tab.
     *
     * This resets hierselect to default values and repopulates options in second and
     * subsequent selects.
     *
     * @see     <a href="http://pear.php.net/bugs/bug.php?id=3176">PEAR bug #3176</a>
     * @param   {Element}   firstSelect First select element in hierselect chain
     * @returns {function()}
     * @private
     */
    function _getOnloadHandler(editorId,ckeditorBasic) {


        // TODO: Take it from options
        // CKEditor
        ckeditorBaasic = {
            toolbar : 'cms_minimum',
            resize_enabled : false,
            toolbarCanCollapse: false,
            forcePasteAsPlainText: true,
            language : "en",
            height: 200,
            removePlugins : 'elementspath'
        };

        $('#'+editorId).ckeditor(ckeditorBasic);

        ckeditor_names = [];
        $('#'+editorId).each(function () {
            id = editorId;
            name = $(this).attr('id');

            ckeditor_names.push(id);
            editor = CKEDITOR.instances[id];
            $('#'+id).bind('blur', function(e) {
                qf.Validator.liveHandler(e)
            });
            editor.on("blur", function(e) {
                id = e.editor.name;
                name = $('#'+id).attr('name');
                CKEDITOR.instances[id].updateElement();
                $('#'+id).trigger('blur');
            });
        })
        function updateCKeditors() {
            $.each(ckeditor_names, function(key,value1) {
                CKEDITOR.instances[value1].updateElement();
            })
        }

        $('input[type="submit"]').click(function(){
            updateCKeditors();
        });
    };

    function _getOncheckHandler(editorId) {
    };

    return {
        /**
         * Adds event handlers for hierselect behavior.
         *
         * @param {Array} selects               IDs of select elements in hierselect
         * @param {Function} optionsCallback    function that will be called to
         *                  get missing options (presumably via AJAX)
         */
        init: function(editorId, ckeditorBasic, optionsCallback)
        {
           qf.events.addListener(window, 'load', _getOnloadHandler(editorId,ckeditorBasic));
        }
    };

})();