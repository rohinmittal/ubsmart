
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
		//echo $this->session->userdata('username');
		
		//$data['users'] = $this->db->query('SELECT username, email, telephone, vw_balance from users where username=' );
 		$this->db->select('username, email, telephone, vw_balance');
 		$this->db->where('username',$this->session->userdata('username'));
		$data['users'] = $this->db->get('users');
		
        // Create custom headers
        $header = array('Username', 'E mail', 'Telephone', 'Virtual Wallet Balance');
        // Set the headings
        $this->table->set_heading($header);
        // Load the view and send the results
        $this->load->view('seller_acc/seller_acc',$data);
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
		$this->load->view('seller_acc/upload_form');
		$this->load->view('includes/footer');
	}
	function form_upload()
	{
		$this->load->library('form_validation');
		
		//rules
		
		$this->form_validation->set_rules('productname', 'Product Name', 'trim|required|callback_check_if_blank_pname');
		//$this->form_validation->set_rules('categories', 'Category' , 'callback_check_if_cat_set');
		//$this->form_validation->run();
		$category = $_POST['categories']; 
		if($category=="Furniture")
		{
			//$this->form_validation->set_rules('f_type', 'F type' , 'callback_check_if_f_type_set');
			//$this->form_validation->run();
			$f_type = $_POST['f_type'];
		
		
		if($f_type == "Tables")
		{
			$this->form_validation->set_rules('mat_type', 'Material', 'callback_check_if_mat_set');
			$this->form_validation->set_rules('tab_dimension_l', 'Table Dimension', 'trim|required|callback_check_if_blank_dimension');
			$this->form_validation->set_rules('tab_dimension_w', 'Table Dimension', 'trim|required|callback_check_if_blank_dimension');
			$this->form_validation->set_rules('tab_dimension_h', 'Table Dimension', 'trim|required|callback_check_if_blank_dimension');
		
		}
		if($f_type == "Chairs")
		{
			$this->form_validation->set_rules('chair_mat_type', 'Material', 'callback_check_if_chair_mat_set');
			$this->form_validation->set_rules('chair_dimension_l', 'Chair Dimension', 'trim|required|callback_check_if_blank_dimension');
			$this->form_validation->set_rules('chair_dimension_w', 'Chair Dimension', 'trim|required|callback_check_if_blank_dimension');
			$this->form_validation->set_rules('chair_dimension_h', 'Chair Dimension', 'trim|required|callback_check_if_blank_dimension');
		}
		}
		else 
		{
			$elec_type = $_POST['e_type'];
			if($elec_type == "Laptops")
			{
				$this->form_validation->set_rules('laptop_serial', 'Serial', 'callback_check_if_serial_set');
			}
			if($elec_type == "Cellphones")
			{
				$this->form_validation->set_rules('imei', 'IMEI', 'callback_check_if_imei_set');
			}
		}
		
		
		
		
		

		
		//$this->form_validation->set_rules('productname', 'Product Name', 'required');
		//$this->form_validation->set_rules('productname', 'Product Name', 'required');
		
		if ($this->form_validation->run() == FALSE) // didn't validate
		{
		$this->load->view('includes/header_loggedin');
		$this->load->view('seller_acc/upload_form');
		$this->load->view('includes/footer');
		}	
		//$config['upload_path'] = './p_images/';//t
		//$concat = $config['upload_path'].'random';//t
		//echo $concat;//t
		else
		{
			$material=0;
			$dimension=0;
			$imei=0;
			$is_charger_cell=0;
			$is_headset=0;
			$is_charger=0;			
			$serial=0;
		$category = $_POST['categories'];    //value of radio button
		if($category == "Furniture")
		{
			
			$fur_type = $_POST['f_type'];
			$sub_cat=$fur_type;
			if($fur_type == "Tables")
			{
				$prod_weight = 0;
				$data['dim_l'] = $_POST['tab_dimension_l'];
				$data['dim_w'] = $_POST['tab_dimension_w'];
				$data['dim_h'] = $_POST['tab_dimension_h'];
				$material = $_POST['mat_type'];
				$tab_age = $_POST['age_table'];
				//$dimension = $_POST['tab_dimension']; //add to form...
				$table_cond = $_POST['table_condition'];
				//echo $tab_age;
				if(isset($_POST['is_owner']))
				{
					$prod_weight = $prod_weight + 25;
				}
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
				{														//Product Condition reresentation in DataBase
					$data['p_condition'] = 'f';                           //f -FAIR
					$prod_weight = $prod_weight + 300;					  //a -Average 
				}														  //b -Below Average
				else if($table_cond=="moderate")
				{
					$data['p_condition'] = 'a';
					$prod_weight = $prod_weight + 150;
				}
				else{
					$data['p_condition'] = 'b';
					$prod_weight = $prod_weight + 50;
				} //serious wear
				echo "<br />";
				//echo $prod_weight;
				if($prod_weight <= 125)
				{
					$prod_tier="E";
				}
				else if($prod_weight <= 225)
				{
					$prod_tier="D";
				}
				else if($prod_weight <= 325)
				{
					$prod_tier="C";
				}
				else if($prod_weight <= 425)
				{
					$prod_tier="B";
				}
				else
				{
					$prod_tier="A";
				}
				//echo $prod_tier;
				echo "<br />";
			}
			else if($fur_type == "Chairs"){ //chair weight calculation
				$prod_weight = 0;
			    $data['dim_l'] = $_POST['chair_dimension_l'];
				$data['dim_w'] = $_POST['chair_dimension_w'];
				$data['dim_h'] = $_POST['chair_dimension_h'];
				$material = $_POST['chair_mat_type'];
				//$dimension = $_POST['chair_dimension'];
				$chair_age = $_POST['age_chair'];
				$chair_cond = $_POST['chair_condition'];
				$type_cush = $_POST['cushion_type'];
				//echo $chair_age;
				if(isset($_POST['is_owner']))
				{
					$prod_weight = $prod_weight + 25;
				}
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
					$data['p_condition'] = 'f';
					$prod_weight = $prod_weight + 300;
				}
				else if($chair_cond=="moderate")
				{
					$data['p_condition'] = 'a';
					$prod_weight = $prod_weight + 150;
				}
				else{
					$data['p_condition'] = 'b';
					$prod_weight = $prod_weight + 50;
				} //serious wear
				
				if(isset($_POST['has_leather']))
				{
					$prod_weight = $prod_weight + 100;
					//echo "sab set hai";
					echo "<br />";
				}
				echo $prod_weight;
				echo "<br />";
					if($prod_weight <= 165)
				{
					$prod_tier="e";
				}
				else if($prod_weight <= 305)
				{
					$prod_tier="d";
				}
				else if($prod_weight <= 445)
				{
					$prod_tier="c";
				}
				else if($prod_weight <= 585)
				{
					$prod_tier="b";
				}
				else
				{
					$prod_tier="a";
				}
				//echo $prod_tier;
				echo "<br />";
				//chair teir calculation	
			}	
				
				
		}
		else{ //weight calculation for electronics category
		$elec_type = $_POST['e_type'];
		$sub_cat=$elec_type;
			if($elec_type == "Laptops")
			{
				//laptop weight calculation
			    $prod_weight = 0;
				$is_charger=0;
				$serial = $_POST['laptop_serial'];
				$ram = $_POST['ram_laptop'];
				$laptop_storage = $_POST['storage_laptop'];
				$laptop_cond = $_POST['laptop_condition'];
				$lap_age = $_POST['laptop_age'];
				//echo $lap_age;
				if(isset($_POST['is_owner']))
				{
					$prod_weight = $prod_weight + 50;
				}
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
					$data['p_condition'] = 'f';
					$prod_weight = $prod_weight + 300;
				}
				else if($laptop_cond=="avg")
				{
					$data['p_condition'] = 'a';
					$prod_weight = $prod_weight + 150;
				}
				else{
					//below avg condition
					$data['p_condition'] = 'b';
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
					$is_charger=1;
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
				//echo $prod_weight;
				echo "<br />";	
					if($prod_weight <= 320)
				{
					$prod_tier="E";
				}
				else if($prod_weight <= 590)
				{
					$prod_tier="D";
				}
				else if($prod_weight <= 860)
				{
					$prod_tier="C";
				}
				else if($prod_weight <= 1130)
				{
					$prod_tier="B";
				}
				else
				{
					$prod_tier="A";
				}
				//echo $prod_tier;
				echo "<br />";
			}	
			else
			{
			//cellphone weight calculation
			    $prod_weight = 0;
				$phone_cond = $_POST['phone_condition'];
				$phn_age = $_POST['phone_age'];
				$imei = $_POST['imei'];
				$is_charger_cell=0;
				$is_headset=0;
				//echo $phn_age;
				if(isset($_POST['is_owner']))
				{
					$prod_weight = $prod_weight + 25;
				}
				if($phn_age=="<11mnth")
				{
					$prod_weight = $prod_weight + 100;
				}
				else if($phn_age=="1-2yr")
				{
					$prod_weight = $prod_weight + 50;
				}
				else{ //>2 year
					$prod_weight = $prod_weight + 25;
				} 
				if($phone_cond=="flawless")
				{
					$data['p_condition'] = 'f';
					$prod_weight = $prod_weight + 300;
				}
				else if($phone_cond=="avg")
				{
					$data['p_condition'] = 'a';
					$prod_weight = $prod_weight + 150;
				}
				else{
					//below avg condition
					$data['p_condition'] = 'b';
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
					$is_charger_cell = 1;
					$prod_weight = $prod_weight +100;
				}
				if(isset($_POST['phone_bill_included']))
				{
					$prod_weight = $prod_weight +100;
				}
				if(isset($_POST['earphone_included']))
				{
					$is_headset = 1;
					$prod_weight = $prod_weight +150;
				}
				if(isset($_POST['box_included']))
				{
					$prod_weight = $prod_weight +150;
				}
				//echo $prod_weight;
				echo "<br />";
						if($prod_weight <= 310)
				{
					$prod_tier="E";
				}
				else if($prod_weight <= 570)
				{
					$prod_tier="D";
				}
				else if($prod_weight <= 830)
				{
					$prod_tier="C";
				}
				else if($prod_weight <= 1090)
				{
					$prod_tier="B";
				}
				else
				{
					$prod_tier="A";
				}
				//echo $prod_tier;
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
		//$data['p_condition'] = $_POST['condition'];
		$data['p_name'] = $_POST['productname'];
		$data['material'] = $material;
		$data['dimension']=$dimension;
		$data['is_charger']=$is_charger;
		$data['serial']=$serial;
		$data['imei']=$imei;
		$data['is_charger_cell']=$is_charger_cell;
		$data['is_headset']=$is_headset;
		if(isset($_POST['is_owner']))
				{
					$data['is_owner']=1;
                }
		else {
					$data['is_owner']=0;
		}
		$data['suramrit'] = "suramrit";
		$this->load->library('form_validation'); // to be implemented
		$this->load->model('product_upload_model');
		$result =  $this->product_upload_model->evaluate_smart_price($data);
		$data['p_smart_price'] = $result['current_smart_price'];
		$data['max_price'] = $result['max_price'];
		$data['min_price'] = $result['min_price'];
		$this->load->view('includes/header_loggedin');
		$this->load->view('seller_acc/confirm_upload',$data);
		$this->load->view('includes/footer');
		
		}	
	
	}
	

	 public function do_upload()
	{
		$this->load->library('form_validation'); // to be implemented
		//rules
		$this->form_validation->set_rules('ask_price', 'Asking Price', 'trim|required|callback_check_if_blank_price|integer|callback_check_if_positive');
		$this->form_validation->set_rules('p_desc', 'Description', 'trim|required|callback_check_if_blank_desc');
		//$this->form_validation->run();
		if ($this->form_validation->run() == FALSE)
		{
		$this->load->view('includes/header_loggedin');
		$this->load->view('seller_acc/confirm_upload',$_POST); // $_POST is used only when form validation failsso that data remains consistent....
		$this->load->view('includes/footer');
		}
		else 
		{
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
		//echo $upload_path;
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
			
			//echo "file upload success--renamed the path too!";
			
		}
		}
		$this->load->helper(array('form', 'url'));
		$this->load->library('upload', $config);
		
		$pid = $this->product_upload_model->upload_details($user_img);
		//echo $pid;
		$new_path = "./p_images/".$pid;
		rename($config['upload_path'], $new_path);
		$data['user_img1_path'] =  $user_img[0];
		$data['user_img2_path'] =  $user_img[1];
		$data['user_img3_path'] =  $user_img[2];
		$data['pid']	= $pid;
		$this->product_upload_model->upload_img_details($data);
		//update the category specific tables
		if($_POST['p_category']=="Furniture")
		{
			$cat_data['pid']=$pid;
			$cat_data['dim_l']=$_POST['dim_l'];
			$cat_data['dim_w']=$_POST['dim_w'];
			$cat_data['dim_h']=$_POST['dim_h'];
			$cat_data['material']=$_POST['material'];
			$this->product_upload_model->upload_furn_details($cat_data);
			//echo "hello--furniture category";	
		}
		else if($_POST['p_subcategory']=="Laptops")
		{
			$cat_data['pid']=$pid;
			$cat_data['is_charger']=$_POST['is_charger'];
			$cat_data['serial']=$_POST['serial'];
			$this->product_upload_model->upload_laptop_details($cat_data);
			//echo "hello--laptop category";	
		}
		else if($_POST['p_subcategory']=="Cellphones")
		{
			$cat_data['pid']=$pid;
			$cat_data['is_charger_cell']=$_POST['is_charger_cell'];
			$cat_data['imei']=$_POST['imei'];
			$cat_data['is_headset']=$_POST['is_headset'];
			$this->product_upload_model->upload_cellphone_details($cat_data);
			//echo "hello--cellphone category";	
		}
		
		//echo "product uploaded";
		//redirect('seller_acc');
		}
	}
	
   public function display_seller_prods()
	{
		//get the table to be displayed...
		$this->load->library('table');
		$header = array('Product Name', 'Product ID', 'Listed Price', 'Category','Sub Category','Product Status');
		// Set the headings
		$this->table->set_heading($header);
		$this->load->model('product_upload_model');
		$results = $this->product_upload_model->fetch_seller_prod();
		$data['allProducts'] = $results['allProducts'];
		//echo "here";
		//echo $data['allProducts']->num_rows();
		$data['orders'] = $results['orders'];
		//echo "here2 ";
		//echo $data['orders']->num_rows();
		$data['sure']="sur";
		//$data['soldProducts'] = $this->product_upload_model->fetch_sold_prod($data['allProducts']);
		$this->load->view('includes/header_loggedin');
		$this->load->view('seller_acc/display_seller_prod',$data);
		$this->load->view('includes/footer');
	}
	public function seller_handover()
	{
		$this->load->model('product_upload_model');
		$this->product_upload_model->updateSellersHandover();
		redirect('seller_acc/display_seller_prods');
	}
 	public function edit_seller_prods()
	{
		$this->load->view('includes/header_loggedin');
		$this->load->view('seller_acc/edit_seller_prod');
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

	public function update_acc()
	{
		$this->load->view('includes/header_loggedin');
		$this->load->view('myaccount/getCurrentPassword_v');
		$this->load->view('includes/footer');
	}
	
	
	//form validation functions
	function check_if_blank_pname($pname)
    {
    	$tcomp=strcmp($pname,"Enter Product Name:");
		$name_entered=TRUE;
        if($tcomp==0)
		{
			$name_entered=FALSE;
		}
        return $name_entered;
	}
	function check_if_blank_dimension($dimen)
    {
    	$tcomp=strcmp($dimen,"Enter Dimension:");
		$dim_entered=TRUE;
        if($tcomp==0)
		{
			$dim_entered=FALSE;
		}
        return $dim_entered;
	}
	function check_if_mat_set($mat_type)
    {
	  if(isset($_POST['mat_type']))
	  {    return TRUE;     }       
      else { return FALSE; }    	
	}
function check_if_chair_mat_set($mat_type)
    {
	  if(isset($_POST['chair_mat_type']))
	  {    return TRUE;     }       
      else { return FALSE; }    	
	}
	function check_if_cat_set($mat_type)
    {
	  if(isset($_POST['categories']))
	  {    return TRUE;     }       
      else { return FALSE; }    	
	}
	function check_if_f_type_set($mat_type)
    {
	  if(isset($_POST['f_type']))
	  {    return TRUE;     }       
      else { return FALSE; }    	
	}
	function check_if_serial_set($serial)
    {
    	$tcomp=strcmp($serial,"Enter serial number:");
		$ser_entered=TRUE;
        if($tcomp==0)
		{
			$ser_entered=FALSE;
		}
        return $ser_entered;
	}
	function check_if_imei_set($imei)
    {
    	$tcomp=strcmp($imei,"Enter IMEI number:");
		$imei_entered=TRUE;
        if($tcomp==0)
		{
			$imei_entered=FALSE;
		}
        return $imei_entered;
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
	function check_if_blank_price($price)
    {
    	$tcomp=strcmp($price,"Enter Asking price for your product!");
		$pr_entered=TRUE;
        if($tcomp==0)
		{
			$pr_entered=FALSE;
		}
        return $pr_entered;
	}
	function check_if_blank_desc($desc)
    {
    	$tcomp=strcmp($desc,"Enter a brief description of the product"); //Make this a text box! -- 
		$desc_entered=TRUE;
        if($tcomp==0)
		{
			$desc_entered=FALSE;
		}
        return $desc_entered;
	}
	}
?>
