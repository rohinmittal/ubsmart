$(document).ready(function() {
	
	$(':text').click(function() {
		current_input_val=$(this).val();
		$(this).select();
	}).focusout(function(){
		if ($(this).val()==''){
			$(this).val(current_input_val);
		}			
	});
	
	$(':password').focusin(function() {
		if ($(this).attr('placeholder') !==undefined){
			$(this).removeAttr('placeholder');
		}
	});
	
	$(':password.password').focusout(function(){
		$(this).attr('placeholder','Password');
	});
	
	$(':password.password_confirm').focusout(function(){
		$(this).attr('placeholder','Confirm Password');
	});
	//do not delete the foll lines!	
	//var height_of_form = document.getElementById('login_form').clientHeight;
	//alert(height_of_form);
	//document.getElementById('adbanner_on_loginpage').style.height=height_of_form+'px';
});
