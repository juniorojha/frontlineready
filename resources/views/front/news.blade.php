@extends('front.layout')
@section('title')
Frontline Ready - In The Spotlight
@stop
@section('meta-data')
@stop
@section('content')
<div class="banner slider section hold">
        <div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="banner-slider-content-hold">
                    <h2>IN THE SPOTLIGHT</h2>
                    <p>Exploring The Latest News Of Frontline Ready</p>
                </div>
            </div>
        </div>
    </div>
    <div class="home-blog-section">
        <div class="blog-left-icons-shape slb-page-hold">
            <img src="{{asset('public/theme/images/shape-logo.png')}}">
        </div>
        <div class="container">

            <div class="row spot-light-blog-top-pd">
                 @foreach($data as $sl)
               <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                  <div class="blog-content-img-holder-box">
                     <a href="{{route('news-detail',['id'=>$sl->query_id])}}"> <img src="{{asset('storage/app/public/news').'/'.$sl->image}}"> </a>
                     <a href="{{route('news-detail',['id'=>$sl->query_id])}}">
                        <h4>{{$sl->title}}</h4>
                     </a>
                     <p>{{$sl->short_desc}}
                     </p>
                     <a href="{{route('news-detail',['id'=>$sl->id])}}"> <b>Read More</b> </a>
                  </div>
               </div>
               @endforeach
            </div>
        </div>
    </div>
@stop
@section('footer')
@stop