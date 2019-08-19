<?php
/* Smarty version 3.1.31, created on 2017-11-02 17:46:59
  from "/home/admin/web/cheapfirstclass.com/public_html/adminpdf/templates/header_login.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_59fb5a131b4940_59912271',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8c405692ac09f5b1d65c10eea046ffd79ef20bab' => 
    array (
      0 => '/home/admin/web/cheapfirstclass.com/public_html/adminpdf/templates/header_login.tpl',
      1 => 1509636759,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:meta.tpl' => 1,
  ),
),false)) {
function content_59fb5a131b4940_59912271 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <title>CHEAPFIRSTCLASS</title>
   <?php $_smarty_tpl->_subTemplateRender("file:meta.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

</head>
<body class="background-login">
<div style="height: 40px;"></div>
<?php echo '<script'; ?>
 type="text/javascript">
   $(document).ready(function(){

      <?php if ($_smarty_tpl->tpl_vars['message']->value) {?>
      var type = '<?php echo $_smarty_tpl->tpl_vars['message']->value['type'];?>
';
      var code = '<?php echo $_smarty_tpl->tpl_vars['message']->value['code'];?>
';
      showMessage(type,code,0 );
      <?php }?>
   })
<?php echo '</script'; ?>
>

<!-- NOTIFICATION -->
<div class="notification">
   <div id="newWarning" class="alert alert-block hide ">
      <button id="" class="close" type="button">×</button>
      <h4 class="notification-title alert-heading"></h4>
      <p class="notification-text"></p>
   </div>
</div><?php }
}
