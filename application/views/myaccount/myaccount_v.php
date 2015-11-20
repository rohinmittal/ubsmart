<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>My Account - UBsMart</title>
</head>


<p id=your_acc><b> Your Account </b></p>
<b>Orders:</b><br>
Order History<br>
<br>
<b>UB sMart Wallet:</b><br>
Check Wallet Balance <br>
Add money to wallet <br>
<br>
<b>Settings:</b><br>
<br>
<?php
echo anchor('myaccount/getPassword','Change Account Details');
?>
