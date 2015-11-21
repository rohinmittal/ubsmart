<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>My Account - UBsMart</title>
</head>


<p id=your_acc>
	<b> Hello <?php echo $username?>! Welcome to your UB sMart Account. </b>
</p>

<b>Orders:</b><br>
<?php echo anchor('myaccount/boughtHistory', 'Order History'); ?>
<br>
<br>
<b>UB sMart Wallet:</b><br>
Current Balance:
	<b><?php echo $vwBalance ?> INR </b>
	<div style="margin-left:1%; display:inline ">
		<?php echo anchor('myaccount/topupVWBalance', 'Topup?'); ?>
	</div><br>
<br>
<br>
<b>Settings:</b><br>
<?php
echo anchor('myaccount/getPassword','Change Account Details');
?>
<br>
