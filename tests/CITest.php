<?php
class CITest extends PHPUnit_Framework_TestCase
{
    private $CI;
    public function setUp()
    {
	// Load CI instance normally
	$this->CI = &get_instance();
    $this->CI->load->database('ubsmart');
    $this->CI->load->model('membership_model');

    }
    public function testEmailExists()
    {
        // check if email exists returns false, if the id exists in database
        $posts = $this->CI->membership_model->check_if_email_exists('rohinmit@buffalo.edu');
        $this->assertEquals(FALSE, $posts);
    }
    
    /**
    * @covers Membership_model::check_if_email_exists
    */
    public function testEmailDoesntExists()
    {
        // check if email exists returns false, if the id exists in database else it returns true
        $posts = $this->CI->membership_model->check_if_email_exists('ubsmart@buffalo.edu');
        $this->assertEquals(TRUE, $posts);
    }
    
    public function testCorrectLoginCredentials()
    {
        // check if login credentials are correct
        $posts = $this->CI->membership_model->validate('vsinha', md5('qwertyuiop'), 'b');
        $this->assertEquals(TRUE, $posts);
    }
    
    public function testIncorrectLoginCredentials()
    {
        // check if login credentials are incorrect
        $posts = $this->CI->membership_model->validate('vsinha', md5('12345'), 'b');
        $this->assertEquals(FALSE, $posts);
    }
    
    public function testBoughtHistory1()
    {
        $data = $this->CI->membership_model->boughtHistory('vsinha');
        $this->assertEquals(0, $data->num_rows());
    }
    
    public function testBoughtHistory2()
    {
        $data = $this->CI->membership_model->boughtHistory('ajay');
        $this->assertEquals(1, $data->num_rows());
    }
    
    
    /* Controller Test cases */
    
    /**
    * @covers Home::check_if_positive
    */         
    public function testCheckIfPositive()
    {
        $data = $this->CI->check_if_positive('-2');
        $this->assertEquals(FALSE, $data);
    }
    
    /**
    * @covers Home::check_if_blank_usrname
    */
    public function testCheckIfBlankUsrname()
    {
        /* returns true if username isn't blank */
        $data = $this->CI->check_if_blank_usrname('Username');
        $this->assertEquals(FALSE, $data);
    }
    
    /**
    * @covers Home::check_if_email_ub
    */
    public function testCheckIfEmailUB()
    {
        /* returns true if username isn't blank */
        $data = $this->CI->check_if_email_ub('rohinmit@buffalo.com');
        $this->assertEquals(FALSE, $data);
    }
    
    /**
    * @covers Home::check_if_blank_tel
    */
    public function testCheckIfBlankTel()
    {
        /* returns false if tel is blank */
        $data = $this->CI->check_if_blank_tel('rohinmit@buffalo.edu');
        $this->assertEquals(TRUE, $data);
    }
    
    /**
    * @covers Home::check_if_blank_email
    */
    public function testCheckIfBlankEmail()
    {
        /* returns false if email is blank */
        $data = $this->CI->check_if_blank_email('Email Address');
        $this->assertEquals(FALSE, $data);
    }
}
