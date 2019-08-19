<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <title>CHEAPFIRSTCLASS</title>
   {include file="meta.tpl"}
</head>
<body class="background-login">
<div style="height: 40px;"></div>
<script type="text/javascript">
   $(document).ready(function(){

      {if $message}
      var type = '{$message['type']}';
      var code = '{$message['code']}';
      showMessage(type,code,0 );
      {/if}
   })
</script>

<!-- NOTIFICATION -->
<div class="notification">
   <div id="newWarning" class="alert alert-block hide ">
      <button id="" class="close" type="button">×</button>
      <h4 class="notification-title alert-heading"></h4>
      <p class="notification-text"></p>
   </div>
</div>