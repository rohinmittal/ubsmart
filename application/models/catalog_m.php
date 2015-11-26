<?php

class Catalog_m extends CI_Model {
	function fetch_results($search_term,$limit,$offset,$sort_by,$sort_order,$filter) {
		
		$sort_order = ($sort_order=='desc') ? 'desc':'asc';
		$sort_col=array ('price','tier');
		$sort_by=(in_array($sort_by, $sort_col)) ? $sort_by : 'price';
				
		$sq=$search_term;
		$sq=trim($sq);
		$sq=preg_replace("!\s+!"," ", $sq);
		//$search_terms = explode(" ", $sq);    //supposed to be used for more sophisticated searching
		
		$len=strlen($filter);
		if((1 <= $len) && ($len <= 5))
		{
			if (preg_match('/[^abcde]/', $filter))
 				{$filter='abcde';}
		}
		else {
			$filter='abcde';
		}		
		$filter_by = str_split($filter);
		$filter_by = implode("','", $filter_by);
		$filter_by = "'".$filter_by."'";
		
		//$query = $this->db->query($q);
		$condn="is_sold = 0 AND tier IN (".$filter_by.") AND (pname LIKE '%" . $sq  ."%')";
		if($sort_by=='tier')
		{
			$sort_order = ($sort_order=='desc') ? 'asc':'desc';
		}	
		$q=$this->db->from('products')->where($condn)->limit($limit,$offset)->order_by($sort_by,$sort_order);
		//print_r($condn);
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
