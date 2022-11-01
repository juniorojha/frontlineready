@extends('admin.layout.index')
@section('title')
Save Make
@stop
@section('content')
<div class="app-page-title">
   <div class="page-title-wrapper">
      <div class="page-title-heading">
         <div class="page-title-icon">
            <i class="pe-7s-paint-bucket icon-gradient bg-mean-fruit"></i>
         </div>
         <div>
            Save Make
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
         Save Make Information
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
         <form action="{{route('update-make')}}" id="save_make_form" method="post">
            {{csrf_field()}}
            <input type="hidden" name="id" value="{{$id}}">
            <div class="position-relative form-group">
               <label for="name" class="">Name <span class="error">*</span></label>
               <input name="name" id="name" placeholder="Enter Make Name" type="text" value="{{isset($data->name)?$data->name:''}}" class="form-control">
            </div>
            <button class="mt-1 btn btn-primary">Submit</button>
         </form>
      </div>
   </div>
</div>
@stop
@section('footer')
<script type="text/javascript">
    $(document).ready(function() {
             $("#save_make_form").validate({
                 rules: {
                     name: {
                         required: true
                     }
                 }
             });
         });
</script>
@stop