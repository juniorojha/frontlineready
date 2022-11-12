@extends('front.layout')
@section('title')
Front Line Ready - Vehicle Detail
@stop
@section('meta-data')
@stop
@section('content')

<script>
    
        function updateTimer(duration) {
            var interVal=  setInterval(function () {
            future = Date.parse(duration);
            date = new Date().toLocaleString("en-US", { timeZone: '<?=Session::get('timezone')?>' });
             now = Date.parse(date);
            diff = future - now;
       
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
            $("#day_car").html(d);
            $("#hour_car").html(h);
            $("#min_car").html(m);
            $("#sec_car").html(s);
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
<?php $path = asset('storage/app/public/cars/banner').'/'.$data->banner;?>
  <div class="banner slider section hold" style="background-image: url('<?=$path?>');">
        <div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="banner-slider-content-hold sell-with-us-heading">

                </div>
            </div>
        </div>
    </div>
    <!--Banner Slider end -->

    <!--Vahicle Description style start here -->
    <div class="my-accont-section">
        <div class="heading-border-section"> <span class="firts"></span>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-heading-cl-pos">
                        <div class="heading-box cutsom-white-bg">
                            <h2 class="reduce-size">{{$data->name}}</h2>
                        </div>
                        <span class="left"></span>
                        <span class="Right"></span>
                    </div>
                </div>
            </div> <span class="second"></span>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="vehicles-description-section">
                        <!--<h4>Guide Price</h4>
                        <p>€40,000 - €60,000</p>-->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <ul class="vehicles-models-detail">
                        <li> <span>Make</span>
                            <p>{{$data->make_id}}</p>
                        </li>
                        <li> <span>Manufacture Year</span>
                            <p>{{$data->year}}</p>
                        </li>
                        <li> <span>Steering Position</span>
                            @if($data->steering_position==2)
                                <p>Right-hand Drive</p>
                            @else
                                <p>Left-hand Drive</p>
                            @endif
                        </li>
                        <li> <span>Chassis Number</span>
                            <p>{{$data->chassis_no}}</p>
                        </li>
                        <li> <span>Former Keepers</span>
                            <p>{{$data->former_keepers}}</p>
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
                        <li> <span>Country</span>
                            <p>{{$data->country_id}}</p>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <ul class="vehicles-models-detail">
                        <li> <span>Variant</span>
                            <p>{{$data->variant}}</p>
                        </li>
                        <li> <span>Gearbox</span>
                            <p>{{$data->gearbox}}</p>
                        </li>
                        <li> <span>Color</span>
                            <p>{{$data->color}}</p>
                        </li>
                        <li> <span>Town/City</span>
                            <p>{{$data->city_id}}</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="current-bid-register-tab-banner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                        <div class="live-bid-hits-tags">
                            @if($data->status==1)
                             <a href="">Live</a>
                            @elseif($data->status==2)
                            <a href="">Coming Soon</a>
                            @elseif($data->status==3)
                            <a href="">Private sales</a>
                            @elseif($data->status==4)
                            <a href="">Sold</a>
                            @endif
                            
                            <div class="bids-times"> <span class="end-in">
                                @if($data->status==1)
                                
                                 <?php 
                                  
                                      $timestamp = $data->aucation_enddate.' '.$data->aucation_endtime;
                                      $date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $timestamp, 'UTC');
                                   
                                      $new_date = $date->setTimezone(Session::get('timezone'));
                                      $date =  \Carbon\Carbon::parse($new_date)->format('Y-m-d');
                                      $time = \Carbon\Carbon::parse($new_date)->format('H:i:s');
                                      $date1 = $date." ".$time;
                                     //echo ;
                                    
                               ?>
                            <script type="text/javascript">
                                updateTimer('{{$date1}}');
                            </script>
                                Ends In :</span>
                                <ul>
                                    <li> <span id="day_car">0</span>
                                        <p >Days</p>
                                    </li>
                                    <li> <span id="hour_car">00</span>
                                        <p >Hours</p>
                                    </li>
                                    <li> <span id="min_car">00</span>
                                        <p >Min</p>
                                    </li>
                                    <li> <span id="sec_car">00</span>
                                        <p >Sec</p>
                                    </li>
                                </ul>
                                 @endif
                            </div>
                           
                            @if($data->status==1)
                            <div class="current-bid-tags">
                                <p>Current Bid : <span>{{$data->currency_symbol}}{{$data->bid_price}}</span></p>
                                  <?php 
                                            if($data->reserve_met==1){
                                                $color = "green";
                                            }else if($data->reserve_met==2){
                                                $color = "red";
                                            }else if($data->reserve_met==3){
                                                $color = "yellow";
                                            }

                                  ?>
                                 <div class="head-bg-color {{$color}}"  id="reverse_status_bid" style="max-width: 100%;">
                                    <p id="reverser_status">
                                        @if($data->reserve_met==1)
                                            RESERVE MET
                                        @elseif($data->reserve_met==2)
                                            RESERVE NOT MET
                                        @elseif($data->reserve_met==3)
                                            RESERVE NEARLY MET
                                        @endif
                                   </p>
                                </div>                                
                            </div>
                            @endif
                       
                            @if($data->status==4)
                            <div class="current-bid-tags" style="width:170px;margin-left: 0px;">
                                <p style="font-weight: 600;font-size: 15px;">Sold Date </p>
                                <div class="head-bg-color" style="    max-width: 50%;">
                                    <p style="padding:0px;">{{$data->sold_date}}</p>
                                </div>
                            </div>
                            <div class="current-bid-tags" style="width:170px">
                                <p style="font-weight: 600;font-size: 15px;">Winning Bid </p>
                                <div class="head-bg-color">
                                    <p style="padding:0px">{{$data->currency_symbol}}{{$data->winning_bid}}</p>
                                </div>
                            </div>
                            <div class="current-bid-tags" style="width:170px">
                                <p style="font-weight: 600;font-size: 15px;">Total Bid </p>
                                <div class="head-bg-color">
                                    <p style="padding:0px">{{$data->total_bid}}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="register-login-makebid" style="">
                            <ul>
                                  @if(Auth::id())
                                  <?php $color = $data->is_like==1?'chartreuse':'black';  ?>
                                  <li>
                                      @if($data->status==1)
                                       <a class="regisder-bids" href="javascript:void()" id="move_to_bid">Make Your Bid</a>
                                      @endif
                                   <a href="javascript:bookcardetail('{{$data->id}}')" style="height: 40px;" class="book-mark-icons"> <i class="fas fa-bookmark" id="book_mark_{{$data->id}}"
                                            aria-hidden="true" style="color:'{{$color}}'"></i> </a>
                                  </li>
                                   
                                  @else
                                  
                                <li> <a class="regisder-bids" data-bs-toggle="modal" data-bs-target="#register_user_model" href="#" onclick="changemodel('login_content')">Login <br>
                                        To Make A Bid</a> </li>
                                        @endif
                                        
                                       
                               
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="home-blog-section vehicle-des-pd-top">
            <div class="blog-left-icons-shape slb-page-hold">
                <img src="{{asset('public/theme/images/shape-logo.png')}}">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="blog-main-heading vehicles-description-conetnst-head">
                            <h2>Introduction</h2>
                           <?= html_entity_decode($data->description)?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="heading-border-section" style="margin-bottom: 10px;">
                <span class="firts"></span>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-heading-cl-pos">
                            <div class="heading-box cutsom-white-bg">
                                <span>VEHICLE OWNER</span>
                                <h2 style="font-family: 'Montserrat';font-size: 35px;padding: 0px;">{{$data->user_name}}</h2>
                            </div>
                            <span class="left"></span>
                            <span class="Right"></span>
                        </div>
                    </div>
                </div>
                <span class="second"></span>
            </div>
            <div class="end-border-and-btn">
                <div class="actions-btn-hold btn_box_border active-btn-colors">
                    <a class="btn_border" href="javascript:void()" id="contact_seller" style="padding:0px 45px;">Contact Seller</a>
                </div>
            </div>
            @if(isset($data->exterior->banner))
            <?php 
                    if($data->exterior->video_type==2){
                        $url  = $data->exterior->media;
                    }else{
                        $url = asset('storage/app/public/cars/video').'/'.$data->exterior->media;
                    }
            ?>
            <div class="vehicles-banner-lists-01">
                <a href="{{$url}}" data-toggle="lightbox"><img src="{{asset('storage/app/public/cars/exterior').'/'.$data->exterior->banner}}" style="width:100%">
                    <img class="video-play-icons" src="{{asset('public/theme/images/video-play.png')}}" >
                </a>
                <a href="{{$url}}" data-remote="{{$url}}" data-toggle="lightbox">

                </a>
            </div>
            @endif
            <div class="heading-border-section vd-content-heads-box-shadow-left">
                <span class="firts"></span>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-heading-cl-pos">
                            <div class="heading-box cutsom-white-bg vd-content-heads">
                                <h2>Exterior</h2>
                            </div>
                            <span class="left"></span>
                            <span class="Right"></span>
                        </div>
                    </div>
                </div>
                <span class="second"></span>
            </div>
            <div class="container">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="vehicles-description-content-inner">
                        <span>Wheels & Tyres</span>
                        <?= isset($data->exterior->wheels_tyres)?html_entity_decode($data->exterior->wheels_tyres):'';?>
                    </div>
                    <div class="vehicles-description-content-inner">
                        <span>Bodywork</span>
                        <?= isset($data->exterior->bodywork)?html_entity_decode($data->exterior->bodywork):'';?>
                    </div>
                    <div class="vehicles-description-content-inner">
                        <span>Paint</span>
                        <?= isset($data->exterior->paint)?html_entity_decode($data->exterior->paint):'';?>
                    </div>
                    <div class="vehicles-description-content-inner">
                        <span>Glass & Trim</span>
                        <?= isset($data->exterior->glass_trim)?html_entity_decode($data->exterior->glass_trim):'';?>
                    </div>
                </div>
            </div>
             @if(isset($data->interior->banner))
            <?php 
                    if($data->interior->video_type==2){
                        $url  = $data->interior->media;
                    }else{
                        $url = asset('storage/app/public/cars/video').'/'.$data->interior->media;
                    }
            ?>
            <div class="vehicles-banner-lists-02">
                <a href="{{$url}}" data-toggle="lightbox" target="_blank"><img src="{{asset('storage/app/public/cars/interior').'/'.$data->interior->banner}}" style="width:100%">
                    <img class="video-play-icons" src="{{asset('public/theme/images/video-play.png')}}">
                </a>
                <a href="{{$url}}" data-remote="{{$url}}" data-toggle="lightbox">

                </a>
            </div>
            @endif
            <div class="heading-border-section vd-content-heads-box-shadow-left">
                <span class="firts"></span>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-heading-cl-pos">
                            <div class="heading-box cutsom-white-bg vd-content-heads">
                                <h2>Interior</h2>
                            </div>
                            <span class="left"></span>
                            <span class="Right"></span>
                        </div>
                    </div>
                </div>
                <span class="second"></span>
            </div>
            <div class="container">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="vehicles-description-content-inner">
                        <span>Seats & Carpets</span>
                        <?= isset($data->interior->seats)?html_entity_decode($data->interior->seats):'';?>
                    </div>
                    <div class="vehicles-description-content-inner">
                        <span>Dashboard</span>
                        <?= isset($data->interior->dashboard)?html_entity_decode($data->interior->dashboard):'';?>
                    </div>
                    <div class="vehicles-description-content-inner">
                        <span>Steering Wheel / Gear Stick</span>
                        <?= isset($data->interior->steering_wheel)?html_entity_decode($data->interior->steering_wheel):'';?>
                    </div>
                </div>
            </div>
             @if(isset($data->mechanics->banner))
            <?php 
                    if($data->mechanics->video_type==2){
                        $url  = $data->mechanics->media;
                    }else{
                        $url = asset('storage/app/public/cars/video').'/'.$data->mechanics->media;
                    }
            ?>
            <div class="vehicles-banner-lists-03">
                <a href="{{$url}}" data-toggle="lightbox"><img src="{{asset('storage/app/public/cars/mechanics').'/'.$data->mechanics->banner}}" style="width:100%">
                    <img class="video-play-icons" src="{{asset('public/theme/images/video-play.png')}}">
                </a>
                <a href="{{$url}}" data-remote="{{$url}}" data-toggle="lightbox">

                </a>
            </div>
            @endif
            <div class="heading-border-section vd-content-heads-box-shadow-left">
                <span class="firts"></span>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-heading-cl-pos">
                            <div class="heading-box cutsom-white-bg vd-content-heads">
                                <h2>Mechanics</h2>
                            </div>
                            <span class="left"></span>
                            <span class="Right"></span>
                        </div>
                    </div>
                </div>
                <span class="second"></span>
            </div>
            <div class="container">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="vehicles-description-content-inner">
                        <span>Engine & Gearbox</span>
                        <?= isset($data->mechanics->engine_gearbox)?html_entity_decode($data->mechanics->engine_gearbox):'';?>
                    </div>
                    <div class="vehicles-description-content-inner">
                        <span>Suspension & Brakes</span>
                        <?= isset($data->mechanics->suspension_brakes)?html_entity_decode($data->mechanics->suspension_brakes):'';?>
                    </div>
                    <div class="vehicles-description-content-inner">
                        <span>The Drive</span>
                        <?= isset($data->mechanics->the_drive)?html_entity_decode($data->mechanics->the_drive):'';?>
                    </div>
                    <div class="vehicles-description-content-inner">
                        <span>Electrics & Other</span>
                        <?= isset($data->mechanics->electrics)?html_entity_decode($data->mechanics->electrics):'';?>
                    </div>
                </div>
            </div>
             <?php 
                              if(isset($data->history->banner)){
                                  $path= url('/')."/storage/app/public/cars/history"."/".$data->history->banner;
                              }
                              else{
                                  $path=asset('public/images/car_placeholder.png');
                              }
                              ?>
                              @if(isset($data->history->banner))
            <div class="vehicles-banner-lists-04" style="background-image:url('{{$path}}')"></div>
            @endif
            <div class="heading-border-section vd-content-heads-box-shadow-left">
                <span class="firts"></span>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-heading-cl-pos">
                            <div class="heading-box cutsom-white-bg vd-content-heads">
                                <h2>History &<br> Paperwork
                                </h2>
                            </div>
                            <span class="left"></span>
                            <span class="Right"></span>
                        </div>
                    </div>
                </div>
                <span class="second"></span>
            </div>
            <div class="container double-border">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="vehicles-description-content-inner">
                        <?= isset($data->history->description)?html_entity_decode($data->history->description):'';?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="center-align">Date</th>
                                    <th class="center-align">Type</th>
                                    <th class="center-align">Mileage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($data->historydata))
                                    @foreach($data->historydata as $dh)
                                        <tr>
                                            <td class="center-align">{{$dh->date}}</td>
                                            <td class="center-align">{{$dh->type}}</td>
                                            <td class="center-align">{{$dh->mileage}}</td>
                                        </tr>
                                   @endforeach
                                @endif
                                                                
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

            <div class="container">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-heading-cl-pos">
                    <div class="heading-box cutsom-white-bg" style="box-shadow: unset;">
                        <h2 style="font-size: 75px;">ALL IMAGES</h2>
                    </div>
                    <span class="left"></span>
                    <span class="Right"></span>
                </div>
                 @if(isset($data->exteriormedia)&&count($data->exteriormedia)>0)
                <div class="row double-border">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="all-images-slides">
                            <div class="end-border-and-btn" style="text-align: right;margin-bottom: 10px;">
                                <h4 style="font-weight: 700;float: left;margin-top: 14px;margin-left:-10px;">Exterior
                                </h4>
                                
                                    <?php $i=0;?>
                                    @if(isset($data->exteriormedia))
                                        @foreach($data->exteriormedia as $dh)
                                            @if($i==0)
                                            <div class="actions-btn-hold btn_box_border" style=" margin: 10px 0px;">
                                              <a class="btn_border" href="{{asset('storage/app/public/cars/exterior').'/'.$dh->media}}" data-toggle="lightbox" data-gallery="hidden-images">VIEW ALL</a>
                                              <?php break;?>
                                              </div>
                                            @endif
                                        @endforeach
                                    @endif
                                
                            </div>
                        </div>
                        <div class="row galler-slider-imgsrow">
                            @if(isset($data->exteriormedia))
                                    @foreach($data->exteriormedia as $dh)                                     
                                        <a href="{{asset('storage/app/public/cars/exterior').'/'.$dh->media}}" data-toggle="lightbox" data-gallery="hidden-images"
                                            class="col-lg-13">
                                            <img src="{{asset('storage/app/public/cars/exterior').'/'.$dh->media}}" class="img-fluid">
                                        </a>
                                   @endforeach
                             @endif
                             @if(isset($data->exteriormedia))
                                    @foreach($data->exteriormedia as $dh)
                                        <div data-toggle="lightbox" data-gallery="hidden-images" data-src="{{asset('storage/app/public/cars/exterior').'/'.$dh->media}}" data-title="Hidden item 0"></div>
                                   @endforeach
                             @endif
                              <div class="Gallery" style="display: none;"></div>
                           
                        </div>
                    </div>
                </div>
                </div>
                @endif
                @if(isset($data->interiormedia)&&count($data->interiormedia)>0)
                <div class="row double-border">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="all-images-slides">
                            <div class="end-border-and-btn" style="text-align: right;margin-bottom: 10px;">
                                <h4 style="font-weight: 700;float: left;margin-top: 14px;margin-left:-10px;">Interior
                                </h4>
                               
                                    <?php $i=0;?>
                                    @if(isset($data->interiormedia))
                                        @foreach($data->interiormedia as $dh)
                                            @if($i==0)
                                             <div class="actions-btn-hold btn_box_border" style=" margin: 10px 0px;">
                                              <a class="btn_border" href="{{asset('storage/app/public/cars/interior').'/'.$dh->media}}" data-toggle="lightbox" data-gallery="hidden-images">VIEW ALL</a>
                                              <?php break;?>
                                              </div>
                                            @endif
                                        @endforeach
                                    @endif
                                
                            </div>
                        </div>
                        <div class="row galler-slider-imgsrow">
                            <?php $i=10;?>
                            @if(isset($data->interiormedia))
                                    @foreach($data->interiormedia as $dh)
                                        <a href="{{asset('storage/app/public/cars/interior').'/'.$dh->media}}" data-toggle="lightbox" data-gallery="hidden-images" class="col-lg-13">
                                            <img src="{{asset('storage/app/public/cars/interior').'/'.$dh->media}}" class="img-fluid">
                                        </a>                                        
                                   @endforeach
                             @endif
                              @if(isset($data->interiormedia))
                                    @foreach($data->interiormedia as $dh)
                                        <div data-toggle="lightbox" data-gallery="hidden-images" data-src="{{asset('storage/app/public/cars/interior').'/'.$dh->media}}" data-title="Hidden item 0"></div>
                                   @endforeach
                             @endif
                        </div>
                    </div>
                </div>
                </div>
                @endif
                @if(isset($data->mechanicsmedia)&&count($data->mechanicsmedia)>0)

                <div class="row double-border">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="all-images-slides">
                            <div class="end-border-and-btn" style="text-align: right;margin-bottom: 10px;">
                                <h4 style="font-weight: 700;float: left;margin-top: 14px;margin-left:-10px;">Mechanics
                                </h4>
                                
                                    <?php $i=0;?>
                                    @if(isset($data->mechanicsmedia))
                                        @foreach($data->mechanicsmedia as $dh)
                                            @if($i==0)
                                            <div class="actions-btn-hold btn_box_border" style=" margin: 10px 0px;">
                                              <a class="btn_border" href="{{asset('storage/app/public/cars/mechanics').'/'.$dh->media}}" data-toggle="lightbox" data-gallery="hidden-images">VIEW ALL</a>
                                              <?php break;?>
                                              </div>
                                            @endif
                                        @endforeach
                                    @endif
                                
                            </div>
                        </div>
                        <div class="row galler-slider-imgsrow">
                            @if(isset($data->mechanicsmedia))
                                    @foreach($data->mechanicsmedia as $dh)
                                        <a href="{{asset('storage/app/public/cars/mechanics').'/'.$dh->media}}" data-toggle="lightbox" data-gallery="hidden-images" class="col-lg-13">
                                            <img src="{{asset('storage/app/public/cars/mechanics').'/'.$dh->media}}" class="img-fluid">
                                        </a>
                                   @endforeach
                             @endif
                             @if(isset($data->mechanicsmedia))
                                    @foreach($data->mechanicsmedia as $dh)
                                        <div data-toggle="lightbox" data-gallery="hidden-images" data-src="{{asset('storage/app/public/cars/mechanics').'/'.$dh->media}}" data-title="Hidden item 0"></div>
                                   @endforeach
                             @endif
                        </div>
                    </div>
                </div>
                </div>
                @endif
 @if(isset($data->historymedia)&&count($data->historymedia)>0)
                <div class="row double-border">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="all-images-slides">
                            <div class="end-border-and-btn" style="text-align: right;margin-bottom: 10px;">
                                <h4 style="font-weight: 700;float: left;margin-top: 14px;margin-left:-10px;">History &
                                    Paperwork</h4>
                                
                                    <?php $i=0;?>
                                    @if(isset($data->historymedia))
                                        @foreach($data->historymedia as $dh)
                                            @if($i==0)
                                            <div class="actions-btn-hold btn_box_border" style=" margin: 10px 0px;">
                                              <a class="btn_border" href="{{asset('storage/app/public/cars/history').'/'.$dh->media}}" data-toggle="lightbox" data-gallery="hidden-images">VIEW ALL</a>
                                              <?php break;?>
                                              </div>
                                            @endif
                                        @endforeach
                                    @endif
                                
                            </div>
                        </div>
                        <div class="row galler-slider-imgsrow">
                            @if(isset($data->historymedia))
                                    @foreach($data->historymedia as $dh)
                                        <a href="{{asset('storage/app/public/cars/history').'/'.$dh->media}}" data-toggle="lightbox" data-gallery="hidden-images" class="col-lg-13">
                                            <img src="{{asset('storage/app/public/cars/history').'/'.$dh->media}}" class="img-fluid">
                                        </a>
                                   @endforeach
                             @endif
                             @if(isset($data->historymedia))
                                    @foreach($data->historymedia as $dh)
                                        <div data-toggle="lightbox" data-gallery="hidden-images" data-src="{{asset('storage/app/public/cars/history').'/'.$dh->media}}" data-title="Hidden item 0"></div>
                                   @endforeach
                             @endif
                        </div>
                    </div>
                </div>
                </div>
                @endif
                <div class="row double-border">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="all-images-slides">
                            <div class="end-border-and-btn" style="text-align: right;margin-bottom: 10px;">
                                <h4 style="font-weight: 700;float: left;margin-top: 14px;margin-left:-10px;">All Video
                                </h4>
                               
                                     @if(isset($data->exterior->banner))
                                     <?php 
                                            if($data->exterior->video_type==2){
                                                $url  = $data->exterior->media;
                                            }else{
                                                $url = asset('storage/app/public/cars/video').'/'.$data->exterior->media;
                                            }
                                    ?>
                                     <div class="actions-btn-hold btn_box_border" style=" margin: 10px 0px;">
                                    <a class="btn_border" href="{{$url}}" data-toggle="lightbox">VIEW ALL</a>
                                    </div>
                                     @endif
                                
                            </div>
                        </div>
                        <div class="row galler-slider-imgsrow">
                            <div class="box1 col-lg-2">                            
                                @if(isset($data->exterior->banner))
                                    <?php 
                                            if($data->exterior->video_type==2){
                                                $url  = $data->exterior->media;
                                            }else{
                                                $url = asset('storage/app/public/cars/video').'/'.$data->exterior->media;
                                            }
                                    ?>
                                        <p>
                                            <a href="{{$url}}" data-toggle="lightbox" class="col-lg-13">
                                                <img src="{{asset('storage/app/public/cars/exterior').'/'.$data->exterior->banner}}" class="img-fluid">
                                            </a>
                                        </p>
                                        <p>
                                            <a href="{{$url}}" data-remote="{{$url}}"
                                                data-toggle="lightbox"></a>
                                        </p>
                                @endif
                            </div>
                            <div class="box1 col-lg-2">
                                @if(isset($data->interior->banner))
                                    <?php 
                                            if($data->interior->video_type==2){
                                                $url  = $data->interior->media;
                                            }else{
                                                $url = asset('storage/app/public/cars/video').'/'.$data->interior->media;
                                            }
                                    ?>           
                                        <p>
                                            <a href="{{$url}}" data-toggle="lightbox" class="col-lg-13">
                                                <img src="{{asset('storage/app/public/cars/interior').'/'.$data->interior->banner}}" class="img-fluid">
                                            </a>
                                        </p>
                                        <p>
                                            <a href="{{$url}}" data-remote="{{$url}}" data-toggle="lightbox"></a>
                                        </p>
                                @endif
                            </div>
                            <div class="box1 col-lg-2">
                                 @if(isset($data->mechanics->banner))
                                    <?php 
                                            if($data->mechanics->video_type==2){
                                                $url  = $data->mechanics->media;
                                            }else{
                                                $url = asset('storage/app/public/cars/video').'/'.$data->mechanics->media;
                                            }
                                    ?>
                                        <p>
                                            <a href="{{$url}}" data-toggle="lightbox" class="col-lg-13">
                                                <img src="{{asset('storage/app/public/cars/mechanics').'/'.$data->mechanics->banner}}" class="img-fluid">
                                            </a>
                                        </p>
                                        <p>
                                            <a href="{{$url}}" data-remote="{{$url}}"
                                                data-toggle="lightbox"></a>
                                        </p>
                                @endif                                
                            </div>
                        </div>
                    </div>
                </div>
               
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
                                        <p ><span id="car_currency">{{$data->currency_symbol}}</span><span id="bid_amount_html">{{$data->bid_price}}</span></p>
                                    </h5>
                                    <p style="color:green">Minimum  Bid: {{$data->currency_symbol}}<span id="next_min_bid">0</span> </p>
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
                                            $timestamp = $data->aucation_enddate.' '.$data->aucation_endtime;
                                            $date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $timestamp, 'UTC');
                                   
                                            $new_date1 = $date->setTimezone(Session::get('current_timezone'));
                                      echo $date =  \Carbon\Carbon::parse($new_date1)->format('l dS F');
                                        ?>
                                        </p></span>
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
                                    <b>Auction Views : <span id="car_views" style="font-size: 15px;font-weight: bolder;">{{$data->totalViews}}</span></b>
                                    <p>Last minute bidding and auction reserve - <a href="{{route('term-privacy')}}">learn more</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="cards-footer">
                            <img src="{{asset('public/theme/images/logo-white.png')}}">
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
                                                                <p> {{$data->currency_symbol}}{{$dc->amount}} bid by {{$dc->username}}</p>
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
                                                    <div class="img-holder"><img src="{{$dc->image}}"></div>
                                                    <div class="chatt-innter-content">
                                                        <span>{{$dc->username}}</span>
                                                        <p>{{$dc->comment}}</p>                                                     
                                                        <p class="time-show" id="time_show_{{$dc->id}}">
                                                        <?php
                                                        $date = \Carbon\Carbon::createFromFormat('Y-m-d H:i', $dc->datetime,'UTC');
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
                            <img src="{{asset('public/theme/images/logo-white.png')}}">
                        </div>
                    </div>
                </div>
                @endif
            </div>
       </div>
<input type="hidden" name="timezone" id="timezone">
@stop

@section('footer')

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
                        if(str.reserve_met==1){
                            txt = "RESERVE MET";
                            color = "green";
                        }
                        if(str.reserve_met==2){
                            txt = "RESERVE NOT MET";
                            color = "red";
                        }
                        if(str.reserve_met==3){
                            txt = "RESERVE NEARLY MET";
                            color = "yellow";
                        }
                        $("#reverse_status_bid").removeClass("green");
                        $("#reverse_status_bid").removeClass("red");
                        $("#reverse_status_bid").removeClass("green");
                        $("#reverse_status_bid").addClass(color);
                        $("#reverser_status").html(txt);
                        
                    }
                   
                }
    });
},5000);

 </script>
@stop