@extends('front.layout')
@section('title')
Front Line Ready - Dealer Dashboard
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
                               <h1>Dealer Dashboard</h1>
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
    <!--User profile  style start here  -->
    <!--My Bids section style start here  -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="user-cars-details-box last-bottom-pd">
                    <ul>
                        <li class="double-border">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            <div class="detail-heading">
                                                <h6>
                                                    Current Bids
                                                    <p class="count">({{count($livecars)}})</p>
                                                </h6>
                                                <span>
                                                    <p class="close">
                                                        <a href="">Close
                                                        </a>
                                                    </p>
                                                </span>
                                                 @if(count($livecars)<0)
                                                        <p>You have not won any auctions yet, place your best bids now!</p>
                                                @endif
                                            </div>
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="cars-details-box-holder double-border">
                                                <div class="row">
                                                    @foreach($livecars as $gc)
                                                     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <div class="cars-detail-col-left">
                                                            <img src="{{asset('storage/app/public/cars/banner').'/'.$gc->thumbail}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <div class="cars-detail-col-right">
                                                            <div
                                                                class="main-heads-cars-user-detail-box1 boder-one-line">
                                                                <h5>{{$gc->year}} | {{$gc->make}} | {{$gc->model}} | {{$gc->mileage}}</h5>
                                                                <span class="icons">
                                                                </span>
                                                                <br>
                                                                <p>STATUS</p>
                                                                <span class="icons"><a>Live</i></a></span>
                                                            </div>
                                                            <div class="main-heads-cars-user-detail-box2">
                                                                <div class="step-one">
                                                                    <p class="content-des">Current Bid</p>
                                                                    <span class="content-price blue-tag">$ {{$gc->bid_price}}</span>
                                                                </div>
                                                                
                                                                <div class="step-one">
                                                                    <p class="content-des">ENDS</p>
                                                                    <span class="content-price red-tag"> <?php 
                                             $timestamp = date("Y-m-d H:i:s",strtotime($gc->end_date));
                                      $date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $timestamp, Session::get('current_timezone'));
                                      $new_date = $date->setTimezone('UTC');
                                      $date =  \Carbon\Carbon::parse($new_date)->format('Y-m-d');
                                      $time = \Carbon\Carbon::parse($new_date)->format('H:i:s');
                                     echo  $date1 = $date." ".$time;
                                                                         
                                                                       ?></span>
                                                                </div>
                                                                <div class="step-one your-bids-tags">
                                                                    <h6>Stock</h6>
                                                                    <span class="content-price"># <?=$gc->stock?></span>
                                                                  
                                                                </div>
                                                                <div class="step-one your-bids-tags">
                                                                    <h6>VIN</h6>
                                                                    <span class="content-price"># <?=$gc->vin?></span>
                                                                  
                                                                </div>
                                                                <div class="step-one">
                                                                    <p class="content-des">BIDS</p>
                                                                    <span class="content-price blue-tag">{{$gc->total_bid}}</span>
                                                                </div>
                                                                <div class="step-one your-bids-tags">
                                                                    <h6>Your Bid</h6>
                                                                    <span class="content-price">$ <?=isset($gc->my_bid->amount)?$gc->my_bid->amount:''?></span>
                                                                   
                                                                </div>
                                                                <div class="step-one">
                                                                    <p class="content-des">Stock</p>
                                                                    <span class="content-price blue-tag">#{{$gc->stock}}</span>
                                                                   
                                                                </div>
                                                                
                                                                <div class="step-one">
                                                                    <p class="content-des">VIN</p>
                                                                    <span class="content-price blue-tag">{{$gc->vin}}</span>
                                                                   
                                                                </div>
                                                                 
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="double-border">
                            <div class="accordion" id="accordionExample1">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne1">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne1" aria-expanded="true"
                                            aria-controls="collapseOne1">
                                            <div class="detail-heading">
                                                <h6>
                                                    Auctions Won (Pending Payment)
                                                    <p class="count"></p>
                                                </h6>
                                                <span>
                                                    <p class="close">
                                                        <a href="">Close </a>
                                                    </p>
                                                </span>
                                            </div>
                                        </button>
                                    </h2>
                                    <div id="collapseOne1" class="accordion-collapse collapse show"
                                        aria-labelledby="headingOne1" data-bs-parent="#accordionExample1">
                                        <div class="accordion-body">
                                            <div class="cars-details-box-holder ">
                                                <div class="row">
                                                    @foreach($auction_win_pay_pending as $gc)
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <div class="cars-detail-col-left">
                                                            <img src="{{asset('storage/app/public/cars/banner').'/'.$gc->thumbail}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <div class="cars-detail-col-right">
                                                            <div
                                                                class="main-heads-cars-user-detail-box1 boder-one-line">
                                                                <h5>{{$gc->year}} | {{$gc->make}} | {{$gc->model}} | {{$gc->mileage}}</h5>
                                                                
                                                                <br>
                                                                <p>STATUS</p>
                                                                <span class="icons"><a>Sold</i></a></span>
                                                            </div>
                                                            <div class="main-heads-cars-user-detail-box2">
                                                                <div class="step-one">
                                                                    <p class="content-des">WINNING BID</p>
                                                                    <span class="content-price blue-tag">$ {{$gc->bid_price}}</span>
                                                                   
                                                                </div><div class="step-one">
                                                                   
                                                                    <p class="content-des">PAYMENT STATUS</p>
                                                                    <span class="content-price blue-tag">Pending</span>
                                                                </div>
                                                                
                                                                <div class="step-one">
                                                                    <p class="content-des">Stock</p>
                                                                    <span class="content-price blue-tag">#{{$gc->stock}}</span>
                                                                   
                                                                </div>
                                                                
                                                                <div class="step-one">
                                                                    <p class="content-des">VIN</p>
                                                                    <span class="content-price blue-tag">{{$gc->vin}}</span>
                                                                   
                                                                </div>
                                                                
                                                                <div class="step-one">
                                                                 
                                                                </div>
                                                            
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </li>
                        </li>
                        <li class="double-border">
                            <div class="accordion" id="accordionExample2">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne2">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne2" aria-expanded="true"
                                            aria-controls="collapseOne2">
                                            <div class="detail-heading">
                                                <h6> Auctions Won (Payment Settled)
                                                   
                                                </h6>
                                                <span>
                                                    <p class="close">
                                                        <a href="">Close
                                                        </a>
                                                    </p>
                                                </span>
                                            </div>
                                        </button>
                                    </h2>
                                    <div id="collapseOne2" class="accordion-collapse collapse show"
                                        aria-labelledby="headingOne2" data-bs-parent="#accordionExample2">
                                        <div class="accordion-body">
                                              <div class="cars-details-box-holder ">
                                                <div class="row">
                                                @foreach($auction_win_pay_settle as $gc)
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <div class="cars-detail-col-left">
                                                            <img src="{{asset('storage/app/public/cars/banner').'/'.$gc->thumbail}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <div class="cars-detail-col-right">
                                                            <div
                                                                class="main-heads-cars-user-detail-box1 boder-one-line">
                                                                <h5>{{$gc->year}} | {{$gc->make}} | {{$gc->model}} | {{$gc->mileage}}</h5>
                                                                
                                                                <br>
                                                                <p>STATUS</p>
                                                                <span class="icons"><a>Sold</i></a></span>
                                                            </div>
                                                            <div class="main-heads-cars-user-detail-box2">
                                                                <div class="step-one">
                                                                    <p class="content-des">WINNING BID</p>
                                                                    <span class="content-price blue-tag">$ {{$gc->bid_price}}</span>
                                                                   
                                                                </div><div class="step-one">
                                                                   
                                                                    <p class="content-des">PAYMENT STATUS</p>
                                                                    <span class="content-price blue-tag">Settled</span>
                                                                </div>
                                                                <div class="step-one">
                                                                    <p class="content-des">Stock</p>
                                                                    <span class="content-price blue-tag">#{{$gc->stock}}</span>
                                                                   
                                                                </div>
                                                                
                                                                <div class="step-one">
                                                                    <p class="content-des">VIN</p>
                                                                    <span class="content-price blue-tag">{{$gc->vin}}</span>
                                                                   
                                                                </div>
                                                                <div class="step-one">
                                                                 
                                                                </div>
                                                            
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    @endforeach
                                                 </div></div>   
                                        </div>
                                    </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@stop
@section('footer')
@stop