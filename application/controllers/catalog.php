<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catalog extends CI_Controller {

	public function index()
	{			
		$this->home1();//load->view('welcome_message');
	}
	public function home1()
	{
		//trying changes
		//$data['title']='Welcome to UBsMart!';
		$data['searchval'] ="no_search_query";
		$this->load->view('includes/header_loggedin');
		$this->load->view('catalog_v',$data);
		$this->load->view('includes/footer');
		print_r($this->session->userdata());//temporary. Feel free to remove once development of seller only/buyer only pages gets going!				
	}
	public function execute_search()
	{
		$data['searchval'] =$_POST['search_query'];
		$this->load->view('includes/header_loggedin');
		$this->load->view('catalog_v',$data);
		$this->load->view('includes/footer');
		
	}
	
}
