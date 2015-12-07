<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Encash your VW - UBsMart</title>
</head>

<div id="update_details_form">
	
	<?php
	echo form_open('seller_acc/encash_form');
	echo form_input('acc_number', set_value('acc_number', 'Enter your account number'));
	echo "<br />";
	echo form_input('acc_name', set_value('acc_name', 'Enter account holders name'));

	echo form_label('Select Account Type','acc_type');
	echo "<br />";
	echo form_label('Checking Account','type_acc');
	echo form_radio('a_type','checking',TRUE,'class="a_type"');
	echo form_label('Savings Account','type_acc');
	echo form_radio('a_type','savings',FALSE,'class="a_type"');
	echo "<br />";
	echo "<br />";
	echo form_input('amount', set_value('amount', 'Enter the amount'));
	echo form_submit('submit','Encash');
	echo anchor('seller_acc','Cancel');
	
	echo form_close(); 	
	
	echo validation_errors('<p class="error">'); 			
	?>
</div>
	
