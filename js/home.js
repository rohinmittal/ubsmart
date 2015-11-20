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

	
	if(document.getElementById("search_bar"))
	{
		document.getElementById("search_submit").style.background = "gray";
	 	document.getElementById("search_submit").disabled=true;
		$( "#search_bar" ).keyup(checkvalidsq);
		$( "#search_bar" ).focusin(checkvalidsq);
		function checkvalidsq() {
         var sq=$(this).val();
         sq=sq.toString();         
         sq=sq.trim();
         //var empty=/\S/.test(sq);
         //alert(sq+"ded");
		 if(sq=="Search"||sq=="")
		 {
	 	  //alert("what");
	 	  document.getElementById("search_submit").style.background = "gray";
	 	  document.getElementById("search_submit").disabled=true;
    	 }
    	 else
    	 {
    	 //	alert("hua!");
    	  document.getElementById("search_submit").style.background = "#027cca";
    	  //document.getElementById("search_submit").style.background = /background: #0070b8;	cursor: pointer;
    	  document.getElementById("search_submit").disabled=false;
    	 }
        }		
	}
	
});