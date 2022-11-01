@extends('admin.layout.index')
@section('title')
Edit Payment Setting
@stop
@section('content')
<div class="app-page-title">
   <div class="page-title-wrapper">
      <div class="page-title-heading">
         <div class="page-title-icon">
            <i class="pe-7s-settings icon-gradient bg-mean-fruit"></i>
         </div>
         <div>
            Edit Payment Setting
            <div class="page-title-subheading"></div>
         </div>
      </div>
      <div class="page-title-actions">
      </div>
   </div>
</div>
<div class="main-card mb-3 ">
   <div class="col-md-6 card">
      <div class="card-header">
         Edit Payment Setting Information
      </div>
      <div class="card-body">
         @if(Session::has('message'))
         <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show" role="alert">
            <button type="button" class="close" aria-label="Close" data-dismiss="alert">
            <span aria-hidden="true">×</span>
            </button>
            {{ Session::get('message') }}
         </div>
         @endif
         <form action="{{route('update-payment-setting')}}" id="save_setting_form" method="post">
            {{csrf_field()}}           
               <div class="position-relative form-group">
                  <label  class="stripe_key">Stripe Payment Key</label>
                  <input name="key" required="" placeholder="Enter Stripe Key" type="text" value="{{isset($setting->stripe_key)?$setting->stripe_key:''}}" class="form-control">
               </div>

               <div class="position-relative form-group">
                  <label  class="stripe_secert">Stripe Payment Secert</label>
                  <input name="secert" required="" placeholder="Enter Stripe Secert" type="text" value="{{isset($setting->stripe_secret)?$setting->stripe_secret:''}}" class="form-control">
               </div>
           
            <button class="mt-1 btn btn-primary">Submit</button>
         </form>
      </div>
   </div>
</div>
@stop
@section('footer')
<script type="text/javascript">
</script>
@stop