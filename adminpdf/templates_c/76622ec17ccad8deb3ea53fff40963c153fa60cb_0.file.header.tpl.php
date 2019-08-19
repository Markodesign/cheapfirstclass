<?php
/* Smarty version 3.1.31, created on 2017-11-02 17:44:36
  from "/home/admin/web/cheapfirstclass.com/public_html/adminpdf/templates/header.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_59fb59841f4e25_92750441',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '76622ec17ccad8deb3ea53fff40963c153fa60cb' => 
    array (
      0 => '/home/admin/web/cheapfirstclass.com/public_html/adminpdf/templates/header.tpl',
      1 => 1509636759,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:meta.tpl' => 1,
  ),
),false)) {
function content_59fb59841f4e25_92750441 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
	<html lang="en">
	<head>
		<?php $_smarty_tpl->_subTemplateRender("file:meta.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>



		<meta charset="utf-8">
		<title>CHEPFIRSTCLASS</title>

	</head>
	<body class="background-white">
	<div style="height: 40px;"></div>
	<!-- NOTIFICATION -->
	<div class="notification">
		<div id="newWarning" class="alert alert-block hide ">
			<button id="" class="close" type="button">×</button>
			<h4 class="notification-title alert-heading"></h4>
			<p class="notification-text"></p>
		</div>
	</div>

	<!-- NAVBAR -->
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container-fluid">
				<span class="brand" >CHEAPFIRSTCLASS </span>
				<div class="nav-collapse collapse">
					<ul class="nav pull-right">
						
						<li><a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;
echo $_smarty_tpl->tpl_vars['quit']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['quit']->value[$_smarty_tpl->tpl_vars['lang']->value];?>
</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- COLORBAR -->
	<div class="colorbar"></div>
	<!-- SIDEBAR -->
	<div class="sidebar">
		<ul class="nav nav-list">
			<?php if (count($_smarty_tpl->tpl_vars['topMenu']->value) > 1) {?>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['topMenu']->value, 'menuChild', false, 'currentChild');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['currentChild']->value => $_smarty_tpl->tpl_vars['menuChild']->value) {
?>
				<?php if (in_array($_smarty_tpl->tpl_vars['access_type']->value,$_smarty_tpl->tpl_vars['menuChild']->value['admin_access'])) {?>
					<li<?php if ($_smarty_tpl->tpl_vars['currentChild']->value == $_smarty_tpl->tpl_vars['selectedTop']->value) {?> class="active"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;
echo $_smarty_tpl->tpl_vars['currentChild']->value;?>
/"><?php echo $_smarty_tpl->tpl_vars['menuChild']->value[$_smarty_tpl->tpl_vars['lang']->value];?>
</a></li>
				<?php }?>
			<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

			<?php }?>
			<?php if (count($_smarty_tpl->tpl_vars['menu']->value[$_smarty_tpl->tpl_vars['selectedTop']->value])) {?>
			<?php if (count($_smarty_tpl->tpl_vars['topMenu']->value) > 1) {?>
				<li class="nav-header">Sections</li>
			<?php }?>

				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['menu']->value[$_smarty_tpl->tpl_vars['selectedTop']->value], 'menuChild', false, 'currentChild');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['currentChild']->value => $_smarty_tpl->tpl_vars['menuChild']->value) {
?>
							<?php if (in_array($_smarty_tpl->tpl_vars['access_type']->value,$_smarty_tpl->tpl_vars['menuChild']->value['admin_access'])) {?>
								<li <?php if ($_smarty_tpl->tpl_vars['currentChild']->value == $_smarty_tpl->tpl_vars['selectedMenu']->value) {?> class="active"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;
echo $_smarty_tpl->tpl_vars['selectedTop']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['currentChild']->value;?>
/"><?php echo $_smarty_tpl->tpl_vars['menuChild']->value[$_smarty_tpl->tpl_vars['lang']->value];?>
</a>										</li>
							<?php }?>
						<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>


			<?php }?>
	</ul>
	</div>
	<!-- MODAL -->

	<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header text-center">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel"></h3>
		</div>
		<div class="modal-body text-center">
			<p></p>
		</div>
		<div class="modal-footer">
			<div class="text-center">
				<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">No</button>
				<button class="btn btn-success ">Yes</button>
			</div>
		</div>
	</div>

<?php }
}
