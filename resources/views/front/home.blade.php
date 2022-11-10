@extends('front.layout')
@section('title')
Frontline Ready - Home
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

    <div class="heading-border-section" id="submit_entry_from">
        <span class="firts"></span>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-heading-cl-pos">
                    <div class="heading-box cutsom-white-bg sell-with-heading--second">
                        <h2 style="">Register as a dealer to buy</h2>
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