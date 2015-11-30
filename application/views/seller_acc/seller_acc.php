<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>My Account</title>
</head>

<p id=your_acc><b> Your Account </b></p>
<div id='results'>
    <?php echo $this->table->generate($users); ?>
    </div>
<b>Products:</b><br>
<a href="<?php echo site_url('seller_acc/upload_form') ?>">Upload Product</a><br>
<br>

<br>
<b><a href="<?php echo site_url('seller_acc/display_seller_prods') ?>">Display Uploaded Products</a></b><br>
<b><a href="<?php echo site_url('seller_acc/edit_seller_prods') ?>">Edit Uploaded Product</a></b><br>
<b>Settings:</b><br>
<a href="<?php echo site_url('seller_acc/update_acc') ?>">Change Account Details</a>
<br>