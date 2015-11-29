<title>Product Upload</title>

<div style="padding: 1.1%; width:450px;margin:auto">
		<div id="upload_form">
	<hl>Please Enter Product Details!</h1>
		<?php
		$attributes_upload = array('id' => 'upload_form');
		//$data
		$data['suri']="suri";
		echo form_open_multipart('seller_acc/form_upload',$attributes_upload);
		
		echo form_label('Product Name','p_name');
		echo form_input('productname', set_value('productname', 'Enter Product Name:'));
		echo form_label('Ownership Type','p_owner');
		echo "<br />";
		echo form_checkbox('is_owner', 'is_owner', FALSE);
		echo form_label('You are the first owner of the product?','is_owner');
		echo "<br />";
		echo "<br />";
		echo form_fieldset('Enter Product Specifications');
		echo form_label('Product Category','p_cat');
		echo "<br />";
		echo form_label('Furniture','is_furniture');
		echo form_radio('categories','furniture',TRUE,'class="cat"');
		echo form_label('Electronics','is_electronic');
		echo form_radio('categories','electronic',FALSE,'class="cat"');
		//echo form_label('Mobile','is_mobile');
		//echo form_radio('categories','mobile',FALSE,'class="cat"');
		echo form_fieldset_close();
		?>
		<div id="formContainer">
	 	<div id = "product_type_form"></div>
	 	
	 	<div id = "furniture_form" style="visibility:visible; " >
	 		<?php
        echo form_label('Select Furniture Type','type_furniture');
        echo "<br />";
        echo form_label('Table','type_furniture');
		echo form_radio('f_type','table',TRUE,'class="f_type"');
		echo form_label('Chair','type_furniture');
		echo form_radio('f_type','chair',FALSE,'class="f_type"');
	 		?>
	 		
	 	
	 	<div id = "table_details" style="visibility:visible; " >
	 		<?php
	 		echo form_label('Material Type','type_material');
        echo "<br />";
	 	 echo form_label('Plastic','type_material');
		echo form_radio('mat_type','plastic',FALSE,'class="type_table"');
		 echo form_label('Wood','type_material');
		echo form_radio('mat_type','wood',FALSE,'class="type_table"');
		 echo form_label('Steel','type_material');
		echo form_radio('mat_type','steel',FALSE,'class="type_table"');
		echo "<br />";
		echo form_fieldset('Enter Product dimensions');
		echo form_label('Length','tab_dimen_l'); 
		echo form_input('tab_dimension_l', set_value('tab_dimension_l', 'Length'));
		echo form_label('Width','tab_dimen_w'); 
		echo form_input('tab_dimension_w', set_value('tab_dimension_w', 'Width'));
		echo form_label('Height','tab_dimen_h'); 
		echo form_input('tab_dimension_h', set_value('tab_dimension_h', 'Height'));
		echo form_fieldset_close();
		$options = array(
                  '<6month'  => '<6 Months',
                  '6-1yr'    => '6 Months to 1 Year',
                  '>1yr'   => '>1 Year',
                );
		echo form_label('Select Duration of Purchase','type_age');
		echo form_dropdown('age_table', $options, '<6month');
		echo "<br />";
		$options = array(
                  'slight'  => 'Slight wear and tear',
                  'moderate'    => 'Moderate wear and tear',
                  'serious'   => 'Serious wear and tear',
                );
		echo form_label('Select Condition of product','table_condition');
		echo form_dropdown('table_condition', $options, 'moderate');
		//table details complete
		?>
		</div>
		<div id = "chair_details" style="visibility:visible; display: none" >
	 		<?php
	 		echo form_label('Material Type','type_material');
        echo "<br />";
	 	 echo form_label('Plastic','type_material');
		echo form_radio('chair_mat_type','plastic',FALSE,'class="type_chair"');
		 echo form_label('Wood','type_material');
		echo form_radio('chair_mat_type','wood',FALSE,'class="type_chair"');
		 echo form_label('Steel','type_material');
		echo form_radio('chair_mat_type','steel',FALSE,'class="type_chair"');
		echo "<br />";
		echo form_label('Cushion Type','type_cushion');
        echo "<br />";
	 	 echo form_label('Cotton/Fabric','type_cushion');
		echo form_radio('cushion_type','cotton',FALSE,'class="type"');
		 echo form_label('Foam','type_cushion');
		echo form_radio('cushion_type','foam',FALSE,'class="type"');
		 echo form_label('None','type_cushion');
		echo form_radio('cushion_type','none',FALSE,'class="type"');
		echo "<br />";
		echo form_fieldset('Enter Product dimensions');
		echo form_label('Length','chair_dimen_l'); 
		echo form_input('chair_dimension_l', set_value('chair_dimension_l', 'Length'));
		echo form_label('Width','chair_dimen_w'); 
		echo form_input('chair_dimension_w', set_value('chair_dimension_w', 'Width'));
		echo form_label('Height','chair_dimen_h'); 
		echo form_input('chair_dimension_h', set_value('chair_dimension_h', 'Height'));
		echo form_fieldset_close();
		
		$options = array(
                  '<6month'  => '<6 Months',
                  '6-1yr'    => '6 Months to 1 Year',
                  '>1yr'   => '>1 Year',
                );
		echo form_label('Select Duration of Purchase','type_age');
		echo form_dropdown('age_chair', $options, '<6month');
		echo "<br />";
		$options = array(
                  'slight'  => 'Slight wear and tear',
                  'moderate'    => 'Moderate wear and tear',
                  'serious'   => 'Serious wear and tear',
                );
		echo form_label('Select Condition of product','chair_condition');
		echo form_dropdown('chair_condition', $options, 'moderate');
		echo "<br />";
		echo form_checkbox('has_leather', 'has_leather', TRUE);
		echo form_label('Does the chair have leather?','has_leather');
		//chair details complete
		?>		
	 	</div>
	 	</div>
	 	<div id="electronic_form" style="visibility:visible; display: none">
	 		<?php
        echo form_label('Select Electronic Item Type','type_electronic');
        echo "<br />";
        echo form_label('Laptop','type_electronic');
		echo form_radio('e_type','laptop',TRUE,'class="e_type"');
		echo form_label('CellPhone','type_electronic');
		echo form_radio('e_type','cellphone',FALSE,'class="e_type"');
	 		?>
        <div id = "laptop_details" style="visibility:visible; " >
	 		<?php
		echo "<br />";
		echo form_fieldset('System Configuration');
		$options = array(
                  '<1g'  => '<1 GB',
                  '1-2g'    => '1 to 2 GB',
                  '>2g'   => '>2 GB',
                );
		echo form_label('System RAM','type_ram');
		echo form_dropdown('ram_laptop', $options, '1-2g');
		echo "<br />";
		$options = array(
                  '<500g'  => '<500 GB',
                  '>500g'   => '>500 GB',
                );
		echo form_label('System Storage','type_storage');
		echo form_dropdown('storage_laptop', $options, '<500g');
		echo form_fieldset_close();
		echo "<br />";
		echo form_fieldset('Functional Condition');
		echo form_checkbox('switch_on', 'switch_on', FALSE);
		echo form_label('System switches on','switch_on');
		echo "<br />";
		echo form_checkbox('key_missing', 'key_missing', FALSE);
		echo form_label('No keys are missing?','key_missing');
		echo "<br />";
		echo form_checkbox('cd_working', 'cd_working', FALSE);
		echo form_label('The CD Drive is working?','cd_working');
		echo "<br />";
		echo form_checkbox('touchpad_working', 'touchpad_working', FALSE);
		echo form_label('Touchpad is working','touchpad_working');
		echo "<br />";
		echo form_checkbox('battery_life', 'battery_life', FALSE);
		echo form_label('Battery lasts more than 45 minutes','battery_life');
		echo "<br />";
		echo form_checkbox('charger_included', 'charger_included', FALSE);
		echo form_label('Charger is included','charger_included');
		echo "<br />";
		echo form_checkbox('bill_included', 'bill_included', FALSE);
		echo form_label('Original Bill is included','bill_included');
		echo form_fieldset_close();
		echo form_checkbox('warranty_valid', 'warranty_valid', FALSE);
		echo form_label('Product Warranty is valid','warranty_valid');
		echo "<br />";
		$options = array(
                  '1-2yr'  => '1 to 2 years',
                  '>2yr'    => 'More than 2 Years',
                  '<1yr'   => 'Less than 1 Year',
                );
		echo form_label('Select Duration of Purchase','laptop_age');
		echo form_dropdown('laptop_age', $options, '1-2yr');
		echo "<br />";
		$options = array(
                  'flawless'  => 'Near Flawless - Minor scratches/wear',
                  'avg'    => 'Good working condition - Some scratches',
                  'serious'   => 'Below average working - Severe wear',
                );
		echo form_label('Select Condition of product','laptop_condition');
		echo form_dropdown('laptop_condition', $options, 'avg');
		echo "<br />";
	
	 	echo form_label('Serial Number','lap_serial');
		echo form_input('laptop_serial', set_value('laptop_serial', 'Enter serial number:'));	
		?>
	 	</div>
	 	
	 	<div id = "cellphone_details" style="visibility:visible; display:none" >
	 		<?php
		 
		echo form_fieldset('Functional Condition');
		echo form_checkbox('phn_switch_on', 'phn_switch_on', FALSE);
		echo form_label('Phone switches on?','phn_switch_on');
		echo "<br />";
		echo form_checkbox('touch_working', 'touch_working', FALSE);
		echo form_label('TouchScreen/NumPad is working?','touch_working');
		echo "<br />";
		echo form_checkbox('charging_defect', 'charging_defect', FALSE);
		echo form_label('Any Charging defect?','charging_defect');
		echo "<br />";
		echo form_checkbox('battery_working', 'battery_working', FALSE);
		echo form_label('Battery is working?','battery_working');
		echo "<br />";
		echo form_checkbox('camera_working', 'camera_working', FALSE);
		echo form_label('Camera is working?','camera_working');
		echo form_fieldset_close();
		echo form_fieldset('Accessories Included');
		echo form_checkbox('phone_charger_included', 'phone_charger_included', FALSE);
		echo form_label('Charger is included?','phone_charger_included');
		echo "<br />";
		echo form_checkbox('phone_bill_included', 'phone_bill_included', FALSE);
		echo form_label('Original Bill is included?','phone_bill_included');
		echo "<br />";
		echo form_checkbox('earphone_included', 'earphone_included', FALSE);
		echo form_label('Earphones included?','earphone_included');
		echo "<br />";
		echo form_checkbox('box_included', 'box_included', FALSE);
		echo form_label('Includes original pakaging','box_included');
		echo "<br />";
		echo form_fieldset_close();
		
		$options = array(
                  '<11mnth'  => 'Less than 11 months',
                  '1-2yr'    => '1 to 2 year',
                  '>2yr'   => 'More than 2 years',
                );
		echo form_label('Select Duration of Purchase','phone_age');
		echo form_dropdown('phone_age', $options, '1-2yr');
		echo "<br />";
		$options = array(
                  'flawless'  => 'Near Flawless - Minor scratches/wear',
                  'avg'    => 'Good working condition - Some scratches',
                  'serious'   => 'Below average working - Severe wear',
                );
		echo form_label('Select Condition of product','phone_condition');
		echo form_dropdown('phone_condition', $options, 'avg');
		echo "<br />";
		echo form_label('IMEI Number','imei');
		echo form_input('imei', set_value('imei', 'Enter IMEI number:'));
		
		
		?>
	 		
	 	</div>
	 	</div>
	 	<?php
	 	echo form_label('Product Condition','p_condition'); 
		echo form_input('condition', set_value('condition', 'Rate the condition of your product out of 10'));
		echo form_label('Listing Price','p_price');
		echo form_input('ask_price', set_value('condition', 'Enter your asking price'));
		
		//echo form_close();?>
	  
	
	 	
	 	<!-- <?php
	 	
		$attributes_upload = array('id' => 'furniture_form');
		echo form_open('seller_acc/upload_furniture',$attributes_upload);
		echo form_input('productname', set_value('productname', 'furniture'));
		echo form_input('condition', set_value('condition', 'ffffff'));
		echo form_close();	
		$attributes_upload = array('id' => 'laptop_form');
		echo form_open('seller_acc/upload_laptop',$attributes_upload);
		echo form_input('productname', set_value('productname', 'laptop'));
		echo form_input('condition', set_value('condition', 'llll'));
		echo form_close();
		$attributes_upload = array('id' => 'mobile_form');
		echo form_open('seller_acc/upload_mobile',$attributes_upload);
		echo form_input('productname', set_value('productname', 'mobile'));
		echo form_input('condition', set_value('condition', 'mmmm'));
		echo form_close();
		 
	
		?> -->
		</div>
		<?php
		echo form_fieldset('Warranty Provided?');
		echo form_label('Yes','has_warranty');
		echo form_radio('warranty_check','4',TRUE);
		echo form_label('No','has_warranty');
		echo form_radio('warranty_check','5',FALSE);
		echo form_fieldset_close();
		
		echo "<br />";//br();
		//echo form_submit('upload', 'Upload Product');
		
		//echo form_input('file_upload',set_value('file_upload'));
		
		//echo form_label('Choose Images','image');
		//echo "<input type='file' name='userfile' size='20' />"; 
		echo "<br />";
		echo "<br />";
        echo "<input type='submit' name='submit' value='Proceed to next step.'/> ";
		echo anchor('seller_acc','Cancel');	
		echo form_close();
		
		
		?>
		<?php echo validation_errors('<p class="error">'); ?>
</div> 
</div>
