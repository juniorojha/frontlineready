@extends('front.layout')
@section('title')
Curating Cars - Sell With Us
@stop
@section('meta-data')
@stop
@section('content')
<?php $path = asset('public/theme/images/sell-banner.jpg');?>
  <div class="banner slider section hold" style="background-image: url('{{$path}}');">
        <div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="banner-slider-content-hold sell-with-us-heading">
                    <h2 style="margin-top:55px">Created with Passion. Curated for You.</h2>
                 <!--  <p>SELL YOUR CLASSIC OR PERFORMANCE WITH US</p>-->
                </div>
            </div>
        </div>
    </div>
    <!--Banner Slider end -->


    <!-- Home Bloges style start here  -->
    <div class="home-blog-section">
        <div class="blog-left-icons-shape slb-page-hold">
            <img src="{{asset('public/theme/images/shape-logo.png')}}">
        </div>
        <div class="container">
            <div class="row seller-top-pd">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="margin: auto;">
                    <div class="sell-with-us-content">
                        <p>We don’t charge any commission or listing fees to our sellers.</p>
                        <p>We 'eliminate all' obstacles in the way of purchasing interesting and desirable vehicles from honest sellers 'by simply charging the buyer a reasonable' commission of just 5% + VAT.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="sell-with-us-img">
                        <img src="{{asset('public/theme/images/sell-about.jpg')}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="sellers-receives-content">
                        <span>You have nothing to lose because we take care of everything for you, including:</span>
                        <ul>
                            <li><p style="margin-left:3px;width: 100%;text-align: justify;">Professional 'photography' and videography 'services' of your vehicle.</p></li>
                            <li><p style="margin-left:3px;width: 100%;text-align: justify;">The car stays with you, so there’s no need to worry about transportation or the chance of your car being damaged.</p></li>
                            <li><p style="margin-left:3px;width: 100%;text-align: justify;">Our listings are the most accurate, detailed and transparent pieces of automotive narrative that you will find anywhere in the industry.</p></li>
                            <li><p style="margin-left:3px;width: 100%;text-align: justify;">'In achieving' the best price, we market to purchasers in the UK, Europe, UAE and Asia.</p></li>
                            <li><p style="margin-left:3px;width: 100%;text-align: justify;">We’ll even 'negotiate' with potential 'buyers' on your behalf so you don’t have to.</p></li>
                            <li><p style="margin-left:3px;width: 100%;text-align: justify;">'The team at Curating Cars' are true petrolhead professionals and engineers 'who hail' from the world of Formula One, 'a'erospace and 'a'utomotive journalism.</p></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="seller-middle-banner"><div class="container">
          <div class="row">
            <div class="banner-inner-content-sell-with-us">
        <h3>Take A Ride With Us!</h3>
        </div>
        </div>
     </div></div>

    <div class="heading-border-section" id="submit_entry_from">
        <span class="firts"></span>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-heading-cl-pos">
                    <div class="heading-box cutsom-white-bg sell-with-heading--second">
                        <h2 style="">LET US HELP YOU SELL</h2>
                    </div>
                    <span class="left"></span>
                    <span class="Right"></span>
                </div>
            </div>
        </div>
        <span class="second"></span>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form_contact_box seller-form-hold">
                    <p>'Submit your details' below and one of our team will contact you within 24 hours.</p>
                    <form id="sell_with_us">
                        <ul id="sell_error"></ul>
                        <div class="contact_form_box register-form-head">
                           <input type="hidden" name="vaildphoneno" id="vaildphoneno" class="vaildphoneno"> 
                           <input type="hidden" name="countrycode" id="countrycode" class="countrycode">
                            <div class="contact_login_box">
                                <label>Name :</label>
                                <input type="text" name="name" id="seller_name">
                                <label>Email :</label>
                                <input type="email" name="email" id="seller_email">
                                <label>Phone Number :</label>
                                <input type="tel" name="phone" class="phone numberonly" required="" id="phone" maxlength="10">
                                <span id="error_reg_phone" class="error error_contact_phone"></span>
                                <span id="valid-msg" class="hide valid-msg">Valid</span>
                                <span id="error-msg" class="hide error-msg">Invalid number</span>
                                <label>Make :</label>
                                <select id="make" name="make" class="country_select">
                                    <option value="">Select Make</option>
                                    @foreach($make_list as $ml)
                                        <option value="{{$ml->name}}">{{$ml->name}}</option>
                                    @endforeach
                                </select>
                                <label>Model :</label>
                                <input type="text" name="model" id="model">
                                <label>Country :</label>
                                <select name="country" id="country_sell" required="" class="country_select country">
                                    @foreach($country as $c)
                                      <option value="{{$c->sortname}}">{{ucwords(strtolower($c->name))}}</option>
                                    @endforeach
                                 </select>

                            </div>
                            <div class="end-border-and-btn">
                                <!-- data-bs-toggle="modal"
                                        data-bs-target="#myModalsell-out-sumit1" -->
                                <div class="actions-btn-hold btn_box_border">
                                    <a class="btn_border" href="javascript:sellwithus()" style="padding:0px 45px;" >SUBMIT <i
                                            class="fal fa-long-arrow-right" style="margin-left: 8px;"
                                            aria-hidden="true"></i></a>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

 <!--    <div class="heading-border-section">
        <span class="firts"></span>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-heading-cl-pos">
                    <div class="heading-box cutsom-white-bg sell-with-heading--second">
                        <h2>SELL YOUR VEHICLE</h2>
                    </div>
                    <span class="left"></span>
                    <span class="Right"></span>
                </div>
            </div>
        </div>
        <span class="second"></span>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sell-ypur-vehicles-content">
                    <p>Alternatively submit the full details of your vehicle here so we can provide a no-obligation</p>
                    <p>valuation and potentially progress to a full listing:</p>
                    <div class="end-border-and-btn">
                        <div class="actions-btn-hold btn_box_border">
                            <a class="btn_border" href="{{route('sell-your-vehicle')}}" style="padding:0px 45px;">SUBMIT AN
                                ENTRY <i class="fal fa-long-arrow-right" style="margin-left: 8px;"
                                    aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <br>
                    <br>
                    <p>If you have any questions then please do speak to a member of the team,</p>
                    <p>the relevant details for your country can be found on our <a href="#" style="
                        text-decoration: underline;
                    ">contact page</a></p>
                </div>
            </div>
        </div>
    </div> -->
    <div class="seller-bottom-banner"></div>
@stop
@section('footer')
@stop