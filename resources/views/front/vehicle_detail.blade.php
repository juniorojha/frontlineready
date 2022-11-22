@extends('front.layout')
@section('title')
Front Line Ready - Vehicle Detail
@stop
@section('meta-data')
@stop
@section('content')
<link rel="stylesheet" href="{{asset('public/css/style.css?v=1.1')}}"></style>
<script>
    
        function updateTimer(duration) {
            var interVal=  setInterval(function () {
            future = Date.parse(duration);
            date = new Date().toLocaleString("en-US", { timeZone: '<?=Session::get('timezone')?>' });
            now = Date.parse(date);
            diff = future - now;
          //  console.log(diff);
       
             days = Math.floor(diff / (1000 * 60 * 60 * 24));
            hours = Math.floor(diff / (1000 * 60 * 60));
            mins = Math.floor(diff / (1000 * 60));
            secs = Math.floor(diff / 1000);
        
           
           /* h = hours;
            m = mins - hours * 60;
            s = secs - mins * 60;*/
            
            
            d = days;
            h = hours - days * 24;
            m = mins - hours * 60;
            s = secs - mins * 60;
            
            m = m < 10 ? "0" + m : m;
            s = s < 10 ? "0" + s : s;
            h = h < 10 ? "0" + h : h;
          //  $("#day_car").html(d);
          //  $("#hour_car").html(h);
          //  $("#min_car").html(m);
          //  $("#sec_car").html(s);
            $("#day_car_bid").html(d);
            $("#hour_car_bid").html(h);
            $("#min_car_bid").html(m);
            $("#sec_car_bid").html(s);
                    
  
            },1000);
       }

       
            
       
</script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.0/moment.min.js'></script>

<script>
   
  
    </script>
    <div class="row" style="    margin-top: 50px;">
        <div class="col-md-6">
            <div class="container">
<!-- Flickity HTML init -->
<div class="carousel carousel-main" data-flickity='{"pageDots": false }'>
  <div class="carousel-cell"><img src="{{asset('storage/app/public/cars/banner').'/'.$data->thumbail}}" style="width: 100%;height: inherit;"/></div>
   @if(isset($data->images))
        @foreach($data->images as $di)
            <div class="carousel-cell"><img src="{{asset('storage/app/public/cars/banner').'/'.$di->image}}" style="width: 100%;height: inherit;"/></div>
        @endforeach
   @endif
</div>

<div class="carousel carousel-nav"
  data-flickity='{ "asNavFor": ".carousel-main", "contain": true, "pageDots": false }'>
  <div class="carousel-cell"><img src="{{asset('storage/app/public/cars/banner').'/'.$data->thumbail}}" style="width: 150px;height: inherit;"/></div>
  
  @if(isset($data->images))
        @foreach($data->images as $di)
            <div class="carousel-cell"><img src="{{asset('storage/app/public/cars/banner').'/'.$di->image}}" style="width: 150px;height: inherit;"/></div>
        @endforeach
   @endif
  
  
</div>

</div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <ul class="vehicles-models-detail">
                        <li> <span>Make</span>
                            <p>{{$data->make_id}}</p>
                        </li>
                        <li> <span>Year</span>
                            <p>{{$data->year}}</p>
                        </li>
                        <li> <span>VIN</span>
                            <p>{{$data->vin}}</p>
                        </li>
                         <li> <span>Transmission</span>
                            <p>{{$data->transmission}}</p>
                        </li>
                        
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <ul class="vehicles-models-detail">
                        <li> <span>Model</span>
                            <p>{{$data->model}}</p>
                        </li>
                        <li> <span>Mileage</span>
                            <p>{{$data->mileage}}</p>
                        </li>
                        <li> <span>Engine Size</span>
                            <p>{{$data->engine_size}}</p>
                        </li>
                        <li> <span>Stock</span>
                            <p>{{$data->stock}}</p>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <ul class="vehicles-models-detail">
                        <li> <span>Exterior Color</span>
                            <p>{{$data->exterior_color}}</p>
                        </li>
                        <li> <span>Interior Color</span>
                            <p>{{$data->interior_color}}</p>
                        </li>
                        <li> <span>Interior Materia</span>
                            <p>{{$data->interior_materia}}</p>
                        </li>
                        <li> <span>Town/City</span>
                            <p>{{$data->city_id}}</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    


<div class="current-bid-register-tab-banner" style="margin-top:15px">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                        <div class="live-bid-hits-tags">
                                                        <a href="">Coming Soon</a>
                                                        
                            <div class="bids-times"> <span class="end-in">
                                                            </span></div>
                           
                                                   
                                                    </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="register-login-makebid" style="">
                            <ul>
                                                                    
                                <li> <a class="regisder-bids" data-bs-toggle="modal" data-bs-target="#register_user_model" href="#" onclick="changemodel('login_content')">Login <br>
                                        To Make A Bid</a> </li>
                                                                                
                                       
                               
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <!--Banner Slider end -->

    <!--Vahicle Description style start here -->
    <div class="my-accont-section">
        

        <div class="home-blog-section vehicle-des-pd-top">
           
         

            <div class="container">
               
               
       
               
                @if($data->status==1)
                <div class="row" id="bid_section">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                        <div class="card-bg-gary">
                            <div class="heading-border-section card-heading-box" style="margin-bottom: 10px;">
                                <span class="firts"></span>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="heading-box cutsom-white-bg card-heads-h">
                                                <h5>Auction Bidding</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <span class="second"></span>
                            </div>
                            <br>
                            <br>
                            <br>
                            <div class="heading-inner-pd">
                                <div class="vehicles-addiction-bidding-cards">
                                    <h5>Current Bidding :
                                        <p ><span id="car_currency">$ </span><span id="bid_amount_html">{{$data->base_price}}</span></p>
                                    </h5>
                                    <p style="color:green">Minimum  Bid: $<span id="next_min_bid">0</span> </p>
                                    <div class="form-group col-lg-12 col-md-12">
                                        <div class="border-input-hold">
                                            <input type="text" style="text-align: center;" name="bid_amount" id="bid_amount">
                                        </div>
                                    </div>
                                    <ul>
                                        @if(empty(Auth::id()))
                                        <li class="btn_box_border">
                                            <a class="btn_border" data-bs-toggle="modal" data-bs-target="#register_user_model" href="#" onclick="changemodel('reg_pharse_1_content')">Register To Bid</a>
                                        </li>
                                        <li class="btn_box_border active-btn-colors">
                                            <a class="btn_border" data-bs-toggle="modal" style="border: 1px solid #fff !important;color: #fff;" data-bs-target="#register_user_model" href="#" onclick="detaillogin('login_content')">Login To Bid</a>
                                        </li>
                                        @else
                                          @if(Auth::user()->email_verification=='0')
                                                <li class="btn_box_border">
                                                    <a class="btn_border" href="javascript:void()" onclick="accountnotverified()" >Place Live Bid</a>
                                                </li>
                                                <li class="btn_box_border">
                                                    <a class="btn_border" href="javascript:void()" onclick="accountnotverified()">Place Max Bid</a>
                                                </li>
                                          @endif
                                         
                                                <li class="btn_box_border">
                                                    <a class="btn_border" href="javascript:placelivebid()" >Place Live Bid</a>
                                                </li>
                                                <li class="btn_box_border">
                                                    <a class="btn_border" href="javascript:placemaxbid()">Place Max Bid</a>
                                                </li>
                                        
                                        
                                       
                                        @endif
                                    </ul>
                                    <p>Our automatic bidding ensures that you never bid more than is required to remain
                                        the highest bidder and our Anti-Sniping technology means that an auction will
                                        only end once everybody has stopped bidding. <a href="{{route('term-privacy')}}">Find Out More.</a></p>
                                    <br>
                                </div>
                                <div class="vehicles-addiction-timmers">
                                    <span>Ends : <p>
                                        
                                         <?php
                                            $timestamp = date("Y-m-d H:i:s",strtotime($data->end_date));
                                            $date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $timestamp, 'UTC');
                                   
                                            $new_date1 = $date->setTimezone(Session::get('current_timezone'));
                                            echo $date =  \Carbon\Carbon::parse($new_date1)->format('l dS F');

                                            $timestamp = date("Y-m-d H:i:s",strtotime($data->end_date));
                                      $date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $timestamp, Session::get('current_timezone'));
                                      $new_date = $date->setTimezone('UTC');
                                      $date =  \Carbon\Carbon::parse($new_date)->format('Y-m-d');
                                      $time = \Carbon\Carbon::parse($new_date)->format('H:i:s');
                                      $date1 = $date." ".$time;
                                        ?>
                                        </p><script type="text/javascript">
                        updateTimer('{{$date}}','{{$data->id}}');
                     </script></span>
                                    <div class="bids-times">
                                        <ul>
                                            <li> <span id="day_car_bid">0</span>
                                                <p>Days</p>
                                            </li>
                                            <li> <span id="hour_car_bid">00</span>
                                                <p >Hours</p>
                                            </li>
                                            <li> <span id="min_car_bid">00</span>
                                                <p>Min</p>
                                            </li>
                                            <li> <span id="sec_car_bid">00</span>
                                                <p>Sec</p>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- <b>Auction Views : <span id="car_views" style="font-size: 15px;font-weight: bolder;">{{$data->totalViews}}</span></b> -->
                                    <p>Last minute bidding and auction reserve - <a href="{{route('term-privacy')}}">learn more</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="cards-footer">
                            <img src="{{asset('public/logo/transparent_logo.png')}}">
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                        <div class="card-bg-gary">
                            <div class="heading-border-section card-heading-box" style="margin-bottom: 10px;">
                                <span class="firts"></span>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="heading-box cutsom-white-bg card-heads-h">
                                                <h5>Ask Owner</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <span class="second"></span>
                                  
                            </div>
                            <div class="heading-inner-pd">
                                <div class="vehicles-addiction-bidding-cards-second">
                                     <span id="error_msg_comment"></span>
                                    <div class="form-group col-lg-12 col-md-12">
                                        
                                        <div class="border-input-hold-second-cards">
                                            <input type="hidden" id="car_id" value="{{$data->id}}"/>
                                            <textarea id="comment_desc" name="comment_desc"  placeholder="Type in here...."></textarea>
                                            
                                        </div>
                                       
                                    </div>
                                    <div class="form-group col-lg-12 col-md-12">
                                          <li class="btn_box_border" style='    float: right; margin-right: 15px;'>
                                               @if(empty(Auth::id()))
                                               <a class="btn_border" href="javascript:void()" data-bs-toggle="modal" data-bs-target="#register_user_model" href="#" onclick="detaillogin('login_content')">Login To Bid</a>
                                               @else
                                            <a class="btn_border" style="float: right;" href="javascript:void()" onclick="addcomment()">Send</a>
                                            @endif
                                        </li>
                                    </div>
                                   
                                    <div class="show-bids-and-chattes" style="    margin-top: 52px;">
                                        <ul style="overflow-y: auto;height: 450px;    padding: 10px;" id="comment_area">
                                            <li><div class="show-bids-date"> <a href="javascript:showbid()">Show Bids Only</a></div></li>
                                            @if(isset($data->Comment))
                                                @foreach($data->Comment as $dc)
                                                   @if($dc->type==1) <!--bid user-->
                                                            <li class="bid_div">                                                    
                                                            <div class="tages">
                                                                <p> $ {{$dc->amount}} bid by {{$dc->username}}</p>
                                                                <p>
                                                          <?php
                                                          
                                                          $date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $dc->datetime,'UTC');
                                                       $td = $date->setTimezone(Session::get('current_timezone'));
                                                    echo \Carbon\Carbon::parse($td)->format('Y-m-d @ h:i:s'); 
                                                   
                                                          ?>          
                                                                    </p>
                                                            </div>
                                                        
                                                    </li>
                                                   @else <!--comment user-->
                                                   <li class="chat-bg-color comment_div" style="">
                                                <div class="chat-box">
                                                   
                                                    <div class="chatt-innter-content">
                                                        <span>{{$dc->username}}</span>
                                                        <p>{{$dc->comment}}</p>                                                     
                                                        <p class="time-show" id="time_show_{{$dc->id}}">
                                                        <?php
                                                                $date = \Carbon\Carbon::createFromFormat('Y-m-d H:i', date('Y-m-d H:i',strtotime($dc->datetime)),'UTC');
                                                                $td = $date->setTimezone(Session::get('current_timezone'));
                                                                echo \Carbon\Carbon::parse($td)->format('Y-m-d @ h:i'); 
                                                        ?></p>
                                                    </div>

                                                </div>
                                                </li>
                                                   @endif
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cards-footer">
                            <img src="{{asset('public/logo/transparent_logo.png')}}">
                        </div>
                    </div>
                </div>
                @endif
            </div>
       </div>
<input type="hidden" name="timezone" id="timezone">
@stop

@section('footer')
  <script src='https://npmcdn.com/flickity@2/dist/flickity.pkgd.js'></script>
<script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.7.7/dist/index.bundle.min.js"></script>

<script>


     function updateTextView(_obj){
  var num = getNumber(_obj.val());
  if(num==0){
    _obj.val('');
  }else{
    _obj.val(num.toLocaleString());
  }
}

function cardnotadded(){
     swal({
        title: "Please add a payment method!",
        text: "",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'My Account',
        cancelButtonText: "Cancel",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function(isConfirm){
    if (isConfirm){
        window.location.href="{{route('billing')}}";
    } else {
        window.location.reload();
    }
    });
}

function accountnotverified(){
    swal("Please complete your email verification!");

}

function getNumber(_str){
  var arr = _str.split('');
  var out = new Array();
  for(var cnt=0;cnt<arr.length;cnt++){
    if(isNaN(arr[cnt])==false){
      out.push(arr[cnt]);
    }
  }
  return Number(out.join(''));
}
$(document).ready(function(){
  $('#bid_amount').on('keyup',function(){
    updateTextView($(this));
  });
});

$("#contact_seller").click(function() {
    $('html, body').animate({
        scrollTop: $("#bid_section").offset().top
    }, 2000);
});
$("#move_to_bid").click(function() {
    $('html, body').animate({
        scrollTop: $("#bid_section").offset().top
    }, 2000);
});

function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
setInterval(function () {
    $.ajax({
                url: '{{route("fetch-visitor")}}',
                method:'get',
                data: { car_id:$("#car_id").val()},
                success: function( data ) {
                    if(data!=0){
                        var str = JSON.parse(data);
                        $("#car_views").html(str.views);
                        $("#bid_amount_html").html(str.bid_amount);  
                        var txt = ""; 
                        var color = "";                     
                        $("#next_min_bid").html(numberWithCommas(str.minmum_amount_next_bid));
                        
                        $("#reverser_status").html(txt);
                        
                    }
                   
                }
    });
},5000);

 </script>
@stop