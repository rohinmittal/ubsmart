<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Confirm your password - UBsMart</title>
</head>


<div id="update_details_form">
	<?php if (isset($incorrect_password)) {?>
	<b><?php echo $incorrect_password; ?></b>
	<?php } else { ?>
	<b>Enter your current password.</b>
	<?php } ?>
	
	<?php
	echo form_open('myaccount/validateCurrentPassword');
	echo form_password('current_password', '', 'placeholder="your current password" class="password"');
	echo form_submit('submit','Submit');
	echo anchor('myaccount','Cancel');
	echo form_close(); 	
	
	echo validation_errors('<p class="error">'); 			
	?>
</div>
	
