@extends('front.layout')
@section('title')
Frontline Ready - My account
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
                                    <li><a class="btn-active" href="{{route('myaccount')}}">MY BIDS</a></li>
                                    <li><a href="{{route('my-watch')}}">WATCHING</a></li>
                                    <li><a href="{{route('my-listing')}}">MY LISTING</a></li>
                                    <li ><a href="{{route('my-details')}}">MY DETAILS</a></li>
                                   <!-- <li><a href="{{route('billing')}}">BILLING</a></li>-->
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
                                                    LIVE AUCTIONS
                                                    <p class="count">({{count($livecars)}})</p>
                                                </h6>
                                                <span>
                                                    <p class="close">
                                                        <a href="">Close
                                                        </a>
                                                    </p>
                                                </span>
                                                 @if(count($livecars)<0)
                                                        <p>You have not won any auctions yet, best get bidding!</p>
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
                                                            <img src="{{asset('storage/app/public/cars/banner').'/'.$gc->banner}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <div class="cars-detail-col-right">
                                                            <div
                                                                class="main-heads-cars-user-detail-box1 boder-one-line">
                                                                <h5>{{$gc->name}}</h5>
                                                                <span class="icons"> @if(Auth::id())
                                          <?php $color = $gc->is_like==1?'chartreuse':'white';  ?>
                                        <a href="javascript:bookcar('{{$gc->id}}')"><i id="book_mark_{{$gc->id}}" class="fas fa-bookmark" style="color:{{$color}}" ></i></a>
                                    @else
                                       <a data-bs-toggle="modal" data-bs-target="#register_user_model" href="#" onclick="changemodel('login_content')"><i class="fas fa-bookmark"></i></a>
                                    @endif
                                                                </span>
                                                                <br>
                                                                <p>STATUS</p>
                                                                <span class="icons"><a>Live</i></a></span>
                                                            </div>
                                                            <div class="main-heads-cars-user-detail-box2">
                                                                <div class="step-one">
                                                                    <p class="content-des">CURRENT BID</p>
                                                                    <span class="content-price blue-tag">{{$gc->currency_symbol}}{{$gc->bid_price}}</span>
                                                                </div>
                                                                <div class="step-one">
                                                                    <p class="content-des">ENDS</p>
                                                                    <span class="content-price red-tag"> <?php 
                                  
                                                                            $date = $gc->aucation_enddate." ".$gc->aucation_endtime;
                                                                       ?>
                                                                    <script type="text/javascript">
                                                                        updateTimer('{{$date}}','{{$gc->id}}');
                                                                    </script></span>
                                                                </div>
                                                                <div class="step-one">
                                                                    <p class="content-des">BIDS</p>
                                                                    <span class="content-price blue-tag">{{$gc->total_bid}}</span>
                                                                </div>
                                                                <div class="step-one your-bids-tags">
                                                                    <h6>Your Bid</h6>
                                                                    <span class="content-price">€32,250</span>
                                                                    <br>
                                                                    <p class="red-tag">You’ve been outbid!</p>
                                                                    <br>
                                                                    <div class="end-border-and-btn"
                                                                        style="text-align: right;">
                                                                        <div class="actions-btn-hold btn_box_border"
                                                                            style=" margin: 10px 0px;"> <a
                                                                                class="btn_border" href="">PLACE BID</a>
                                                                        </div>
                                                                    </div>
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
                                                    WON
                                                    <p class="count">({{count($wincars)}})</p>
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
                                                    @foreach($wincars as $wc)
                                                    <!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">-->
                                                    <!--    <div class="cars-detail-col-left">-->
                                                    <!--        <img src="{{asset('public/theme/images/pro02.jpg')}}">-->
                                                    <!--    </div>-->
                                                    <!--</div>-->
                                                    <!--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">-->
                                                    <!--    <div class="cars-detail-col-right">-->
                                                    <!--        <div-->
                                                    <!--            class="main-heads-cars-user-detail-box1 boder-one-line">-->
                                                    <!--            <h5>2008 Audi R8 V8 Supercharged</h5>-->
                                                    <!--            <span class="icons"><a href="">-->
                                                    <!--                    <i class="fas fa-bookmark"-->
                                                    <!--                        aria-hidden="true"></i></a>-->
                                                    <!--            </span>-->
                                                    <!--            <br>-->
                                                    <!--            <p>STATUS</p>-->
                                                    <!--            <span class="icons"><a>Live</i></a></span>-->
                                                    <!--        </div>-->
                                                    <!--        <div class="main-heads-cars-user-detail-box2">-->
                                                    <!--            <div class="step-one">-->
                                                    <!--                <p class="content-des">CURRENT BID</p>-->
                                                    <!--                <span class="content-price blue-tag">€43,000</span>-->
                                                    <!--            </div>-->
                                                    <!--            <div class="step-one">-->
                                                    <!--                <p class="content-des">ENDS</p>-->
                                                    <!--                <span class="content-price red-tag">ENDED</span>-->
                                                    <!--            </div>-->
                                                    <!--            <div class="step-one">-->
                                                    <!--                <p class="content-des">BIDS</p>-->
                                                    <!--                <span class="content-price blue-tag">25</span>-->
                                                    <!--            </div>-->
                                                    <!--            <div class="step-one your-bids-tags">-->
                                                    <!--                <h6>Your Bid</h6>-->
                                                    <!--                <span class="content-price">€43,000</span>-->
                                                    <!--                <br>-->
                                                    <!--                <p class="green-tag">You are the highest bidder!</p>-->
                                                    <!--            </div>-->
                                                    <!--        </div>-->
                                                    <!--    </div>-->
                                                    <!--</div> -->
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
                                                <h6>LOST
                                                    <p class="count">(0)</p>
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
                                            <!-- <div class="cars-details-box-holder double-border">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <div class="cars-detail-col-left">
                                                            <img src="{{asset('public/theme/images/pro03.jpg')}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <div class="cars-detail-col-right">
                                                            <div
                                                                class="main-heads-cars-user-detail-box1 boder-one-line">
                                                                <h5>1986 LOTUS Excel SE</h5>
                                                                <span class="icons"><a href="">
                                                                        <i class="fas fa-bookmark"
                                                                            aria-hidden="true"></i></a>
                                                                </span>
                                                                <br>
                                                                <p>STATUS</p>
                                                                <span class="icons red"><a>Sold</i></a></span>
                                                            </div>
                                                            <div class="main-heads-cars-user-detail-box2">
                                                                <div class="step-one">
                                                                    <p class="content-des">CURRENT BID</p>
                                                                    <span class="content-price blue-tag">€24,000</span>
                                                                </div>
                                                                <div class="step-one">
                                                                    <p class="content-des">ENDS</p>
                                                                    <span class="content-price red-tag">ENDED</span>
                                                                </div>
                                                                <div class="step-one">
                                                                    <p class="content-des">BIDS</p>
                                                                    <span class="content-price blue-tag">21</span>
                                                                </div>
                                                                <div class="step-one your-bids-tags">
                                                                    <h6>Your Bid</h6>
                                                                    <span class="content-price">€19,500</span>
                                                                    <br>
                                                                    <p class="red-tag">You’ve been outbid!</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="cars-details-box-holder double-border">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <div class="cars-detail-col-left">
                                                            <img src="{{asset('public/theme/images/pro03.jpg')}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <div class="cars-detail-col-right">
                                                            <div
                                                                class="main-heads-cars-user-detail-box1 boder-one-line">
                                                                <h5>1986 LOTUS Excel SE</h5>
                                                                <span class="icons"><a href="">
                                                                        <i class="fas fa-bookmark"
                                                                            aria-hidden="true"></i></a>
                                                                </span>
                                                                <br>
                                                                <p>STATUS</p>
                                                                <span class="icons red"><a>Sold</i></a></span>
                                                            </div>
                                                            <div class="main-heads-cars-user-detail-box2">
                                                                <div class="step-one">
                                                                    <p class="content-des">CURRENT BID</p>
                                                                    <span class="content-price blue-tag">€24,000</span>
                                                                </div>
                                                                <div class="step-one">
                                                                    <p class="content-des">ENDS</p>
                                                                    <span class="content-price red-tag">ENDED</span>
                                                                </div>
                                                                <div class="step-one">
                                                                    <p class="content-des">BIDS</p>
                                                                    <span class="content-price blue-tag">21</span>
                                                                </div>
                                                                <div class="step-one your-bids-tags">
                                                                    <h6>Your Bid</h6>
                                                                    <span class="content-price">€19,500</span>
                                                                    <br>
                                                                    <p class="red-tag">You’ve been outbid!</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->
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