function validateEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function contact_user(){
	var name = $("#contact_name").val();
    var email = $("#contact_email").val();
    var country = $("#country").val();
    var phone = $("#phone").val();
    var message = $("#message").val();
    var interested_in = $('input[name=interested_in]:checked', '#contactus_from').val();
    var msg = "";
    if(name==""){
        $("#error_contact_name").html("Please enter your name.");
		msg=1;
    }
    if(email==""){
        $("#error_contact_email").html("Please enter your email address.");
		msg=1;
    }else{
		if (!validateEmail(email)) {
			$("#error_contact_email").html("Please enter vaild email address");
			msg=1;
        }
    }
    if(country==""){
		$("#error_contact_country").html("Please enter country");
		msg=1;
	}
	if(phone==""){
		$("#error_contact_phone").html("Please enter phone number.");
		msg=1;
	}
	if($("#vaildphoneno").val()!=1){
		$("#error_contact_phone").html("Please enter vaild Phone number.");
		msg=1;
    }
    if(message==""){
		$("#error_contact_msg").html("Please enter message.");
		msg=1;
   	}
	
	if(msg==""){
		$.ajaxSetup({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
		});
		$.ajax({
                   	url: $("#site_url").val()+"/save_contact_detail",
					method: 'post',
					data: $('#contactus_from').serialize(),
					success: function(response){
                                   $("#model_name_user").html(name);
                                   $("#myModalsell-out-sumit1").modal('show');
                                   $("#contact_name").val("");
                                   $("#contact_email").val("");
                                   $("#contact_country").val("");
                                   $("#phone").val("");
                                   $("#message").val("");
                                   $("#error_contact_name").html("");
                                   $("#error_contact_email").html("");
                                   $("#error_contact_country").html("");
                                   $("#error_contact_phone").html("");
                                   $("#error_contact_msg").html("");
                                   $("#test1").attr("checked",true);
                                   $("#test2").attr("checked",false);
                                   $("#test3").attr("checked",false);

                    }
        });
    }
}

function removeerror(val){
	$("#"+val).css("display","none");
}


function bookcar(id){
    $.ajax({
                   	url: $("#site_url").val()+"/add_book_Car",
					method: 'get',
					data: {id:id},
					success: function(response){
                           if(response==1){
                               $("#book_mark_"+id).css("color","chartreuse");
                           }else{
                               $("#book_mark_"+id).css("color","white");
                           }
                    }
        });
}

function bookcardetail(id){
     $.ajax({
                   	url: $("#site_url").val()+"/add_book_Car",
					method: 'get',
					data: {id:id},
					success: function(response){
                           if(response==1){
                               $("#book_mark_"+id).css("color","chartreuse");
                           }else{
                               $("#book_mark_"+id).css("color","black");
                           }
                    }
        });
}

function removeemail(val,val1){
	if (!validateEmail(val)) {
 		 $("#"+val1).html("Please enter vaild email address.");
 	}else{
 		$("#"+val1).css("display","none");
 	}
}

$(document).ready(function () {    
    
            $('.numberonly').keypress(function (e) {    
    
                var charCode = (e.which) ? e.which : event.keyCode    
    
                if (String.fromCharCode(charCode).match(/[^0-9]/g))    
    
                    return false;                        
    
            });    
    
        });  

function openclosemodel(val,val1){
	alert(val+" "+val1);
	$("#"+val1).model("show");
	
}

function changemodelnew(val1){
	$("#"+val1).model("show");
}

function placelivebid(){
    var bid_amount = $("#bid_amount").val();
    var amount = $("#bid_amount_html").html();
    var next_bid = $("#next_min_bid").html();
    const bid1 = bid_amount.replace(/,/g, '');
    const bid2 = amount.replace(/,/g, '');
     const bid3 = next_bid.replace(/,/g, '');
    
    if(bid_amount==""){
        swal("Please enter bid amount!.");
    }else{
    	    if(parseFloat(bid3)>parseFloat((bid1))){
    	    	console.log("amount small");
    	    	swal("Please enter amount greater than "+next_bid+".");
    	    }else if (parseFloat((bid1)) < parseFloat(Number(bid2))) {
    	        
               swal("Amount is less then current bid!.");
            }else{ 
            	        $.ajax({
				                url: $("#site_url").val()+"/get_txt",
				                method:'get',
				                data : {bid_amount:bid_amount.replace(/,/g, '')},
				                success: function( data ) {
				                	   $("#bid_currency").html($("#car_currency").html());
					                   $("#place_bid_amount").html(bid_amount);
					                   $("#car_bid_id").val($("#car_id").val());
					                   $("#bid_type").val(1);
					                   $("#commission").html($("#car_currency").html()+data);
					                   $("#confirm_bid_amount").modal('show');
               					}
               			}); 
            }
    }
  
}

function showbid(){
    $(".bid_div").css("display","block");
    $(".comment_div").css("display","none");
}
function confirmlivebid(){
     var bid_amount = $("#place_bid_amount").html();
      var car_id = $("#car_bid_id").val();
      var type = $("#bid_type").val();
      if($("#agree").prop("checked")==false){
          alert("Please confirm your bid amount.");
      }else{
            $.ajaxSetup({
			    headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
    		});
            $.ajax({
                       	url: $("#site_url").val()+"/add_live_bid",
    					method: 'post',
    					data: {bid_amount:bid_amount,car_id:car_id,type:type},
    					success: function(response){
    					     $("#confirm_bid_amount").modal('hide');
    						 $("#success_bid").modal('show');
    						 $("#dis_bid_amount").html($("#car_currency").html()+bid_amount);
    						 $("#bid_user_name").html(response);
    						 
                        }
            });
      }
      	
}



function placemaxbid(){
    var bid_amount = $("#bid_amount").val();
    var amount = $("#bid_amount_html").html();
    const bid1 = bid_amount.replace(/,/g, '');
    const bid2 = amount.replace(/,/g, '');
    if (parseFloat((bid1)) < parseFloat(Number(bid2))) {
       alert("Amount is less then current bid.");
    }else{
        $.ajax({
				  url: $("#site_url").val()+"/get_txt",
				  method:'get',
				  data : {bid_amount:bid_amount.replace(/,/g, '')},
				  success: function( data ) {
				          $("#bid_currency").html($("#car_currency").html());
					      $("#place_bid_amount").html(bid_amount);
					      $("#car_bid_id").val($("#car_id").val());
					       $("#bid_type").val(2);
					      $("#commission").html($("#car_currency").html()+data);
					      $("#confirm_bid_amount").modal('show');
               		}
        });
    }
}
function changemodel(val){
	//alert(val);
	$("#reg_pharse_1_content").css("display","none");
	$("#reg_pharse_2_content").css("display","none");
	$("#login_content").css("display","none");
	$("#forgot_content").css("display","none");
	$("#"+val).css("display","block");
}

function detaillogin(val){
    $("#same_page").val(1);
    changemodel(val);
}
function dealerregisteruser(val){
	//alert("hey");
	var name = $("#"+val+"_name").val();
	var dealership_name = $("#"+val+"_dealership_name").val();
	var dealership_p_number = $("#"+val+"_dealership_p_number").val();
	var address = $("#"+val+"_address").val();
	var street_address = $("#"+val+"_street_address").val();
	var city = $("#"+val+"_locality").val();
	var state = $("#"+val+"_state").val();
	var country = $("#"+val+"_country").val();
    var email = $("#"+val+"_email").val();
    var password = $("#"+val+"_password").val();
    if(val=="reg1"){
    	var phone = $("#phone_pay").val();
    }else{
    	var phone = $("#"+val+"_phone").val();
    }
    
    var cpwd = $("#"+val+"_cpassword").val();
    
   
    var msg = "";
    var txt = "";
   
    if(name==""){
        txt = txt+"<li>Name is required</li>";
		msg=1;
    }
    if(dealership_name==""){
        txt = txt+"<li>Dealership name is required</li>";
		msg=1;
    }
    if(dealership_p_number==""){
        txt = txt+"<li>Dealership P Number is required</li>";
		msg=1;
    }
    if(address==""){
        txt = txt+"<li>Address is required</li>";
		msg=1;
    }
    if(street_address==""){
        txt = txt+"<li>Street Address is required</li>";
		msg=1;
    }
    if(city==""){
        txt = txt+"<li>City is required</li>";
		msg=1;
    }
    if(state==""){
        txt = txt+"<li>State is required</li>";
		msg=1;
    }
    if(email==""){
        txt = txt+"<li>Please enter your email address.</li>";
		msg=1;
    }else{
		if (!validateEmail(email)) {
			txt = txt+"<li>Please enter vaild email address.</li>";
			msg=1;
        }
    }
    if(password==""){
        txt = txt+"<li>Please enter your password.</li>";
		msg=1;
    }else{
    	 if (password.length >= 8){

	     }else{
	     	 txt = txt+"<li>At least 1 digit.At least 8 character.</li>";     	 
	     	 msg=1;
	     	 if(password.match(/[0-9]/g)){
	     	
		     }else{
		     	txt = txt+"<li>At least 1 digit.</li>";     	 
		     	 msg=1;
		     } 
	     }
    }  
    if(cpwd==""){
        txt = txt+"<li>Please enter your confirm password.</li>";
		msg=1;

    }else{
    	if(password!=cpwd){
			txt = txt+"<li>Confirm password and password must be same.</li>";
			msg=1;
	    }
    }
    
    if(country==""){
		txt = txt+"<li>Please enter country.</li>";
		msg=1;
	}
	if(phone==""){
		txt = txt+"<li>Please enter phone number.</li>";
		msg=1;
	}else{
		if($("#vaildphoneno_reg").val()!=1){
			txt = txt+"<li>Please enter vaild phone number.</li>";
			msg=1;
	    }
	}
	
	
	
	
	if(msg==""){
		$.ajaxSetup({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
		});
		$.ajax({
                   	url: $("#site_url").val()+"/register_user",
					method: 'post',
					data: $('#'+val+'_registation_form').serialize(),
					success: function(response){
						if(response==1){
						   	$('#'+val+'_registation_form').trigger("reset");                      
	                        changemodel("reg_pharse_2_content");	                       
						}else if(response==2){ // email not unqiue
							$("#"+val+"_error").html("Email address already exist.");
    	 					$("#"+val+"_error").addClass("errorbox");
						}else if(response==3){
							$("#"+val+"_error").html("Username must be unique.");
    	 					$("#"+val+"_error").addClass("errorbox");
						}else{

						}                        

                    }
        });
    }else{
    	 $("#"+val+"_error").html(txt);
    	 $("#"+val+"_error").addClass("errorbox");
    }
}
function registeruser(){
	//alert("hey");
	var username = $("#reg_username").val();
    var email = $("#reg_email").val();
    var password = $("#reg_password").val();
    var country = $("#country_reg").val();
    var phone = $("#phone_reg").val();
    var cpwd = $("#cpassword_reg").val();
    
   
    var msg = "";
    var txt = "";
   
    if(username==""){
        txt = txt+"<li>Please enter your username.</li>";
		msg=1;
    }else{
    	if($("#vaildusername").val()==0){
		    txt = txt+"<li>Username already taken.</li>";
			msg=1;
	    } 
    }
    if(email==""){
        txt = txt+"<li>Please enter your email address.</li>";
		msg=1;
    }else{
		if (!validateEmail(email)) {
			txt = txt+"<li>Please enter vaild email address.</li>";
			msg=1;
        }
        if($("#vaildemail").val()==0){
		    txt = txt+"<li>Email address already register.</li>";
			msg=1;
	    }
    }
    if(password==""){
        txt = txt+"<li>Please enter your password.</li>";
		msg=1;
    }else{
    	 if (password.length >= 8){

	     }else{
	     	 txt = txt+"<li>At least 1 digit.At least 8 character.</li>";     	 
	     	 msg=1;
	     	 if(password.match(/[0-9]/g)){
	     	
		     }else{
		     	txt = txt+"<li>At least 1 digit.</li>";     	 
		     	 msg=1;
		     } 
	     }
    }  
    if(cpwd==""){
        txt = txt+"<li>Please enter your confirm password.</li>";
		msg=1;

    }else{
    	if(password!=cpwd){
			txt = txt+"<li>Confirm password and password must be same.</li>";
			msg=1;
	    }
    }
    
    if(country==""){
		txt = txt+"<li>Please select country.</li>";
		msg=1;
	}
	if(phone==""){
		txt = txt+"<li>Please enter phone number.</li>";
		msg=1;
	}else{
		if($("#vaildphoneno_reg").val()!=1){
			txt = txt+"<li>Please enter vaild phone number.</li>";
			msg=1;
	    }
	}
	
	
	if($("#cond_reg_1").prop("checked")==false){
    	txt = txt+"<li>Please agree to the terms & conditions.</li>";
		msg=1;
	}
	/* var recaptcha_response = grecaptcha.getResponse();;
     if(recaptcha_response.length == 0) {
         txt = txt+"<li>Please Verified Captcha code</li>";
       // document.getElementById('g-recaptcha-error').innerHTML = '<span style="color:red;">This field is required.</span>';
        msg=1;
    }*/
	
	if(msg==""){
		$.ajaxSetup({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
		});
		$.ajax({
                   	url: $("#site_url").val()+"/register_user",
					method: 'post',
					data: $('#user_registration_form').serialize(),
					success: function(response){
						if(response==1){
							$("#username").val("");
						    $("#reg_email").val("");
						    $("#reg_password").val("");
						    $("#country_reg").val("");
						    $("#phone_reg").val("");
						    $("#cpassword_reg").val("");
	                        $("#error_reg_username").html("");
	                        $("#error_reg_email").html("");
	                        $("#error_reg_password").html("");
	                        $("#error_reg_confirm_password").html("");
	                        $("#error_reg_country").html("");
	                        $("#error_reg_phone").html("");
	                        $("#cond_reg_2").attr("checked",false);
	                        $("#cond_reg_1").attr("checked",false);
	                        $("#reg_error").removeClass("errorbox");
	                        changemodel("reg_pharse_2_content");	                       
						}else if(response==2){ // email not unqiue
							$("#reg_error").html("Email address already exist.");
    	 					$("#reg_error").addClass("errorbox");
						}else if(response==3){
							$("#reg_error").html("Username must be unique.");
    	 					$("#reg_error").addClass("errorbox");
						}else{

						}
                        

                    }
        });
    }else{
    	 $("#reg_error").html(txt);
    	 $("#reg_error").addClass("errorbox");
    }
}


function checkpasswordvaildation(val) {
            var res;
            var str = $("#reg_password").val();
            if (str.match(/[a-z]/g) && str.match(
                    /[A-Z]/g) && str.match(
                    /[0-9]/g) && str.match(
                    /[^a-zA-Z\d]/g) && str.length >= 8)
                res = "TRUE";
            else
                res = "FALSE";
            
  
        }

function checkusername(val){
			$.ajax({
                   	url: $("#site_url").val()+"/check_username?username="+val,
					method: 'get',
					success: function(response){
						 if(response==1){
								$("#reg_error").html("This username already taken.");
    	 						$("#reg_error").addClass("errorbox");
    	 						$("#username").val("");
    	 						$("#vaildusername").val(0);
						 }else{
						 		$("#reg_error").html("");
    	 						$("#reg_error").removeClass("errorbox");
    	 						$("#vaildusername").val(1);
    	 						
						 }
					}
			});
}

function check_email_reg(val){
	$.ajax({
                   	url: $("#site_url").val()+"/check_email",
					method: 'get',
					data: {email:val},
					success: function(response){
						if(response==1){
							     $("#reg_error").html("Email address already register.");
    	 						$("#reg_error").addClass("errorbox");
    	 						$("#reg_email").val();
    	 						$("#vaildemail").val(0);
						}else{
							    $("#reg_error").html("");
    	 						$("#reg_error").removeClass("errorbox");
    	 						$("#vaildemail").val(1);
						}
                    }
        });
}


function getstatebycountry(val,ids){
   $.ajax({
                   	url: $("#site_url").val()+"/getstatelist?id="+val,
					method: 'get',
					success: function(response){
						var str = JSON.parse(response);
						var txt = "";
						var key1 = "";
						for(var i=0;i<str.length;i++){
							txt = txt+'<option value="'+str[i].id+'">'+str[i].name+'</option>';
							if(i==0){
								key1 = str[i].id;
							}
						}
						$("#state_"+ids).html(txt);
						//getcitybystate(key1,ids);
					}
			});
}

function getcitybystate(val,ids){
            $.ajax({
                   	url: $("#site_url").val()+"/getcitylist?id="+val,
					method: 'get',
					success: function(response){
						var str = JSON.parse(response);
						var txt = "";
						for(var i=0;i<str.length;i++){
							txt = txt+'<option value="'+str[i].id+'">'+str[i].name+'</option>';
						}
						$("#city_"+ids).html(txt);
					}
			});
}

function verifyCaptcha(token) {
    recaptcha_response = token;
    document.getElementById('g-recaptcha-error').innerHTML = '';
}

function post_login(){
    
	var email = $("#login_email").val();
    var password = $("#login_password").val();
    var txt = "";
    var msg = "";
	if(email==""){
        txt = txt+"<li>Please enter your email address.</li>";
		msg=1;
    }else{
		if (!validateEmail(email)) {
			txt = txt+"<li>Please enter vaild email address.</li>";
			msg=1;
        }
    }
    if(password==""){
        txt = txt+"<li>Please enter your password.</li>";
		msg=1;
    }
    /*var recaptcha_response = grecaptcha.getResponse();;
     if(recaptcha_response.length == 0) {
         txt = txt+"<li>Please tick I'm not a robot.</li>";
        msg=1;
    }*/
    if(msg==""){
		$.ajaxSetup({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
		});
		$.ajax({
                   	url: $("#site_url").val()+"/login_user",
					method: 'post',
					data: $('#login_form').serialize(),
					success: function(response){
						if(response==1){
						    if($("#same_page").val()==0){
						         window.location.href = $("#site_url").val()+"/myaccount"; 
						    }else{
						        window.location.reload();
						    }
							                
						}else if(response==2){
							$("#login_error").html("Please activate your account.");
    	 					$("#login_error").addClass("errorbox");                
						}else{ // email not unqiue
							$("#login_error").html("The email or password you entered is incorrect.");
    	 					$("#login_error").addClass("errorbox");
						}
                    }
        });
    }else{
    	 $("#login_error").html(txt);
    	 $("#login_error").addClass("errorbox");
    }
}

function addcomment(){
    var desc = $("#comment_desc").val();
    var car_id = $("#car_id").val();
    var txt = "";
    var msg = "";
	if(desc==""){
	    $("#error_msg_comment").html("Please enter your comment.");
		msg=1;
    }
    if(msg==""){
		$.ajaxSetup({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
		});
		$.ajax({
                   	url: $("#site_url").val()+"/add_comment",
					method: 'post',
					data: {desc:desc,car_id:car_id},
					success: function(response){
						    $("#comment_area").append(response);
                    }
        });
    }else{
    	 $("#error_msg_comment").css("color","red");
    }
}
function forgotpassword(){
	var email = $("#forgot_email").val();
    var msg = "";
	if(email==""){
	     $("#error_forgot_email").css("color","red");
		$("#error_forgot_email").html("Please enter your recovery email address.");
		msg=1;
    }else{
		if (!validateEmail(email)) {
		     $("#error_forgot_email").css("color","red");
			$("#error_forgot_email").html("Please enter your vaild email address.");
			msg=1;
        }
    }
    if(msg==""){
		$.ajaxSetup({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
		});
		$.ajax({
                   	url: $("#site_url").val()+"/user_forgotpassword",
					method: 'post',
					data: $('#forgot_pwd_from').serialize(),
					success: function(response){
					        $("#success_forgot_mail").css("color","green");
							$("#success_forgot_mail").html("An email is on its way to you. If an account exists for that email address then a reset link will have been sent to that inbox.");  
						
                    }
        });
    }
}

function updateinvoicedetail(){
    var company_name = $("#company_name_in").val();
    var billing_address = $("#billing_address_in").val();
    var state = $("#state_in").val();
    var country = $("#country_in").val();
    var city = $("#city_in").val();
    var phone = $("#phone").val();
    var vat_no = $("#vat_no").val();
    var pincode_in = $("#pincode_in").val();
    var msg = "";  
    if(company_name==""){
        $("#error_company_name").html("Please enter company name.");
		msg=1;
    }
    if(billing_address==""){
    	$("#error_billing_address").html("Please enter billing address.");
		msg=1;
    }
    if(state==""){
        $("#error_state_in").html("Please select your state.");
		msg=1;
    }
    if(city==""){
        $("#error_city_in").html("Please select your city.");
		msg=1;
    }
    if(vat_no==""){
        $("#error_vat_no").html("Please enter your vat number.");
		msg=1;
    }
    if(pincode_in==""){
        $("#error_pincode_in").html("Please enter pincode.");
		msg=1;
    }
    
    if(country==""){
    	$("#error_country_in").html("Please select country.");
		msg=1;
	}
	if(phone==""){
		$("#error_in_phone").html("Please enter phone number.");
		msg=1;
	}else{
		if($("#vaildphoneno_in").val()!=1){
			$("#error_in_phone").html("Please enter vaild phone number.");
			msg=1;
	    }
	}
	
	if(msg==""){
		$.ajaxSetup({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
		});
		$.ajax({
                   	url: $("#site_url").val()+"/update_invoice_detail",
					method: 'post',
					data: $('#invoice_payment_address').serialize(),
					success: function(response){
						if(response==1){
							
	                        window.location.reload();	                       
						}
                    }
        });
    }
}

function resetpassword(){
	var npwd = $("#npwd").val();
	var rpwd = $("#rpwd").val();
    var msg = "";
	if(npwd==""){
		$("#error_reset_npwd").html("Please enter your new password");
		msg=1;
    }
    if(rpwd==""){
		$("#password_error").html("Please re-enter your new password");
		msg=1;
    }
    if(npwd!=rpwd){
		$("#password_error").html("New password and re-enter password must be same.");
		msg=1;
    }
    else if(npwd!=""&&rpwd!=""){
        if (npwd.length >= 8){
            if(npwd.match(/[0-9]/g)){
                
            }else{
                $("#password_error").html("At least 1 digit.");
                msg=1;         
            }
        }else{
            $("#password_error").html("At least 8 character.");
            msg=1;
        }
    }
     
    
       
         
    if(msg==""){
		$.ajaxSetup({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
		});
		$.ajax({
                   	url: $("#site_url").val()+"/reset_new_password",
					method: 'post',
					data: $('#reset_from').serialize(),
					success: function(response){
						if(response==1){                             
							$("#password_error").html(""); 
							$("#error_reset_npwd").html(""); 
							$("#npwd").val("");
							$("#rpwd").val("");     
							changemodel('login_content');
                            $('#register_user_model').modal('show');     
						}else{ // email not unqiue
							$("#password_error").html("Reset code expired you need reset again.");
						}
                    }
        });
    }
}
function sellwithus(){
    var name = $("#seller_name").val();
    var email = $("#seller_email").val();
    var phone = $("#phone").val();
    var make = $("#make").val();
    var model = $("#model").val();
    var country = $("#country").val();
    var txt = "";
    var msg = "";
	if(email==""){
        txt = txt+"<li>Please enter your email address.</li>";
		msg=1;
    }else{
		if (!validateEmail(email)) {
			txt = txt+"<li>Please enter vaild email address.</li>";
			msg=1;
        }
    }
    if(name==""){
        txt = txt+"<li>Please enter your name.</li>";
		msg=1;
    }
    if(make==""){
        txt = txt+"<li>Please select make.</li>";
		msg=1;
    }
    if(model==""){
        txt = txt+"<li>Please enter vehicle model.</li>";
		msg=1;
    }
    if(phone==""){
		txt = txt+"<li>Please enter phone number.</li>";
		msg=1;
	}else{
		if($("#vaildphoneno").val()!=1){
			txt = txt+"<li>Please enter vaild phone number</li>";
			msg=1;
	    }
	}
	if(country==""){
		txt = txt+"<li>Please select country.</li>";
		msg=1;
	}
    if(msg==""){
		$.ajaxSetup({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
		});
		$.ajax({
                   	url: $("#site_url").val()+"/post_sell_with_us",
					method: 'post',
					data: $('#sell_with_us').serialize(),
					success: function(response){
						if(response==1){
							$("#seller_name").val("");
						    $("#seller_email").val("");
						    $("#phone").val("");
						    $("#make").val("");
						    $("#model").val("");
						    $("#country").val("");
						    $("#sell_error").html("");
    						$("#sell_error").removeClass("errorbox");
							$("#model_name_user").html(name);
                            $("#myModalsell-out-sumit1").modal('show');                
						}else{
							$("#sell_error").html("Something getting worng.");
    	 					$("#sell_error").addClass("errorbox");
						}
                    }
        });
    }else{
    	 $("#sell_error").html(txt);
    	 $("#sell_error").addClass("errorbox");
    }
}

function subscriberuser(){
    var email = $("#sub_email").val();
    var msg = "";
	if(email==""){
		$("#sub_email_error").html("Please enter your email address.");
		msg=1;
    }else{
		if (!validateEmail(email)) {
			$("#sub_email_error").html("Please enter vaild email address.");
			msg=1;
        }
    }
    if(msg==""){
		$.ajaxSetup({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
		});
			$.ajax({
	                   	url: $("#site_url").val()+"/newsletter_user",
						method: 'post',
						data: $('#subscriber_form').serialize(),
						success: function(response){
							$("#model_email").html(email);
							$("#sub_email").val("");
	                        $("#subscriber_news").modal('show');
	                    }
	        });
    }
}


function update_mydetail(){
	var username = $("#username").val();
    var email = $("#useremail").val();
    var msg = "";
	if(username==""){
		$("#error_username").html("The name has already been taken");
		$("#error_msg_username").html('<i class="fas fa-times-circle"></i>');
		msg=1;
    }
    if(email==""){
    	$("#error_msg_email").html('<i class="fas fa-times-circle"></i>');
    }else{
		if (!validateEmail(email)) {
			$("#error_msg_email").html('<i class="fas fa-times-circle"></i>');
			msg=1;
        }
    }
    if(msg==""){
		$.ajaxSetup({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
		});
		var fd = new FormData();
        var files = $('#upload_image')[0].files;
        fd.append('file',files[0]);
        fd.append('username',username);
        fd.append('email',email);

			$.ajax({
	                   	url: $("#site_url").val()+"/update_my_detail",
						method: 'post',
						contentType: false,
             			processData: false,
						data: fd,
						success: function(response){
						    if(response==1){
						        $("#btnmydetail").addClass('update-icons');
						    }else{
						       
						    }
							
	                    }
	        });
    }
}

function changepassword(){
    var cpwd = $("#cpwd").val();
    var npwd = $("#npwd").val();
    var msg = "";
	if(cpwd==""){
		$("#error_msg_cpwd").html('<i class="fas fa-times-circle"></i>');
		msg=1;
    }
    if(npwd==""){
    	$("#error_msg_cpwd").html('<i class="fas fa-times-circle"></i>');
    }

    if(msg==""){
		$.ajaxSetup({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
		});
		var fd = new FormData();
        fd.append('cpwd',cpwd);
        fd.append('npwd',npwd);

			$.ajax({
	                   	url: $("#site_url").val()+"/update_my_password",
						method: 'post',
						contentType: false,
             			processData: false,
						data: fd,
						success: function(response){
							$("#btnchangepwd").addClass('update-icons');
	                    }
	        });
    }
}

function emailsubscription(){
	if($("#promotions_email_notification").prop("checked")==true){
		var promotions_email_notification = 1;
	}else{
		var promotions_email_notification = 0;
	}
	if($("#trade_news_email_notification").prop("checked")==true){
		var trade_news_email_notification = 1;
	}else{
		var trade_news_email_notification = 0;
	}
	$.ajaxSetup({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
		});
     $.ajax({
                   	url: $("#site_url").val()+"/emailsubscription",
					method: 'post',
					data: {promotions_email_notification:promotions_email_notification,trade_news_email_notification:trade_news_email_notification},
					success: function(response){
						if(response==1){
							$("#emailnotibtn").addClass('update-icons');
						}
                    }
     });
}


function notification(){
	if($("#watcher_comment_notification").prop("checked")==true){
		var watcher_comment_notification = 1;
	}else{
		var watcher_comment_notification = 0;
	}
	if($("#outbid_sms_notification").prop("checked")==true){
		var outbid_sms_notification = 1;
	}else{
		var outbid_sms_notification = 0;
	}
	$.ajaxSetup({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
		});
     $.ajax({
                   	url: $("#site_url").val()+"/notificationuser",
					method: 'post',
					data: {outbid_sms_notification:outbid_sms_notification,watcher_comment_notification:watcher_comment_notification},
					success: function(response){
						if(response==1){
							$("#btnnotifi").addClass('update-icons');
						}
                    }
     });
}

function checkcurrentpwd(val){
	 $.ajax({
                   	url: $("#site_url").val()+"/check_user_pwd",
					method: 'get',
					data: {password:val},
					success: function(response){
						if(response==0){
							$("#error_msg_cpwd").html('<i class="fas fa-times-circle"></i>');
						}else{
							$("#error_msg_cpwd").html('<i class="fas fa-check-circle"></i>');
						}
                    }
     });
}

function check_username(val){
	    $.ajax({
                   	url: $("#site_url").val()+"/check_username",
					method: 'get',
					data: {username:val},
					success: function(response){
						if(response==1){
							$("#error_msg_username").html('<i class="fas fa-times-circle"></i>');
						}else{
							$("#error_msg_username").html('<i class="fas fa-check-circle"></i>');
						}
                    }
        });
}

function check_email(val){
	$.ajax({
                   	url: $("#site_url").val()+"/check_email",
					method: 'get',
					data: {email:val},
					success: function(response){
						if(response==1){
							$("#error_msg_email").html('<i class="fas fa-times-circle"></i>');
						}else{
							$("#error_msg_email").html('<i class="fas fa-check-circle"></i>');
						}
                    }
        });
}

function checkactivefilter(val){
	for(var i=1;i<5;i++){
		$("#ls_"+i).removeClass('active-2');
		$("#header_"+i).addClass('hide');
		$("#container_"+i).addClass('hide');
		
	}
	$("#ls_"+val).addClass('active-2');
	$("#header_"+val).removeClass('hide');
		$("#container_"+val).removeClass('hide');
}


function settimezone(){
	var d = new Date();
    var n = d.getTimezoneOffset();
	$.ajax({
			url: $("#site_url").val() + "/getcurrenttime"+"/"+n,
			success: function (res) {
			    var str=JSON.parse(res);
			    $("#timezone").val(str.timezone);			   
			}
	});	
}

function convertUTCToTimezone(utcDt, utcDtFormat, timezone,format1) {
    return moment.utc(utcDt, utcDtFormat).tz($("#timezone").val()).format(format1);
}

function gettimezone(){
    return $("#timezone").val();
}

if($("#current_timezone").val()==""||$("#current_timezone").val()==false){
	   console.log("hey");
                var d = new Date();
			    var n = d.getTimezoneOffset();
				$.ajax({
						url: $("#site_url").val() + "/getcurrenttime"+"/"+n,
						success: function (res) {
						    var str=JSON.parse(res);
						    $("#current_timezone").val(str.timezone);			   
						}
				});	 
}