<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
		$this->load->view('includes/header');
		$this->load->view('login_form');
		$this->load->view('includes/footer');
	}
	
	public function signup()
	{
		$this->load->view('includes/header');
		$this->load->view('signup_form');
		$this->load->view('includes/footer');
	}

	public function logout()
	{
	    $this->session->sess_destroy();
	    $this->index();
	}

	public function validate_credentials()
	{
		$this->load->library('form_validation');
		
		//rules
		$this->form_validation->set_rules('username', 'Username', 'trim|required|callback_check_if_blank_usrname');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('login_type', 'login_type', 'callback_check_if_signintype_chosen');
		
		if ($this->form_validation->run() == FALSE) // didn't validate
		{ 
         $this->load->view('includes/header');
         $this->load->view('login_form');
         $this->load->view('includes/footer'); 
		 //just checking for issues with git
        } 
        else
        {	
			$this->load->model('membership_model');
			$query=$this->membership_model->validate();
			if($query)//credentials validated!
			{
		     //echo "<script type='text/javascript'>alert('login successful!')</script>";
			 $lt='buyer';
			 if($this->input->post('login_type')=='s')
		     {$lt='seller';}		     			 
			 $data=array(
			      'username'=>$this->input->post('username'),
			      'is_logged_in'=>true,
			      'logintype'=>$lt
			 );
			 $this->session->set_userdata($data);
			 //print_r($_POST);
			 if($lt=='buyer')
			  {redirect('catalog');}
			 else
			  {redirect('seller_info');}	//seller_info is to be created by Suramrit	
		    }
	    	else
		    {
			 echo "<script type='text/javascript'>alert('Incorrect credentials!')</script>";
			 $this->index();
		    }
	    }
	}
	

    function create_member()
	{
		$this->load->library('form_validation');
		
		//rules		
		$this->form_validation->set_rules('email', 'Email Address', 'trim|required|callback_check_if_blank_email|valid_email|callback_check_if_email_ub|callback_check_if_email_exists');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|callback_check_if_blank_usrname|callback_check_if_username_exists');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'trim|required|matches[password]');
		$this->form_validation->set_rules('roles[]', 'roles', 'callback_check_if_role_chosen'); 
		$this->form_validation->set_rules('telephone', 'Cellphone Number', 'trim|required|callback_check_if_blank_tel|exact_length[10]|integer|callback_check_if_positive');

		if ($this->form_validation->run() == FALSE) // didn't validate
		{ 
          $this->load->view('includes/header');
          $this->load->view('signup_form');
          $this->load->view('includes/footer'); 
        } 
        else
        {
          $this->load->model('membership_model');
		  
		  if ($query=$this->membership_model->create_member())
		  {
			$this->sendVerificationEmail($this->input->post('email'));
		  	$data['account_created']='Your account has been created.<br/><br/>You may now login.';
			
			$this->load->view('includes/header');
            $this->load->view('login_form',$data);
            $this->load->view('includes/footer');
			//print_r($this->session->userdata());
		  }
		  else
		  {
			$this->load->view('includes/header');
            $this->load->view('signup_form');
            $this->load->view('includes/footer');   
		  } 
		}
	}       

    function check_if_username_exists($requested_username)
    {      
      $this->load->model('membership_model');
	  
      $username_available = $this->membership_model->check_if_username_exists($requested_username); 
      if ($username_available) { return TRUE; } else { return FALSE; }
	}
	
	function check_if_email_exists($requested_email)
    {      
      $this->load->model('membership_model');
	  
      $email_available = $this->membership_model->check_if_email_exists($requested_email); 
      if ($email_available) { return TRUE; } else { return FALSE; }
	}
	
	function check_if_email_ub($requested_email)
    {      
      //$this->load->model('membership_model');
	  list($eid, $dom) = explode("@", $requested_email);
	  $dom=strcasecmp($dom,"buffalo.edu");
      if($dom==0)
       {$email_is_ub = TRUE;}
      else 
       {$email_is_ub = FALSE;}       
      if ($email_is_ub) { return TRUE; } else { return FALSE; }
	}
    function check_if_signintype_chosen($login_type)
    {
      $lt_chosen=FALSE;
	  if(isset($_POST['login_type']))
	  {    $lt_chosen=TRUE;     }       
      if ($lt_chosen) { return TRUE; } else { return FALSE; }    	
	}
	function check_if_role_chosen($roles)
    {
      $role_chosen=TRUE;
	  $rolevals=$_POST['roles'];      
      if($rolevals[0]==NULL and $rolevals[1]==NULL)
	  {    $role_chosen=FALSE;     }       
      if ($role_chosen) { return TRUE; } else { return FALSE; }
	}
	function check_if_blank_usrname($username)
    {
    	$usr=strcmp($username,"Username");
		$usrname_entered=TRUE;
        if($usr==0)
		{
			$usrname_entered=FALSE;
		}
        return $usrname_entered;
	}
	function check_if_blank_email($email)
    {
    	$em=strcmp($email,"Email Address");
		$em_entered=TRUE;
        if($em==0)
		{
			$em_entered=FALSE;
		}
        return $em_entered;
	}
	function check_if_blank_tel($tel)
    {
    	$tcomp=strcmp($tel,"Cellphone Number");
		$tel_entered=TRUE;
        if($tcomp==0)
		{
			$tel_entered=FALSE;
		}
        return $tel_entered;
	}
	function check_if_positive($tel)
    {
    	$tcomp=$tel[0];
		$tel_positive=TRUE;
        if($tcomp=='-')
		{
			$tel_positive=FALSE;
		}
        return $tel_positive;
	}
	
	function sendVerificationEmail($email) {
		$this->load->library('email');
		$config['protocol']    = 'smtp';
		$config['smtp_host']    = 'ssl://smtp.gmail.com';
		$config['smtp_port']    = '465';
		$config['smtp_timeout'] = '7';
		$config['smtp_user']    = 'ubsmart.ub@gmail.com';
		$config['smtp_pass']    = '<password>';
		$config['charset']    = 'utf-8';
		$config['newline']    = "\r\n";
		$config['mailtype'] = 'html';
		$config['validation'] = TRUE; // bool whether to validate email or not      
		$this->email->initialize($config);

		$this->email->from('ubsmart.ub@gmail.com', 'Team UBsMart');
		$this->email->to($email);
		$this->email->subject('Thank you for registering at UBsmart!');
		$this->email->message('Thank you!<br>Welcome to UBsMart. We hope you\'ll like our platform.');
		$this->email->send();
	}
}
?>
