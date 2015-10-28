<?php
class signup extends CI_Controller {
    public function __construct()
    {
	parent::__construct();
	$this->load->helper(array('form', 'url'));     
    } 

    public function index()
    {
	$this->load->library('form_validation');

	$data['title'] = 'Sign up as a new user!'; 

	$this->form_validation->set_rules('username', 'Username', 'required');
	$this->form_validation->set_rules('password', 'Password', 'required',
		array('required' => 'You must provide a %s.')
		);

	$this->form_validation->set_rules('email', 'Email', 'required',
		array('required' => 'You must provide a %s.')
		);

	if ($this->form_validation->run() === FALSE)
	{
	    $this->load->view('templates/header', $data);
	    $this->load->view('user/signupform');
	    $this->load->view('templates/footer');
	}
	else
	{
	    $this->load->view('user/signupsuccess');
	}
    }
}
