@extends('front.layout')
@section('title')
Curating Cars - In The Spotlight
@stop
@section('meta-data')
@stop
@section('content')
<div class="banner slider section hold">
   <div class="container">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <div class="banner-slider-content-hold">
            <h2>Reset Password</h2>
            <p></p>
         </div>
      </div>
   </div>
</div>
<div class="home-blog-section">
<div class="blog-left-icons-shape slb-page-hold">
   <img src="{{asset('public/theme/images/shape-logo.png')}}">
</div>
<div class="container">
<div class="row" style="margin-top: 50px;margin-bottom: 50px;">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="faq-pd-top-holder">
  
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form_contact_box seller-form-hold">
               @if(!isset($msg))
               <p></p>
               <form id="reset_from" >
                  <ul id="success_reset"></ul>
                  {{csrf_field()}}
                  <input type="hidden" name="code" value="{{$code}}" />
                  <input type="hidden" name="id" value="{{$data->user_id}}" />
                  <div class="contact_form_box register-form-head">
                     <div class="contact_login_box">
                        <label>New Password :</label>
                        <input type="password" name="npwd" required="" id="npwd" onblur="removeerror('error_reset_npwd')">
                        <span id="error_reset_npwd" class="error"></span>
                        <label>Re Enter New Password :</label>
                        <input type="password" name="rpwd"  required="" id="rpwd" onchange="checkbothpwd(this.value)"  >
                        <span id="password_error" class="error"></span>
                     </div>
                     <div class="end-border-and-btn">
                        <div class="actions-btn-hold btn_box_border">
                           <a class="btn_border" href="javascript:resetpassword()" style="padding:0px 45px;" >SUBMIT <i
                              class="fal fa-long-arrow-right" style="margin-left: 8px;"
                              aria-hidden="true"></i></a>
                        </div>
                     </div>
               </form>
               @endif @if(isset($msg))
               <h3>{{$msg}}</h3>
               @endif
               </div>
            </div>
         </div>
      </div>
   </div>
   </div></div>

@stop
@section('footer')
<script type="text/javascript">
   function checkbothpwd(val){
       if(val!=$("#npwd").val()){
          $("#password_error").html("New Password and Re-enter Password Must Be Same");
          $("#rpwd").val();
       }else{
          $("#password_error").html("");
          var npwd = $("#npwd").val();
       if (npwd.length >= 8){
           
       }else{alert('At least 8 character.');}
           if(npwd.match(/[0-9]/g)){
              
           }else{
              alert('At least 1 digit.');
              
           }   
       }
       
       
    }
</script>
@stop