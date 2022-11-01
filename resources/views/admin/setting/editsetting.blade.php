@extends('admin.layout.index')
@section('title')
Edit General Setting
@stop
@section('content')
<div class="app-page-title">
   <div class="page-title-wrapper">
      <div class="page-title-heading">
         <div class="page-title-icon">
            <i class="pe-7s-settings icon-gradient bg-mean-fruit"></i>
         </div>
         <div>
            Edit General Setting
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
         General Setting Information
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
         <form action="{{route('update-setting')}}" id="save_setting_form" method="post">
            {{csrf_field()}}
            
            <div class="position-relative form-group">
               <label for="email" class="">Email <span class="error">*</span></label>
               <input name="email" id="email" placeholder="Enter Email" type="text" value="{{isset($setting->email)?$setting->email:''}}" class="form-control">
            </div>
            <div class="position-relative form-group">
               <label for="phone" class="">Phone <span class="error">*</span></label>
               <input name="phone" id="phone" placeholder="Enter Phone" type="text" value="{{isset($setting->phone)?$setting->phone:''}}" class="form-control">
            </div>
            <div class="position-relative form-group">
               <label for="address" class="">Address <span class="error">*</span></label>
               <textarea name="address" id="address" placeholder="Enter Address" class="form-control">{{isset($setting->address)?$setting->address:''}}</textarea>
            </div>
            <div class="position-relative form-group">
               <label for="facebook_id" class="">Facebook Id <span class="error">*</span></label>
               <input name="facebook_id" id="facebook_id" placeholder="Enter Facebook Id" type="text" value="{{isset($setting->facebook_id)?$setting->facebook_id:''}}" class="form-control">
            </div>
             <div class="position-relative form-group">
               <label for="twitter_id" class="">Twitter Id <span class="error">*</span></label>
               <input name="twitter_id" id="twitter_id" placeholder="Enter Twitter Id" type="text" value="{{isset($setting->twitter_id)?$setting->twitter_id:''}}" class="form-control">
            </div>
             <div class="position-relative form-group">
               <label for="instgram_id" class="">Instgram Id <span class="error">*</span></label>
               <input name="instgram_id" id="instgram_id" placeholder="Enter Instgram Id" type="text" value="{{isset($setting->instgram_id)?$setting->instgram_id:''}}" class="form-control">
            </div>
            <div class="position-relative form-group">
               <label for="txt_charge" class="">Txt Charges<span class="error">*</span></label>
               <input name="txt_charge" id="txt_charge" placeholder="Enter Txt Charges" type="number" value="{{isset($setting->txt_charge)?$setting->txt_charge:''}}" class="form-control">
            </div>
             <div class="position-relative form-group">
                           <label for="timezone" class=" form-control-label">
                          Timezone
                           <span class="reqfield">*</span>
                           </label>
                           <select class="form-control" name="timezone" id="timezone" required="">
                              <option value="">Select Timezone</option>
                              @foreach($timezone as $tz=>$value)
                              <option value="{{$tz}}" <?=$setting->timezone ==$tz ? ' selected="selected"' : '';?>>{{$value}}</option>
                              @endforeach
                           </select>
                        </div>
            <div class="position-relative form-group">
               <label for="instgram_id" class="">Fees Info <span class="error">*</span></label>
               <textarea id="fees_info" name="fees_info">{{isset($setting->fees_info)?$setting->fees_info:''}}</textarea>
            </div>
            
            <button class="mt-1 btn btn-primary">Submit</button>
         </form>
      </div>
   </div>
</div>
@stop
@section('footer')
<script type="text/javascript">
CKEDITOR.replace('fees_info');
    $(document).ready(function() {
             $("#save_setting_form").validate({
                 rules: {
                     email: {
                         required: true,
                         email:true
                     },
                     phone: {
                         required: true
                     },
                     address: {
                         required: true
                     },
                     facebook_id: {
                         required: true
                     },
                     twitter_id: {
                         required: true
                     },
                     instgram_id: {
                         required: true
                     }
                 }
             });
         });
</script>
@stop