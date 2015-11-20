<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Confirm your password - UBsMart</title>
</head>

<div id="update_details_form">
	<?php
	echo form_open('myaccount/validatePassword');
	echo form_password('current_password', '', 'placeholder="your current password" class="password"');
	echo form_submit('submit','Submit');
	echo anchor('myaccount','Cancel');
	echo form_close(); 	
	
	echo validation_errors('<p class="error">'); 			
	?>
</div>
	
