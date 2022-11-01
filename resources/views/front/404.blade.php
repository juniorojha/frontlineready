@extends('front.layout')
@section('title')
Curating Cars - 404
@stop
@section('meta-data')
@stop
@section('content')
<?php $path = asset('public/theme/images/sell-banner-2.jpg');?>
<div class="banner slider section hold" style="background-image: url('{{$path}}');">
   <div class="container">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <div class="banner-slider-content-hold sell-with-us-heading">
           <h2 class="mt-4">Sorry, we couldn't find this page.</h2>
           <p class="my-4">The page may no longer exist or the link could be incorrect. Why not return to our homepage.</p>
           <a style="    border: 1px solid #fff;border-radius: 30px;padding: 1px 19px !important;background-color: #000 !important;color: #fff !important;" href="{{route('home')}}">Return to homepage</a>
         </div>
      </div>
   </div>
</div>

@stop
@section('footer')
@stop