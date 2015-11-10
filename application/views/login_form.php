<div id="login_form">
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