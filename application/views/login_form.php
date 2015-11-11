<div id=login_page>	
<div id="adbanner_on_loginpage">
	<p style="font-size: 15" >"Content....."</p>
</div>
<div id="login_form" style="float:right">
	<?php if (isset($account_created)) {?>
		<h3><?php echo $account_created; ?></h3>
	<?php } else { ?>
		<h1>Login, please.</h1>
	<?php } ?>
	
	<?php
    echo form_open('login/validate_credentials');
	echo form_input('username', 'Username');
	echo form_password('password', '', 'placeholder="Password" class="password"');
	echo form_submit('submit','Login');
	echo anchor('login/signup','Create Account');
	echo form_close(); 				
	?>
	<?php echo validation_errors('<p class="error">'); ?>
</div>
</div>