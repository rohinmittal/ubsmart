<?php
class homepage extends CI_Controller {

// to access homepage/view
    public function index()
    {
	$this->load->library('form_validation');

	$data['title'] = ucfirst('navigation bar'); // Capitalize the first letter
	$data['path'] = 'home';

	$data['login'] = ('../login');
	$data['signup'] = ('../signup');
	$this->load->view('templates/header', $data);
	$this->load->view('homepage/homepage', $data);

	$this->load->view('templates/footer', $data);
    }
}
