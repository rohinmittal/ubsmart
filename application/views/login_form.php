<title> UB sMart </title>
<div id=login_page>	
<div id="adbanner_on_loginpage">
	<p style="font-size: 15" >"Content....."</p>
</div>
<div id="login_form">
	<?php if (isset($account_created)) {?>
		<h1><?php echo $account_created; ?></h1>
	<?php } else { ?>
		<h1>Login, please.</h1>
	<?php } ?>
	
	<?php
    echo form_open('home/validate_credentials');
	
	echo form_input('username', 'Username', 'style="width:91%"');
	echo form_password('password', '', 'placeholder="Password" class="password" style="width:91%"');
	$attr4style = array('class' => 'form_labels','style' => 'color: #0070b8;');
	echo form_label('Sign in as:  Buyer','sgnin_buyer',$attr4style);
	echo form_radio('login_type','b');
	echo form_label('Seller','sgnin_seller',$attr4style);
	echo form_radio('login_type','s');
	echo nl2br("\n\n");
	
	echo form_submit('submit','Login');
	echo anchor('home/signup','Create Account');
	echo form_close(); 				
	
	echo validation_errors('<p class="error">'); 
	?>
</div>
</div>
