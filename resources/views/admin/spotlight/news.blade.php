@extends('admin.layout.index')
@section('title')
News
@stop
@section('content')
<div class="app-page-title">
   <div class="page-title-wrapper">
      <div class="page-title-heading">
         <div class="page-title-icon">
            <i class="pe-7s-news-paper icon-gradient bg-mean-fruit"></i>
         </div>
         <div>
            News
            <div class="page-title-subheading"></div>
         </div>
      </div>
      <div class="page-title-actions">
      </div>
   </div>
</div>
<div class="main-card mb-3 card">
   <div class="card-body">
      <div class="row" style="margin-left: 5px;margin-bottom: 10px;">
         <a href="{{route('save-news',['id'=>$id])}}" class="btn btn-primary">Add News</a>
      </div>
      @if(Session::has('message'))
      <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show" role="alert">
         <button type="button" class="close" aria-label="Close" data-dismiss="alert">
         <span aria-hidden="true">×</span>
         </button>
         {{ Session::get('message') }}
      </div>
      @endif
      <table style="width: 100%;" id="NewsTable" class="table table-hover table-striped table-bordered">
         <thead>
            <tr>
               <th>#</th>
               <th>Image</th>
               <th>Title</th>
               <th>Short Description</th>
               <th>Action</th>
            </tr>
         </thead>
         <tfoot>
            <tr>
               <th>#</th>
               <th>Image</th>
               <th>Title</th>
               <th>Short Description</th>
               <th>Action</th>
            </tr>
         </tfoot>
      </table>
   </div>
</div>
@stop
@section('footer')
<script type="text/javascript">
   $('#NewsTable').DataTable({
   processing: true,
   serverSide: true,
   ajax: '{{route("news-data-table")}}',
   columns: [{  data: 'DT_RowIndex',
               name: 'DT_RowIndex',
               orderable: false,
               searchable: false 
            },{
           data: 'image',
           name: 'image'
       },{
           data: 'name',
           name: 'name'
       },{
           data: 'short_desc',
           name: 'short_desc'
       }, {
           data: 'action',
           name: 'action'
       }
   ],columnDefs: [{
            targets: 1,
            render: function (data) {
                         
                if (data != null) {
                    return '<img src="'+data+'" style="height:150px;width:150px;border-radius: 0px">';
                } else {
                    return '';
                }
            }
        }],
   order: [
       [0, "DESC"]
   ]
   });
   function delete_record(url){
         var msg = "Do you Sure Want To Delete This News?";
         if (confirm(msg)) {                
                 window.location.href = url;                 
         } else {
             window.location.reload();
         }
     } 
</script>
@stop