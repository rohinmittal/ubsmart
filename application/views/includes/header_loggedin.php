<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="<?php echo base_url();?>css/style.css" type='text/css'>
<img id= "logo" src="<?php echo base_url("/images/ubsmart_logo.jpg"); ?>"/>   	
</head>
<body>   
<div class="search_bar">
<?php
if($this->session->userdata('logintype')=='buyer')
{
    echo form_open('catalog/execute_search');
    //echo form_label('Age: '.form_input('userAge',""),'age');
    ?>

	<div id="SB" style="background:#393939; padding: 1px;
display: -webkit-flex;
	 -webkit-align-items: center;
display: flex;
	 align-items: center;">

	     <?php echo form_input('search_query', 'Search', 'id="search_bar" style="margin: 0 0 0 0; 
		     border: none; height: 1px;width:30%; display: inline; margin-left:33%;"');
	 ?>
	     <button type="submit" style="display: inline; margin-left: -0.5%;" id="search_submit"><img id="MG"src="<?php echo base_url("/images/MG.png"); ?>"/></button>				
	     </div><?php
	     echo form_close();
}?>
</div>
<div class="main_bar">
<div id="mb_headers">
<?php 
if($this->session->userdata('logintype')=='buyer')
{?>
    <span class="electronics" id="categ_disp1" style="background: yellow;">Electronics</span>			    
	<span class="furniture" id="categ_disp1" style="margin-left: 0.8%; background: red;">Furniture</span>
	<?php } ?>
	<div id="right">
	<?php 
	if($this->session->userdata('logintype')=='buyer')
		{echo anchor('catalog','Browse Catalog','style="padding-right: 10px;"');}			
	echo anchor('myaccount','My account','style="padding-right: 10px;"');
	echo anchor('home/logout','Logout!','style=""');?>
</div>
</div>
<div id="dropdowns">
<ul class="electronics">
<li><?php echo anchor('','Cellphones','style=""');?></li>
<li><?php echo anchor('','Laptops','style=""');?></li>
</ul>
<ul class="furniture">
<li><?php echo anchor('','Table','style=""');?></li>
<li><?php echo anchor('','Chair','style=""');?></li>
</ul>
</div>
</div>



