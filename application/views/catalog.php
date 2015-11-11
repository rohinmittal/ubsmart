<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Welcome to UBsMart</title>
</head>

<body>
<div id="container">
	<h1>Welcome to UBsMart</h1>

	<div id="body">
		<p>The page you are looking at is the homepage for UBsMart!!!!</p>
		<?php echo anchor('home/myaccount','My account');?>
		<?php echo anchor('home/logout','Logout!');?>
	</div>
	
		
</div>

</body>
</html>
