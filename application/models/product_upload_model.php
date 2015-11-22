<?php

class product_upload_model extends CI_Model {
	
	function upload_details() {
		//$data['users'] = $this->db->query('SELECT username, email, telephone, vw_balance from users where username=' );
 		//$this->db->select('username');
 		//$this->db->where('username',$this->session->userdata('username'));
		//$data['users'] = $this->db->get('users');
		$sellername = $this->session->userdata('username');
		$askprice = $this->input->post('ask_price');
		
		$productname = $this->input->post('productname');
	    
		$category = $this->input->post('categories');
		$sub_cat = $category;
		$condition = $this->input->post('condition');	
		$tier = "a"; //calculation 
		$smart_price = 100; //calculation
		$data = array($sellername,NULL,$askprice,$productname,0,$category,$sub_cat,$condition,$tier,$smart_price);
		$sql = "INSERT INTO products(seller,price,pname,is_sold,category,subcategory,p_condition,is_sowner,tier,smart_price) VALUES ('".$sellername."', '".$askprice."','".$productname."','0','".$category."','".$sub_cat."','".$condition."','1','".$tier."','".$smart_price."')";
		//$this->db->insert('products',$data); 	
	    $this->db->query($sql);
		
    }
	

	
	
	

} 
