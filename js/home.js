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
		document.getElementById("search_submit").style.background = "#C9CBCD";
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
	 	  document.getElementById("search_submit").style.background = "#C9CBCD";
	 	  document.getElementById("search_submit").disabled=true;
    	 }
    	 else
    	 {
    	 //	alert("hua!");
    	  document.getElementById("search_submit").style.background = "white";
    	  //document.getElementById("search_submit").style.background = /background: #0070b8;	cursor: pointer;
    	  document.getElementById("search_submit").disabled=false;
    	 }
        }		
	}
	 $('#furniture_form,#laptop_form,#mobile_form').css("display","none");
	   
	    $(".edit_option").click(function(){
        if ($('input[name=edit_option]:checked').val() == "edit") {
           document.getElementById('edit_detail_form').style.display="block";
           //document.getElementById('electronic_form').style.display="none";
           //document.getElementById('mobile_form').style.display="none";
        }
     });
	   
	   
    $(".cat").click(function(){
        if ($('input[name=categories]:checked').val() == "furniture") {
           document.getElementById('furniture_form').style.display="block";
           document.getElementById('electronic_form').style.display="none";
           //document.getElementById('mobile_form').style.display="none";
        }
        if ($('input[name=categories]:checked').val() == "electronic") {
            document.getElementById('electronic_form').style.display="block";
            document.getElementById('furniture_form').style.display="none";
            //document.getElementById('mobile_form').style.display="none";
        }
       // if ($('input[name=categories]:checked').val() == "mobile"){
         //  document.getElementById('mobile_form').style.display="block";
          // document.getElementById('laptop_form').style.display="none";
           //document.getElementById('furniture_form').style.display="none";
       // }
     });
     
     $(".f_type").click(function(){
     	if ($('input[name=f_type]:checked').val() == "table") {
           document.getElementById('table_details').style.display="block";
           document.getElementById('chair_details').style.display="none";
        }
        if ($('input[name=f_type]:checked').val() == "chair") {
            document.getElementById('chair_details').style.display="block";
            document.getElementById('table_details').style.display="none";
        }
     });
      $(".e_type").click(function(){
     	if ($('input[name=e_type]:checked').val() == "laptop") {
           document.getElementById('laptop_details').style.display="block";
           document.getElementById('cellphone_details').style.display="none";
        }
        if ($('input[name=e_type]:checked').val() == "cellphone") {
            document.getElementById('cellphone_details').style.display="block";
            document.getElementById('laptop_details').style.display="none";
        }
     });
    
	//for drop downs
	$('#mb_headers span').mouseenter(function() { 
		var elem_class = $(this).attr('class');
		var elem_width = $(this).css('width');
		var matching_ul = $('ul.' + elem_class);
		matching_ul.css('visibility','visible');
		matching_ul.css('min-width', elem_width);
	}).mouseleave(function() {
		 var elem_class =$(this).attr('class');
		 $('ul.' + elem_class).css('visibility','hidden'); 
	});
	$('#dropdowns ul').mouseenter(function() {
		$(this).css('visibility','visible');
	}).mouseleave(function() {
		$(this).css('visibility','hidden'); }); 	
});