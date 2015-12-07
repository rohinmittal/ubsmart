
<title>My Account - UBsMart</title>

<div id="breadcrumbs">
	<br>
</div>
<div id="your_acc">
	<b> Hello <?php echo $username?>! Welcome to your UB sMart Account. </b><br><br>
	You have <?php echo $handoverCount ?> pending handovers! Click on the Handover link below to confirm your handovers!<br><br>
</div>



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

