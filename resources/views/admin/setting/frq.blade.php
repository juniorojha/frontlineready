@extends('admin.layout.index')
@section('title')
FRQ
@stop
@section('content')
<div class="app-page-title">
   <div class="page-title-wrapper">
      <div class="page-title-heading">
         <div class="page-title-icon">
            <i class="pe-7s-paint-bucket icon-gradient bg-mean-fruit"></i>
         </div>
         <div>
            FRQ
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
         <a href="{{route('save-make',['id'=>0])}}" class="btn btn-primary">Add FRQ</a>
      </div>
       @if(Session::has('message'))
                           <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show" role="alert">
                              <button type="button" class="close" aria-label="Close" data-dismiss="alert">
                              <span aria-hidden="true">×</span>
                              </button>
                              {{ Session::get('message') }}
                           </div>
                           @endif
      <table style="width: 100%;" id="FRQTable" class="table table-hover table-striped table-bordered">
         <thead>
            <tr>
               <th>Id</th>
               <th>Question</th>
               <th>Answer</th>
               <th>Action</th>
            </tr>
         </thead>
         <tfoot>
            <tr>
               <th>Id</th>
               <th>Name</th>
               <th>Action</th>
            </tr>
         </tfoot>
      </table>
   </div>
</div>
@stop
@section('footer')
<script type="text/javascript">
       $('#FRQTable').DataTable({
       processing: true,
       serverSide: true,
       ajax: '{{route("make-data-table")}}',
       columns: [{
               data: 'id',
               name: 'id'
           },{
               data: 'name',
               name: 'name'
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
             var msg = "Are you sure you want to delete this Make?";
             if (confirm(msg)) {                
                     window.location.href = url;                 
             } else {
                 window.location.reload();
             }
         } 
</script>
@stop