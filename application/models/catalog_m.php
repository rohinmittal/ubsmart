<?php

class Catalog_m extends CI_Model {
	function fetch_results() {
		
		$sq=$this->input->post('search_query');
		$sq=trim($sq);
		$sq=preg_replace("!\s+!"," ", $sq);
		$search_terms = explode(" ", $sq);
		
		$q="SELECT * FROM products WHERE  is_sold = 0 AND (pname LIKE '%" . $sq  ."%')";
		
		$query = $this->db->query($q);
		if ($query->num_rows() > 0)
		{
			return $query;
   		/*	foreach ($query->result() as $row)
   			{
      			echo $row->pname;
      			//echo $row->name;
      			//echo $row->body;
   			}*/
		}
		else {
			return NULL;
		}
		
	}
	/*
	function check_password() {
		$this->db->where('username', $this->session->userdata('username'));
		$this->db->where('password', md5($this->input->post('current_password')));

		$query = $this->db->get('users');
		
		if($query->num_rows() == 1) {
			return true;
		}
		return false;
	}
	
	
	
	function check_if_email_exists($email)
	{
		$this->db->where('email', $email);
		$result = $this->db->get('users');
		if ($result->num_rows() > 0)
		 { return FALSE;}
		else
		 { return TRUE; }
	}*/
} 
