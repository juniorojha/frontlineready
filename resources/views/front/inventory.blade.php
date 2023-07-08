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
<!-- header End -->
      <!-- Slider Start -->
      <div class="container filter-main-hold-pos" id="filter_section">
         <div class="row">
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
            </div>
        
         </div>
         <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               <br/><br/>
               <div class="product-featur-row">
                  <ul>
                     <li class="actions-btn-hold btn_box_border" id="ls_4">
                        <a class="btn_border" download href="{{asset('storage/app/public/').'/'.$setting->inventory_pdf}}">Download Inventory</a>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
 
      <!-- Search and filter end -->
      <!-- main heading start -->
      <!-- <div class="heading-border-section" id="header_1">
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
      </div> -->
      <!-- main heading end -->
      <!-- Product cars-box-first satrt-->
      <div class="container" id="container_1">
         <div class="row" id="live_cars_list">
            
           @foreach($get_all_cars as $gc)
               <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                  <div class="product-box">
                     <div class="product-img-heading">
                        <!-- <div class="attributes">
                           <ul>
                              <li>
                                 <p class="live">LIVE</p>
                              </li>
                           </ul>
                        </div> -->
                        <div class="img-hold">
                           <a href="{{route('stock',['car'=>$gc->key_id])}}"><img src="{{asset('storage/app/public/cars/banner').'/'.$gc->thumbail}}"></a>
                           <!-- <img src="{{asset('storage/app/public/cars/banner').'/'.$gc->thumbail}}"> -->
                        </div>
                        <div class="heading-hold">
                           <a href="{{route('stock',['car'=>$gc->key_id])}}">
                               <h6 style="font-size:12px;margin-bottom:20px;">{{$gc->year}} | {{$gc->make}} | {{$gc->model}} | {{$gc->mileage}}</h6>
                           </a>
                           <!-- <h6 style="font-size:12px;margin-bottom:20px;">{{$gc->year}} | {{$gc->make}} | {{$gc->model}} | {{$gc->mileage}}</h6>
                          <ul class="icons-section"> -->
                           
                           </ul>
                        </div>
                     </div>
                     <div class="product-content">
                       
                     </div>
                  </div>
               </div>
            @endforeach
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
@stop