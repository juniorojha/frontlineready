@extends('admin.layout.index')
@section('title')
Save FAQ Question
@stop
@section('content')
<div class="app-page-title">
   <div class="page-title-wrapper">
      <div class="page-title-heading">
         <div class="page-title-icon">
            <i class="pe-7s-paint-bucket icon-gradient bg-mean-fruit"></i>
         </div>
         <div>
            Save FAQ Question
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
         Save FAQ Question Information
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
         <form action="{{route('update-frq-ques')}}" id="save_make_form" method="post">
            {{csrf_field()}}
            <input type="hidden" name="id" value="{{$id}}">
            <input type="hidden" name="topic_id" value="{{$topic_id}}">
            <div class="position-relative form-group">
               <label for="question" class="">Question <span class="error">*</span></label>
               <textarea name="question" id="question" class="form-control" placeholder="Enter Question Name">{{isset($data->question)?$data->question:''}}</textarea>
               
            </div>
            <div class="position-relative form-group">
               <label for="answer" class="">Answer <span class="error">*</span></label>
               <textarea name="answer" id="answer" placeholder="Enter Answer Name" class="form-control">{{isset($data->answer)?$data->answer:''}}</textarea>
               
            </div>
            <button class="mt-1 btn btn-primary">Submit</button>
         </form>
      </div>
   </div>
</div>
@stop
@section('footer')
<script type="text/javascript">
     CKEDITOR.replace('answer');
    $(document).ready(function() {
             $("#save_make_form").validate({
                ignore: [],
              debug: false,
                 rules: {
                     question: {
                         required: true
                     },
                     /*answer:{
                         required: function() 
                        {
                         CKEDITOR.instances.cktext.updateElement();
                        },

                         minlength:10
                    }*/
                 }
             });
         });
         
</script>
@stop