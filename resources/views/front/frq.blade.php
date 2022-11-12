@extends('front.layout')
@section('title')
Front Line Ready - FRQ
@stop
@section('meta-data')
@stop
@section('content')
<style>
    table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  padding:5px;
}
</style>
<?php $path = asset('public/theme/images/sell-banner-2.jpg');?>
<div class="banner slider section hold" style="background-image: url('{{$path}}');">
   <div class="container">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <div class="banner-slider-content-hold sell-with-us-heading">
            <h2>Frequently Asked Question</h2>
            <p></p>
         </div>
      </div>
   </div>
</div>
<div class="container">
   <div class="row" style="margin-top: 50px;margin-bottom: 50px;">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <div class="faq-pd-top-holder">
            <div class="container">
               <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                     <div class="faq-left-tabs">
                        <div class="d-flex align-items-start">
                           <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                             <?php $i=0;?>
                             @foreach($getfrq as $gf)
                                <button class="nav-link faq-tab-left-btn <?=$i==0?'active':''?>" id="v-pills-{{$i}}-tab" data-bs-toggle="pill" data-bs-target="#v-pills-{{$i}}" type="button" role="tab" aria-controls="v-pills-{{$i}}" aria-selected="true">{{$gf->topic}}</button>
                                <?php $i++;?>
                            @endforeach
                              <button class="nav-link faq-tab-left-btn" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Fees</button>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                     <div class="faq-tabs-right-sections">
                        <div class="tab-content" id="v-pills-tabContent">
                            <?php $i=0;?>
                            @foreach($getfrq as $gf)
                                       <div class="tab-pane fade show <?=$i==0?'active':''?>" id="v-pills-{{$i}}" role="tabpanel" aria-labelledby="v-pills-{{$i}}-tab">
                                          <div class="accordion" id="accordionExample">
                                            @foreach($gf->frqlist as $gff)
                                                 <div class="accordion-item">
                                                    <h2 class="accordion-header" id="heading{{$gff->id}}">
                                                       <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$gff->id}}" aria-expanded="true" aria-controls="collapse{{$gff->id}}">
                                                       {{$gff->question}}
                                                       </button>
                                                    </h2>
                                                    <div id="collapse{{$gff->id}}" class="accordion-collapse collapse" aria-labelledby="heading{{$gff->id}}" data-bs-parent="#accordionExample">
                                                       <div class="accordion-body inner-descitopn">
                                                         <?= html_entity_decode($gff->answer)?>
                                                       </div>
                                                    </div>
                                                 </div>  
                                            @endforeach  
                                          </div>
                                       </div>
                                <?php $i++;?>
                            @endforeach
                          
                           <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                              <div class="section-title">
                                  <?= html_entity_decode($setting->fees_info);?>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@stop
@section('footer')
@stop