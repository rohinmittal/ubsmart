
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
		$this->load->model('membership_model');
		$query = $this->membership_model->retreiveUserDetails();
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data['vwBalance'] = $row->vw_balance;
				$data['username'] = $row->username;
			}
		}
		$this->load->view('includes/header_loggedin');
		$this->load->view('myaccount/myaccount_v', $data);
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
			$query = $this->membership_model->check_password();
			if($query) {
				//password validated.
				redirect('myaccount/getNewDetails');		
			}
			else {
				$data['incorrect_password']='Incorrect password. Please enter your correct password.<br>';
				$this->load->view('includes/header_loggedin');
				$this->load->view('myaccount/getPassword_v', $data);         
				$this->load->view('includes/footer'); 
			}
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
	
	function topupVWBalance() {
		$expiry['monthOptions'] = array(
			'January' => 'Jan',
			'February' => 'Feb',
			'March' => 'Mar',	
			'Arpil' => 'Apr',
			'May' => 'May',
			'June' => 'Jun',
			'July' => 'Jul',
			'August' => 'Aug',
			'September' => 'Sep',
			'October' => 'Oct',
			'November' => 'Nov',
			'December' => 'Dec',		
		);
		$expiry['yearOptions'] = array(
			'2015' => '2015',
			'2016' => '2016',
			'2017' => '2017',
			'2018' => '2018',
			'2019' => '2019',
			'2020' => '2020',
			'2021' => '2021',
			'2022' => '2022',
			'2023' => '2023',
			'2024' => '2024',
			'2025' => '2025',			
			
		);
		$this->load->view('includes/header_loggedin');
		$this->load->view('myaccount/topupVWBalance_v', $expiry);
		$this->load->view('includes/footer');
	}
	
	function validateCreditCardDetails() {
		$this->load->library('form_validation');
		//rules		
		$this->form_validation->set_rules('cardnumber', 'Card Number', 'trim|required|exact_length[16]|integer');
		$this->form_validation->set_rules('amount', 'Amount', 'trim|required|integer|callback_check_if_positive_amount');
		if ($this->form_validation->run() == FALSE) // didn't validate
		{ 
			$expiry['monthOptions'] = array(
			'January' => 'Jan',
			'February' => 'Feb',
			'March' => 'Mar',	
			'Arpil' => 'Apr',
			'May' => 'May',
			'June' => 'Jun',
			'July' => 'Jul',
			'August' => 'Aug',
			'September' => 'Sep',
			'October' => 'Oct',
			'November' => 'Nov',
			'December' => 'Dec',		
		);
		$expiry['yearOptions'] = array(	
			'2015' => '2015',
			'2016' => '2016',
			'2017' => '2017',
			'2018' => '2018',
			'2019' => '2019',
			'2020' => '2020',
			'2021' => '2021',
			'2022' => '2022',
			'2023' => '2023',
			'2024' => '2024',
			'2025' => '2025',			
			
		);
         $this->load->view('includes/header_loggedin');
         $this->load->view('myaccount/topupVWBalance_v', $expiry);
         $this->load->view('includes/footer'); 
        } 
        else
        {
			$this->load->model('membership_model');
			$this->membership_model->topupVW();
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
	
	function check_if_positive_amount($amount)
    {
        if($amount < 0)
		{
			return false;
		}
		return false;
	}
}
?>
