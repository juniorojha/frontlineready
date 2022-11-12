@extends('front.layout')
@section('title')
Front Line Ready - About Us
@stop
@section('meta-data')
@stop
@section('content')
<?php $path = asset('public/theme/images/sell-banner.jpg');?>
  <div class="banner slider section hold" style="background-image: url('{{$path}}');">
        <div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="banner-slider-content-hold sell-with-us-heading">
                    <h2 style="margin-top:55px">The auto dealer exclusively for dealers.</h2>
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
                        <p>At Front Line Ready, we do exactly what our name says – provide front line ready cars to automotive dealers. We're passionate about vehicles and making sure retail dealers have an effective and efficient method of acquiring inventory.  We understand the challenges in today's environment with shortages of inventory and more competition for every vehicle.  Our goal is to help our partner dealers buy and sell more cars. Period.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="sell-with-us-img">
                        <img src="{{asset('public/theme/images/sell-about.jpg')}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin: auto;">
                    <div class="sell-with-us-content">
                        <span>How it Works</span>
                        <p>We buy vehicles and put them through a rigorous inspection and reconditioning process to make sure they meet our high standards. Each Front Line Ready vehicle will have a current Texas Inspection and be ready for you to sell immediately on your lot without time consulting and costly reconditioning.  We then post them to our dealer only auction portal where our dealer partners can participate in our 10-day auction process or "buy it now".  We then deliver the vehicle to the winning dealer.  We then certify our cars for 30 days or 1,000 miles. <br/>
                        It's that simple.  No standing around a live auction all day.  No more auction buy fees.  No more waiting for the next trade in. <br/> Contact us to learn more.
                    </p>
                    </div>
                </div>
            </div>       
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin: auto;">
                    <div class="sell-with-us-content">
                        <span>How we are different</span>
                        <table class="tg_table">
                            <thead>
                              <tr>
                                <th class="tg-0lax">Approach to Buying</th>
                                <th class="tg-0lax">Reconditioning Process</th>
                                <th class="tg-0lax">Technology Platform</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td class="tg-1lax">Not every vehicle is for us. We buy from individuals and look for cars with less than 100,000 miles with only minor imperfections. We are experts in evaluating and buying vehicles.</td>
                                <td class="tg-1lax">Our vehicles are put through a 100+ point inspection and any maintenance or cometic issues are addressed. Only vehicles that reach at least a 4.0 out of 5 are certified as Front Line Ready.</td>
                                <td class="tg-1lax">We utilize proprietary technology to both buy and sell.  This allows both the seller and our dealer partners to have transparency in the process.  We make it easy.</td>
                              </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>       
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="sellers-receives-content">
                        <span>How Our Auctions Work</span>
                        <p>The process at Front Line Ready is very simple.</p>
                        <ol>
                            <li><p style="margin-left:3px;width: 100%;text-align: justify;">Register as a dealer (see below).</p></li>
                            <li><p style="margin-left:3px;width: 100%;text-align: justify;">Visit our site and review our inventory.</p></li>
                            <li><p style="margin-left:3px;width: 100%;text-align: justify;">Each listing will have pictures and detailed vehicle information.  If you have additional questions on a vehicle, call us.</p></li>
                            <li><p style="margin-left:3px;width: 100%;text-align: justify;">Each listing will have a starting minimum floor bid and a Buy it Now price.</p></li>
                            <li><p style="margin-left:3px;width: 100%;text-align: justify;">Each listing will give the option to submit a maximum proxy bid or next bid increment ($100 bid increments) </p></li>
                            <li><p style="margin-left:3px;width: 100%;text-align: justify;">Each listing lasts 10 days with a stated countdown unless the Buy it Now option is exercised.</p></li>
                            <li><p style="margin-left:3px;width: 100%;text-align: justify;">If you win, the vehicle is delivered to your facility.</p></li>
                        </ol>
                        <p>That's it.  Sound easy enough?</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="seller-middle-banner"><div class="container">
          <div class="row">
            <div class="banner-inner-content-sell-with-us">
        <h3>Take a Ride With Us!</h3>
        </div>
        </div>
     </div></div>

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