
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class myaccount extends CI_Controller {

	public function index()
	{
		$this->load->model('membership_model');
		$result = $this->membership_model->retreiveUserDetails();
		$data=array();
		$data['vwBalance'] = $result->vw_balance;
		$data['username'] = $result->username;

		// now find the pending handovers count
		$data['handoverCount'] = $this->membership_model->countBuyerPendingHandovers()->num_rows();
					
		$this->load->view('includes/header_loggedin');
		$this->load->view('myaccount/myaccount_v', $data);
		$this->load->view('includes/footer');
	}
	
	public function boughtHistory($newOrder=0) {
		$this->load->model('membership_model');
		$data['query_result'] = $this->membership_model->boughtHistory($this->session->userdata('username'));
		
		$this->load->view('includes/header_loggedin');
		
		if ($data['query_result']->num_rows() > 0) {
			if($newOrder == 1) {
				$data['newOrder'] = 1;
			}
			$this->load->view('myaccount/boughtHistory_v', $data);
		}
		else {
			// no product bought
			$this->load->view('myaccount/boughtHistory_v');
		}
		
		$this->load->view('includes/footer');
	}
	
	public function confirmHandover() {
		$this->load->model('membership_model');
		$this->membership_model->updateBuyersHandover();
		redirect('myaccount/boughtHistory');
	}
	
	public function getCurrentPassword() {
		$this->load->view('includes/header_loggedin');
		$this->load->view('myaccount/getCurrentPassword_v');
		$this->load->view('includes/footer');
	}

	public function validateCurrentPassword()
	{	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('current_password', 'Password', 'trim|required|callback_check_if_blank_password');
		
		if ($this->form_validation->run() == FALSE) // didn't validate
		{ 
         $this->load->view('includes/header_loggedin');
         $this->load->view('myaccount/getCurrentPassword_v');
         $this->load->view('includes/footer'); 
        } 
        else
        {	
			$this->load->model('membership_model');
			$query = $this->membership_model->check_password($this->session->userdata('username'), md5($this->input->post('current_password')));
			if($query) {
				//password validated.
				redirect('myaccount/getNewDetails');		
			}
			else {
				$data['incorrect_password']='Incorrect password. Please enter your correct password.<br>';
				$this->load->view('includes/header_loggedin');
				$this->load->view('myaccount/getCurrentPassword_v', $data);         
				$this->load->view('includes/footer'); 
			}
	    }
	}
	
	
			
	public function getNewDetails() {
		$this->load->view('includes/header_loggedin');
		$this->load->view('myaccount/updateDetails_v');
		$this->load->view('includes/footer');
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
			if($this->session->userdata('logintype')=='buyer')
			{
			redirect('myaccount');		}
			else
			{
				redirect('seller_acc');
			}
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
		if ($this->form_validation->run() == FALSE) // didn't validate
		{ 
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
		return true;
	}
}
?>
