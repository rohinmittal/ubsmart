
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class myaccount extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('includes/header_loggedin');
		$this->load->view('myaccount/myaccount_v');
		$this->load->view('includes/footer');
	}
	
	public function getPassword() {
		$this->load->view('includes/header_loggedin');
		$this->load->view('myaccount/getPassword_v');
		$this->load->view('includes/footer');
	}
	
	public function getNewDetails() {
		$this->load->view('includes/header_loggedin');
		$this->load->view('myaccount/updateDetails_v');
		$this->load->view('includes/footer');
	}
	
	public function validatePassword()
	{	
		$this->load->library('form_validation');
		
		//rules
		$this->form_validation->set_rules('current_password', 'Password', 'trim|required|callback_check_if_blank_password');
		
		if ($this->form_validation->run() == FALSE) // didn't validate
		{ 
         $this->load->view('includes/header_loggedin');
         $this->load->view('myaccount/getPassword_v');
         $this->load->view('includes/footer'); 
        } 
        else
        {	
			$this->load->model('membership_model');
			$this->membership_model->check_password();
			redirect('myaccount/getNewDetails');		
	    }
	}
	
	public function updateDetails() {
		$this->load->library('form_validation');
		
		//rules		
		$this->form_validation->set_rules('newPassword', 'Password', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('confirmPassword', 'Password Confirmation', 'trim|required|matches[newPassword]');

		if ($this->form_validation->run() == FALSE) // didn't validate
		{ 
         $this->load->view('includes/header_loggedin');
         $this->load->view('myaccount/updateDetails_v');
         $this->load->view('includes/footer'); 
        } 
        else
        {	
			$this->load->model('membership_model');
			$this->membership_model->updateDetails();
			redirect('myaccount');		
	    }	
	}
	
	function check_if_blank_password($password)
    {
    	$pwd = strcmp($password,"Username");
		$password_entered=TRUE;
        if($pwd == 0)
		{
			$password_entered = FALSE;
		}
        return $password_entered;
	} 
}
?>
