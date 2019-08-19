<?php
/* Smarty version 3.1.31, created on 2017-11-02 17:46:59
  from "/home/admin/web/cheapfirstclass.com/public_html/adminpdf/templates/login.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_59fb5a131cf5d5_32091591',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0682e210b88f05487793dc764901591b9347cc7a' => 
    array (
      0 => '/home/admin/web/cheapfirstclass.com/public_html/adminpdf/templates/login.tpl',
      1 => 1509636760,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59fb5a131cf5d5_32091591 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!-- NAVBAR -->
<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container-fluid">
			<span class="brand" >CHEAPFIRSTCLASS</span>
		</div>
	</div>
</div>
<!-- CONTAINER -->
<div class="container-fluid nopd">
	<!-- LOGIN -->
	<div class="login">
		<form name="login" class="login-form" action="" method="post">
			<h2 class="form-signin-heading">Welcome!</h2>

			<input type="text" name="email" class="input-block-level" placeholder="Email">
			<input type="password" name="password" class="input-block-level" placeholder="Password">
			<input name="cms_login_submit" type="hidden" value="1" />



			<button class="btn btn-large btn-block btn-primary" type="submit">Login</button>
		
		</form>

	</div>
</div>
<?php }
}
