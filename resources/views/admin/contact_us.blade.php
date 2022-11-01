@extends('admin.layout.index')
@section('title')
Contact Us
@stop
@section('content')
<div class="app-page-title">
   <div class="page-title-wrapper">
      <div class="page-title-heading">
         <div class="page-title-icon">
            <i class="pe-7s-id icon-gradient bg-mean-fruit"></i>
         </div>
         <div>
            Contact Us
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
      <table style="width: 100%;" id="ContactUsTable" class="table table-hover table-striped table-bordered">
         <thead>
            <tr>
               <th>Id</th>
               <th>Name</th>
               <th>Country</th>
               <th>Email</th>
               <th>Phone</th>
               <th>Interested_In</th>
               <th>Description</th>
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
               <th>Interested_In</th>
               <th>Description</th>
               <th>Action</th>
            </tr>
         </tfoot>
      </table>
   </div>
</div>
@stop
@section('footer')
<script type="text/javascript">
   $('#ContactUsTable').DataTable({
   processing: true,
   serverSide: true,
   ajax: '{{route("contact-us-data-table")}}',
   columns: [{
           data: 'id',
           name: 'id'
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
           data: 'interested_in',
           name: 'interested_in'
       },{
           data: 'description',
           name: 'description'
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