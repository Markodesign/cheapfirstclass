<?php
/* Smarty version 3.1.31, created on 2017-11-17 14:18:53
  from "/home/admin/web/cheapfirstclass.com/public_html/adminpdf/templates/section_select.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a0eefcd525e04_17479241',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2b9a012bdef9eae2f6236dd93732516bd4c7e972' => 
    array (
      0 => '/home/admin/web/cheapfirstclass.com/public_html/adminpdf/templates/section_select.tpl',
      1 => 1510928330,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a0eefcd525e04_17479241 (Smarty_Internal_Template $_smarty_tpl) {
?>


<h2><?php echo $_smarty_tpl->tpl_vars['section']->value->box_title;?>
<br />
	
</h2>
<?php if (!isset($_smarty_tpl->tpl_vars['section']->value->box_can_add) || isset($_smarty_tpl->tpl_vars['section']->value->box_can_add) && $_smarty_tpl->tpl_vars['section']->value->box_can_add == true) {?>
	<button class="btn btn-large btn-block btn-success" type="button"
	        onclick="OpenSection('<?php echo $_smarty_tpl->tpl_vars['section']->value->name;?>
', 0);return false;"><?php echo $_smarty_tpl->tpl_vars['section']->value->box_add_title;?>
</button>
	<p class="muted pt20">or browse existing ones:</p>
<?php }?>

<select class="input-block-level" size="10" name="tips"
        onchange="OpenSection('<?php echo $_smarty_tpl->tpl_vars['section']->value->name;?>
', this.value);return false;">
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['section']->value->box_elements, 'item_value', false, 'item_key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item_key']->value => $_smarty_tpl->tpl_vars['item_value']->value) {
?>
		<option <?php if ($_smarty_tpl->tpl_vars['section']->value->box_value == $_smarty_tpl->tpl_vars['item_key']->value) {?>selected="selected"<?php }?> value="<?php echo $_smarty_tpl->tpl_vars['item_key']->value;?>
" title="<?php echo $_smarty_tpl->tpl_vars['item_value']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['item_value']->value;?>
</option>
	<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

</select>
<?php if ($_smarty_tpl->tpl_vars['section']->value->box_sortable && $_smarty_tpl->tpl_vars['section']->value->box_value > 0 && count($_smarty_tpl->tpl_vars['section']->value->box_elements) > 1) {?>
	<ul class="nav nav-pills nav-center">
		<?php if ($_smarty_tpl->tpl_vars['first_id']->value != $_smarty_tpl->tpl_vars['section']->value->box_value) {?>
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;
echo $_smarty_tpl->tpl_vars['selectedUrl']->value;?>
?<?php echo $_smarty_tpl->tpl_vars['section']->value->name;?>
_sort=first&<?php echo $_smarty_tpl->tpl_vars['sections']->value->generateUrlParams();?>
"><i
							class="icon-step-backward icon-rotate-90"></i></a></li>
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;
echo $_smarty_tpl->tpl_vars['selectedUrl']->value;?>
?<?php echo $_smarty_tpl->tpl_vars['section']->value->name;?>
_sort=prew&<?php echo $_smarty_tpl->tpl_vars['sections']->value->generateUrlParams();?>
"><i
							class="icon-chevron-up"></i></a></li>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['last_id']->value != $_smarty_tpl->tpl_vars['section']->value->box_value) {?>
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;
echo $_smarty_tpl->tpl_vars['selectedUrl']->value;?>
?<?php echo $_smarty_tpl->tpl_vars['section']->value->name;?>
_sort=next&<?php echo $_smarty_tpl->tpl_vars['sections']->value->generateUrlParams();?>
"><i
							class="icon-chevron-down"></i></a></li>
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;
echo $_smarty_tpl->tpl_vars['selectedUrl']->value;?>
?<?php echo $_smarty_tpl->tpl_vars['section']->value->name;?>
_sort=last&<?php echo $_smarty_tpl->tpl_vars['sections']->value->generateUrlParams();?>
"><i
							class="icon-step-forward icon-rotate-90"></i></a></li>
		<?php }?>
	</ul>
<?php }
}
}
