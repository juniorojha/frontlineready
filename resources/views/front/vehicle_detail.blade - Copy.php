@extends('front.layout')
@section('title')
Curating Cars - Vehicle Detail
@stop
@section('meta-data')
@stop
@section('content')

    <link rel="stylesheet" type="text/css" href="{{asset('public/lightbox/gallery.css')}}" media="screen" />
    <style type="text/css">
         .Main {
      padding: 20px;
      margin-top: 150px;
    }
    .nav{
      background-color: #cde5a9;
      padding: 5px;
    }
    .nav .bubble{
      padding: 10px;
      background-color: #edffd2;
      border-radius: 100vw;
      max-width: 100px;
      text-align: center;
      margin-top: 5px;
      display: inline-block;
    }
    .nav .bubble a{
      text-decoration: none;
      color: #ababab;
    }
    .Gallery {
      margin: 20px;
    }
    </style>
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
                            <h2 class="reduce-size">{{$data->year}} {{$data->make_id}} {{$data->model}} V8 Supercharged</h2>
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
                        <h4>Guide Price</h4>
                        <p>€40,000 - €60,000</p>
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
                        <div class="live-bid-hits-tags"> <a href="">LIve</a>
                            <div class="bids-times"> <span class="end-in">Ends In :</span>
                                <ul>
                                    <li> <span>3</span>
                                        <p>Days</p>
                                    </li>
                                    <li> <span>05</span>
                                        <p>Hours</p>
                                    </li>
                                    <li> <span>26</span>
                                        <p>Min</p>
                                    </li>
                                    <li> <span>24</span>
                                        <p>Sec</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="current-bid-tags">
                                <p>Current Bid : <span>£20,000</span></p>
                                <div class="head-bg-color green">
                                    <p>RESERVE MET</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="register-login-makebid" style="">
                            <ul>
                            	  @if(Auth::id())
                            	  @else
                                <li> <a class="regisder-bids" data-bs-toggle="modal" data-bs-target="#register_user_model" href="#" onclick="changemodel('reg_pharse_1_content')">Register/Login <br>
                                        To Make A Bid</a> </li>
                                        @endif
                                <li>
                                    <a href="" class="book-mark-icons"> <i class="fas fa-bookmark"
                                            aria-hidden="true"></i> </a>
                                </li>
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
                    <a class="btn_border" href="" style="padding:0px 45px;">Contact Seller</a>
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
                                <h2>INterior</h2>
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
            <div class="vehicles-banner-lists-04"></div>
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
                <div class="row double-border">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="all-images-slides">
                            <div class="end-border-and-btn" style="text-align: right;margin-bottom: 10px;">
                                <h4 style="font-weight: 700;float: left;margin-top: 14px;margin-left:-10px;">Exterior
                                </h4>
                                <div class="actions-btn-hold btn_box_border" style=" margin: 10px 0px;">
                                    <a class="btn_border" href="javascript:void()" onclick="JavaScriptGallery.openViewer(0)">VIEW ALL</a>
                                </div>
                            </div>
                        </div>
                        <div class="row galler-slider-imgsrow">
                        	@if(isset($data->exteriormedia))
                            	 	@foreach($data->exteriormedia as $dh)
		                                <a href="javascript:void()" data-toggle="lightbox" data-gallery="hidden-images" class="col-lg-13">
			                                <img src="{{asset('storage/app/public/cars/exterior').'/'.$dh->media}}" class="img-fluid codeImage galleryJS addToGallery">
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

                <div class="row double-border">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="all-images-slides">
                            <div class="end-border-and-btn" style="text-align: right;margin-bottom: 10px;">
                                <h4 style="font-weight: 700;float: left;margin-top: 14px;margin-left:-10px;">Interior
                                </h4>
                                <div class="actions-btn-hold btn_box_border" style=" margin: 10px 0px;">
                                    <a class="btn_border" href="javascript:void()" onclick="JavaScriptGallery.openViewer(0)">VIEW ALL</a>
                                </div>
                            </div>
                        </div>
                        <div class="row galler-slider-imgsrow">
                            <?php $i=10;?>
                            @if(isset($data->interiormedia))
                            	 	@foreach($data->interiormedia as $dh)
		                                
                                        <a href="javascript:void()" class="col-lg-13">
                                        <img loading="lazy" class="img-fluid" alt="Image2" width="300px" height="169px" id="{{$i}}" onclick="JavaScriptGallery.openViewer(this.id)" src="{{asset('storage/app/public/cars/interior').'/'.$dh->media}}"></a>
                                        <?php $i++;?>
	                               @endforeach
                             @endif
                        </div>
                    </div>
                </div>

                <div class="row double-border">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="all-images-slides">
                            <div class="end-border-and-btn" style="text-align: right;margin-bottom: 10px;">
                                <h4 style="font-weight: 700;float: left;margin-top: 14px;margin-left:-10px;">Mechanics
                                </h4>
                                <div class="actions-btn-hold btn_box_border" style=" margin: 10px 0px;">
                                    <a class="btn_border" href="">VIEW ALL</a>
                                </div>
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

                <div class="row double-border">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="all-images-slides">
                            <div class="end-border-and-btn" style="text-align: right;margin-bottom: 10px;">
                                <h4 style="font-weight: 700;float: left;margin-top: 14px;margin-left:-10px;">History &
                                    Paperwork</h4>
                                <div class="actions-btn-hold btn_box_border" style=" margin: 10px 0px;">
                                    <a class="btn_border" href="">VIEW ALL</a>
                                </div>
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
                <div class="row">
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
                                        <p> £20,000</p>
                                    </h5>
                                    <p>Enter Your Maximum Bid:</p>
                                    <div class="form-group col-lg-12 col-md-12">
                                        <div class="border-input-hold">
                                            <input type="text" name="">
                                        </div>
                                    </div>
                                    <ul>
                                        <li class="btn_box_border">
                                            <a class="btn_border" data-bs-toggle="modal" data-bs-target="#register_user_model" href="#" onclick="changemodel('reg_pharse_1_content')">Register To Bid</a>
                                        </li>
                                        <li class="btn_box_border active-btn-colors">
                                            <a class="btn_border" data-bs-toggle="modal" data-bs-target="#register_user_model" href="#" onclick="changemodel('login_content')">Login To Bid</a>
                                        </li>
                                    </ul>
                                    <p>Our automatic bidding ensures that you never bid more than is required to remain
                                        the highest bidder and our Anti-Sniping technology means that an auction will
                                        only end once everybody has stopped bidding. <a href="">Find Out More.</a></p>
                                    <br>
                                </div>
                                <div class="vehicles-addiction-timmers">
                                    <span>Ends : <p>Monday 25 October</p></span>
                                    <div class="bids-times">
                                        <ul>
                                            <li> <span>3</span>
                                                <p>Days</p>
                                            </li>
                                            <li> <span>05</span>
                                                <p>Hours</p>
                                            </li>
                                            <li> <span>26</span>
                                                <p>Min</p>
                                            </li>
                                            <li> <span>24</span>
                                                <p>Sec</p>
                                            </li>
                                        </ul>
                                    </div>
                                    <b>Auction Views : 772</b>
                                    <p>Last minute bidding and auction reserve - <a href="">learn more</a></p>
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
                                    <div class="form-group col-lg-12 col-md-12">
                                        <div class="border-input-hold-second-cards">
                                            <textarea placeholder="Type in here...."></textarea>
                                        </div>
                                    </div>
                                    <div class="show-bids-and-chattes">
                                        <ul>
                                            <li>
                                                <div class="show-bids-date">
                                                    <a href="">Show Bids Only</a>
                                                    <div class="tages">
                                                        <p> £20,000 bid by brend4nn</p>
                                                        <p> 22.10.2021 @ 18:15:47</p>
                                                    </div>
                                                    <div class="tages">
                                                        <p> £17,500 bid by Chriszee</p>
                                                        <p> 22.10.2021 @ 15:18:13</p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="chat-bg-color" style="
                                        ">
                                                <div class="chat-box">
                                                    <div class="img-holder"><img src="{{asset('public/theme/images/user-thumb.jpg')}}"></div>
                                                    <div class="chatt-innter-content">
                                                        <span>davewebb</span>
                                                        <p>Hi, Have you had the frame inspected for cracks around the
                                                            bulk head? Thanks</p>
                                                        <a href="">Reply</a>
                                                        <p class="time-show">2 days ago</p>
                                                    </div>

                                                </div>

                                                <div class="chat-box reply-box">
                                                    <div class="img-holder"><img src="{{asset('public/theme/images/user-thumb.jpg')}}"></div>
                                                    <div class="chatt-innter-content">
                                                        <span>davewebb</span>
                                                        <p>Hi, No cracks on bulkhead!</p>
                                                        <a href="">Reply</a>
                                                        <p class="time-show">2 days ago</p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="tages">
                                                    <p> £15,500 bid by Zabbdee</p>
                                                    <p> 21.10.2021 @ 20:30:53</p>
                                                </div>
                                            </li>
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

            </div>




        </div>
       
        
      
@stop
@section('footer')
 
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="{{asset('public/lightbox/gallery.js?v=033')}}"></script>
<script>

      /*
      * For every Day/Project a new "addGallery"
      */

      JavaScriptGallery.setGalleryTransition("opacity");
      JavaScriptGallery.enableExtraButtons();
      json =
        '{ "Entry": { "Title": "", ' +
        '"Image": ["http://localhost/project/client/curatingcars/storage/app/public/cars/exterior/8403460771642090875.jpg",' +
        '"http://localhost/project/client/curatingcars/storage/app/public/cars/exterior/9323020231642090947.jpg"] } }';
      JavaScriptGallery.addGallery(json);
      
      JavaScriptGallery.initGallerySlide(300, true, true);
      JavaScriptGallery.enableDoubleClick();
      JavaScriptGallery.initMove();
      JavaScriptGallery.enableKeydownESC();
    </script>
@stop