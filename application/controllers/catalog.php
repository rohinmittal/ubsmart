<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catalog extends CI_Controller {

	public function index()
	{			
		$this->home1();
	}
	public function home1()
	{
		$data['searchval'] ="no_search_query";
		$data['filter'] ="default";
		
		
		$this->load->model('catalog_m');
		$query_results=$this->catalog_m->fetch_latest_prods();
		$data['resultsForLatestProd']=$query_results;
				
		$this->load->view('includes/header_loggedin');
		$this->load->view('catalog_v',$data);
		$this->load->view('includes/footer');
	}
	public function execute_search($sort_by='price', $sort_order='asc',$filter='abcde', $offset=0)
	{
		$limit=8;
					
		$search_term = 'no_search_query'; // default when no term in session or POST
		if ($this->input->post('search_query'))
		{
    		// use the term from POST and set it to session
    		$search_term = $this->input->post('search_query');
    		$this->session->set_userdata('search_term', $search_term);
		}
		elseif ($this->session->userdata('search_term'))
		{
    		// if term is not in POST use existing term from session
    		$search_term = $this->session->userdata('search_term');
		}
		
		$data['searchval']=$search_term;	
		
		$this->load->model('catalog_m');
		$query_results=$this->catalog_m->fetch_results($search_term,$limit,$offset,$sort_by,$sort_order,$filter);
		$data['results']=$query_results['query'];
		$data['results_num']=$query_results['num_rows'];
		 
		//pagination		
		$this->load->library('pagination');
		$conf = array();
		$conf['base_url']=base_url("catalog/execute_search/$sort_by/$sort_order/$filter");
		if($data['results']!=NULL)
		{
			$conf['total_rows']=$data['results_num'];
		}
		$conf['per_page']=$limit;
		$conf['uri_segment']=6;
		$this->pagination->initialize($conf);
		$data['pagination']=$this->pagination->create_links();
		
		$data['sort_by']=$sort_by; 
 		$data['sort_order']=$sort_order;
		$data['filter']=$filter;
		
		$this->load->view('includes/header_loggedin');
		$this->load->view('catalog_v',$data);
		$this->load->view('includes/footer');
			
	}
	
	public function product_display($id)
	{
	  $this->load->model('catalog_m');
	  $query=$this->catalog_m->fetch_prod_details($id);
	  $data['prod_details']=$query['prod_details'];
	  $data['minSP']=$query['minSP'];
	  $data['maxSP']=$query['maxSP'];
	  $data['add_details']=$query['specific_details'];
	  	  
	  //print_r($query['q1']);
	  //echo nl2br("\n\n");
	  //print_r($query['prod_details']);
	  if($this->session->flashdata('order_not_placed')=='no')
		{
		$data['order_placed']='no';	
		}	  
	  
	  $this->load->view('includes/header_loggedin');
	  $this->load->view('product_display_v',$data);
	  $this->load->view('includes/footer');
	}
	public function product_buy($pid,$price)
	{
	  $this->load->model('catalog_m');
	  $query=$this->catalog_m->order_product($pid,$price);
	  
	  if($query==TRUE)
	  {
	  	$newOrder=1;
	  	redirect('myaccount/boughtHistory/'.$newOrder);
	  }
	  else
	  {    
		$this->session->set_flashdata('order_not_placed','no');
		redirect('catalog/product_display/'.$pid);
	  }		
	}
}