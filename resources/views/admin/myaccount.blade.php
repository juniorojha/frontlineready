@extends('admin.layout.index')
@section('title')
My Account
@stop
@section('content')
<div class="app-page-title">
   <div class="page-title-wrapper">
      <div class="page-title-heading">
         <div class="page-title-icon">
            <i class="pe-7s-paint-bucket icon-gradient bg-mean-fruit"></i>
         </div>
         <div>
            My Account
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
         My Account Information
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
         <form action="{{route('update-profile')}}" id="save_account_form" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="position-relative form-group">
               <label for="name" class="">Name<span class="error">*</span></label>
               <input name="name" id="name" required="" placeholder="Enter Name" type="text" value="{{Auth::user()->name}}" class="form-control">
            </div>

            <div class="position-relative form-group">
               <label for="email" class="">Email<span class="error">*</span></label>
               <input name="email" id="email" required="" placeholder="Enter Email Id" type="email" value="{{Auth::user()->email}}" class="form-control">
            </div>
            
            
            <div class="position-relative form-group">
               <label for="image" class="">Image<span class="error">*</span></label>
               <div id="uploaded_image">
                  <div class="upload-btn-wrapper">
                     <button class="btn imgcatlog" type="button">
                     <?php 
                        if(isset(Auth::user()->image)){
                            $path= url('/')."/storage/app/public/profile"."/".Auth::user()->image;
                        }
                        else{
                            $path=asset('public/images/user.jpg');
                        }
                        ?>
                     <img src="{{$path}}" alt="..." class="img-thumbnail"  id="basic_img" >
                     </button>
                     <input type="hidden" id="basic_img1"/>
                     @if(isset(Auth::user()->image))
                     <input type="file" name="upload_image" class="form-control" id="upload_image" />
                     @else
                     <input type="file" required="" class="form-control" name="upload_image" id="upload_image" />
                     @endif
                  </div>
               </div>
            </div>
            <button class="mt-1 btn btn-primary">Submit</button>
         </form>
      </div>
   </div>
</div>
@stop
@section('footer')
<script type="text/javascript">
//   CKEDITOR.replace('description');
    $(document).ready(function() {
             $("#save_account_form").validate({
                 rules: {
                     name: {
                         required: true
                     },
                     image: {
                         required: true
                     },
                     email: {
                         required: true,
                         email:true
                     }
                 }
             });
         });
   
    $(document).ready(function () {
   $('#upload_image').on('change', function (e) {
    readURL(this, "basic_img");
   });
   });
   
   
   function readURL(input, field) {
   if (input.files && input.files[0]) {
    var reader = new FileReader();
   
    reader.onload = function (e) {
      $("#basic_img1").val(e.target.result);
      $('#' + field).attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
   }
   }
   
</script>
@stop