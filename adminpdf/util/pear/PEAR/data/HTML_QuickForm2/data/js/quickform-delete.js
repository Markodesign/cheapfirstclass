
qf.elements.delete = (function(){
    function _confirm(deleteId) {
        $('#warn_delete').show();
        return false;
    };

    return {
        init: function(deleteId, optionsCallback)
        {
            $('#'+deleteId).click(function(){
                return _confirm(deleteId);
            })
        }
    };
})();