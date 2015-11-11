<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$this->home1();//load->view('welcome_message');
	}
	public function home1()
	{
		//trying changes
		$data['title']='Welcome to UBsMart!';
		$this->load->view('includes/header');
		$this->load->view('home_view',$data);
		$this->load->view('includes/footer');				
	}
}
