<?php

class Membership_model extends CI_Model {
	function validate($username, $password, $loginType) {
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		if($loginType=='s')
		{
			$this->db->where('is_seller', 1);
		}
		if($loginType=='b')
		{
			$this->db->where('is_buyer', 1);
		}
		$query = $this->db->get('users');
		
		if($query->num_rows() > 0) {
			 return true;
		}
		return false;
	}
	
	function create_member() {
		$username = $this->input->post('username');
		$ro[0]=1;
		$ro[1]=1; 
		if($this->input->post('roles[0]')==NULL)
		{$ro[0]=0;}
		if($this->input->post('roles[1]')==NULL)
		{$ro[1]=0;} 
        $new_member_insert_data = array(
        	'is_buyer' => $ro[0],
        	'is_seller' => $ro[1],
        	'telephone' => $this->input->post('telephone'),
        	'email' => $this->input->post('email'),
        	'username' => $this->input->post('username'),
        	'password' => md5($this->input->post('password')) 
        );
		
		$insert=$this->db->insert('users', $new_member_insert_data);
		return $insert;
    }
	
	function check_password($username, $password) {
		$this->db->where('username', $username);
		$this->db->where('password', $password);

		$query = $this->db->get('users');
		
		if($query->num_rows() == 1) {
			return true;
		}
		return false;
	}
	
	function retreiveUserDetails() {
		$this->db->where('username', $this->session->userdata('username'));
		$query = $this->db->get('users');		
		return $query->row();
	}
	
	function updateDetails() {
		$request = array(
			'password' => md5($this->input->post('newPassword'))	
		);
		$this->db->where('username', $this->session->userdata('username'));
		$this->db->update('users', $request);
	}
	
	function topupVW() {
		$this->db->where('username', $this->session->userdata('username'));
		$query = $this->db->get('users');	
		$old_balance = $query->row()->vw_balance;
		
		$request = array(
			'vw_balance' => ($this->input->post('amount')	+ $old_balance)
		);
		$this->db->where('username', $this->session->userdata('username'));
		$this->db->update('users', $request);
	}
	
	function check_if_username_exists($username)
	{
		$this->db->where('username', $username);
		$result = $this->db->get('users');
		if ($result->num_rows() > 0)
		 { return FALSE;}
		else
		 { return TRUE; }
	}
	
	function check_if_email_exists($email)
	{
		$this->db->where('email', $email);
		$result = $this->db->get('users');
		if ($result->num_rows() > 0)
		 { return FALSE;}
		else
		 { return TRUE; }
	}
	
	function boughtHistory() {
		$this->db->where('buyer_name', $this->session->userdata('username'));

		$query = $this->db->get('orders');
		return $query;
	}
	
	function productDetailsFromProductID($product_id) {
		$this->db->where('product_id', $product_id);

		$query = $this->db->get('products');
		assert($query->num_rows() > 0);
		return $query->row();
	}
	
	function updateBuyersHandover() {
		$this->db->where('order_id', $this->input->post('orderID'));	
		$data = array(
			'buyer_conf' => 1 
		);
		$this->db->update('orders', $data);
		
		//now from this orderID, find if buyer_conf and seller_conf both are 1. If yes, fetch the subcategory 
		// and tier of the current product. Update it's smartprice'
		
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
	
	function countBuyerPendingHandovers() {
		$this->db->where('buyer_name', $this->session->userdata('username'));
		$this->db->where('buyer_conf', 0);	
		$query = $this->db->get('orders');
		return $query;
	}
} 
