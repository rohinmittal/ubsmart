<?php

class Catalog_m extends CI_Model {
	function fetch_results($search_term,$limit,$offset,$sort_by,$sort_order) {
		
		$sort_order = ($sort_order=='desc') ? 'desc':'asc';
		$sort_col=array ('price','tier');
		$sort_by=(in_array($sort_by, $sort_col)) ? $sort_by : 'price';
				
		$sq=$search_term;
		$sq=trim($sq);
		$sq=preg_replace("!\s+!"," ", $sq);
		//$search_terms = explode(" ", $sq);    //supposed to be used for more sophisticated searching
		
		//$query = $this->db->query($q);
		$condn="is_sold = 0 AND (pname LIKE '%" . $sq  ."%')";	
		$q=$this->db->from('products')->where($condn)->limit($limit,$offset)->order_by($sort_by,$sort_order);
		$query = $q->get();
		
		//for count
		$q2=$this->db->select('COUNT(*) as count', FALSE)->from('products')->where($condn);
		$tmp=$q2->get()->result();
		$found_res=$tmp[0]->count;
		
		$ret['query']=$query;
		$ret['num_rows']=$found_res;
				
		if ($found_res > 0)
		{
			$ret['query']=$query;
			$ret['num_rows']=$found_res;	
			return $ret;
   		
		}
		else {
			$ret['query']=NULL;
			return $ret;
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