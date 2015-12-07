<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>My Account - UBsMart</title>
</head>

<p id=your_acc>
	<b> Hello <?php echo $username?>! Welcome to your UB sMart Account. </b><br><br>
	You have <?php echo $handoverCount ?> pending handovers! Click on the Handover link below to confirm your handovers!<br><br>
</p>



<div id="left_side">
	<fieldset>
		<legend style="text-align:left"><b>Orders</b></legend>
		<br>
		<?php echo anchor('myaccount/boughtHistory', 'Order History / Handovers'); ?>
		<br>
		<br>
		<br>
	</fieldset>
</div>

<div id="right_side">
	<fieldset>
		<legend style="text-align:left"><b>Settings</b></legend>
		<br>
		<?php echo anchor('myaccount/getCurrentPassword','Change Account Details'); ?>
		<br>
		<br>
		<br>
	</fieldset>
</div>

<div id ="center_s">
	<fieldset>
		<legend style="text-align:left"><b>UB sMart Wallet</b></legend>
		<br>
		Current Balance: <b><?php echo $vwBalance ?> USD </b>
		<br>
		<?php echo anchor('myaccount/topupVWBalance', 'Topup?'); ?>
		<br>
		<br>
	</fieldset>
</div>

