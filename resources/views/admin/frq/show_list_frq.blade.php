@extends('admin.layout.index')
@section('title')
FAQ {{$data->topic}}
@stop
@section('content')
<div class="app-page-title">
   <div class="page-title-wrapper">
      <div class="page-title-heading">
         <div class="page-title-icon">
            <i class="pe-7s-car icon-gradient bg-mean-fruit"></i>
         </div>
         <div>
            FAQ {{$data->topic}}
            <div class="page-title-subheading"></div>
         </div>
      </div>
      <div class="page-title-actions">
      </div>
   </div>
</div>
<div class="main-card mb-3 card">
   <div class="card-body">
     <!--  -->
      @if(Session::has('message'))
      <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show" role="alert">
         <button type="button" class="close" aria-label="Close" data-dismiss="alert">
         <span aria-hidden="true">×</span>
         </button>
         {{ Session::get('message') }}
      </div>
      @endif
        <div class="row" style="margin-left: 5px;margin-bottom: 10px;">
         <a href="{{route('save-ques',['id'=>$id,'topic_id'=>$data->id])}}" class="btn btn-primary">Add FAQ</a>
      </div> 
      <input type="hidden" name="query_id" id="query_id" value="{{$query}}">
      <table style="width: 100%;" id="frq_ques_ans_table" class="table table-hover table-striped table-bordered">
         <thead>
            <tr>
               <th>Id</th>
               <th>Question</th>
               <th>Action</th>
            </tr>
         </thead>
         <tfoot>
            <tr>
               <th>Id</th>
               <th>Question</th>
               <th>Action</th>
            </tr>
         </tfoot>
      </table>
   </div>
</div>

@stop
@section('footer')
<script type="text/javascript">
   $('#frq_ques_ans_table').DataTable({
   processing: true,
   serverSide: true,
   ajax: '{{url("admin/frq_ques_data_table?query=")}}'+$("#query_id").val(),
   columns: [{  data: 'DT_RowIndex',
               name: 'DT_RowIndex',
               orderable: false,
               searchable: false 
            },{
           data: 'question',
           name: 'question'
       },{
           data: 'action',
           name: 'action'
       }
   ]
   });

   function delete_record(url){
         var msg = "Do you Sure Want To Delete This FAQ?";
         if (confirm(msg)) {                
                 window.location.href = url;                 
         } else {
             window.location.reload();
         }
     } 
   
</script>
@stop