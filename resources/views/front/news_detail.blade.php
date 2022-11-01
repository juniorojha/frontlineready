@extends('front.layout')
@section('title')
Curating Cars - {{$data->title}}
@stop
@section('meta-data')
@stop
@section('content')
   <div class="banner slider section hold">
        <div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="banner-slider-content-hold-second">
                    <h2>{{$data->title}}</h2>
                </div>
            </div>
        </div>
    </div>
    <!--Banner Slider end -->


    <!-- Home Bloges style start here  -->
    <div class="home-blog-section">
        <div class="blog-left-icons-shape slb-page-hold">
            <img src="{{asset('public/theme/images/shape-logo.png')}}">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="blog-main-heading spoligth-second-content">
                        <span>{{$data->short_desc}}
                        </span>
                    </div>
                </div>
            </div>
            <div class="row">

                <?= html_entity_decode($data->filels);?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="end-border-and-btn last-bottom-pd">
                        <div class="actions-btn-hold btn_box_border">
                            <a class="btn_border" href="{{route('spotlight')}}">All News</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Home Bloges style end here  -->

    <!-- Home Bloges-second-heaing-white style start here  -->
    <div class="spot-light-end-section-bg">
        <div class="heading-border-section">
            <span class="firts"></span>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-heading-cl-pos">
                        <div class="heading-box second-white-heading">
                            <h2>MORE NEWS</h2>
                        </div>
                        <span class="left"></span>
                        <span class="Right"></span>
                    </div>
                </div>
            </div>
            <span class="second"></span>
        </div>
        <div class="container">
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
        </div>
    </div>
@stop
@section('footer')
@stop