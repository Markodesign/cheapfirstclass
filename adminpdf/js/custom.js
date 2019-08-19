$(document).ready(function () {
//warning

	$('.close').click(function () {
		$(this).parents('.notification').addClass('hide');
	});

	$('input, select , textarea').click(function () {
		$('#newWarning').fadeOut(2000);
	});
	     $('input[name="submit_buttons[delete]"]').click(function (e) {
			// showMessage('w', 22, 1);
			 $(this).parents('form').submit();
		 });
		$('.js-refund-btn').click(function (e) {

		e.preventDefault();
		var modal = $('#myModal');
		modal.attr('data-name', 'refund');
		modal.attr('data-value', $(this).attr('data-id'));
		showMessage('w',25,1);
		//$('.js-delete-hidden-btn').remove();

	});

	$('body').delegate('.js-delete-btn','click',function () {
		$('form').append('<input type="hidden" class="js-delete-hidden-btn" value="Yes" name="submit_buttons[delete]">').submit();
	});



	$(".forgot-password").validate({
		rules: {
			email: {
				required: true,
				email: true
			}
		},
		onkeyup: false	,
		onfocusout:false,
		showErrors: function(errorMap, errorList) {
			if (errorList.length > 0){
				showMessage('w',19,0);
			}
		}
	});

	$('.datetimepicker').datetimepicker({
		format:	'm/d/Y H:i'
	});
    $('.stop_element').parents('div.row').addClass('stop');
    $('.hidden_block').parents('div.row').hide();
    $('.js-add-stop-btn').click(function (e) {
		e.preventDefault();
		var button = $(this);
		var stop_id = parseInt(button.attr('data-stop')) ;
        button.attr('data-stop',stop_id +1 );
        button.append("<input type='hidden' name='stops[]' value='"+ stop_id +"'>");
	 	var elements =	$(this).parents('fieldset').find('div.row').not('.stop').clone(true);
        elements.each(function () {

		 var text_label = $(this).find('label').text();
		 var text_new = 'Stop ' + (stop_id +1) + ' ';
            $(this).find('label').prepend(text_new);
            $(this).find('input').val('');
           var name_input =  $(this).find('input').attr('name');
            $(this).find('input').attr('name', 'stop_' +stop_id + '_' +name_input);

            $(this).addClass('stop');
    /*        $(this).find('label').children() //select all the children
                .remove()   //remove all the children
                .end()  //again go back to selected element
                .text().replace(cur_label, new_label);*/
        }) ;

        elements =  elements.not('.alternate-legend');
        elements.show();
        button.parents('div.row').before(elements);
	})


});

function showMessage (a,b,c) {
	
}

String.prototype.capitalize = function () {
	return this.charAt(0).toUpperCase() + this.slice(1);
};

