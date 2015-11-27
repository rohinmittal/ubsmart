<?php

class product_upload_model extends CI_Model {
	
	function upload_details($user_img=array()) {
		//$data['users'] = $this->db->query('SELECT username, email, telephone, vw_balance from users where username=' );
 		//$this->db->select('username');
 		//$this->db->where('username',$this->session->userdata('username'));
		//$data['users'] = $this->db->get('users');
		$conn = mysqli_connect("127.0.0.1", "ubsmart", "CVsxu2ENzhVbeMm9", "ubsmart");
		if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
		$sellername = $this->session->userdata('username');
		$askprice = $this->input->post('ask_price'); //to be changed
		
		$productname = $this->input->post('p_name');
	    echo $user_img[0];;
		$category = $this->input->post('p_category');
		$sub_cat = $this->input->post('p_subcategory');
		$condition = 10;
		$tier = $this->input->post('p_tier'); 
		$p_desc = $this->input->post('p_desc'); 
		$smart_price = $this->input->post('p_smart_price');//calculation of the updated smart price
		$data = array($sellername,NULL,$askprice,$productname,0,$category,$sub_cat,$condition,$tier,$smart_price);
		$sql = "INSERT INTO products(seller,price,pname,is_sold,category,subcategory,p_condition,is_sowner,tier,smart_price,p_desc) VALUES ('".$sellername."','".$askprice."','".$productname."','0','".$category."','".$sub_cat."','".$condition."','1','".$tier."','".$smart_price."','".$p_desc."')";
		//$this->db->insert('products',$data); 	
	    $this->db->query($sql);
		
		$sql1 = "SELECT MAX(product_id) from products WHERE seller= '".$sellername."'";
		$query = $this->db->query($sql1);
		$data = $query->result_array();
		
        $pid = ($data[0]['MAX(product_id)']);
	    //foreach ($query->result() as $row)
		//{
			//echo $row->smart_price;
		// $pid = $row->'MAX(product_id)';	
			//echo "<br />";
   		//}
	
		return $pid;
    
	}

	function upload_img_details($data=array())	
	{
	
		$sql = "UPDATE `products` SET `pic1`= '".$data['user_img1_path']."', `pic2`= '".$data['user_img2_path']."',`pic3`= '".$data['user_img3_path']."' WHERE product_id = ".$data['pid']." ";
		$query = $this->db->query($sql);
	
	}
	
	function evaluate_smart_price($data=array()){ //NOTE: till now the users product has not been  uploaded into the database
		//$this->db->select('username');
 		//$this->db->where('username',$this->session->userdata('username'));
		//$data['users'] = $this->db->get('users');
		$current_smart_price=0;
		$prod_tier=$data['p_tier'];
		$category=$data['p_category'];
		//$subcat=$data['sub_cat'];
		$this->db->select('smart_price');
		$this->db->where('category',$category);
		$this->db->where('subcategory',$category);
		$this->db->where('tier',$prod_tier);
		$query = $this->db->get('products',1);
		if($query->num_rows()){
		foreach ($query->result() as $row)
		{
			//echo $row->smart_price;
			 $current_smart_price =  $row->smart_price;	
			//echo "<br />";
   		}
		//$current_smart_price = $current_smart_price/($query->num_rows());
		}
		else   $current_smart_price=0;
	//	echo "<br />";
	//	echo "<br />";
    //	echo $current_smart_price;
		return $current_smart_price;
	}
	function fetch_seller_prod()
	{
		$sellername = $this->session->userdata('username');
		$this->db->select('pname, product_id, price, category, subcategory, is_sold');
		$this->db->where('seller',$sellername);
		$data['seller_prods'] = $this->db->get('products');
		return $data;		
	}
	function edit_seller_prod()
	{
		$pid = $this->input->post('product_id');
		$p_name = $this->input->post('product_name');
		$p_price = $this->input->post('product_price');
		$p_desc = $this->input->post('product_desc');
		
		$sql = "UPDATE `products` SET `pname`= '".$p_name."', `price`= '".$p_price."',`p_desc`= '".$p_desc."' WHERE product_id = ".$pid." ";
		$query = $this->db->query($sql);
	}
	function del_seller_prod()
	{
		$pid = $this->input->post('product_id');
		$sql = "DELETE FROM `products` WHERE `product_id` = ".$pid." ";
		$query = $this->db->query($sql);
		
	}
	
	

} 
