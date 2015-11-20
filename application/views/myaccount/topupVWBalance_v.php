<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Topup your VW - UBsMart</title>
</head>

<div id="update_details_form">
	<?php
	echo form_open('myaccount/validateCreditCardDetails');
	echo form_input('cardnumber', set_value('cardnumber', 'enter your 16 digit card number'));
	echo form_input('month', set_value('month', '1-12'));
	echo form_input('year', set_value('year', '2015'));
	echo form_submit('submit','Submit');
	echo anchor('myaccount','Cancel');
	echo form_close(); 	
	
	echo validation_errors('<p class="error">'); 			
	?>
</div>
	
