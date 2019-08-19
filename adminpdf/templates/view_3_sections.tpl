

<script type="text/javascript">
	$(document).ready(function () {
		var form = '{$sections->getSelectedSection()->name}';
		if (form != '') {

			$('#' + form).submit(function () {
				if ($('.error').length > 0) {
					//$('#newSuccess').addClass('hide');
					//$( '.element.error span').parents('.row').find('label').addClass('label-error');
					//$('#newWarning').removeClass('hide');
					showMessage('w', 19, 0);
				}
			});
			$('#' + form + ' input').change(function () {
				$('.label-error').removeClass('label-error');
				$('#newWarning').addClass('hide');
			})
		} else {
			$('form').submit(function () {
				if ($('.error').length > 0) {
					showMessage('w', 19, 0);
				}
			});

		}


		$('textarea').parents('.element').addClass('textarea');
		$('.title-element').parents('.row').addClass('alternate-legend');

		if ($('.tab-content-form').length > 0) {
			{if isset($FormTabIndex)}
			formtab = {$FormTabIndex};
			{else}
			formtab = 0;
			{/if}
			BuildFormTabs('form-container', 'quickform');
			ActivateFormTab('form-container', formtab, 'quickform');
		}
////



		{if  in_array($section_name,array('key') )}
		$('.quickform span.required').parent().addClass('strong').append('<br><em><small class="muted"></small></em>');

		{else}

	$('.quickform span.required').parent().addClass('strong').append('<br><em><small class="muted">Required</small></em>');
	$('.quickform .row:not(.option-item) label.element:not(.strong)').append('<br><em><small class="muted">Optional</small></em>');
	{/if}
		$('.quickform .options-class').parents('.row').addClass('option-item');
		var input_second_price = $('.quickform .input-second-price:first');
		if (input_second_price.length > 0) {
			var parent_block = input_second_price.parent('.row');
			input_second_price = input_second_price.detach();
			parent_block.remove();
			$('.quickform .input-first-price:first').after(input_second_price);
		}
		var input_second_price = $('.quickform .input-second-price.fix');
		if (input_second_price.length > 0) {
			var parent_block = input_second_price.parent('.row');
			input_second_price = input_second_price.detach();
			parent_block.remove();
			$('.quickform .input-first-price.fix').after(input_second_price);
		}




		// end dashboard
		$(document).delegate('.quickform span.error', "click", function () {
			$(this).hide();
			$(this).parent().removeClass('error');
		});
		//$('.datepicker, .datepicker2,.dateonepicker').after('<span class="add-on"><i class="icon-calendar"></i></span>');

		$('.quickform div.element:empty').parent().remove();
		//$('.datepicker').next().remove();
		//$('.datepicker, .datepicker2,.dateonepicker').after('<span class="add-on"><i class="icon-calendar"></i></span>');

		// category
		{literal}

		$(document).delegate('.icon-calendar', "click", function () {
			$('.datepicker,.datepicker2,.dateonepicker', $(this).parent().parent()).focus();

		});
		$(".dateonepicker").datepicker({
			beforeShow: function (event, ui) {
				$('#ui-datepicker-div').css('left', '1000px');
				//$('input[type="text"]').val('');
				$('#alternate3').remove();
				$('.dateonepicker').parent().append('<input  disabled style="font-size:14px; border:0;padding-left:60px; background-color:#f5f5f5; box-shadow: none; cursor:default;" type="text" id="alternate3">')
			},

			showOn: 'both',
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd",
			//showOn:"button",
			buttonImage: url + "css-image/opacity-icon.png",
			buttonImageOnly: true,
			yearRange: '' + (new Date().getFullYear() - 10) + ':' + (new Date().getFullYear() + 20) + '',
			"maxDate": new Date((new Date().getFullYear()+2 ), (new Date().getMonth() ), (new Date().getDate())),
			"minDate": new Date((new Date().getFullYear() ), (new Date().getMonth() ), (new Date().getDate())),
			"showOptions": {direction: 'right'},

			altField: "#alternate3",
			altFormat: "MM d, yy",
			beforeShow: function (event, ui) {
				$('#ui-datepicker-div').css('left', '1000px');
				//$('input[type="text"]').val('');
				$('#alternate3').remove();
				$('.dateonepicker').parent().append('<input  disabled style="font-size:14px; border:0;padding-left:60px; background-color:#f5f5f5; box-shadow: none; cursor:default;" type="text" id="alternate3">')
			},
			onSelect: function (dateText, inst) {
				var div = $('legend:contains("orders")').parent();
				$('<label id="alternate3"></label>').appendTo(div).html(dateText);
				$(".dateonepicker").focus();
				$(".dateonepicker").blur();

			}

		});


		$(".datepicker").datepicker({
			beforeShow: function (event, ui) {
				$('#ui-datepicker-div').css('left', '1000px');
				$('.datepicker').val('');
				$('#alternate').remove();
				$('.datepicker').parent().append('<input  disabled style="font-size:14px; border:0;padding-left:60px; background-color:#f5f5f5; box-shadow: none; cursor:default;" type="text" id="alternate">')
			},
			showOn: 'both',
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd",
			//showOn:"button",
			buttonImage: url + "css-image/opacity-icon.png",
			buttonImageOnly: true,
			yearRange: '' + (new Date().getFullYear() - 1) + ':' + (new Date().getFullYear() + 1) + '',
			"maxDate": new Date((new Date().getFullYear() ), (new Date().getMonth() ), (new Date().getDate())),
			"minDate": new Date((new Date().getFullYear() - 1), (new Date().getMonth() ), (new Date().getDate())),
			"showOptions": {direction: 'right'},

			altField: "#alternate",
			altFormat: "MM d, yy",
			onSelect: function (dateText, inst) {
				var div = $('legend:contains("orders")').parent();
				$('<label id="alternate"></label>').appendTo(div).html(dateText);
				$(".datepicker").focus();
				$(".datepicker").blur();
			},
//			afterShow: function() {
//				$('input').blur();
//				console.log("After show");
//			},
			onClose: function (selectedDate) {
				if (selectedDate != '') {
					$(".datepicker2").datepicker("option", "minDate", selectedDate);
					var maxSelectedDate ;
					if ( moment(selectedDate,'YYYY-MM-DD').add(365, 'days').format('X') >  moment().format('X') ){
						maxSelectedDate =  moment().format('YYYY-MM-DD');

					}else{
						maxSelectedDate =	moment(selectedDate,'YYYY-MM-DD').add(365, 'days').format('YYYY-MM-DD');
					}

					$(".datepicker2").datepicker("option", "maxDate", maxSelectedDate );
				}else{
					$(".datepicker2").datepicker("option", "minDate", new Date((new Date().getFullYear() - 1), (new Date().getMonth() ), (new Date().getDate())));
				}
				var img = $(".datepicker2").parent().find('.ui-datepicker-trigger');
				$(".datepicker2").parent().find('.ui-datepicker-trigger').remove();
				$(".datepicker2").parent().find('.add-on').after(img);
			}
		});
		$(".datepicker2").datepicker({

			beforeShow: function (event, ui) {
				$('#ui-datepicker-div').css('left', '1000px');
				$('.datepicker2').val('');
				$('#alternate2').remove();
				$('.datepicker2').parent().append('<input  disabled style="font-size:14px; border:0;padding-left:60px; background-color:#f5f5f5; box-shadow: none; cursor:default;" type="text" id="alternate2">')
			},

			showOn: 'both',
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd",
			//showOn:"button",
			buttonImage: url + "css-image/opacity-icon.png",
			buttonImageOnly: true,
			yearRange: '' + (new Date().getFullYear() - 10) + ':' + (new Date().getFullYear() + 20) + '',
			"maxDate": new Date((new Date().getFullYear() ), (new Date().getMonth() ), (new Date().getDate())),
			"minDate": new Date((new Date().getFullYear()), (new Date().getMonth() ), (new Date().getDate())),
			"showOptions": {direction: 'right'},

			altField: "#alternate2",
			altFormat: "MM d, yy",
			onSelect: function (dateText, inst) {
				var div = $('legend:contains("orders")').parent();
				$('<label id="alternate2"></label>').appendTo(div).html(dateText);
				$(".datepicker2").focus();
				$(".datepicker2").blur();

			},
			onClose: function (selectedDate) {
				if (selectedDate != ''){
					$(".datepicker").datepicker("option", "maxDate", selectedDate);
					$(".datepicker").datepicker("option", "minDate", moment(selectedDate,'YYYY-MM-DD').subtract(365, 'days').format('YYYY-MM-DD'));
				}else{
					$(".datepicker").datepicker("option", "maxDate", new Date((new Date().getFullYear() ), (new Date().getMonth() ), (new Date().getDate())));

				}

				var img = $(".datepicker2").parent().find('.ui-datepicker-trigger');
				$(".datepicker2").parent().find('.ui-datepicker-trigger').remove();
				$(".datepicker2").parent().find('.add-on').after(img);
				var img2 = $(".datepicker").parent().find('.ui-datepicker-trigger');
				$(".datepicker").parent().find('.ui-datepicker-trigger').remove();
				$(".datepicker").parent().find('.add-on').after(img2);
			}
		});
		$('.datepicker, .datepicker2,.dateonepicker').after('<span class="add-on"><i class="icon-calendar"></i></span>');

		{/literal}




	});

	var selectedParamsArray = [];
	{foreach from=$sections item=section}
	selectedParamsArray['{$section->name}'] = '{$section->box_value}';
	{/foreach}

	function OpenSection(section_name, section_value) {

		var param = '';
		var page = '{$page}';

		for (key in selectedParamsArray) {
			value = selectedParamsArray[key];
			if (section_name == key) {
				new_value = section_value;
			} else {
				new_value = value;
			}
			if (param != '') param += '&';
			param += key + '=' + new_value;
			if (section_name == key) {
				break;
			}


		}
//    alert(section_name);
//    alert(section_value);
		if (page) {
			if (section_name == 'categories') {
				//	param = param + '&items=0'
			}
		}
		if (param != '') param = '?' + param;
		document.location = url + '{$selectedUrl}' + param;
		return false;
	}
</script>



<!-- BROWSE -->
{if !$sections->showOnlyForm()}
	<div class="browse">
		{$sections}
		{if $smarty.get.request}
		<a href="{$url}{$selectedUrl}?request={$selected_rq.rq_id}&show_pdf=1" class="btn btn-default">View pdf</a>
		{if $show_send_email}
			<a href="{$url}{$selectedUrl}?request={$selected_rq.rq_id}&send_email=1" class="btn btn-default">Send pdf to {$selected_rq.rq_email}</a>
		{/if}


		{/if}
	</div>
{/if}

<!-- MAIN -->
<div class="container-fluid nopd ">
	<div class="row-fluid">
		<div class="main {if $sections->showOnlyForm()}smal{/if}">
			{if $sections->showOnlyForm()}

			{if $data_report}
			<div class="page-header"><h1>{$csvFileName}</h1>
				<table class="table table-hover table-striped table-bordered" id="account-fixed">


					{foreach from=$data_report item=row key=Key}
						<tr>
							<td>{$Key+1}</td>

							{foreach from=$row item=column }
								<td>{$column}</td>
							{/foreach}
							{for $foo=count($row) to $report_column_count}
								<td></td>
							{/for}


						</tr>
					{/foreach}

				</table>

				{else}
				{$section->form_js}
				<div class="page-header"><h1>{$section->form_title}</h1>
					{*<small>{$section->form_description}</small>*}
				</div>
				{$section->form}

				{/if}


				{elseif $sections->getSelectedSection()}
				{$sections->getSelectedSection()->form_js}
				<div class="page-header"><h1>{$sections->getSelectedSection()->form_description}</h1>
					{*<small>{$sections->getSelectedSection()->form_description}</small>*}
				</div>

				{$sections->getSelectedSection()->form}



				{else}
				<div class="page-header"><h1>Complete the steps on the left.</h1></div>
				{/if}
			</div>
		</div>
	</div>
</div>
