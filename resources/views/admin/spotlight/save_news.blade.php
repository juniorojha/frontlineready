@extends('admin.layout.index')
@section('title')
Save News
@stop
@section('content')
<!-- <link rel="stylesheet" href="{{asset('public/richtexteditor/rte_theme_default.css')}}" /> 
<script type="text/javascript" src="{{asset('public/richtexteditor/rte.js')}}"></script> 
<script type="text/javascript" src='{{asset("public/richtexteditor/plugins/all_plugins.js")}}'></script> 
<link rel='stylesheet' href='https://mindmup.github.io/bootstrap-wysiwyg/external/google-code-prettify/prettify.css'> -->

<div class="app-page-title">
   <div class="page-title-wrapper">
      <div class="page-title-heading">
         <div class="page-title-icon">
            <i class="pe-7s-paint-bucket icon-gradient bg-mean-fruit"></i>
         </div>
         <div>
            Save News
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
         Save News Information
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
         <form action="{{route('update-news')}}" id="save_make_form" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" name="id" value="{{$id}}">
            <div class="position-relative form-group">
               <label for="title" class="">Title<span class="error">*</span></label>
               <input name="title" id="title" required="" placeholder="Enter News Title" type="text" value="{{isset($data->title)?$data->title:''}}" class="form-control">
            </div>
            <div class="position-relative form-group">
               <label for="short_desc" class="">Short Description<span class="error">*</span></label>
               <input name="short_desc" id="short_desc" placeholder="Enter News Short Description" type="text" value="{{isset($data->short_desc)?$data->short_desc:''}}" required="" class="form-control">
            </div>
            <div class="position-relative form-group">
               <label for="description" class="">News Content<span class="error">*</span></label>
               <textarea name="description" class="editor" id="description" required="">{{isset($data->filels)?$data->filels:''}}</textarea>            
            </div>
            <div class="position-relative form-group">
               <label for="image" class="">Image<span class="error">*</span></label>
               <div id="uploaded_image">
                  <div class="upload-btn-wrapper" style="    width: 100%;">
                     <button class="btn imgcatlog" type="button">
                     <?php 
                        if(isset($data->image)){
                            $path= url('/')."/storage/app/public/news"."/".$data->image;
                        }
                        else{
                            $path=asset('public/images/news-placeholder.jpg');
                        }
                        ?>
                     <img src="{{$path}}" alt="..." class="img-thumbnail1"  id="basic_img" >
                     </button>
                     <input type="hidden" id="basic_img1"/>
                     @if(isset($data->image))
                     <input type="file" name="upload_image" style="height: 200px;width: 350px;" class="form-control" id="upload_image" />
                     @else
                     <input type="file" required="" class="form-control" style="height: 200px;width: 350px;" name="upload_image" id="upload_image" />
                     @endif
                  </div>
               </div>
            </div>
            <input type="hidden" id="storage_path" value="{{asset('storage/app/public/news/')}}">
            <button class="mt-1 btn btn-primary">Submit</button>
         </form>
      </div>
   </div>
</div>
@stop
@section('footer')


<script type="text/javascript">
   CKEDITOR.replace( 'description', {
      /*filebrowserUploadMethod :'xhr',
    filebrowserImageUploadUrl: '{{asset("public/upload.php?responseType=json&responseText=12")}}'*/
    
    filebrowserUploadUrl: '{{asset("public/ckeditor/ck_upload.php?path=")}}'+$("#storage_path").val(),
        filebrowserUploadMethod: 'form'
});
 /*var editor1 = new RichTextEditor("#description");*/  
    $(document).ready(function() {
             $("#save_make_form").validate({
                 rules: {
                     title: {
                         required: true
                     },
                     description: {
                         required: true
                     },
                     short_desc: {
                         required: true
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