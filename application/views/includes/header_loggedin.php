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
    			
    			<div id="SB" style="background:#393939; padding: 1px;">
    			<?php echo form_input('search_query', 'Search', 'id="search_bar" style="margin: 0 0 0 0; 
    			border: none; height: 1px ;width:40%; display: inline; margin-left:25%;"');
				?>
				<button type="submit" style="display: inline;" id="search_submit"><img src="<?php echo base_url("/images/MG.png"); ?>"/></button>				
				</div><?php
   			}?>
		</div>
		<div class="main_bar">
		<?php echo anchor('catalog','Browse Catalog');?>
		<?php echo anchor('myaccount','My account');?>
		<?php echo anchor('home/logout','Logout!');?>
		</div>
	
	
