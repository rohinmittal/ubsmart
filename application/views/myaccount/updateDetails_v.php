<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Update details - UBsMart</title>
</head>

<div id="update_details_form">
	<?php
	echo form_open('myaccount/updateDetails');
	echo form_password('newPassword', '', 'placeholder="your new password" class="password"');
	echo form_password('confirmPassword', '', 'placeholder="confirm your password" class="password"');
	echo form_submit('submit','Update Details');
	if($this->session->userdata('logintype')=='buyer')
			{
				echo anchor('myaccount','Cancel');
			}
			else
			{
				echo anchor('seller_acc','Cancel');
			}
	echo form_close();
	echo validation_errors('<p class="error">');  				
	?>
</div>
	
