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
		if($sq=="Cellphones" || $sq=="Laptops" || $sq=="Tables" || $sq=="Chairs")
		{
			$condn="is_sold = 0 AND tier IN (".$filter_by.") AND (subcategory ='" . $sq  ."')";
		}
		else 
		{
			$condn="is_sold = 0 AND tier IN (".$filter_by.") AND (pname LIKE '%" . $sq  ."%')";
		}
		
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
	
	function fetch_latest_prods() {
		
		$q=$this->db->from('products')->where('is_sold = 0')->limit(5)->order_by('product_id','desc');
		$query = $q->get()->result();
				
		return $query;
	}
		
	function fetch_prod_details($pid)
	{
		$q=$this->db->from('products')->where('is_sold = 0 AND product_id = '.$pid);
		$query = $q->get();
		//$ret['q1']=$q;
		$ret['prod_details']=$query;
		$table='';
		$query=$query->result();
		
		
		$q11 = $this->db->query('SELECT MIN(price) as minsp FROM products WHERE is_sold = 2 AND tier=\''.$query[0]->tier.'\' AND subcategory=\''.$query[0]->subcategory.'\';');
		$q11=$q11->result();
		if($q11[0]->minsp != NULL)
		{
			
			$ret['minSP']=$q11[0]->minsp;
		}
		else
		{
			$ret['minSP']="Not Available";				
		}
		$q12 = $this->db->query('SELECT MAX(price) as maxsp FROM products WHERE is_sold = 2 AND tier=\''.$query[0]->tier.'\' AND subcategory=\''.$query[0]->subcategory.'\';');
		$q12=$q12->result();
		if($q12[0]->maxsp != NULL)
		{
			
			$ret['maxSP']=$q12[0]->maxsp;
		}
		else
		{
			$ret['maxSP']="Not Available";				
		}	
		
		switch ($query[0]->subcategory)
		{
			case "Cellphones":
				$table='mobile_detail';
				break;
			case "Laptops":
				$table='laptop_detail';
				break;
			case "Tables":
			case "Chairs":
				$table='furniture_detail';
				break;
		}
		
		$q2=$this->db->from($table)->where('pid = '.$pid);
		$query2 = $q2->get();
		$ret['specific_details']=$query2;
		
		return $ret;
	}
	
	function order_product($pid,$price)
	{
		$un=$this->session->userdata('username');
		$this->db->where('username', $un);
		$q1 = $this->db->get('users')->result();
		if($q1[0]->vw_balance >= $price)
		{
			$timestamp = time();
			$curr_date=date("Y-m-d", $timestamp);
			$new_order_insert_data = array(
        	'buyer_name' => $this->session->userdata('username'),
        	'product_id' => $pid,
        	'order_date' => $curr_date
			);
			$insert=$this->db->insert('orders', $new_order_insert_data);
			$query1 = $this->db->query('UPDATE products SET is_sold = 1 WHERE product_id = '.$pid.';');
			$query2 = $this->db->query('UPDATE users SET vw_balance = vw_balance-'.$price.' WHERE username = \''.$un.'\';');			
			return $insert;
		}
		else
			return FALSE;
	}	
}