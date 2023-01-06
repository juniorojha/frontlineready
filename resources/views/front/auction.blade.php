@extends('front.layout')
@section('title')
Front Line Ready - Home
@stop
@section('meta-data')
@stop
@section('content')
 <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick-theme.min.css'></style>
<style>
    .wrapper{
  padding: 30px 0;
  overflow-x: hidden;
}


.my-slider{
  padding: 0 70px;
}
.slick-initialized .slick-slide {
    /* background-color: #b32532; */
    color: #FFF;
    height: 412px;
    margin: 0 15px 0 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

ul.slick-dots {
    display: none !important;
}

.slick-next, .slick-prev{
  z-index: 5;
}
.slick-next{
  right: 15px;
}
.slick-prev{
  left: 15px;
}
.slick-next:before, .slick-prev:before{
  color: #000;
  font-size: 26px;
}
.timging-tage p {
    margin-bottom: 0px;
    color: #fff;
    font-size: 17px;
    width: 65%;
    font-family: "Montserrat";
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
                        if($("#end_time_"+id).length){
                            if(d==1){
                                $("#end_time_"+id).html(" In a day")
                            }else{
                                $("#end_time_"+id).html(d+" days")
                            }
                                
                        }
                    }else{
                        if($("#end_time_"+id).length){
                              $("#end_time_"+id).html(d+" "+h+":"+m+":"+s)  
                        }
                       
                    }
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
      <div class="container filter-main-hold-pos" id="filter_section">
         <div class="row">
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
               <div class="search-box">
                  <div class="input-group" style="flex-wrap: unset;">
                     <i class="fas fa-search"></i>
                     <div class="easy-autocomplete">
                        <input class="form-control autosearch-input-mobile" type="search"
                           placeholder="Please enter a stock number, make, model or year" aria-label="Search"
                            autocomplete="off" id="search_cars" name="search_cars" onkeypress="searchfilterresult()" onkeyup="searchfilterresult()">
                     </div>
                  </div>
               </div>
            </div>
        
         </div>
         <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               <div class="product-featur-row">
                  <ul>
                     <li class="actions-btn-hold btn_box_border active-2" id="ls_1">
                        <a class="btn_border" href="javascript:checkactivefilter(1)">Live (<span id="totallivecar">{{count($get_car_live)}}</span>)</a>
                     </li>
                     <li class="actions-btn-hold btn_box_border " id="ls_2">
                        <a class="btn_border" href="javascript:checkactivefilter(2)">Coming Soon (<span id="totalcommingsooncar">{{count($get_car_coming)}}</span>)</a>
                     </li>
                     
                     
                     <li class="actions-btn-hold btn_box_border" id="ls_4">
                        <a class="btn_border" href="javascript:checkactivefilter(4)">Sold (<span id="totalsoldcar">{{count($get_car_sold)}}</span>)</a>
                     </li>
                     <li class="actions-btn-hold btn_box_border" id="ls_4">
                        <a class="btn_border" download href="{{asset('storage/app/public/').'/'.$setting->inventroy_pdf}}">Download Inventory</a>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
 
      <!-- Search and filter end -->
      <!-- main heading start -->
      <div class="heading-border-section" id="header_1">
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
      <div class="container" id="container_1">
         <div class="row" id="live_cars_list">
            
           @foreach($get_car_live as $gc)
               <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
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
                           <a href="{{route('vehicle-detail',['query'=>$gc->key_id])}}"><img src="{{asset('storage/app/public/cars/banner').'/'.$gc->thumbail}}"></a>
                        </div>
                        <div class="heading-hold">
                           <a href="{{route('vehicle-detail',['query'=>$gc->key_id])}}">
                               <h4>{{$gc->year}} | {{$gc->make}} | {{$gc->model}} | {{$gc->mileage}}</h4>
                           </a>
                          <ul class="icons-section">
                           
                           </ul>
                        </div>
                     </div>
                     <div class="product-content">
                       
                     </div>
                     <div class="product-shadow-box">
                       
                        <div class="timging-tage">
                           <p>Ends In : <span id="end_time_{{$gc->id}}">
                               <?php 
                                      $timestamp = date("Y-m-d H:i:s",strtotime($gc->end_date));
                                      $date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $timestamp, Session::get('current_timezone'));
                                      $new_date = $date->setTimezone('UTC');
                                      $date =  \Carbon\Carbon::parse($new_date)->format('Y-m-d');
                                      $time = \Carbon\Carbon::parse($new_date)->format('H:i:s');
                                      $date1 = $date." ".$time;
                               ?>
                            <script type="text/javascript">
                        updateTimer('{{$date1}}','{{$gc->id}}');
                     </script>
                     </span></p>
                     
                        </div>
                        <div class="current-bids">
                           <p>Current Bid: $ {{$gc->base_price}}</p>
                        </div>
                     </div>
                  </div>
               </div>
            @endforeach
         </div>
      </div>
     <div class="heading-border-section hide " id="header_2">
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
      <div class="container hide" id="container_2">
         <div class="row" id="coming_car_list">
             @foreach($get_car_coming as $gc)
               <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
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
                           <a href="{{route('vehicle-detail',['query'=>$gc->key_id])}}"><img src="{{asset('storage/app/public/cars/banner').'/'.$gc->thumbail}}"></a>
                        </div>
                        <div class="heading-hold" style="    border: 1px solid black;padding: 7px;margin-bottom: 13px;">
                           <a href="{{route('vehicle-detail',['query'=>$gc->key_id])}}">
                              <h4>{{$gc->year}} | {{$gc->make}} | {{$gc->model}} | {{$gc->mileage}}</h4>
                           </a>
                           <ul class="icons-section">
                             
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            @endforeach
          
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
               <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
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
                           <a href="{{route('vehicle-detail',['query'=>$gc->key_id])}}"><img src="{{asset('storage/app/public/cars/banner').'/'.$gc->thumbail}}"></a>
                        </div>
                        <div class="heading-hold" style="    border: 1px solid black;padding: 7px;margin-bottom: 13px;">
                           <a href="{{route('vehicle-detail',['query'=>$gc->key_id])}}">
                              <h4>{{$gc->year}} | {{$gc->make}} | {{$gc->model}} | {{$gc->mileage}}</h4>
                           </a>
                           <ul class="icons-section">
                              
                           </ul>
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
     
    
     
      <input type="hidden" id="filter_id" value="{{isset($id)?$id:0}}"/>
@stop
@section('footer')
<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD9Q9MOTLukAh9rokc-_gN3wVNmf66Ve9M&callback=initAutocomplete&libraries=places&v=weekly"
      defer
    ></script>
 <script src='https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js'></script>
<script type="text/javascript">
 $(document).ready(function(){
      $('.my-slider').slick({
        slidesToShow: 2,
        slidesToScroll: 1,
        arrows: true,
        dots: true,
        speed: 300,
        infinite: true,
        autoplaySpeed: 3000,
        autoplay: true,
        responsive: [
      {
        breakpoint: 991,
        settings: {
          slidesToShow: 3,
        }
      },
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 1,
        }
      }
    ]
      });
    });
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
    componentRestrictions: {country: ["us"]},
    fields: ["address_components", "geometry"],
    types: ["address"],
  });
  //address1Field.focus();
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
     
      var search_cars = $("#search_cars").val();

    
      $.ajax({
                  url: '{{url("searchcars")}}',
                  method:'get',
                  data: { search_cars:search_cars},
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