<?php

class Membership_model extends CI_Model {
	function validate() {
		$this->db->where('username', $this->input->post('username'));
		$this->db->where('password', md5($this->input->post('password')));
		if($this->input->post('login_type')=='s')
		{
			$this->db->where('is_seller', 1);
		}
		if($this->input->post('login_type')=='b')
		{
			$this->db->where('is_buyer', 1);
		}
		$query = $this->db->get('users');
		
		if($query->num_rows() == 1) {
			 return true;
		}
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
} 
