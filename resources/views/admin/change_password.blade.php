@extends('admin.layout.index')
@section('title')
Change Password
@stop
@section('content')
<div class="app-page-title">
   <div class="page-title-wrapper">
      <div class="page-title-heading">
         <div class="page-title-icon">
            <i class="pe-7s-paint-bucket icon-gradient bg-mean-fruit"></i>
         </div>
         <div>
            Change Password
            <div class="page-title-subheading"></div>
         </div>
      </div>
      <div class="page-title-actions">
      </div>
   </div>
</div>
<div class="main-card mb-3 ">
   <div class="col-md-9 card">
      <div class="card-header">
         Change Password
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
         <form action="{{route('update-my-password')}}" id="change_password_form" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="position-relative form-group">
               <label for="cpwd" class="">Enter Current Password<span class="error">*</span></label>
               <input name="cpwd" id="cpwd" required="" placeholder="******" type="password" value="" class="form-control" onchange="check_current_password(this.value)">
            </div>

            <div class="position-relative form-group">
               <label for="npwd" class="">Enter New Password<span class="error">*</span></label>
               <input name="npwd" id="npwd" required="" placeholder="******" type="password" value="" class="form-control">
            </div>

            <div class="position-relative form-group">
               <label for="rpwd" class="">Re-Enter New Password<span class="error">*</span></label>
               <input name="rpwd" id="rpwd" required="" placeholder="******" type="password" value="" class="form-control" onchange="checkbothpwd(this.value)">
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
             $("#change_password_form").validate({
                 rules: {
                     cpwd: {
                         required: true
                     },
                     npwd: {
                         required: true
                     },
                     rpwd: {
                         required: true
                     }
                 }
             });
         });
   
    function checkbothpwd(val){
      var npwd = $("#npwd").val();
      if(npwd!=val){
         alert("New Password and Re-Enter Password Must Be Same");
         $("#rpwd").val("");
      }
    }

    function check_current_password(val){
          $.ajax({
                  url: '{{url("admin/check_current_password")}}'+"/"+val,
                  data: { },
                  success: function( data ) {
                     if(data==0){
                        alert("Please Enter Correct Password");
                        $("#cpwd").val("");
                     }
                  }
      });
    }
</script>
@stop