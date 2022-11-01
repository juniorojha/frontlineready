@extends('front.layout')
@section('title')
Curating Cars - My Listing
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
                                    <li><a href="{{route('myaccount')}}">MY BIDS</a></li>
                                    <li><a href="{{route('my-watch')}}">WATCHING</a></li>
                                    <li><a class="btn-active" href="{{route('my-listing')}}">MY LISTING</a></li>
                                    <li><a href="{{route('my-details')}}">MY DETAILS</a></li>
                                    <li><a href="{{route('billing')}}">BILLING</a></li>
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
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="user-cars-details-box">
                    <ul>
                        @if(count($getmycarall)==0)
                        <li class="">
                            <div class="detail-heading">
                                <p>Do you have a vehicle or automobilia that you'd like to consign?</p>
                                <div class="end-border-and-btn double-border">
                                    <div class="actions-btn-hold btn_box_border">
                                        <a class="btn_border" href="{{route('sell-with-us')}}">Sell With Us</a>
                                    </div>
                                </div>

                            </div>
                        </li>
                        @endif
                         <?php $total=count($getmycarall);$i=1;?>
                        @if(count($getmycarall)>0)
                            @foreach($getmycarall as $gc)
                                <li class="<?= $i==$total?'last-bottom-pd':'double-border'?>" >
                            <div class="cars-details-box-holder double-border">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="cars-detail-col-left">
                                           <a href="{{route('vehicle-detail',['query'=>$gc->key_id])}}"><img src="{{asset('storage/app/public/cars/banner').'/'.$gc->banner}}"></a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="cars-detail-col-right">
                                            <div class="main-heads-cars-user-detail-box1">
                                                <a href="{{route('vehicle-detail',['query'=>$gc->key_id])}}">
                              <h5>{{$gc->name}}</h5>
                           </a>
                           
                            <?php $color = $gc->is_like==1?'chartreuse':'white';  ?>
                                                <span class="icons"><a href="javascript:bookcar('{{$gc->id}}')"><i id="book_mark_{{$gc->id}}" class="fas fa-bookmark" style="color:{{$color}}" ></i></a>
                                                </span>
                                                <p class="upper-description">{{$gc->short_desc}}</p>
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
                                                <br>
                                               <p>STATUS</p>
                                                @if($gc->status==1)
                             <span class="icons">Live</span></a>
                            @elseif($gc->status==2)
                            <span class="icons"><a>Coming Soon</a></span>
                            @elseif($gc->status==3)
                            <span class="icons"><a>Private sales</a></span>
                            @elseif($gc->status==4)
                            <span class="icons"><a>Sold</a></span>
                            @endif
                                                
                                            </div>

                                            <div class="main-heads-cars-user-detail-box2">
                                                <div class="step-one">
                                                    <p class="content-des">CURRENT BID</p>
                                                    <span class="content-price blue-tag">No Bid</span>
                                                </div>
                                                <div class="step-one">
                                                    <p class="content-des">ENDS</p>
                                                    <span class="content-price red-tag">Starting Soon</span>
                                                </div>
                                                <div class="step-one">
                                                    <p class="content-des">BIDS</p>
                                                    <span class="content-price blue-tag">0</span>
                                                </div>
                                                <div class="step-one your-bids-tags">
                                                    <div class="end-border-and-btn" style="text-align: right;">
                                                     
                                                        <div class="actions-btn-hold btn_box_border" style=" margin: 10px 0px;"> <a class="btn_border" href="">GO TO LISTING</a> </div>
                                                 
                                                        
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                          <?php $i++;?>
                            @endforeach
                        @endif


                        <!--  <li class="last-bottom-pd">
                            <div class="cars-details-box-holder double-border ">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="cars-detail-col-left">
                                            <img src="{{asset('public/theme/images/pro02.jpg')}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="cars-detail-col-right">
                                            <div class="main-heads-cars-user-detail-box1">
                                                <h5>2012 Mercedes-Benz C63 AMG....</h5>
                                                <span class="">

                                                </span>
                                                <p class="upper-description">Fantastic Condition - Very Well Cared For
                                                </p>
                                                <span>
                                                    <p>1993</p>
                                                    |
                                                    <p>LHD</p>
                                                    |
                                                    <p>United State <img src="{{asset('public/theme/images/uniter-img.jpg')}}"></p>
                                                </span>
                                                <br>
                                                <p>STATUS</p>
                                                <span class="content-price">COMING SOON</span>
                                            </div>

                                            <div class="main-heads-cars-user-detail-box2">
                                                <div class="step-one">
                                                    <p class="content-des">CURRENT BID</p>
                                                    <span class="content-price blue-tag">€0</span>
                                                </div>
                                                <div class="step-one">
                                                    <p class="content-des">ENDS</p>
                                                    <span class="content-price ">COMING SOON</span>
                                                </div>
                                                <div class="step-one">
                                                    <p class="content-des">BIDS</p>
                                                    <span class="content-price blue-tag">0</span>
                                                </div>
                                                <div class="step-one your-bids-tags">
                                                    <div class="end-border-and-btn" style="text-align: right;">
                                                        <div class="actions-btn-hold btn_box_border" style=" margin: 10px 0px;"> <a class="btn_border" href="">GO
                                                                TO LISTING</a> </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>  -->

                    </ul>
                </div>
            </div>
        </div>
    </div>
@stop
@section('footer')
@stop