@extends('admin.layout.index')
@section('title')
Subscriber List
@stop
@section('content')
<div class="app-page-title">
   <div class="page-title-wrapper">
      <div class="page-title-heading">
         <div class="page-title-icon">
            <i class="pe-7s-safe icon-gradient bg-mean-fruit"></i>
         </div>
         <div>
            Subscriber List
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
      <table style="width: 100%;" id="SubscriberTable" class="table table-hover table-striped table-bordered">
         <thead>
            <tr>
               <th>Id</th>
               <th>Email</th>
            </tr>
         </thead>
         <tfoot>
            <tr>
               <th>Id</th>
               <th>Email</th>
            </tr>
         </tfoot>
      </table>
   </div>
</div>
@stop
@section('footer')
<script type="text/javascript">
   $('#SubscriberTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: '{{route("subscriber-data-table")}}',
      columns: [{
              data: 'id',
              name: 'id'
          },{
              data: 'email',
              name: 'email'
          }
      ],
      order: [
          [0, "DESC"]
      ]
   });
</script>
@stop