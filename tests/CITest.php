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
}
