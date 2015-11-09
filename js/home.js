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
});
