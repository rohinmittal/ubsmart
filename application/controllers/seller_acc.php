
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class seller_acc extends CI_Controller {

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
		
		$this->load->library('table');
		$this->load->library('pagination'); /*do later*/
        // Query the database and get results
 
		$data['products'] = $this->db->get('products');
		//$data['u_name']=$this->session->userdata('username');
		echo $this->session->userdata('username');
		
		//$data['users'] = $this->db->query('SELECT username, email, telephone, vw_balance from users where username=' );
 		$this->db->select('username, email, telephone, vw_balance');
 		$this->db->where('username',$this->session->userdata('username'));
		$data['users'] = $this->db->get('users');
		
        // Create custom headers
        $header = array('Username', 'E mail', 'Telephone', 'Virtual Wallet Balance');
        // Set the headings
        $this->table->set_heading($header);
        // Load the view and send the results
        $this->load->view('seller_acc',$data);
		$this->load->view('includes/footer');
	}
	public function update()
	{
		$this->load->view('includes/header_loggedin');
		//load update view   $this->load->view('seller_acc',$data);
		$this->load->view('includes/footer');
	}
		public function upload_form()
	{
		$this->load->view('includes/header_loggedin');
		$this->load->view('upload_form');
		$this->load->view('includes/footer');
	}
	function form_upload()
	{
		echo "fir shuru ho gya";	
		//$config['upload_path'] = './p_images/';//t
		//$concat = $config['upload_path'].'random';//t
		//echo $concat;//t
		$category = $_POST['categories'];    //value of radio button
		if($category == "furniture")
		{
			$sub_cat=$fur_type;
			$fur_type = $_POST['f_type'];
			if($fur_type == "table")
			{
				$prod_weight = 0;
				$material = $_POST['mat_type'];
				$tab_age = $_POST['age_table'];
				$table_cond = $_POST['table_condition'];
				echo $tab_age;
				if($material=='plastic')
				{
				$prod_weight = $prod_weight + 25;		
				}
				else if($material=='wood')
				{
					$prod_weight = $prod_weight + 50;
				}
				else {    //steel
				$prod_weight = $prod_weight + 100;
				}
				if($tab_age=="<6month")
				{
					$prod_weight = $prod_weight + 100;
				}
				else if($tab_age=="6-1yr")
				{
					$prod_weight = $prod_weight + 50;
				}
				else{
					$prod_weight = $prod_weight + 25;
				} //>1yr
				if($table_cond=="slight")
				{
					$prod_weight = $prod_weight + 300;
				}
				else if($table_cond=="moderate")
				{
					$prod_weight = $prod_weight + 150;
				}
				else{
					$prod_weight = $prod_weight + 50;
				} //serious wear
				echo "<br />";
				echo $prod_weight;
				if($prod_weight <= 100)
				{
					$prod_tier="e";
				}
				else if($prod_weight <= 200)
				{
					$prod_tier="d";
				}
				else if($prod_weight <= 300)
				{
					$prod_tier="c";
				}
				else if($prod_weight <= 400)
				{
					$prod_tier="b";
				}
				else
				{
					$prod_tier="a";
				}
				echo $prod_tier;
				echo "<br />";
			}
			else if($fur_type == "chair"){ //chair weight calculation
				$prod_weight = 0;
				$material = $_POST['chair_mat_type'];
				$chair_age = $_POST['age_chair'];
				$chair_cond = $_POST['chair_condition'];
				$type_cush = $_POST['cushion_type'];
				echo $chair_age;
				if($material=='plastic')
				{
				$prod_weight = $prod_weight + 25;		
				}
				else if($material=='wood')
				{
					$prod_weight = $prod_weight + 50;
				}
				else {    //steel
				$prod_weight = $prod_weight + 100;
				}
				if($chair_age=="<6month")
				{
					$prod_weight = $prod_weight + 100;
				}
				else if($chair_age=="6-1yr")
				{
					$prod_weight = $prod_weight + 50;
				}
				else{
					$prod_weight = $prod_weight + 25;
				} //>1yr
				
				if($type_cush=="cotton")
				{
					$prod_weight = $prod_weight + 100;
				}
				else if($type_cush=="foam")
				{
					$prod_weight = $prod_weight + 50;
				}
				
				
				if($chair_cond=="slight")
				{
					$prod_weight = $prod_weight + 300;
				}
				else if($chair_cond=="moderate")
				{
					$prod_weight = $prod_weight + 150;
				}
				else{
					$prod_weight = $prod_weight + 50;
				} //serious wear
				
				if(isset($_POST['has_leather']))
				{
					$prod_weight = $prod_weight + 100;
					echo "sab set hai";
					echo "<br />";
				}
				echo $prod_weight;
				echo "<br />";
					if($prod_weight <= 140)
				{
					$prod_tier="e";
				}
				else if($prod_weight <= 280)
				{
					$prod_tier="d";
				}
				else if($prod_weight <= 420)
				{
					$prod_tier="c";
				}
				else if($prod_weight <= 560)
				{
					$prod_tier="b";
				}
				else
				{
					$prod_tier="a";
				}
				echo $prod_tier;
				echo "<br />";
				//chair teir calculation	
			}	
				
				
		}
		else{ //weight calculation for electronics category
		$elec_type = $_POST['e_type'];
		$sub_cat=$elec_type;
			if($elec_type == "laptop")
			{
				//laptop weight calculation
			    $prod_weight = 0;
				$ram = $_POST['ram_laptop'];
				$laptop_storage = $_POST['storage_laptop'];
				$laptop_cond = $_POST['laptop_condition'];
				$lap_age = $_POST['laptop_age'];
				echo $lap_age;
				if($ram=='<1g')
				{
				$prod_weight = $prod_weight + 25;		
				}
				else if($ram=='1-2g')
				{
					$prod_weight = $prod_weight + 50;
				}
				else {    //>2g
				$prod_weight = $prod_weight + 100;
				}
				if($laptop_storage=='<500g')
				{
				$prod_weight = $prod_weight + 50;		
				}
				else if($laptop_storage=='>500g')
				{
					$prod_weight = $prod_weight + 100;
				}
				if($lap_age=="<1yr")
				{
					$prod_weight = $prod_weight + 100;
				}
				else if($lap_age=="1-2yr")
				{
					$prod_weight = $prod_weight + 50;
				}
				else{ //>2 year
					$prod_weight = $prod_weight + 25;
				} //>1yr
				if($laptop_cond=="flawless")
				{
					$prod_weight = $prod_weight + 300;
				}
				else if($laptop_cond=="avg")
				{
					$prod_weight = $prod_weight + 150;
				}
				else{
					//below avg condition
					$prod_weight = $prod_weight + 50;
				}
				if(isset($_POST['key_missing']))
				{
					$prod_weight = $prod_weight +100;
				}
				if(isset($_POST['touchpad_working']))
				{
					$prod_weight = $prod_weight +100;
				}
				if(isset($_POST['cd_working']))
				{
					$prod_weight = $prod_weight +100;
				}
				if(isset($_POST['battery_life']))
				{
					$prod_weight = $prod_weight +100;
				}
				if(isset($_POST['charger_included']))
				{
					$prod_weight = $prod_weight +100;
				}
				if(isset($_POST['bill_included']))
				{
					$prod_weight = $prod_weight +100;
				}
				if(isset($_POST['warranty_valid']))
				{
					$prod_weight = $prod_weight +150;
				}
				echo $prod_weight;
				echo "<br />";	
					if($prod_weight <= 270)
				{
					$prod_tier="e";
				}
				else if($prod_weight <= 540)
				{
					$prod_tier="d";
				}
				else if($prod_weight <= 810)
				{
					$prod_tier="c";
				}
				else if($prod_weight <= 1080)
				{
					$prod_tier="b";
				}
				else
				{
					$prod_tier="a";
				}
				echo $prod_tier;
				echo "<br />";
			}	
			else
			{
			//cellphone weight calculation
			    $prod_weight = 0;
				$phone_cond = $_POST['phone_condition'];
				$phn_age = $_POST['phone_age'];
				echo $phn_age;
				if($phn_age=="<11mnth")
				{
					$prod_weight = $prod_weight + 100;
				}
				else if($lap_age=="1-2yr")
				{
					$prod_weight = $prod_weight + 50;
				}
				else{ //>2 year
					$prod_weight = $prod_weight + 25;
				} 
				if($phone_cond=="flawless")
				{
					$prod_weight = $prod_weight + 300;
				}
				else if($phone_cond=="avg")
				{
					$prod_weight = $prod_weight + 150;
				}
				else{
					//below avg condition
					$prod_weight = $prod_weight + 50;
				}
				if(isset($_POST['touch_working']))
				{
					$prod_weight = $prod_weight +100;
				}
				if(isset($_POST['charging_defect']))
				{
					$prod_weight = $prod_weight +100;
				}
				if(isset($_POST['battery_working']))
				{
					$prod_weight = $prod_weight +100;
				}
				if(isset($_POST['camera_working']))
				{
					$prod_weight = $prod_weight +100;
				}
				if(isset($_POST['phone_charger_included']))
				{
					$prod_weight = $prod_weight +100;
				}
				if(isset($_POST['phone_bill_included']))
				{
					$prod_weight = $prod_weight +100;
				}
				if(isset($_POST['earphone_included']))
				{
					$prod_weight = $prod_weight +150;
				}
				if(isset($_POST['box_included']))
				{
					$prod_weight = $prod_weight +150;
				}
				echo $prod_weight;
				echo "<br />";
						if($prod_weight <= 260)
				{
					$prod_tier="e";
				}
				else if($prod_weight <= 520)
				{
					$prod_tier="d";
				}
				else if($prod_weight <= 780)
				{
					$prod_tier="c";
				}
				else if($prod_weight <= 1040)
				{
					$prod_tier="b";
				}
				else
				{
					$prod_tier="a";
				}
				echo $prod_tier;
				echo "<br />";
				//upload---integeration... 		
			}
		}
		
		
		//calculate tier and pass to model... within each block for product weight calculation depending on category...
		//
		$data['form_data']=$_POST;
		$data['p_tier']= $prod_tier;
		$data['p_category']= $category;
		$data['p_subcategory']=$sub_cat;
		$data['p_condition'] = $_POST['condition'];
		$data['p_name'] = $_POST['productname'];
		$data['suramrit'] = "suramrit";
		$this->load->library('form_validation'); // to be implemented
		$this->load->model('product_upload_model');
		$current_smart_price =  $this->product_upload_model->evaluate_smart_price($data);
		$data['p_smart_price'] = $current_smart_price;
		$this->load->view('includes/header_loggedin');
		$this->load->view('confirm_upload',$data);
		$this->load->view('includes/footer');
		
		
	
	}
	

	 public function do_upload()
	{
		$this->load->library('form_validation'); // to be implemented
		$this->load->model('product_upload_model');
		//$current_smart_price =  $this->product_upload_model->evaluate_smart_price($data);
		//$suramrit = $data['suri'];
		//echo $suramrit;
		//redirect('seller_acc');
			isset($_POST['check1']); //check if check button is set.. 
        ///if ($answer == "furniture") {          
        //echo $answer;
		//echo data;s
		$this->load->library('upload');
		$upload_path = './p_images/'.$this->session->userdata('username');
		mkdir($upload_path);
		echo $upload_path;
		$config['upload_path'] = './p_images/'.$this->session->userdata('username'); //Path to be stored as  ./p_images/temp_'username'/image1,2,3.... 
		$config['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
		$config['max_size']	= '1024000';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$config['max_width']  = '1024';
		$files = $_FILES['userfiles'];
		
		for ($i = 0; $i < 3; $i++)
		{
		 $_FILES['userfiles']['name'] = $files['name'][$i];
		 $user_img[$i] = $files['name'][$i];
         $_FILES['userfiles']['type'] = $files['type'][$i];
         $_FILES['userfiles']['tmp_name'] = $files['tmp_name'][$i];
         $_FILES['userfiles']['error'] = $files['error'][$i];
         $_FILES['userfiles']['size'] = $files['size'][$i];	
	     $this->upload->initialize($config);
		 if($this->upload->do_upload('userfiles'))
		{
			
			echo "file upload success--renamed the path too!";
			
		}
		}
		$this->load->helper(array('form', 'url'));
		$this->load->library('upload', $config);
		
		$pid = $this->product_upload_model->upload_details($user_img);
		echo $pid;
		$new_path = "./p_images/".$pid;
		rename($config['upload_path'], $new_path);
		$data['user_img1_path'] =  "./p_images/".$pid."/".$user_img[0];
		$data['user_img2_path'] =  "./p_images/".$pid."/".$user_img[1];
		$data['user_img3_path'] =  "./p_images/".$pid."/".$user_img[2];
		$data['pid']	= $pid;
		$this->product_upload_model->upload_img_details($data);
		
		//echo "product uploaded";
		//redirect('seller_acc');
	}
	
   public function display_seller_prods()
	{
		//get the table to be displayed...
		$this->load->library('table');
		$header = array('Product Name', 'Product ID', 'Listed Price', 'Category','Sub Category','Product Status');
		// Set the headings
		$this->table->set_heading($header);
		$this->load->model('product_upload_model');
		$data = $this->product_upload_model->fetch_seller_prod($data);
		$this->load->view('includes/header_loggedin');
		$this->load->view('display_seller_prod',$data);
		$this->load->view('includes/footer');
	}
 	public function edit_seller_prods()
	{
		$this->load->view('includes/header_loggedin');
		$this->load->view('edit_seller_prod');
		$this->load->view('includes/footer');
	}

	public function do_edit()
	{
		$this->load->model('product_upload_model');	
		$option = $_POST['edit_option'];    //value of radio button
		if($option == "Edit Product")
		{
			$this->product_upload_model->edit_seller_prod();
			echo 'Changed Details';
		}
		else {
			$this->product_upload_model->del_seller_prod();
			echo 'Product deleted';
		}
			
		
	}
	}
?>
