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
	    //echo $user_img[0];;
		$category = $this->input->post('p_category');
		$sub_cat = $this->input->post('p_subcategory');
		$condition = 10;
		$tier = $this->input->post('p_tier'); 
		$p_desc = $this->input->post('p_desc'); 
		$p_condition = $this->input->post('p_condition');
		 $is_owner = $this->input->post('is_sowner'); 
		 //echo "here here here";
		 //echo $is_owner;
		 //echo $p_condition;
		$smart_price = $this->input->post('p_smart_price');//calculation of the updated smart price
		$data = array($sellername,NULL,$askprice,$productname,0,$category,$sub_cat,$condition,$tier,$smart_price);
		$sql = "INSERT INTO products(seller,price,pname,is_sold,category,subcategory,p_condition,is_sowner,tier,smart_price,p_desc) VALUES ('".$sellername."','".$askprice."','".$productname."','0','".$category."','".$sub_cat."','".$p_condition."','".$is_owner."','".$tier."','".$smart_price."','".$p_desc."')";
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

	function upload_furn_details($data= array())
	{
		$pid=$data['pid'];
		$dim_l=$data['dim_l'];
		$dim_w=$data['dim_w'];
		$dim_h=$data['dim_h'];
		$dimension = $dim_l.'x'.$dim_w.'x'.$dim_h;
		$material=$data['material'];
		$sql = "INSERT INTO furniture_detail(pid,dimensions,material) VALUES ('".$pid."','".$dimension."','".$material."')";
		//$this->db->insert('products',$data); 	
	    $this->db->query($sql);
	}
	
	function upload_laptop_details($data= array())
	{
		$pid=$data['pid'];
		$serial=$data['serial'];
		$is_charger=$data['is_charger'];
		$sql = "INSERT INTO laptop_detail(pid,is_charger,serial) VALUES ('".$pid."','".$is_charger."','".$serial."')";
		//$this->db->insert('products',$data); 	
	    $this->db->query($sql);
	}
	function upload_cellphone_details($data= array())
	{
		$pid=$data['pid'];
		$imei=$data['imei'];
		$is_charger=$data['is_charger_cell'];
		$is_headset=$data['is_charger_cell'];
		$sql = "INSERT INTO mobile_detail(pid,imei,is_charger,is_headset) VALUES ('".$pid."','".$imei."','".$is_charger."','".$is_headset."')";
		//$this->db->insert('products',$data); 	
	    $this->db->query($sql);
	}
	
	
	function upload_img_details($data=array())	
	{
	
		$sql = "UPDATE `products` SET `pic1`= '".$data['user_img1_path']."', `pic2`= '".$data['user_img2_path']."',`pic3`= '".$data['user_img3_path']."' WHERE product_id = ".$data['pid']." ";
		$query = $this->db->query($sql);
	
	}
	
	function evaluate_smart_price($data=array()){ 
		//$this->db->select('username');
 		//$this->db->where('username',$this->session->userdata('username'));
		//$data['users'] = $this->db->get('users');
		$current_smart_price=0;
		$prod_tier=$data['p_tier'];
		$category=$data['p_category'];
		$subcategory=$data['p_subcategory'];
		//$subcat=$data['sub_cat'];
		$this->db->select('smart_price');
		$this->db->where('category',$category);
		$this->db->where('subcategory',$subcategory);
		$this->db->where('tier',$prod_tier);
		$query = $this->db->get('products',1);
		if($query->num_rows()){
		foreach ($query->result() as $row)
		{
			//echo $row->smart_price;
			 $data['current_smart_price'] =  $row->smart_price;	
			//echo "<br />";
   		}
		//$current_smart_price = $current_smart_price/($query->num_rows());
		}
		else   $current_smart_price=0;
		$sql2 = "SELECT MAX(price) from products WHERE category= '".$category."' AND subcategory = '".$subcategory."' AND tier ='".$prod_tier."'";
		$query2 = $this->db->query($sql2);
		$data2 = $query2->result_array();
		
        $data['max_price'] = ($data2[0]['MAX(price)']);
		
		$sql3 = "SELECT MIN(price) from products WHERE category= '".$category."' AND subcategory = '".$subcategory."' AND tier ='".$prod_tier."'";
		$query3 = $this->db->query($sql3);
		$data3 = $query3->result_array();
		
        $data['min_price'] = ($data3[0]['MIN(price)']);
		//$this->db->select_max();
	//	echo "<br />";
	//	echo "<br />";
    //	echo $current_smart_price;
    // here find the min?max in the same sub category + tier 
    
		return $data;
	}
	function fetch_seller_prod()
	{
		$sellername = $this->session->userdata('username');
		$this->db->select('pname, product_id, price, category, subcategory, is_sold');
		$this->db->where('seller',$sellername);
		$query['allProducts']= $this->db->get('products');
		
		$soldProducts = array();
		foreach ($query['allProducts']->result() as $row)
		{
			if($row->is_sold == '1' || '2') {
				//echo $row->product_id;
				array_push($soldProducts,$row->product_id);
			}
		}
		
		$this->db->select('order_id, buyer_name, buyer_conf, seller_conf,product_id');
		$this->db->where_in('product_id',$soldProducts);
		$query['orders']= $this->db->get('orders');
		return $query;
	}
	function updateSellersHandover()
	{
		$curr_time = time();
		$date = date("Y-m-d H:i:s", $curr_time);
			$this->db->where('order_id', $this->input->post('orderID'));	
		$data = array(
			'seller_conf' => 1 ,
			'scdt' => $date
		);
		$this->db->update('orders', $data);
	
	//now from this orderID, find if buyer_conf and seller_conf both are 1. If yes, fetch the subcategory 
		// and tier of the current product. Update it's smartprice'
		//check implementation for this
		$this->db->where('order_id', $this->input->post('orderID'));
		$orderQuery = $this->db->get('orders');
	
	
	if($orderQuery->row()->buyer_conf == 1 && $orderQuery->row()->seller_conf == 1) {
			
			// since both buyer and seller have confirmed, update is_sold in product table to 2.
			$this->db->where('product_id', $orderQuery->row()->product_id);
			$data = array(
				'is_sold' => 2 
			);
			
			$this->db->update('products', $data);
			
			$this->db->where('product_id', $orderQuery->row()->product_id);
			$productQuery = $this->db->get('products');
			
			$tier = $productQuery->row()->tier;
			$subcategory = $productQuery->row()->subcategory;
			
			$this->db->where('is_sold', 2);
			$this->db->where('tier', $tier);
			$this->db->where('subcategory', $subcategory);
			$soldProductsSameType = $this->db->get('products');
			$totalPrice = 0;
			$count = $soldProductsSameType->num_rows();
			foreach ($soldProductsSameType->result() as $row) {
				$totalPrice = $totalPrice + $row->price;
			} 
			
			$smartPrice = $totalPrice / $count;
			
			$this->db->where('tier', $tier);
			$this->db->where('subcategory', $subcategory);
			$data = array(
				'smart_price' => $smartPrice
			);
			
			$this->db->update('products', $data);
		}
	
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