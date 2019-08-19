
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
      <form name="login" class="new-pass-form" action="" method="post">
         <h2 class="form-signin-heading">Reset Password!</h2>

         <input type="password" id="password" name="password" class="input-block-level" placeholder="New Password">
         <input type="password" name="password_check" class="input-block-level" placeholder="Confirm New Password">
         <input name="cms_login_submit" type="hidden" value="1" />
         <input name="hash" type="hidden" value="{$hash}" />
         {*			<label class="checkbox">
						 <input type="checkbox" value="remember-me"> Remember me
					 </label>*}


         <button class="btn btn-large btn-block btn-primary" type="submit">Change</button>
         <div class="login-link-block">
            <a class="resend-activation" href="{$url}resend-activation/">Resend Activation</a>
            <a class="forgot-password" href="{$url}forgot-password/">Forgot Password?</a>
         </div>
      </form>

   </div>
</div>
