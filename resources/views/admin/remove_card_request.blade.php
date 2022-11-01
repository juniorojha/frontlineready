@extends('admin.layout.index')
@section('title')
Remove Card Request
@stop
@section('content')
<div class="app-page-title">
   <div class="page-title-wrapper">
      <div class="page-title-heading">
         <div class="page-title-icon">
            <i class="pe-7s-id icon-gradient bg-mean-fruit"></i>
         </div>
         <div>
           Remove Card Request
            <div class="page-title-subheading"></div>
         </div>
      </div>
      <div class="page-title-actions">
      </div>
   </div>
</div>
<div class="main-card mb-3 card">
   <div class="card-body">
      
      @if(Session::has('message'))
      <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show" role="alert">
         <button type="button" class="close" aria-label="Close" data-dismiss="alert">
         <span aria-hidden="true">×</span>
         </button>
         {{ Session::get('message') }}
      </div>
      @endif
      <table style="width: 100%;" id="RequestremoveTable" class="table table-hover table-striped table-bordered">
         <thead>
            <tr>
               <th>Id</th>
               <th>Name</th>
               <th>Status</th>
               <th>Action</th>
            </tr>
         </thead>
         <tfoot>
            <tr>
               <th>Id</th>
               <th>Name</th>
                <th>Status</th>
               <th>Action</th>
            </tr>
         </tfoot>
      </table>
   </div>
</div>
@stop
@section('footer')
<script type="text/javascript">
   $('#RequestremoveTable').DataTable({
   processing: true,
   serverSide: true,
   ajax: '{{route("request-card-data-table")}}',
   columns: [{
           data: 'id',
           name: 'id'
       },{
           data: 'name',
           name: 'name'
       },{
           data: 'status',
           name: 'status'
       }, {
           data: 'action',
           name: 'action'
       }
   ],
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