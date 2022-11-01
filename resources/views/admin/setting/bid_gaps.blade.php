@extends('admin.layout.index')
@section('title')
Edit Bid Gap
@stop
@section('content')
<div class="app-page-title">
   <div class="page-title-wrapper">
      <div class="page-title-heading">
         <div class="page-title-icon">
            <i class="pe-7s-settings icon-gradient bg-mean-fruit"></i>
         </div>
         <div>
            Edit Bid Gap
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
         Bid Gap Information
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
         <form action="{{route('update-bid-gaps')}}" id="save_setting_form" method="post">
            {{csrf_field()}}
            
            @foreach($data as $c)
               <div class="position-relative form-group">
                  <label  class="">{{$c->types}}</label>
                  <input name="gap[]" required="" placeholder="Enter Bid Gap" type="text" value="{{isset($c->gap)?$c->gap:''}}" class="form-control">
               </div>
            @endforeach 
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