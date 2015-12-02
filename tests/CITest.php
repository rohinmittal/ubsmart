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

    $this->model = $this->CI->membership_model;
    }
    
    /* Model test cases */
    
    /**
    * @covers Membership_model::check_if_email_exists
    */
    public function testEmailExists()
    {
        // check if email exists returns false, if the id exists in database
        $posts = $this->model->check_if_email_exists('rohinmit@buffalo.edu');
        $this->assertEquals(FALSE, $posts);
    }
    
    /**
    * @covers Membership_model::check_if_email_exists
    */
    public function testEmailDoesntExists()
    {
        // check if email exists returns false, if the id exists in database else it returns true
        $posts = $this->model->check_if_email_exists('ubsmart@buffalo.edu');
        $this->assertEquals(TRUE, $posts);
    }
    
    /**
    * @covers Membership_model::validate
    */
    public function testCorrectLoginCredentials()
    {
        // check if login credentials are correct
        $posts = $this->model->validate('vsinha', md5('qwertyuiop'), 'b');
        $this->assertEquals(TRUE, $posts);
    }
    
    /**
    * @covers Membership_model::validate
    */  
    public function testIncorrectLoginCredentials()
    {
        // check if login credentials are incorrect
        $posts = $this->model->validate('vsinha', md5('12345'), 'b');
        $this->assertEquals(FALSE, $posts);
    }
    
    /**
    * @covers Membership_model::boughtHistory
    */    
    public function testBoughtHistory1()
    {
        $data = $this->model->boughtHistory('vsinha');
        $this->assertEquals(0, $data->num_rows());
    }

    /**
    * @covers Membership_model::boughtHistory
    */    
    public function testBoughtHistory2()
    {
        $data = $this->model->boughtHistory('ajay');
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
    * @covers Home::check_if_blank_usrname
    */
    public function testCheckIfNotBlankUsrname()
    {
        /* returns true if username isn't blank */
        $data = $this->CI->check_if_blank_usrname('rohinmittal');
        $this->assertEquals(TRUE, $data);
    }
        
    /**
    * @covers Home::check_if_email_ub
    */
    public function testCheckIfNotEmailUB()
    {
        /* returns true if username isn't blank */
        $data = $this->CI->check_if_email_ub('rohinmit@buffalo.com');
        $this->assertEquals(FALSE, $data);
    }
    
    /**
    * @covers Home::check_if_email_ub
    */
    public function testCheckIfEmailUB()
    {
        /* returns true if username isn't blank */
        $data = $this->CI->check_if_email_ub('rohinmit@buffalo.edu');
        $this->assertEquals(TRUE, $data);
    }
    
    /**
    * @covers Home::check_if_blank_tel
    */
    public function testCheckIfBlankTel()
    {
        /* returns false if tel is blank */
        $data = $this->CI->check_if_blank_tel('Cellphone Number');
        $this->assertEquals(FALSE, $data);
    }
 
     /**
    * @covers Home::check_if_blank_tel
    */
    public function testCheckIfNotBlankTel()
    {
        /* returns false if tel is blank */
        $data = $this->CI->check_if_blank_tel('1234567890');
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
    
    /**
    * @covers Home::check_if_blank_email
    */
    public function testCheckIfNotBlankEmail()
    {
        /* returns false if email is blank */
        $data = $this->CI->check_if_blank_email('rohinmit@buffalo.edu');
        $this->assertEquals(TRUE, $data);
    }
}
