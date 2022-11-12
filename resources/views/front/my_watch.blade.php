@extends('front.layout')
@section('title')
Front Line Ready - My Watching
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
                                    <li><a class="btn-active"  href="{{route('my-watch')}}">WATCHING</a></li>
                                    <li><a href="{{route('my-listing')}}">MY LISTING</a></li>
                                    <li><a href="{{route('my-details')}}">MY DETAILS</a></li>
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
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="user-cars-details-box">
                    <ul>
                        @if(count($get_my_watch)==0)
                        <li class="">
                            <div class="detail-heading">
                                <p>You're not watching any lots currently.</p><br>
                                <p>Click on the <a href="" style="
                                    background-color: #000;
                                    padding: 4px 6px 3px;
                                    color: #fff;
                                    border-radius: 4px;
                                    font-size: 11px;
                                    margin-top: 5px;
                                "><i class="fas fa-bookmark" aria-hidden="true"></i></a> icon for an auction and we'll
                                    keep you updated about its progress.</p>
                                <br>
                            </div>
                        </li>
                        @endif
                        
                        <?php $total=count($get_my_watch);$i=1;?>
                        @foreach($get_my_watch as $gc)
                            @if($gc->carInfo)
                            <li class="<?= $i==$total?'last-bottom-pd':'double-border'?>" >
                            <div class="cars-details-box-holder double-border">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="cars-detail-col-left">
                                           <a href="{{route('vehicle-detail',['query'=>$gc->carInfo->key_id])}}"><img src="{{asset('storage/app/public/cars/banner').'/'.$gc->carInfo->banner}}"></a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="cars-detail-col-right">
                                            <div class="main-heads-cars-user-detail-box1">
                                                <a href="{{route('vehicle-detail',['query'=>$gc->carInfo->key_id])}}">
                              <h5>{{$gc->carInfo->name}}</h5>
                           </a>
                           
                            <?php $color = $gc->carInfo->is_like==1?'chartreuse':'white';  ?>
                                                <span class="icons"><a href="javascript:bookcar('{{$gc->carInfo->id}}')"><i id="book_mark_{{$gc->carInfo->id}}" class="fas fa-bookmark" style="color:{{$color}}" ></i></a>
                                                </span>
                                                <p class="upper-description">{{$gc->carInfo->short_desc}}</p>
                                                <span>
                                                    <p>{{$gc->carInfo->year}}</p>
                                                    |
                                           @if($gc->carInfo->steering_position==1)
                           <p>LHD</p>
                           @else
                           <p>RHD</p>
                           @endif
                                                    |
                                                    <p>{{$gc->carInfo->country_name}} <img src="https://ipdata.co/flags/{{$gc->carInfo->country_sortname}}.png"></p>
                                                </span>
                                                <br>
                                               <p>STATUS</p>
                                                @if($gc->carInfo->status==1)
                             <span class="icons">Live</span></a>
                            @elseif($gc->carInfo->status==2)
                            <span class="icons"><a>Coming Soon</a></span>
                            @elseif($gc->carInfo->status==3)
                            <span class="icons"><a>Private sales</a></span>
                            @elseif($gc->carInfo->status==4)
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
                                                   @if($gc->carInfo->status==1)      
                                                        <div class="actions-btn-hold btn_box_border" style=" margin: 10px 0px;"> <a class="btn_border" href="{{route('vehicle-detail',['query'=>$gc->carInfo->key_id])}}">PLACE BID</a> </div>
                                                        @endif
                                                        
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                          <?php $i++;?>
                          @endif
                        @endforeach

                         

                      

                    </ul>
                </div>
            </div>
        </div>
    </div>
@stop
@section('footer')
@stop