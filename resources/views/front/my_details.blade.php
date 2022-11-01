@extends('front.layout')
@section('title')
Curating Cars - My Details
@stop
@section('meta-data')
@stop
@section('content')
<div class="user-profile section hold">
        <div class="heading-border-section">
            <span class="firts"></span>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-heading-cl-pos">
                        <div class="heading-box cutsom-white-bg">
                            <div class="user-profile-tabs">
                                <ul>
                                    <li><a href="{{route('myaccount')}}">MY BIDS</a></li>
                                    <li><a href="{{route('my-watch')}}">WATCHING</a></li>
                                    <li><a href="{{route('my-listing')}}">MY LISTING</a></li>
                                    <li><a class="btn-active" href="{{route('my-details')}}">MY DETAILS</a></li>
                                    <li><a href="{{route('billing')}}">BILLING</a></li>
                                </ul>
                            </div>
                        </div>
                        <span class="left"></span>
                        <span class="Right"></span>
                    </div>
                </div>
                <span class="second"></span>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="user-cars-details-box">
                    <ul>
                        <li class="double-border">
                            <div class="accordion" id="accordionExample3">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne3">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne3" aria-expanded="true" aria-controls="collapseOne3">
                                            <div class="detail-heading">
                                                <h6>MY DETAILS
                                                    <p class="count">(0)</p>
                                                </h6>
                                                <span>
                                                    <p class="close">
                                                        <a href="">Close</a>
                                                    </p>
                                                </span>
                                            </div>
                                        </button>
                                    </h2>
                                    <div id="collapseOne3" class="accordion-collapse collapse show" aria-labelledby="headingOne3" data-bs-parent="#accordionExample3">
                                        <div class="accordion-body">
                                            <div class="cars-details-box-holder double-border">
                                                <div class="form-inner-hold">
                                                    <form id="mydetailfrom" method="post" enctype="multipart/form-data">
                                                        <div class="contact_form_box register-form-head">
                                                            <div>
                                                                <div id="uploaded_image">
                                                                  <div class="upload-btn-wrapper">
                                                                     <button class="btn imgcatlog" type="button">
                                                                     <?php 
                                                                        if(isset(Auth::user()->image)){
                                                                            $path= url('/')."/storage/app/public/profile"."/".Auth::user()->image;
                                                                        }
                                                                        else{
                                                                            $path=asset('public/images/user.jpg');
                                                                        }
                                                                        ?>
                                                                     <img src="{{$path}}" alt="..." class="img-thumbnail"  id="basic_img" >
                                                                     </button>
                                                                     <input type="hidden" id="basic_img1"/>
                                                                     @if(isset(Auth::user()->image))
                                                                     <input type="file" name="upload_image" class="form-control" id="upload_image" />
                                                                     @else
                                                                     <input type="file" required="" class="form-control" name="upload_image" id="upload_image" />
                                                                     @endif
                                                                  </div>
                                                               </div>
                                                            </div>
                                                            <div class="contact_left_side_box">
                                                                <label>Display Name :</label>
                                                                <input type="text" name="username" id="username" value="{{Auth::user()->username}}" onchange="check_username(this.value)">
                                                                <div class="correct-and-cross-icons" id="error_msg_username">
                                                                    
                                                                </div>
                                                                <span id="error_username"></span>
                                                            </div>
                                                            <div class="contact_right_side_box">
                                                                <label>Email :</label>
                                                                <input type="email" name="email" disable id="useremail" value="{{Auth::user()->email}}" readonly onchange="check_email(this.value)">
                                                                <div class="correct-and-cross-icons" id="error_msg_email">
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="end-border-and-btn" style="text-align: right;">
                                                                <div class="actions-btn-hold btn_box_border" style=" margin: 25px 0px 25px;"> <a class="btn_border " id="btnmydetail" href="javascript:update_mydetail()">UPDATE</a> </div>
                                                            </div>

                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        </div></div></li>
                        <li class="double-border">
                            <div class="accordion" id="accordionExample4">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne4">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne4" aria-expanded="true" aria-controls="collapseOne4">
                                            <div class="detail-heading">
                                                <h6>PASSWORD
                                                    <p class="count">(0)</p>
                                                </h6>
                                                <span>
                                                    <p class="close">
                                                        <a href="">Close </a>
                                                    </p>
                                                </span>
                                            </div>
                                        </button>
                                    </h2>
                                    <div id="collapseOne4" class="accordion-collapse collapse show" aria-labelledby="headingOne4" data-bs-parent="#accordionExample4">
                                        <div class="accordion-body">
                                            <div class="cars-details-box-holder double-border">
                                                <div class="form-inner-hold">
                                                    <form>
                                                        <div class="contact_form_box register-form-head">
                                                            <div class="contact_left_side_box">
                                                                <label>Current Password :</label>
                                                                <input type="password" name="cpwd" id="cpwd" placeholder="*****" onchange="checkcurrentpwd(this.value)">
                                                                <div class="correct-and-cross-icons" id="error_msg_cpwd">
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="contact_right_side_box">
                                                                <label>New Password</label>
                                                                <input type="password" name="npwd" id="npwd" placeholder="*****">
                                                                <div class="correct-and-cross-icons" id="error_msg_npwd">
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="end-border-and-btn" style="text-align: right;">
                                                                <div class="actions-btn-hold btn_box_border" style=" margin: 25px 0px 25px;"> <a class="btn_border" href="javascript:changepassword()" id="btnchangepwd">UPDATE</a> </div>
                                                            </div>

                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        </div></div></li>
                        <li class="last-bottom-pd">
                            <div class="accordion" id="accordionExample5">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne5">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne5" aria-expanded="true" aria-controls="collapseOne5">
                                            <div class="detail-heading">
                                                <h6>EMAIL SUBSCRIPTIONS
                                                    <p class="count">(0)</p>
                                                </h6>
                                                <span>
                                                    <p class="close">
                                                        <a href="">Close</a>
                                                    </p>
                                                </span>
                                            </div>
                                        </button>
                                    </h2>
                                    <div id="collapseOne5" class="accordion-collapse collapse show" aria-labelledby="headingOne5" data-bs-parent="#accordionExample5">
                                        <div class="accordion-body">
                                            <div class="cars-details-box-holder double-border">
                                                <div class="form-inner-hold">
                                                    <div class="check-box-right-in">
                                                        <p>Join our mail list for news and promotions</p>
                                                        <input class="form-check-input" type="checkbox" name="promotions_email_notification" id="promotions_email_notification" value="1" <?=Auth::user()->promotions_email_notification==1?'checked="checked"':''?> >
                                                    </div>
                                                    <div class="check-box-right-in">
                                                        <p>Join our mail list for trade news</p>
                                                        <input class="form-check-input" type="checkbox" name="trade_news_email_notification" id="trade_news_email_notification" value="1" <?=Auth::user()->trade_news_email_notification==1?'checked="checked"':''?>> 
                                                    </div>
                                                    <div class="end-border-and-btn" style="text-align: right;">
                                                        <div class="actions-btn-hold btn_box_border" style=" margin: 25px 0px 25px;"> <a class="btn_border" href="javascript:emailsubscription()" id="emailnotibtn">UPDATE</a> </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        </div></div></li>
                       <!-- <li class="last-bottom-pd">
                            <div class="accordion" id="accordionExample6">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne6">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne6" aria-expanded="true" aria-controls="collapseOne6">
                                            <div class="detail-heading">
                                                <h6>NOTIFICATIONS
                                                    <p class="count">(0)</p>
                                                </h6>
                                                <span>
                                                    <p class="close">
                                                        <a href="">Close </a>
                                                    </p>
                                                </span>
                                            </div>
                                        </button>
                                    </h2>
                                    <div id="collapseOne6" class="accordion-collapse collapse show" aria-labelledby="headingOne6" data-bs-parent="#accordionExample6">
                                        <div class="accordion-body">
                                            <div class="cars-details-box-holder double-border">
                                                <div class="form-inner-hold">
                                                    <div class="check-box-right-in" style="display:none">
                                                        <p>Send me SMS when i’m outbid</p>
                                                        <input class="form-check-input" type="checkbox" name="outbid_sms_notification" id="outbid_sms_notification" value="1" <?=Auth::user()->outbid_sms_notification==1?'checked="checked"':''?>>
                                                    </div>
                                                    <div class="check-box-right-in">
                                                        <p>Notify me via email when the vendor comments on an auction i
                                                            am watching</p>
                                                        <input class="form-check-input" type="checkbox" name="watcher_comment_notification" id="watcher_comment_notification" value="1" <?=Auth::user()->watcher_comment_notification==1?'checked="checked"':''?>>
                                                    </div>
                                                    <div class="end-border-and-btn" style="text-align: right;">
                                                        <div class="actions-btn-hold btn_box_border" style=" margin: 25px 0px 25px;"> <a class="btn_border" id="btnnotifi" href="javascript:notification()">UPDATE </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        </div></div></li>-->
                    </ul>
                </div>
            </div>
        </div>
    </div>
@stop
@section('footer')
<script type="text/javascript">
    $(document).ready(function () {
   $('#upload_image').on('change', function (e) {
    readURL(this, "basic_img");
   });
   });
   
   
   function readURL(input, field) {
   if (input.files && input.files[0]) {
    var reader = new FileReader();
   
    reader.onload = function (e) {
      $("#basic_img1").val(e.target.result);
      $('#' + field).attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
   }
   }
</script>
@stop