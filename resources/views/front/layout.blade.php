<!doctype html>
<html lang="en">
   <head>
      <title>@yield('title')</title>
      <link rel="icon" type="image/png" href="{{asset('public/theme/images/favicon16x16.png')}}" sizes="16x16">
      <link rel="icon" type="image/png" href="{{asset('public/theme/images/favicon32x32.png')}}" sizes="32x32">
      <link rel="icon" type="image/png" href="{{asset('public/theme/images/favicon96x96.png')}}" sizes="96x96">
      <link rel="apple-touch-icon" sizes="72x72" href="{{asset('public/theme/images/touch-ipad.png')}}">
      <link rel="apple-touch-icon" sizes="114x114" href="{{asset('public/theme/images/touch-iphone.png')}}">
      <link rel="apple-touch-icon" sizes="152x152" href="{{asset('public/theme/images/touch-ipad-ret.png')}}">
       <link rel='stylesheet' href='https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css'>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      @yield('meta-data')
      <!-- Bootstrap CSS -->
      <link href="{{asset('public/theme/css/bootstrap.min.css')}}" rel="stylesheet">
      <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.4/css/all.css"
         integrity="sha384-rqn26AG5Pj86AF4SO72RK5fyefcQ/x32DNQfChxWvbXIyXFePlEktwD18fEz+kQU" crossorigin="anonymous">
      <link href="{{asset('public/theme/css/main.css?v=1.0')}}" rel="stylesheet">
      <link href="{{asset('public/theme/css/code.css?v=933')}}" rel="stylesheet">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/css/intlTelInput.css" rel="stylesheet" media="screen">
      {!! NoCaptcha::renderJs() !!}
   </head>
   <body>
      <!-- header Start -->
      <div class="static-header" style="background-color: black;position: fixed;top: 0px;width: 100%;z-index: 99999;opacity: 80%;">
         <div class="container">
            <div class="row" style="height: 30px; padding-top: 2px; color: white; top: 0px; overflow: hidden;">
               <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                  <p><a href="mailto:sales@frontlinereadytx.com"><i class="fa fa-envelope-o"></i>  sales@frontlinereadytx.com</a></p>
               </div>
               <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
               </div>
               <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
               </div>
               <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="text-align: right;">
                  <p><i class="fa fa-file-pdf-o"></i><a target="_blank" href="{{asset('storage/app/public/').'/'.$setting->inventory_pdf}}">  Download Current Inventory</a>
                     <!-- @if(Auth::id())
                     <a target="_blank" href=""></a>
                     @else
                     <a data-bs-toggle="modal" class="btn_border" data-bs-target="#register_user_model" href="#" onclick="changemodel('login_content')">Login to d/a>
                     @endif -->
                  </p>
               </div>                              
            </div>
         </div>
      </div>
      <div class="top-header-hold">
         <div class="container">
            <div class="row">
               <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                  <div class="header-humburger">
                     <div class="only-responsive-show">
                        <span class="openNav" style="color: #000;font-size:27px;cursor:pointer">&#9776;</span>
                        <div id="mySidenav" class="sidenav">
                           <a href="javascript:void(0)" class="closeNav closebtn">&times;</a>
                           <ul class="top-nav-bar">
                              <li class="<?=Session::get("menu_active")==1?'active':''?>"><a href="{{route('home')}}">Home</a></li>
                              <li class="<?=Session::get("menu_active")==2?'active':''?>"><a href="{{route('about-us')}}">About us</a></li>
                              <li class="<?=Session::get("menu_active")==3?'active':''?>"><a href="{{route('inventory')}}">Inventory</a></li>
                              <li class="<?=Session::get("menu_active")==6?'active':''?>"><a href="{{route('contact-us')}}">Contact us</a></li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="logo-nav">
                     <a href="{{route('home')}}">
                     <img src="{{asset('public/logo/grayscale_transparent.png')}}" style="width: 138px;height: 88px;">
                     </a>
                  </div>
               </div>
               <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                  <ul class="top-nav-bar desktop-hold">
                     <li class="<?=Session::get("menu_active")==1?'active':''?>"><a href="{{route('home')}}">Home</a></li>
                     <li class="<?=Session::get("menu_active")==2?'active':''?>"><a href="{{route('about-us')}}">About us</a></li>
                     <li class="<?=Session::get("menu_active")==3?'active':''?>"><a href="{{route('inventory')}}">Inventory</a></li>
                     <li class="<?=Session::get("menu_active")==6?'active':''?>"><a href="{{route('contact-us')}}">Contact us</a></li>         
                  </ul>
               </div>
            </div>
         </div>
      </div>
      </div>
      @yield('content')
      <div class="footer_main_box">
         <div class="container">
           <!-- <div class="row">
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="logo-nav">
                     <img src="{{asset('public/logo/original_logo.png')}}">
                  </div>
               </div>
            </div>-->
            <div class="row">
               <!-- <div class="col-lg-4 col-md-3 col-sm-3 col-xs-12">
                  <div class="footer-heading-contents">
                     <h5>Auctions</h5>
                     <ul>
                        <li><a href="{{route('auction',['id'=>1])}}">Live</a></li>
                        <li><a href="{{route('auction',['id'=>1])}}">Coming Soon</a></li>
                        <li><a href="{{route('auction',['id'=>4])}}">Sold</a></li>
                     </ul>
                  </div>
               </div> -->
               <!-- <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                  <div class="footer-heading-contents">
                     <h5>Selling</h5>
                     <ul>
                        <li><a href="{{route('sell-with-us')}}">Sell with us</a></li>
                        <li><a href="{{route('sell-with-us')}}#submit_entry_from">Submit an entry</a></li>
                     
                     </ul>
                  </div>
               </div> -->
               <div class="col-lg-4 col-md-3 col-sm-3 col-xs-12">
                  <div class="footer-heading-contents">
                     <h5>About Us</h5>
                     <ul>
                        <li><a href="{{route('contact-us')}}">Contact Us</a></li>
                        <li><a href="{{route('term-privacy')}}">Privacy Policy</a></li>
                        <li><a href="{{route('term-privacy')}}">Terms and Conditions</a></li>
                        <li><a href="{{route('cookie-policy')}}">Cookie Policy</a></li>
                     </ul>
                  </div>
               </div>
               <div class="col-lg-4 col-md-3 col-sm-3 col-xs-12"></div>
               <div class="col-lg-4 col-md-3 col-sm-3 col-xs-12">
                  <div class="footer-heading-contents">
                     <!-- <h5>In The Spotlight</h5> -->
                     <h5></h5>
                     <div class="social-media-links show-desktop">
                        <ul>
                           <li><a href="{{$setting->facebook_id}}" target="_blank"><i
                              class="fab fa-facebook-square"></i></a></li>
                           <li><a href="{{$setting->instgram_id}}" target="_blank"><i
                              class="fab fa-instagram-square"></i></a></li>
                           <li><a href="{{$setting->twitter_id}}" target="_blank"><i
                              class="fab fa-twitter-square"></i></a></li>
                        </ul>
                     </div>
                     <ul>
                        <!-- <li><a href="{{route('spotlight')}}">News</a></li> -->
                        <li></li>
                     </ul>
                     <div class="social-media-links show-mob-rep">
                        <ul>
                           <li><a href="{{$setting->facebook_id}}" target="_blank"><i
                              class="fab fa-facebook-square"></i></a></li>
                           <li><a href="{{$setting->instgram_id}}" target="_blank"><i
                              class="fab fa-instagram-square"></i></a></li>
                           <li><a href="{{$setting->twitter_id}}" target="_blank"><i class="fab fa-twitter-square"></i></a>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="footer-bottom-bar">
                     <ul>
                        <li>Copyright © {{date('Y')}} Front Line Ready.</li>
                        
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="modal fade" id="register_user_model">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <!-- Modal Header -->
         <div class="modal-header" style="border:unset">
            <button type="button" class="btn-close" data-bs-dismiss="modal">X</button>
         </div>
         <!-- Modal body -->
         <div class="modal-body" style="border:unset; padding: 15px 0px;">
            <div class="heading-border-section" style="margin-bottom:0px">
               <span class="firts"></span>
               <div class="container">
                  <div class="row">
                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-heading-cl-pos">
                        <div class="heading-box back-white-header">
                           <img src="{{asset('public/logo/grayscale_transparent.png')}}">
                        </div>
                     </div>
                  </div>
                 
                  <div class="row" id="reg_pharse_2_content">
                     <div class="form_contact_box register-form">
                        <h2>REGISTRATION COMPLETE</h2>
                        <br>
                        <p>Thank you for registering!</p>
                        <p>A Front Line Ready representative will be in contact with you shortly.</p>
                        <br>
                        <br>
                     </div>
                     <div class="end-border-and-btn">
                        <div class="actions-btn-hold btn_box_border">
                           <a class="btn_border" href="" style="padding:0px 45px;">BACK TO AUCTIONS <i
                              class="fal fa-long-arrow-right" style="margin-left: 8px;"
                              aria-hidden="true"></i></a>
                        </div>
                        <br>
                        <br>
                        <br>
                        <br>
                     </div>
                  </div>
                  <div class="row" id="login_content">
                     <div class="form_contact_box register-form">
                        <h2>WELCOME BACK</h2>
                        <p>Please sign in to your account.</p>
                        <form id="login_form">
                           <ul id="login_error"></ul>
                           <div class="contact_form_box register-form-head">
                              <div class="contact_login_box">
                                 <label>Email :</label>
                                 <input class="hight-input-add" type="email" name="email" id="login_email">
                                 <label>Password :</label>
                                 <input class="hight-input-add" type="password" name="password" id="login_password">
                                 <a href="javascript:changemodel('forgot_content')">Forgotten your password?</a>
                                 <a class="show-password" id="passwordshow" href="javascript:changeboxinput()">show password</a>
                                 <br>
                                  <!--<div class="g-recaptcha" data-sitekey="{{env('NOCAPTCHA_SITEKEY')}}" data-callback="verifyCaptcha"></div>
                                    <div id="g-recaptcha-error"></div>-->
                                  </div>
                              
                              <div class=" end-border-and-btn ">
                                 <div class="actions-btn-hold btn_box_border ">
                                    <a class="btn_border " href="javascript:post_login()" style="padding:0px 45px; ">CONTINUE <i
                                       class="fal fa-long-arrow-right" style="margin-left: 8px; "
                                       aria-hidden="true "></i></a>
                                 </div>
                              </div>
                              
                              <p style="font-size: 14px; ">Don’t have an account yet? - <a href="{{route('home')}}#submit_entry_from" style="color: #0b68aa;text-decoration: underline; ">Register here</a>
                              </p>
                           </div>
                        </form>
                     </div>
                  </div>
                  <div class="row" id="forgot_content">
                     <div class="form_contact_box register-form">
                        <h2>FORGOTTEN YOUR PASSWORD?</h2>
                        <p>Enter your email below to receive confirmation of your usename and a link to reset your password</p>
                        <form id="forgot_pwd_from">
                           <p id="success_forgot_mail"></p>
                           <div class="contact_form_box register-form-head">
                              <div class="contact_login_box">
                                 <label>Email :</label>
                                 <input class="hight-input-add" type="email" onblur="removeemail(this.value,'error_forgot_email')" name="email" id="forgot_email">
                                 <span id="error_forgot_email"></span>
                              </div>
                              <div class=" end-border-and-btn ">
                                 <div class="actions-btn-hold btn_box_border ">
                                    <a class="btn_border" href="javascript:forgotpassword()" style="padding:0px 45px; ">SEND ME THE
                                    LINK <i class="fal fa-long-arrow-right" style="margin-left: 8px; "
                                       aria-hidden="true "></i></a>
                                 </div>
                              </div>
                              <p style="font-size: 14px; ">Remember your details? <a href="javascript:changemodel('login_content')"
                                 style="color: #0b68aa;text-decoration: underline; ">Login</a></p>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
               <span class="second"></span>
            </div>
         </div>
         <!-- Modal footer -->
      </div>
   </div>
</div>
 <input type="hidden" id="current_timezone" value="{{Session::get('timezone')}}" />
<!-- notification icon
Please add a payment method to you account. My Account -->
      <!-- Footer end -->
 
      <script src="{{asset('public/theme/js/build.min.js')}}"></script>
      <script src="{{asset('public/theme/js/bootstrap.bundle.min.js')}}"></script>
      <input type="hidden" id="same_page" value="0"/>
      <script src="https://kit.fontawesome.com/7651e8d221.js" crossorigin="anonymous')}}"></script>
      <script src="{{asset('public/theme/js/cutsom.main.js')}}"></script>
      <input type="hidden" id="is_verified_falsh" value="{{Session::get('is_verified_falsh')}}">   
      <input type="hidden" id="site_url" value="{{route('home')}}">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/intlTelInput.min.js"></script> 
      <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/intlTelInput.js"></script> 
      <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.31/moment-timezone-with-data-2012-2022.min.js"></script>
      <script type="text/javascript" src="{{asset('public/theme/js/script.js?v=1.2345')}}"></script>      
      <script type="text/javascript" src="{{asset('public/theme/js/core.js?v=1.95622')}}"></script>
      <script src='https://www.google.com/recaptcha/api.js'></script>
      <script src='https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.min.js'></script>
     

      @yield('footer')
     

      <script type="text/javascript">
            $(window).load(function() {
                if($("#is_verified_falsh").val()==1){
                     changemodel('login_content');
                     $('#register_user_model').modal('show');
                }
               
            });
            
            function changeboxinput(){
                if($('#login_password').attr('type')=='password'){
                    $('#login_password').attr('type','text');
                    $("#passwordshow").html("hide password");
                }else{
                    $('#login_password').attr('type','password');
                    $("#passwordshow").html("show password");
                }
                
            }

           
            
      </script>
   </body>
</html>




 <div class="modal fade" id="myModalsell-out-sumit1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header" style="border:unset">
                    <button type="button" class="btn-close" data-bs-dismiss="modal">X</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body" style="border:unset; padding: 15px 0px;">
                    <div class="heading-border-section" style="margin-bottom:0px">
                        <span class="firts"></span>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="heading-box back-white-header">
                                        <img src="{{asset('public/logo/grayscale_transparent.png')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form_contact_box register-form">
                                    <p style="font-size: 20px;line-height: 35px;">
                                        Thanks for reaching out <span id="model_name_user"></span>!</p>
                                    <p style="font-size: 20px;line-height: 35px;">
                                        One of our team will contact you within 24 hours!</p>
                                    <br>
                                    <br>
                                    <br>
                                </div>

                            </div>
                        </div>
                        <span class="second"></span>
                    </div>
                </div>
                <!-- Modal footer -->
            </div>
        </div>
    </div>

    <div class="modal fade" id="myModalsell-out-sumit2">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header" style="border:unset">
                    <button type="button" class="btn-close" data-bs-dismiss="modal">X</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body" style="border:unset; padding: 15px 0px;">
                    <div class="heading-border-section" style="margin-bottom:0px">
                        <span class="firts"></span>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="heading-box back-white-header">
                                        <img src="{{asset('public/logo/grayscale_transparent.png')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form_contact_box register-form">
                                    
                                    <p style="font-size: 20px;line-height: 35px;">
                                        Your password has been reset successfully. Please log in now with your new password.</p>
                                    <br>
                                    <br>
                                    <br>
                                </div>

                            </div>
                        </div>
                        <span class="second"></span>
                    </div>
                </div>
                <!-- Modal footer -->
            </div>
        </div>
    </div>

    <div class="modal fade" id="subscriber_news">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header" style="border:unset">
                    <button type="button" class="btn-close" data-bs-dismiss="modal">X</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body" style="border:unset; padding: 15px 0px;">
                    <div class="heading-border-section" style="margin-bottom:0px">
                        <span class="firts"></span>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="heading-box back-white-header">
                                        <img src="{{asset('public/logo/grayscale_transparent.png')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form_contact_box register-form">
                                    <p style="font-size: 20px;line-height: 35px;">
                                        You’re officially in <span id="model_email"></span>!</p>
                                    <p style="font-size: 20px;line-height: 35px;">
                                        Thanks for registering and we’ll be sure</p>
                                        <p style="font-size: 20px;line-height: 35px;">
                                        to keep you up to speed on our next move!</p>
                                    <br>
                                    <br>
                                    <br>
                                </div>

                            </div>
                        </div>
                        <span class="second"></span>
                    </div>
                </div>
                <!-- Modal footer -->
            </div>
        </div>
    </div>
    
     <div class="modal fade" id="confirm_bid_amount">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header" style="border:unset">
                    <button type="button" class="btn-close" data-bs-dismiss="modal">X</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body" style="border:unset; padding: 15px 0px;">
                    <div class="heading-border-section" style="margin-bottom:0px">
                        <span class="firts"></span>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="heading-box back-white-header">
                                        <img src="{{asset('public/logo/grayscale_transparent.png')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form_contact_box register-form">
                                    <p style="font-size: 20px;line-height: 35px;    font-size: 16px;">
                                        You agree to purchase if your bid meets or exceeds the reserve price.</p>
                                    <p style="font-size: 20px;line-height: 35px;    font-size: 16px;">Bid are legally binding and may not be retracted.</p>
                                        
                                    <br>
                                    <br>
                                    <p class="row" style="display: inline-table;font-weight: 800;font-size: x-large;">Your Bid :<span id="bid_currency" style='padding-right: 0px;color: green;'>$</span><span style="padding-left: 0px;color: green;" id="place_bid_amount">0</span></p>
                                    <br>
                                    <input type="hidden" id="car_bid_id"/>
                                    <input type="hidden" id="bid_type" name="bid_type"/>
                                     <div class="register-check-popup-holder">
                                         <ul>
                                            <li>
                                               <input class="form-check-input" type="checkbox" name="agree" value="1" id="agree">
                                               <p> I agree to the Terms and Conditions</p>
                                               <span id="agree_error" class="error"></span>
                                            </li>
                                         </ul>
                                      </div>
                                </div>
                                <ul style="text-align: center;">
                                    <li class="btn_box_border">
                                            <a class="btn_border" href="javascript:confirmlivebid()" onclick="">confirm</a>
                                        </li>
                                </ul>

                            </div>
                        </div>
                        <span class="second"></span>
                    </div>
                </div>
                <!-- Modal footer -->
            </div>
        </div>
    </div>
    
    
     <div class="modal fade" id="success_bid">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header" style="border:unset">
                    <button type="button" class="btn-close" data-bs-dismiss="modal">X</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body" style="border:unset; padding: 15px 0px;">
                    <div class="heading-border-section" style="margin-bottom:0px">
                        <span class="firts"></span>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="heading-box back-white-header">
                                        <img src="{{asset('public/logo/grayscale_transparent.png')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form_contact_box register-form">
                                    <h2>YOUR BID WAS ACCEPTED</h2>
                                    <br>
                                    <p class="row" style="font-weight: 800;font-size: x-large;"><span  style='padding-right: 0px;color: green;'>Your Bid :</span><span  style='padding-right: 0px;color: green;' id="dis_bid_amount">$20,000</span><span style='    font-size: small;'>was accepted</span></p>
                                   
                                    <p>Thanks <span id="bid_user_name">Sam</span>!</p>
                                </div>
                                <ul style="text-align: center;">
                                    <li class="btn_box_border">
                                            <a class="btn_border" href="javascript:void()" onclick="window.location.reload()">Back To Listing</a>
                                        </li>
                                </ul>

                            </div>
                        </div>
                        <span class="second"></span>
                    </div>
                </div>
                <!-- Modal footer -->
            </div>
        </div>
    </div>

    
    
    <div class="modal fade" id="buynowmodal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header" style="border:unset">
                    <button type="button" class="btn-close" data-bs-dismiss="modal">X</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body" style="border:unset; padding: 15px 0px;">
                    <div class="heading-border-section" style="margin-bottom:0px">
                        <span class="firts"></span>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="heading-box back-white-header">
                                        <img src="{{asset('public/logo/grayscale_transparent.png')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form_contact_box register-form">
                                    <h4 style="font-weight: 800;">Congratulations! You have won this auction.</h4>
                                    <br>
                                    <p class="row" style="font-weight: 800;">A Front Line Ready representative will be contacting you. Remember – you have 48 hours to settle the transaction.</p>
                                   
                                    <p>Thank you for buying a Front Line Ready vehicle!</p>
                                </div>
                                <ul style="text-align: center;">
                                    <li class="btn_box_border">
                                            <a class="btn_border" href="javascript:void()" onclick="window.location.reload()">Back To Listing</a>
                                        </li>
                                </ul>

                            </div>
                        </div>
                        <span class="second"></span>
                    </div>
                </div>
                <!-- Modal footer -->
            </div>
        </div>
    </div>

    

<!-- The Modal 4th-poup end here -->
<!-- The Modal start here -->