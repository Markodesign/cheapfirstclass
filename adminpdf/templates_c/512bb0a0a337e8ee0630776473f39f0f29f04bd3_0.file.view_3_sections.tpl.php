<?php
/* Smarty version 3.1.31, created on 2017-11-17 14:18:53
  from "/home/admin/web/cheapfirstclass.com/public_html/adminpdf/templates/view_3_sections.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a0eefcd4b93b0_36177355',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '512bb0a0a337e8ee0630776473f39f0f29f04bd3' => 
    array (
      0 => '/home/admin/web/cheapfirstclass.com/public_html/adminpdf/templates/view_3_sections.tpl',
      1 => 1510928329,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a0eefcd4b93b0_36177355 (Smarty_Internal_Template $_smarty_tpl) {
?>


<?php echo '<script'; ?>
 type="text/javascript">
	$(document).ready(function () {
		var form = '<?php echo $_smarty_tpl->tpl_vars['sections']->value->getSelectedSection()->name;?>
';
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
			<?php if (isset($_smarty_tpl->tpl_vars['FormTabIndex']->value)) {?>
			formtab = <?php echo $_smarty_tpl->tpl_vars['FormTabIndex']->value;?>
;
			<?php } else { ?>
			formtab = 0;
			<?php }?>
			BuildFormTabs('form-container', 'quickform');
			ActivateFormTab('form-container', formtab, 'quickform');
		}
////



		<?php if (in_array($_smarty_tpl->tpl_vars['section_name']->value,array('key'))) {?>
		$('.quickform span.required').parent().addClass('strong').append('<br><em><small class="muted"></small></em>');

		<?php } else { ?>

	$('.quickform span.required').parent().addClass('strong').append('<br><em><small class="muted">Required</small></em>');
	$('.quickform .row:not(.option-item) label.element:not(.strong)').append('<br><em><small class="muted">Optional</small></em>');
	<?php }?>
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

		




	});

	var selectedParamsArray = [];
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sections']->value, 'section');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['section']->value) {
?>
	selectedParamsArray['<?php echo $_smarty_tpl->tpl_vars['section']->value->name;?>
'] = '<?php echo $_smarty_tpl->tpl_vars['section']->value->box_value;?>
';
	<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>


	function OpenSection(section_name, section_value) {

		var param = '';
		var page = '<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
';

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
		document.location = url + '<?php echo $_smarty_tpl->tpl_vars['selectedUrl']->value;?>
' + param;
		return false;
	}
<?php echo '</script'; ?>
>



<!-- BROWSE -->
<?php if (!$_smarty_tpl->tpl_vars['sections']->value->showOnlyForm()) {?>
	<div class="browse">
		<?php echo $_smarty_tpl->tpl_vars['sections']->value;?>

		<?php if ($_GET['request']) {?>
		<a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;
echo $_smarty_tpl->tpl_vars['selectedUrl']->value;?>
?request=<?php echo $_smarty_tpl->tpl_vars['selected_rq']->value['rq_id'];?>
&show_pdf=1" class="btn btn-default">View pdf</a>
		<?php if ($_smarty_tpl->tpl_vars['show_send_email']->value) {?>
			<a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;
echo $_smarty_tpl->tpl_vars['selectedUrl']->value;?>
?request=<?php echo $_smarty_tpl->tpl_vars['selected_rq']->value['rq_id'];?>
&send_email=1" class="btn btn-default">Send pdf to <?php echo $_smarty_tpl->tpl_vars['selected_rq']->value['rq_email'];?>
</a>
		<?php }?>


		<?php }?>
	</div>
<?php }?>

<!-- MAIN -->
<div class="container-fluid nopd ">
	<div class="row-fluid">
		<div class="main <?php if ($_smarty_tpl->tpl_vars['sections']->value->showOnlyForm()) {?>smal<?php }?>">
			<?php if ($_smarty_tpl->tpl_vars['sections']->value->showOnlyForm()) {?>

			<?php if ($_smarty_tpl->tpl_vars['data_report']->value) {?>
			<div class="page-header"><h1><?php echo $_smarty_tpl->tpl_vars['csvFileName']->value;?>
</h1>
				<table class="table table-hover table-striped table-bordered" id="account-fixed">


					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data_report']->value, 'row', false, 'Key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['Key']->value => $_smarty_tpl->tpl_vars['row']->value) {
?>
						<tr>
							<td><?php echo $_smarty_tpl->tpl_vars['Key']->value+1;?>
</td>

							<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['row']->value, 'column');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['column']->value) {
?>
								<td><?php echo $_smarty_tpl->tpl_vars['column']->value;?>
</td>
							<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

							<?php
$_smarty_tpl->tpl_vars['foo'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['foo']->step = 1;$_smarty_tpl->tpl_vars['foo']->total = (int) ceil(($_smarty_tpl->tpl_vars['foo']->step > 0 ? $_smarty_tpl->tpl_vars['report_column_count']->value+1 - (count($_smarty_tpl->tpl_vars['row']->value)) : count($_smarty_tpl->tpl_vars['row']->value)-($_smarty_tpl->tpl_vars['report_column_count']->value)+1)/abs($_smarty_tpl->tpl_vars['foo']->step));
if ($_smarty_tpl->tpl_vars['foo']->total > 0) {
for ($_smarty_tpl->tpl_vars['foo']->value = count($_smarty_tpl->tpl_vars['row']->value), $_smarty_tpl->tpl_vars['foo']->iteration = 1;$_smarty_tpl->tpl_vars['foo']->iteration <= $_smarty_tpl->tpl_vars['foo']->total;$_smarty_tpl->tpl_vars['foo']->value += $_smarty_tpl->tpl_vars['foo']->step, $_smarty_tpl->tpl_vars['foo']->iteration++) {
$_smarty_tpl->tpl_vars['foo']->first = $_smarty_tpl->tpl_vars['foo']->iteration == 1;$_smarty_tpl->tpl_vars['foo']->last = $_smarty_tpl->tpl_vars['foo']->iteration == $_smarty_tpl->tpl_vars['foo']->total;?>
								<td></td>
							<?php }
}
?>



						</tr>
					<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>


				</table>

				<?php } else { ?>
				<?php echo $_smarty_tpl->tpl_vars['section']->value->form_js;?>

				<div class="page-header"><h1><?php echo $_smarty_tpl->tpl_vars['section']->value->form_title;?>
</h1>
					
				</div>
				<?php echo $_smarty_tpl->tpl_vars['section']->value->form;?>


				<?php }?>


				<?php } elseif ($_smarty_tpl->tpl_vars['sections']->value->getSelectedSection()) {?>
				<?php echo $_smarty_tpl->tpl_vars['sections']->value->getSelectedSection()->form_js;?>

				<div class="page-header"><h1><?php echo $_smarty_tpl->tpl_vars['sections']->value->getSelectedSection()->form_description;?>
</h1>
					
				</div>

				<?php echo $_smarty_tpl->tpl_vars['sections']->value->getSelectedSection()->form;?>




				<?php } else { ?>
				<div class="page-header"><h1>Complete the steps on the left.</h1></div>
				<?php }?>
			</div>
		</div>
	</div>
</div>
<?php }
}
