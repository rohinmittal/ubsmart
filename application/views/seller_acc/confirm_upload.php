<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<title>Confirm Upload</title>

<div style="padding: 1.1%; width:450px;margin:auto">
		<div id="confirm_form">
	<?php 
	$attributes_upload = array('id' => 'confirm_upload');
	    //echo $suramrit; //use  these variables from $data to fill form... fill form to data base.. :)
		echo form_open_multipart('seller_acc/do_upload',$attributes_upload);
		?>
		<div id ="product details" style="visibility:visible; display: none" > 
	
		<?php
		echo form_input('p_name', set_value('p_name',$p_name ));
		echo form_input('p_category', set_value('p_category', $p_category));
		echo form_input('p_subcategory', set_value('p_subcategory', $p_subcategory));
		echo form_input('p_smart_price', set_value('p_smart_price', $p_smart_price));
		echo form_input('p_tier', set_value('p_tier', $p_tier));
		echo form_input('dimension', set_value('dimension', $dimension));
		echo form_input('material', set_value('material', $material));
		echo form_input('serial', set_value('serial', $serial));
		echo form_input('is_charger', set_value('is_charger', $is_charger));
		echo form_input('is_headset', set_value('is_headset', $is_headset));
		echo form_input('is_charger_cell', set_value('is_charger_cell', $is_charger_cell));
		echo form_input('imei', set_value('imei', $imei));
		echo form_input('p_condition', set_value('p_condition', $p_condition));
		echo form_input('is_sowner', set_value('is_sowner', $is_owner));
		echo form_input('dim_l', set_value('dim_l', $dim_l));
		echo form_input('dim_w', set_value('dim_w', $dim_w));
		echo form_input('dim_h', set_value('dim_h', $dim_h));
		
		
		?>
		</div id="confirm_upload">
		<?php
		//echo form_label('Product Name','p_name');
		//echo form_input('productname', set_value('productname',$p_name ));
		//echo $is_owner;
		//echo $p_condition;
		//echo form_input('is_sowner', set_value('is_sowner', $is_owner));
		echo form_fieldset('The evaluated tier for your product is');
		echo form_label($p_tier,'p_tier');
		echo form_fieldset_close();
		echo "<br />";
		echo "<br />";
		//echo $_POST['productname'];
		echo "<br />";
		echo form_fieldset('The Smart price for this product is:');
		echo form_label('Smart Price  ','p_sp');
		echo form_label($p_smart_price,'p_sp2');
		echo "<br />";
		echo form_label('Max Price  ','p_mp');
		echo form_label($max_price,'p_mp2');
		echo "<br />";
		echo form_label('Min Price  ','p_minp');
		echo form_label($min_price,'p_minp2');
		echo "<br />";
		echo form_fieldset_close();
		echo "<br />";
	    echo form_label('Enter Asking price for your product!','ask_price'); 
		echo form_input('ask_price', set_value('ask_price','Enter Asking Price of the product.'));
		echo form_label('Enter a brief description of the product','p_desc');
		echo form_input('p_desc', set_value('p_desc','Describe your product.'));
		echo form_label('Choose 3 Images','image2');
		echo "<input type='file' name='userfiles[]' size='20' multiple/>"; 
		echo "<br />";
		echo "<br />";
		echo "<input type='submit' name='submit2' value='Upload' /> ";
		echo anchor('seller_acc','Cancel');	
		echo form_close();
		
		?>
		<?php echo validation_errors('<p class="error">'); ?>
</div>
	</div>