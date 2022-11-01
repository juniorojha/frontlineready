@extends('admin.layout.index')
@section('title')
Sales Inquiry List
@stop
@section('content')
<div class="app-page-title">
   <div class="page-title-wrapper">
      <div class="page-title-heading">
         <div class="page-title-icon">
            <i class="pe-7s-safe icon-gradient bg-mean-fruit"></i>
         </div>
         <div>
            Sales Inquiry List
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
      <table style="width: 100%;" id="SalesHelpTable" class="table table-hover table-striped table-bordered">
         <thead>
            <tr>
               <th>Id</th>
               <th>Name</th>
               <th>Country</th>
               <th>Email</th>
               <th>Phone</th>
               <th>Make</th>
               <th>Model</th>
               <th>Action</th>
            </tr>
         </thead>
         <tfoot>
            <tr>
               <th>Id</th>
               <th>Name</th>
               <th>Country</th>
               <th>Email</th>
               <th>Phone</th>
               <th>Make</th>
               <th>Model</th>
               <th>Action</th>
            </tr>
         </tfoot>
      </table>
   </div>
</div>
@stop
@section('footer')
<script type="text/javascript">
   $('#SalesHelpTable').DataTable({
   processing: true,
   serverSide: true,
   ajax: '{{route("sales-help-data-table")}}',
   columns: [{  data: 'DT_RowIndex',
               name: 'DT_RowIndex',
               orderable: false,
               searchable: false 
            },{
           data: 'name',
           name: 'name'
       },{
           data: 'country',
           name: 'country'
       },{
           data: 'email',
           name: 'email'
       },{
           data: 'phone',
           name: 'phone'
       },{
           data: 'make',
           name: 'make'
       },{
           data: 'model',
           name: 'model'
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
         var msg = "Do you Sure Want To Delete This Sales Inquiry?";
         if (confirm(msg)) {                
                 window.location.href = url;                 
         } else {
             window.location.reload();
         }
     } 
</script>
@stop