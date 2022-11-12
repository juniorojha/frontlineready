@extends('front.layout')
@section('title')
Front Line Ready - Home
@stop
@section('meta-data')
@stop
@section('content')
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
      <!-- Search and filter start -->
      <div class="container filter-main-hold-pos" id="filter_section">
         <div class="row">
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
               <div class="search-box">
                  <div class="input-group" style="flex-wrap: unset;">
                     <i class="fas fa-search"></i>
                     <div class="easy-autocomplete">
                        <input class="form-control autosearch-input-mobile" type="search"
                           placeholder="Looking for something cool? Search here...." aria-label="Search"
                            autocomplete="off" id="search_cars" name="search_cars" onkeypress="searchfilterresult()" onkeyup="searchfilterresult()">
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
               <div class="filter-box-right">
                  <ul>
                     <li class="dropdown">
                        <a href="javascript:;" onclick="filterdropdown()" class="dropbtn"><i
                           class="fas fa-sliders-h"></i>
                        Filters</a>
                     </li>
                  </ul>
               </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               <div id="filter_drop" class="dropdown-content mob-resp-pos">
                  <div class="row g-3">
                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="pop-main-btn-hold">
                           <ul>
                              <li class="btn_box_border "><a href="javascript:clearallinput()" class="btn_border">Clear</a></li>
                              <li class="btn_box_border active-2"><a href="javascript:searchfilterresult()" class="btn_border">Close</a></li>
                           </ul>
                        </div>
                     </div>
                     <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <div class="col-megamenu">
                           <h6 class="title">MANUFACTURER</h6>
                           <ul class="list-unstyled">
                              <?php $i=0;?>
                              @foreach($makes as $m)
                                 <li>
                                    <span>
                                    <input class="form-check-input closebox" type="checkbox" value="{{$m->id}}" name="make[]" id="make_{{$i}}">
                                    <label class="form-check-label" for="make_{{$i}}">{{$m->name}} ({{$m->totalcars}})</label>
                                    </span>
                                 </li>
                                 <?php $i++;?>
                              @endforeach
                             
                           </ul>
                        </div>
                        <!-- col-megamenu.// -->
                     </div>
                     <!-- end col-3 -->
                     <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <div class="col-megamenu">
                           <h6 class="title">SELLER TYPE</h6>
                           <ul class="list-unstyled">
                              <li>
                                 <span>
                                 <input class="form-check-input closebox" type="checkbox" name="seller_type[]" value="2" id="seller_type_2">
                                 <label class="form-check-label" for="seller_type_2">Private ({{$privatecarcount}})</label>
                                 </span>
                              </li>
                              <li>
                                 <span>
                                 <input class="form-check-input closebox" type="checkbox" name="seller_type[]" value="1" id="seller_type_1">
                                 <label class="form-check-label" for="seller_type_1">Trade ({{$tradecarcount}})</label>
                                 </span>
                              </li>
                              <li>
                                 <span>
                                 <input class="form-check-input closebox" type="checkbox" name="seller_type[]" value="3" id="seller_type_3">
                                 <label class="form-check-label" for="seller_type_3">Managed ({{$managedcarcount}})</label>
                                 </span>
                              </li>
                           </ul>
                        </div>
                        <!-- col-megamenu.// -->
                     </div>
                     <!-- end col-3 -->
                     <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <div class="col-megamenu">
                           <h6 class="title">LOCATION OF CAR</h6>
                           <ul class="list-unstyled">
                              <?php $i=0;?>
                              @foreach($get_country_list as $gc)
                                 <li>
                                    <span>
                                    <input class="form-check-input closebox" type="checkbox" value="{{$gc->country_id}}" name="country_list[]" id="country_{{$i}}">
                                    <label class="form-check-label" for="country_{{$i}}">{{$gc->country_name}}({{$gc->total_car}})</label>
                                    </span>
                                 </li>
                                 <?php $i++;?>
                              @endforeach
                              
                           </ul>
                        </div>
                        <!-- col-megamenu.// -->
                     </div>
                     <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <div class="col-megamenu">
                           <h6 class="title">DRIVER SIDE</h6>
                           <ul class="list-unstyled">
                              <li>
                                 <span>
                                 <input class="form-check-input closebox" type="checkbox" value="2" name="steering_position[]" id="right">
                                 <label class="form-check-label" for="right">Right ({{$rhlcar}})</label>
                                 </span>
                              </li>
                              <li>
                                 <span>
                                 <input class="form-check-input closebox" type="checkbox" value="1" name="steering_position[]" id="left">
                                 <label class="form-check-label" for="left">Left({{$lhlcar}})</label>
                                 </span>
                              </li>
                           </ul>
                        </div>
                        <!-- col-megamenu.// -->
                     </div>
                     <!-- end col-3 -->
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               <div class="product-featur-row">
                  <ul>
                    
                     <li class="actions-btn-hold btn_box_border active-2" id="ls_2">
                        <a class="btn_border" href="javascript:checkactivefilter(2)">Coming Soon (<span id="totalcommingsooncar">{{count($get_car_coming)}}</span>)</a>
                     </li>
                      <li class="actions-btn-hold btn_box_border" id="ls_1">
                        <a class="btn_border" href="javascript:checkactivefilter(1)">Live (<span id="totallivecar">{{count($get_car_live)}}</span>)</a>
                     </li>
                     <li class="actions-btn-hold btn_box_border " id="ls_3">
                        <a class="btn_border" href="javascript:checkactivefilter(3)">Private sales (<span id="totalprivatecar">{{count($get_car_private)}}</span>)</a>
                     </li>
                     <li class="actions-btn-hold btn_box_border" id="ls_4">
                        <a class="btn_border" href="javascript:checkactivefilter(4)">Sold (<span id="totalsoldcar">{{count($get_car_sold)}}</span>)</a>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
      <!-- Search and filter end -->
      <!-- main heading start -->
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

      <div class="heading-border-section hide" id="header_3">
         <span class="firts"></span>
         <div class="container">
            <div class="row">
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-heading-cl-pos">
                  <div class="heading-box">
                     <h2>Private Sales</h2>
                  </div>
                  <span class="left"></span>
                  <span class="Right"></span>
               </div>
            </div>
         </div>
         <span class="second"></span>
      </div>
      <!-- main heading end -->
      <div class="container hide" id="container_3">
         <div class="row" id="private_cars_list">
            @foreach($get_car_private as $gc)
               <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <div class="product-box">
                     <div class="product-img-heading">
                        <div class="attributes">
                           <ul>
                              <li>
                                 <p class="live">Private Sales</p>
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
                        <div class="head-bg-color red">
                           <p>RESERVE NOT MET</p>
                        </div>
                        <div class="timging-tage">
                           <p>Ends In : 10:12:37</p>
                        </div>
                        <div class="current-bids">
                           <p>Current Bids : €20,000</p>
                        </div>
                     </div>
                  </div>
               </div>
            @endforeach
            <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               <div class="end-border-and-btn last-bottom-pd">
                  <div class="actions-btn-hold btn_box_border">
                     <a class="btn_border" href="">All Buy Now Cars</a>
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
      <div class="home-scribes-banner-section">
         <div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               <div class="scribes-content-here">
                  <h6>Subscribe Now</h6>
                  <h2>Be the first to receive News & updates!</h2>
               </div>
               <div class="form_box">
                  <form id="subscriber_form" method="post" action="javascript:void(0)">
                     <span class="error_msg" id="reg_error_name"></span>
                     <input type="email" name="email" id="sub_email" placeholder="Email :" onblur="removeemail(this.value,'sub_email_error')">
                     <span id="sub_email_error" class="error"></span>
                     <br>
                     <div class="btn_box_border whit-color">
                        <a class="btn_border whit-color" href="javascript:subscriberuser()">
                        SUBSCRIBE <i class="fal fa-long-arrow-right"></i>
                        </a>
                     </div>
                  </form>
               </div>
            </div>
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
      <!-- Section 5 Start -->
      <div class="home-contact-us-section" style="position: relative;" id="user_contact_us">
         <div class="container">
            <div class="home-contact-us-heading">
               <h2>Contact us</h2>
               <p>If you are interested in learning more about our online auctions, please fill out the form below and one of our representatives will follow up with you directly.</p>
            </div>
            <div class="form_contact_box">
               <form action="#" method="post" id="contactus_from">
                   <input type="hidden" name="vaildphoneno" id="vaildphoneno" value="0" class="vaildphoneno" />
                   <input type="hidden" name="countrycode" id="countrycode" value="0" class="countrycode"/>
                    {{csrf_field()}}
                  <div class="contact_form_box">
                     <div class="contact_left_side_box">
                        <label>Name :</label>
                        <input type="text" name="name"  required="" id="contact_name" onblur="removeerror('error_contact_name')">
                        <span id="error_contact_name" class="error"></span>
                        <label>Email :</label>
                        <input type="email" name="email" id="contact_email" onblur="removeemail(this.value,'error_contact_email')">
                        <span id="error_contact_email" class="error"></span>
                     </div>
                     <div class="contact_right_side_box">
                        <label>Country :</label>
                        <select name="country" id="country" required="" class="country_select country">
                           @foreach($country as $c)
                              <option value="{{$c->sortname}}">{{ucwords(strtolower($c->name))}}</option>
                           @endforeach
                        </select>
                        <span id="error_contact_country" class="error"></span>
                        <label>Phone Number :</label>
                        <input type="tel" name="phone" required="" id="phone" class="phone numberonly" maxlength="10" onblur="removeerror('error_contact_phone')">
                        <span id="error_contact_phone" class="error error_contact_phone"></span>
                        <span id="valid-msg" class="hide valid-msg">Valid</span>

                        <span id="error-msg" class="hide error-msg">Invalid number</span>
                     </div>
                     <div class="contact_message">
                        <label>Your Message :</label>
                        <textarea id="message" name="message" required="" onblur="removeerror('error_contact_msg')"></textarea>
                        <span id="error_contact_msg" class="error"></span>
                     </div>
                     <div class="radio_btn_box">
                        <p>Interested In :</p>
                        <ul>
                           <li>
                              <span>
                              <input name="interested_in" checked type="radio" value="1" id="buy" style="width:auto;" />
                              <label for="buy">Only Buying</label>
                              </span>
                           </li>
                           <li>
                              <span>
                              <input name="interested_in" type="radio" id="sell"  value="2" style="width:auto;" />
                              <label for="sell">Only Selling</label>
                              </span>
                           </li>
                           <li>
                              <span>
                              <input name="interested_in" type="radio" id="everything" value="3" style="width:auto;" />
                              <label for="everything">Everything We've Got!</label>
                              </span>
                           </li>
                        </ul>
                     </div>
                     <div class="end-border-and-btn">
                        <div class="actions-btn-hold btn_box_border">
                           <a class="btn_border" href="javascript:contact_user()" style="padding:0px 45px;">SEND <i
                              class="fal fa-long-arrow-right" style="margin-left: 8px;"></i></a>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <!-- Section 5 end -->
      <!-- Footer start -->
      <input type="hidden" id="filter_id" value="{{isset($id)?$id:0}}"/>
@stop
@section('footer')
<script type="text/javascript">
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