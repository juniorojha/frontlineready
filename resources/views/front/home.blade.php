@extends('front.layout')
@section('title')
Front Line Ready - Home
@stop
@section('meta-data')
@stop
@section('content')
<style type="text/css">
    button.btn_border {
        border: 1px solid white;
        display: inline-block;
        border-radius: 100px;
        width: 100%;
        border-color: black;
        padding: 0px 20px;
        font-weight: 400;
    }
    button:hover {
    color: unset;
}
</style>
<script>
    
    	
        
        function updateTimer(duration,id) {
                    var interVal=  setInterval(function () {
                    future = Date.parse(duration);
                     date = new Date().toLocaleString("en-US", { timeZone: '<?=Session::get('timezone')?>' });
             now = Date.parse(date);
                    diff = future - now;
                    
                    days = Math.floor(diff / (1000 * 60 * 60 * 24));
                    hours = Math.floor(diff / (1000 * 60 * 60));
                    mins = Math.floor(diff / (1000 * 60));
                    secs = Math.floor(diff / 1000);
                
                   
                 
                    
                    
                    d = days;
                    h = hours - days * 24;
                    m = mins - hours * 60;
                    s = secs - mins * 60;
                     console.log(d+":"+h+":"+m+":"+s);
                    m = m < 10 ? "0" + m : m;
                    s = s < 10 ? "0" + s : s;
                    h = h < 10 ? "0" + h : h;
                    if(d>0){
                        
                            document.getElementById("end_time_"+id).innerHTML = d+" Day";
                       
                        
                    }else{
                        
                        document.getElementById("end_time_"+id).innerHTML = h+":"+m+":"+s;
                       
                    }
                    //console.log(d+);
                    if(d=='00'&&h=='00'&m=='00'&s=='00'){
                         var totallivecar = document.getElementById("totallivecar").value;
                         document.getElementById("totallivecar").value = parseInt(totallivecar)-1;
                         document.getElementById("live_cars_"+id).style.display="none";
                    }
 
  
            },1000);
   
}


</script>
<!-- header End -->
      <!-- Slider Start -->
      <div class="content display-container ">
         <section id="hero1" class="mySlides hero fade-in">
            <div class="inner cus-sliders">
               <div class="container row-fluid">
                  <div class="banner_text">
                     <div class="text-part">
                        <h2>The auto dealer exclusively for dealers.</h2>
                        <p></p>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <div class="header_dots">
            <span class="w3-badge demo demo-1 w3-border w3-transparent w3-hover-white" id="badge1"
               onclick="currentDiv(1)"></span>
         </div>
      </div>
      <!-- Slider end -->
      <!-- home-cars-and-search-sections Start -->
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
        </div>
    </div>
    <div class="heading-border-section hide" id="header_1">
         <span class="firts"></span>
         <div class="container">
            <div class="row">
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-heading-cl-pos">
                  <div class="heading-box">
                     <h2>LIVE</h2>
                  </div>
                  <span class="left"></span>
                  <span class="Right"></span>
               </div>
            </div>
         </div>
         <span class="second"></span>
      </div>
      <!-- main heading end -->
      <!-- Product cars-box-first satrt-->
      <div class="container hide" id="container_1">
         <div class="row" id="live_cars_list">
            
           @foreach($get_car_live as $gc)
               <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="live_cars_{{$gc->id}}">
                  <div class="product-box">
                     <div class="product-img-heading">
                        <div class="attributes">
                           <ul>
                              <li>
                                 <p class="live">LIVE</p>
                              </li>
                           </ul>
                        </div>
                        <div class="img-hold">
                           <a href="{{route('vehicle-detail',['query'=>$gc->key_id])}}"><img src="{{asset('storage/app/public/cars/banner').'/'.$gc->banner}}"></a>
                        </div>
                        <div class="heading-hold">
                           <a href="{{route('vehicle-detail',['query'=>$gc->key_id])}}">
                              <h4>{{$gc->name}}</h4>
                           </a>
                          <ul class="icons-section">
                              <li> @if(Auth::id())
                                          <?php $color = $gc->is_like==1?'chartreuse':'white';  ?>
                                        <a href="javascript:bookcar('{{$gc->id}}')"><i id="book_mark_{{$gc->id}}" class="fas fa-bookmark" style="color:{{$color}}" ></i></a>
                                    @else
                                       <a data-bs-toggle="modal" data-bs-target="#register_user_model" href="#" onclick="changemodel('login_content')"><i class="fas fa-bookmark"></i></a>
                                    @endif</li>
                               <li  class="share-button sharer"><button  type="button" class="share-btn"><i class="fas fa-share-alt"></i></button>
                               <div class="social top center networks-5 ">
 <!-- Facebook Share Button -->
    <a class="fbtn share facebook" href="https://www.facebook.com/sharer/sharer.php?u={{route('vehicle-detail',['query'=>$gc->key_id])}}" target="_blank"><i class="fa fa-facebook"></i></a> 
    <!-- Google Plus Share Button -->
    <a class="fbtn share instagram" href="https://www.instagram.com/" target="_blank"><i class="fa  fa-instagram"></i></a> 
    <!-- Twitter Share Button -->
    <a class="fbtn share twitter" href="https://twitter.com/intent/tweet?text=title&amp;url={{route('vehicle-detail',['query'=>$gc->key_id])}}&amp;via=$gc->name" target="_blank"><i class="fa fa-twitter"></i></a> 
       <!-- Pinterest Share Button -->
    <!-- LinkedIn Share Button -->
    <a class="fbtn share linkedin" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=url&amp;title=title&amp;source={{route('vehicle-detail',['query'=>$gc->key_id])}}" target="_blank"><i class="fa fa-linkedin"></i></a>
</div>
</li>
                           </ul>
                        </div>
                     </div>
                     <div class="product-content">
                        <p class="double-border">{{$gc->short_desc}}</p>
                        <span style="margin-top: 3px;margin-bottom: 3px;">
                           <p>{{$gc->year}}</p>
                           |
                           @if($gc->steering_position==1)
                           <p>LHD</p>
                           @else
                           <p>RHD</p>
                           @endif
                           |
                           <p>{{$gc->country_name}} <img src="https://ipdata.co/flags/{{$gc->country_sortname}}.png"></p>
                           <p><div class=" btn_box_border active-btn-colors" style="margin:0px;"><a href="{{route('vehicle-detail',['query'=>$gc->key_id])}}#bid_section" class="btn_border" >bid now</a></div></p>
                        </span>
                     </div>
                     <div class="product-shadow-box">
                        <div class="head-bg-color red">
                              @if($gc->reserve_met==1)
                                 <div class="head-bg-color green">
                                    <p>RESERVE MET</p>
                                </div>
                                @elseif($gc->reserve_met==2)
                                 <div class="head-bg-color red">
                                    <p>RESERVE NOT MET</p>
                                </div>
                                @elseif($gc->reserve_met==3)
                                 <div class="head-bg-color yellow">
                                    <p>RESERVE NEARLY MET</p>
                                </div>
                                @endif
                        </div>
                        <div class="timging-tage">
                           <p>Ends In : <span id="end_time_{{$gc->id}}">
                               <?php 
                                      $timestamp = $gc->aucation_enddate.' '.$gc->aucation_endtime;
                                      $date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $timestamp, 'UTC');
                                   
                                      $new_date = $date->setTimezone(Session::get('timezone'));
                                      $date =  \Carbon\Carbon::parse($new_date)->format('Y-m-d');
                                      $time = \Carbon\Carbon::parse($new_date)->format('H:i:s');
                                       
                                      $date1 = $date." ".$time;
                                    // echo $date1;
                                     
                               ?>
                            <script type="text/javascript">
                                updateTimer('{{$date1}}','{{$gc->id}}');
                            </script>
                            </span></p>
                        
                            
                        </div>
                        <div class="current-bids">
                           <p>Current Bids : {{$gc->currency_symbol}}{{$gc->bid_price}}</p>
                        </div>
                     </div>
                  </div>
               </div>
            @endforeach
            <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               <div class="end-border-and-btn double-border">
                  <div class="actions-btn-hold btn_box_border">
                     <a class="btn_border" href="">All Auctions</a>
                  </div>
               </div>
            </div> -->
         </div>
      </div>
      <!-- Product cars-box-first end-->
      <!-- Product cars-box-part2 satrt-->
      <!-- main heading start -->
     <div class="heading-border-section " id="header_2">
         <span class="firts"></span>
         <div class="container">
            <div class="row">
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-heading-cl-pos">
                  <div class="heading-box">
                     <h2>Coming soon</h2>
                  </div>
                  <span class="left"></span>
                  <span class="Right"></span>
               </div>
            </div>
         </div>
         <span class="second"></span>
      </div>
      <!-- main heading end -->
      <div class="container" id="container_2">
         <div class="row" id="coming_car_list">
             @foreach($get_car_coming as $gc)
               <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <div class="product-box">
                     <div class="product-img-heading">
                        <div class="attributes">
                           <ul>
                              <li>
                                 <p class="live">Coming Soon</p>
                              </li>
                           </ul>
                        </div>
                        <div class="img-hold">
                           <a href="{{route('vehicle-detail',['query'=>$gc->key_id])}}"><img src="{{asset('storage/app/public/cars/banner').'/'.$gc->banner}}"></a>
                        </div>
                        <div class="heading-hold">
                           <a href="{{route('vehicle-detail',['query'=>$gc->key_id])}}">
                              <h4>{{$gc->name}}</h4>
                           </a>
                           <ul class="icons-section">
                              <li> @if(Auth::id())
                                          <?php $color = $gc->is_like==1?'chartreuse':'white';  ?>
                                        <a href="javascript:bookcar('{{$gc->id}}')"><i id="book_mark_{{$gc->id}}" class="fas fa-bookmark" style="color:{{$color}}" ></i></a>
                                    @else
                                       <a data-bs-toggle="modal" data-bs-target="#register_user_model" href="#" onclick="changemodel('login_content')"><i class="fas fa-bookmark"></i></a>
                                    @endif</li>
                               <li  class="share-button sharer"><button  type="button" class="share-btn"><i class="fas fa-share-alt"></i></button>
                               <div class="social top center networks-5 ">
 <!-- Facebook Share Button -->
    <a class="fbtn share facebook" href="https://www.facebook.com/sharer/sharer.php?u={{route('vehicle-detail',['query'=>$gc->key_id])}}" target="_blank"><i class="fa fa-facebook"></i></a> 
    <!-- Google Plus Share Button -->
    <a class="fbtn share instagram" href="https://www.instagram.com/" target="_blank"><i class="fa  fa-instagram"></i></a> 
    <!-- Twitter Share Button -->
    <a class="fbtn share twitter" href="https://twitter.com/intent/tweet?text=title&amp;url={{route('vehicle-detail',['query'=>$gc->key_id])}}&amp;via=$gc->name" target="_blank"><i class="fa fa-twitter"></i></a> 
       <!-- Pinterest Share Button -->
    <!-- LinkedIn Share Button -->
    <a class="fbtn share linkedin" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=url&amp;title=title&amp;source={{route('vehicle-detail',['query'=>$gc->key_id])}}" target="_blank"><i class="fa fa-linkedin"></i></a>
</div>
</li>
                           </ul>
                        </div>
                     </div>
                     <div class="product-content">
                        <p class="double-border">{{$gc->short_desc}}</p>
                        <span>
                           <p>{{$gc->year}}</p>
                           |
                           @if($gc->steering_position==1)
                           <p>LHD</p>
                           @else
                           <p>RHD</p>
                           @endif
                           |
                           <p>{{$gc->country_name}} <img src="https://ipdata.co/flags/{{$gc->country_sortname}}.png"></p>
                        </span>
                     </div>
                     <div class="product-shadow-box">
                       <div class="head-bg-color">
                           <p></p>
                        </div>
                        
                        <div class="current-bids">
                           <p>Current Bids : No Bids</p>
                        </div>
                     </div>
                  </div>
               </div>
            @endforeach
            <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               <div class="end-border-and-btn last-bottom-pd">
                  <div class="actions-btn-hold btn_box_border">
                     <a class="btn_border" href="">All Coming Soon Cars</a>
                  </div>
               </div>
            </div> -->
         </div>
      </div>
      <div class="heading-border-section hide" id="header_4">
         <span class="firts"></span>
         <div class="container">
            <div class="row">
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-heading-cl-pos">
                  <div class="heading-box">
                     <h2>Sold</h2>
                  </div>
                  <span class="left"></span>
                  <span class="Right"></span>
               </div>
            </div>
         </div>
         <span class="second"></span>
      </div>
      <!-- main heading end -->
      <div class="container hide" id="container_4">
         <div class="row" id="sold_car_list">
            @foreach($get_car_sold as $gc)
               <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <div class="product-box">
                     <div class="product-img-heading">
                        <div class="attributes">
                           <ul>
                              <li>
                                 <p class="live">Sold</p>
                              </li>
                           </ul>
                        </div>
                        <div class="img-hold">
                           <a href="{{route('vehicle-detail',['query'=>$gc->key_id])}}"><img src="{{asset('storage/app/public/cars/banner').'/'.$gc->banner}}"></a>
                        </div>
                        <div class="heading-hold">
                           <a href="{{route('vehicle-detail',['query'=>$gc->key_id])}}">
                              <h4>{{$gc->name}}</h4>
                           </a>
                           <ul class="icons-section">
                               <li> @if(Auth::id())
                                        <a href="javascript:bookcar('{{$gc->id}}')"><i id="book_mark_{{$gc->id}}" class="fas fa-bookmark"></i></a>
                                    @else
                                       <a data-bs-toggle="modal" data-bs-target="#register_user_model" href="#" onclick="changemodel('login_content')"><i class="fas fa-bookmark"></i></a>
                                    @endif</li>
                               <li><a href="javascript:void()" onClick="callShare('{{$gc->name}}','hetya','hetal');"><i class="fas fa-share-alt"></i></a></li>
                           </ul>
                        </div>
                     </div>
                     <div class="product-content">
                        <p class="double-border">{{$gc->short_desc}}</p>
                        <span>
                           <p>{{$gc->year}}</p>
                           |
                           @if($gc->steering_position==1)
                           <p>LHD</p>
                           @else
                           <p>RHD</p>
                           @endif
                           |
                           <p>{{$gc->country_name}} <img src="https://ipdata.co/flags/{{$gc->country_sortname}}.png"></p>
                        </span>
                     </div>
                     <div class="product-shadow-box">
                        <div class="head-bg-color green">
                           <p> {{$gc->total_bid}} Bids</p>
                        </div>
                        <div class="timging-tage">
                           <p>Sold Date : {{$gc->sold_date}}</p>
                        </div>
                        <div class="current-bids">
                           <p>Winning Bid : {{$gc->currency_symbol}}{{$gc->winning_bid}}</p>
                        </div>
                     </div>
                  </div>
               </div>
            @endforeach
           <!--  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               <div class="end-border-and-btn last-bottom-pd">
                  <div class="actions-btn-hold btn_box_border">
                     <a class="btn_border" href="">All Sold Cars</a>
                  </div>
               </div>
            </div> -->
         </div>
      </div>
      </div>
      <!-- home-subscribe-now-banner satrt here  -->
      <!-- Home Bloges style start here  -->
      <div class="home-blog-section">
         <div class="blog-left-icons-shape">
            <img src="{{asset('public/theme/images/shape-logo.png')}}">
         </div>
         <div class="container">
            <div class="row">
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="blog-main-heading desktop-pd-hold1">
                     <h3>In The Spotlight</h3>
                  </div>
               </div>
            </div>
            <div class="row">
               @foreach($spotLight as $sl)
               <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                  <div class="blog-content-img-holder-box">
                     <a href="{{route('news-detail',['id'=>$sl->query_id])}}"> <img src="{{asset('storage/app/public/news').'/'.$sl->image}}"> </a>
                     <a href="{{route('news-detail',['id'=>$sl->query_id])}}">
                        <h4>{{$sl->title}}</h4>
                     </a>
                     <p>{{$sl->short_desc}}
                     </p>
                     <a href="{{route('news-detail',['id'=>$sl->query_id])}}"> <b>Read More</b> </a>
                  </div>
               </div>
               @endforeach
              
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               <div class="end-border-and-btn">
                  <div class="actions-btn-hold btn_box_border">
                     <a class="btn_border" href="{{route('spotlight')}}">All News</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
      </div>
      <!-- Home Bloges style end here  -->
    <div class="seller-middle-banner"><div class="container">
          <div class="row">
            <div class="banner-inner-content-sell-with-us">
        <h3>Take a Ride With Us!</h3>
        </div>
        </div>
     </div></div>

    <div class="heading-border-section" id="submit_entry_from">
        <span class="firts"></span>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-heading-cl-pos">
                    <div class="heading-box cutsom-white-bg sell-with-heading--second">
                        <h2 style="">Register to bid</h2>
                    </div>
                    <span class="left"></span>
                    <span class="Right"></span>
                </div>
            </div>
        </div>
        <span class="second"></span>
    </div>
    <div class="container" id="delarship_reg">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form_contact_box seller-form-hold">
                    <p>If you are interested in learning more about our online auctions, please fill out the form below and one of our representatives will follow up with you directly.</p>
                    <form id="reg1_registation_form">
                        <ul id="reg1_error"></ul>
                        <div class="contact_form_box register-form-head">
                           <input type="hidden" name="vaildphoneno" id="vaildphoneno" class="vaildphoneno"> 
                           <input type="hidden" name="countrycode" id="countrycode" class="countrycode">
                            <div class="contact_login_box">
                                <label>Name :</label>
                                <input type="text" name="name" id="reg1_name">
                                <label>Dealership Name :</label>
                                <input type="text" name="dealership_name" id="reg1_dealership_name">
                                <label>Dealership P Number :  <button type="button"  data-toggle="tooltip" data-placement="right" title="or State’s applicable Dealer License number" style="border-radius: 75%;border: 1px solid black;padding: 0px 8px;background: lightgray;"><i class="fa fa-info"></i></button></label>
                                <input type="text" name="dealership_p_number" id="reg1_dealership_p_number">
                                <label class="full-field">
                                    <span class="form-label">Address*</span>
                                    <input
                                      id="reg1_address"
                                      name="address"
                                      required
                                      autocomplete="off"
                                    />
                                  </label>
                                  <label class="full-field">
                                    <span class="form-label">street address</span>
                                    <input id="reg1_street_address" name="street_address" />
                                  </label>
                                  <label class="full-field">
                                    <span class="form-label">City*</span>
                                    <input id="reg1_locality" name="city" required />
                                  </label>
                                  <label class="slim-field-left">
                                    <span class="form-label">State/Province*</span>
                                    <input id="reg1_state" name="state" required />
                                  </label>
                                  <label class="slim-field-right" for="postal_code">
                                    <span class="form-label">Postal code*</span>
                                    <input id="reg1_postcode" name="postcode" required />
                                  </label>
                                  <label class="full-field">
                                    <span class="form-label">Country/Region*</span>
                                    <input id="reg1_country" name="country" required />
                                  </label>
                                <label>Email :</label>
                                <input type="email" name="email" id="reg1_email">
                                <label>Phone Number :</label>
                                <input type="tel" name="phone" class="phone numberonly" required="" id="phone_pay" maxlength="10">
                                <span id="error_reg_phone" class="error error_contact_phone"></span>
                                <span id="valid-msg" class="hide valid-msg">Valid</span>
                                <span id="error-msg" class="hide error-msg">Invalid number</span>
                                <label>Password :</label>
                                <input type="password" name="password" id="reg1_password">
                                <label>Conform Password :</label>
                                <input type="password" name="cpassword" id="reg1_cpassword">
                            </div>
                            <div class="end-border-and-btn">
                                <!-- data-bs-toggle="modal"
                                        data-bs-target="#myModalsell-out-sumit1" -->
                                <div class="actions-btn-hold btn_box_border">
                                    <a class="btn_border" href="javascript:dealerregisteruser('reg1')" style="padding:0px 45px;" >SUBMIT <i
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
@stop
@section('footer')

<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD9Q9MOTLukAh9rokc-_gN3wVNmf66Ve9M&callback=initAutocomplete&libraries=places&v=weekly"
      defer
    ></script>
<script type="text/javascript">
   var autocomplete;
var address1Field;
var address2Field;
var postalField;

function initAutocomplete() {
  address1Field = document.querySelector("#reg1_address");
  address2Field = document.querySelector("#reg1_street_address");
  postalField = document.querySelector("#reg1_postcode");
  // Create the autocomplete object, restricting the search predictions to
  // addresses in the US and Canada.
  autocomplete = new google.maps.places.Autocomplete(address1Field, {
    componentRestrictions: {  },
    fields: ["address_components", "geometry"],
    types: ["address"],
  });
  address1Field.focus();
  // When the user selects an address from the drop-down, populate the
  // address fields in the form.
  autocomplete.addListener("place_changed", fillInAddress);
}

function fillInAddress() {
  // Get the place details from the autocomplete object.
  const place = autocomplete.getPlace();
  var address1 = "";
  var postcode = "";

  // Get each component of the address from the place details,
  // and then fill-in the corresponding field on the form.
  // place.address_components are google.maps.GeocoderAddressComponent objects
  // which are documented at http://goo.gle/3l5i5Mr
  for (const component of place.address_components) {
    // @ts-ignore remove once typings fixed
    const componentType = component.types[0];

    switch (componentType) {
      case "street_number": {
        address1 = `${component.long_name} ${address1}`;
        break;
      }

      case "route": {
        address1 += component.short_name;
        break;
      }

      case "postal_code": {
        postcode = `${component.long_name}${postcode}`;
        break;
      }

      case "postal_code_suffix": {
        postcode = `${postcode}-${component.long_name}`;
        break;
      }
      case "locality":
        document.querySelector("#reg1_locality").value = component.long_name;
        break;
      case "administrative_area_level_1": {
        document.querySelector("#reg1_state").value = component.short_name;
        break;
      }
      case "country":
        document.querySelector("#reg1_country").value = component.long_name;
        break;
    }
  }

  address1Field.value = address1;
  postalField.value = postcode;
  address2Field.focus();
}

window.initAutocomplete = initAutocomplete;
   function clearallinput(){
       $(".closebox").removeAttr('checked');
   }
   
   if($("#filter_id").val()==1){
       checkactivefilter(1);
   }
    if($("#filter_id").val()==2){
       checkactivefilter(2);
   }
    if($("#filter_id").val()==3){
       checkactivefilter(3);
   }
    if($("#filter_id").val()==4){
       checkactivefilter(4);
   }

   function searchfilterresult(){
      var makelist = new Array();
      var sellertype = new Array();
      var country_list = new Array();
      var steering_position = new Array();
      var search_cars = $("#search_cars").val();

      $.each($("input[name='make[]']:checked"), function() {
          makelist.push($(this).val());
      });
      $.each($("input[name='seller_type[]']:checked"), function() {
          sellertype.push($(this).val());
      });
      $.each($("input[name='country_list[]']:checked"), function() {
          country_list.push($(this).val());
      });
      $.each($("input[name='steering_position[]']:checked"), function() {
          steering_position.push($(this).val());
      });  
      $.ajax({
                  url: '{{url("searchcars")}}',
                  method:'get',
                  data: { makelist:makelist.toString(),sellertype:sellertype.toString(),country_list:country_list.toString(),steering_position:steering_position.toString(),search_cars:search_cars},
                  success: function( data ) {
                           var str = JSON.parse(data);
                           $("#live_cars_list").html(str.livetxt);
                           $("#coming_car_list").html(str.comingtxt);
                           $("#private_cars_list").html(str.privatetxt);
                           $("#sold_car_list").html(str.soldtxt);
                           $("#totalcommingsooncar").html(str.comingcount);
                           $("#totallivecar").html(str.livecount);
                           $("#totalprivatecar").html(str.privatecount);
                           $("#totalsoldcar").html(str.soldcount);

                      
                  }
      }); 
      $("#filter_drop").removeClass('show');
   }
   
   function callShare()
	   {
		   //alert(arguments[0]+" "+arguments[1]+" "+arguments[2]);
		   var shareData = {
			title: arguments[0],
			text: arguments[0],
			url: arguments[1],
      		}
		navigator.share(shareData);
	   }

         $(window).on('load resize', function () {

             var pageNavHeight = $('.page_nav').height();

             var winHeight = $(window).height();

             console.log(pageNavHeight, winHeight);

             $('.main_content').height(winHeight - pageNavHeight);

         });

         $(function () {

         

         

             $('.__trigger_links_content').on('click', function (e) {

                 e.preventDefault();

                 $('.overlay').addClass('called');

                 $('.links_content').addClass('called');

         

                 $('.about_content').removeClass('called');

                 $('.page_nav').find('a').removeClass('active');

                 $(this).addClass('active');

             });

         

             $('.__trigger_about_content').on('click', function (e) {

                 e.preventDefault();

                 $('.overlay').addClass('called');

                 $('.about_content').addClass('called');

         

                 $('.links_content').removeClass('called');

                 $('.page_nav').find('a').removeClass('active');

                 $(this).addClass('active');

             });

         

             $('.__trigger_main_content').on('click', function (e) {

                 e.preventDefault();

                 $('.overlay').removeClass('called');

                 $('.links_content, .about_content').removeClass('called');

                 $('.page_nav').find('a').removeClass('active');

                 $('.main_content_triggerer').addClass('active');

                 $(this).addClass('active');

             });

         });
</script>

@stop