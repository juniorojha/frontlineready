@extends('admin.layout.index')
@section('title')
Dashboard
@stop
@section('content')
<div class="app-page-title">
   <div class="page-title-wrapper">
      <div class="page-title-heading">
         <div class="page-title-icon">
            <i class="pe-7s-rocket icon-gradient bg-mean-fruit"></i>
         </div>
         <div>
            Dashboard
            <div class="page-title-subheading"></div>
         </div>
      </div>
      <div class="page-title-actions">
      </div>
   </div>
</div>
<div class="row"><h1>Auctions</h1></div>
<div class="row">
   <div class="col-md-6 col-xl-3">
      <div class="card mb-3 widget-content bg-night-fade">
         <div class="widget-content-wrapper text-white">
            <div class="widget-content-left">
               <div class="widget-heading">Live</div>
               <div class="widget-subheading"></div>
            </div>
            <div class="widget-content-right">
               <div class="widget-numbers text-white"><span>{{$livecars}}</span></div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-md-6 col-xl-3">
      <div class="card mb-3 widget-content bg-arielle-smile">
         <div class="widget-content-wrapper text-white">
            <div class="widget-content-left">
               <div class="widget-heading">Coming Soon</div>
               <div class="widget-heading"></div>
            </div>
            <div class="widget-content-right">
               <div class="widget-numbers text-white"><span>{{$comingsooncars}}</span></div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-md-6 col-xl-3">
      <div class="card mb-3 widget-content bg-happy-green">
         <div class="widget-content-wrapper text-white">
            <div class="widget-content-left">
               <div class="widget-heading">Auctions Won</div>
               <div class="widget-heading">Not Settled</div>
            </div>
            <div class="widget-content-right">
               <div class="widget-numbers text-white"><span>{{$pendingpayment}}</span></div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-md-6 col-xl-3">
      <div class="card mb-3 widget-content bg-happy-itmeo">
         <div class="widget-content-wrapper text-white">
            <div class="widget-content-left">
               <div class="widget-heading">Auctions Won</div>
               <div class="widget-heading">Payment Settled</div>
            </div>
            <div class="widget-content-right">
               <div class="widget-numbers text-white"><span>{{$settledpayment}}</span></div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="row"><h1>Dealers</h1></div>
<div class="row">
   <div class="col-md-6 col-xl-3">
      <div class="card mb-3 widget-content bg-night-fade">
         <div class="widget-content-wrapper text-white">
            <div class="widget-content-left">
               <div class="widget-heading">Active</div>
               <div class="widget-subheading"></div>
            </div>
            <div class="widget-content-right">
               <div class="widget-numbers text-white"><span>{{$activedealer}}</span></div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-md-6 col-xl-3">
      <div class="card mb-3 widget-content bg-arielle-smile">
         <div class="widget-content-wrapper text-white">
            <div class="widget-content-left">
               <div class="widget-heading">Pending</div>
               <div class="widget-heading"></div>
            </div>
            <div class="widget-content-right">
               <div class="widget-numbers text-white"><span>{{$pendingdealer}}</span></div>
            </div>
         </div>
      </div>
   </div>
   </div>
@stop
@section('footer')
<script type="text/javascript">
    
</script>
@stop