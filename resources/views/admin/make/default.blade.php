@extends('admin.layout.index')
@section('title')
Make
@stop
@section('content')
<div class="app-page-title">
   <div class="page-title-wrapper">
      <div class="page-title-heading">
         <div class="page-title-icon">
            <i class="pe-7s-paint-bucket icon-gradient bg-mean-fruit"></i>
         </div>
         <div>
            Make
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
      <div class="row" style="margin-left: 15px;margin-bottom: 10px;">
         <a href="{{route('save-make',['id'=>$id])}}" class="btn btn-primary">Add Make</a>
      </div>
     
      <table style="width: 100%;" id="MakeTable" class="table table-hover table-striped table-bordered">
         <thead>
            <tr>
               <th>#</th>
               <th>Name</th>
               <th>Action</th>
            </tr>
         </thead>
         <tfoot>
            <tr>
               <th>#</th>
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
       $('#MakeTable').DataTable({
       processing: true,
       serverSide: true,
       ajax: '{{route("make-data-table")}}',
       columns: [
            {  data: 'DT_RowIndex',
               name: 'DT_RowIndex',
               orderable: false,
               searchable: false 
            },{
               data: 'name',
               name: 'name'
           }, {
               data: 'action',
               name: 'action'
           }
       ]
   });
       function delete_record(url){
             var msg = "Do you Sure Want To Delete This Make?";
             if (confirm(msg)) {                
                     window.location.href = url;                 
             } else {
                 window.location.reload();
             }
         } 
</script>
@stop