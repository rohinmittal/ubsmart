<title>Edit Products Uploaded</title>

<div style="padding: 1.1%; width:450px;margin:auto">
		<div id="confirm_form">
	<?php 
     	$attributes_upload = array('id' => 'edit_upload');
	    //echo $suramrit; //use  these variables from $data to fill form... fill form to data base.. :)
		echo form_open('seller_acc/do_edit',$attributes_upload);
		
		
		//echo form_label('Product Name','p_name');
		//echo form_input('productname', set_value('productname',$p_name ));
		echo form_fieldset('Enter Product ID (refer Uploaded product page)');
		echo form_input('product_id', set_value('product_id', 'Enter the product ID'));
		echo form_fieldset_close();
		echo "<br />";
		echo "<br />";
		//echo $_POST['productname'];
		echo "<br />";
		echo "<br />";
		echo form_fieldset('Enter Edit Options');
		echo form_label('Edit Product Details','prod_edit');
		echo form_radio('edit_option','edit',FALSE,'class="edit_option"');
		echo form_label('Delete Product','prod_edit');
		echo form_radio('edit_option','delete',FALSE,'class="edit_option"');
		echo form_fieldset_close();
		echo "<br />";
		echo "<br />";
		?>
		<div id = "edit_detail_form" style="visibility:visible; display:none" >
			<?php
		echo form_fieldset('Enter Changed Details - Refer Policy for Details');
		echo form_label('Product Name','p_name');
		echo form_input('product_name', set_value('product_name', 'Update product name'));
		echo form_label('Product Price','p_price');
		echo form_input('product_price', set_value('product_price', 'Update product price'));
		echo form_label('Product Description','p_price');
		echo form_input('product_desc', set_value('product_desc', 'Update product description'));
		echo form_fieldset_close();
	
		?>
		</div>
		<?php
			echo "<input type='submit' name='submit' value='Confirm Edit'/> ";
		echo anchor('seller_acc','Cancel');	
		echo form_close();
		?>
		
</div>
	</div>