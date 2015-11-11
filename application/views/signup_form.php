<title>Sign up!</title>
<div style="padding: 1.1%; width:300px;margin:auto">
	<div id="register_form">
	<hl>Create an Account!</h1>
		<?php
		echo form_open('home/create_member');
		//echo form_input('first_name', set_value('first_name', 'First Name'));
		//echo form_input('last_name', set_value('last_name', 'Last Name'));
		
		echo form_input('username', set_value('username', 'Username'));
		echo form_input('email', set_value('email', 'Email Address'));
		echo form_input('telephone', set_value('telephone', 'Cellphone Number'));
		
		echo form_password('password', '', 'placeholder="Password" class="password"');
		echo form_password('password_confirm', '', 'placeholder="Confirm Password" class="password_confirm"');
		
		
		echo form_fieldset('Select your role(s)');
		echo form_label('Buyer','is_buyer');
		echo form_checkbox('roles[]','1',TRUE);
		echo form_label('Seller','is_seller');
		echo form_checkbox('roles[]','1',TRUE);
		echo form_fieldset_close();
		
		echo "<br />";//br();
		echo form_submit('submit', 'Create Account');
		echo anchor('home','Cancel');
		echo form_close();		
		?>
		<?php echo validation_errors('<p class="error">'); ?>
</div> 
</div>
