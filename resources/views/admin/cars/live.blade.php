@extends('admin.layout.index')
@section('title')
Live Cars
@stop
@section('content')
<div class="app-page-title">
   <div class="page-title-wrapper">
      <div class="page-title-heading">
         <div class="page-title-icon">
            <i class="pe-7s-car icon-gradient bg-mean-fruit"></i>
         </div>
         <div>
            Live Cars
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
       <table style="width: 100%;" id="LiveCarTable" class="table table-hover table-striped table-bordered">
         <thead>
            <tr>
               <th>Id</th>
               <th>Image</th>
               <th>VIN</th>
               <th>Current Bid</th>
               <th>Total Bid</th>
               <th>Aucation EndTime</th>
               <th>More</th>
               <th>Action</th>
            </tr>
         </thead>
         <tfoot>
            <tr>
               <th>Id</th>
               <th>Image</th>
               <th>VIN</th>
               <th>Current Bid</th>
               <th>Total Bid</th>
               <th>Aucation EndTime</th>
               <th>More</th>
               <th>Action</th>
            </tr>
         </tfoot>
      </table>
   </div>
</div>
@stop
@section('footer')
<script type="text/javascript">
     $('#LiveCarTable').DataTable({
           processing: true,
           serverSide: true,
           ajax: '{{route("live-car-data-table")}}',
           columns: [{  data: 'DT_RowIndex',
                           name: 'DT_RowIndex',
                           orderable: false,
                           searchable: false 
                },{
                   data: 'image',
                   name: 'image'
               },{
                   data: 'vin',
                   name: 'vin'
               },{
                   data: 'current_bid',
                   name: 'current_bid'
               },{
                   data: 'total_bid',
                   name: 'total_bid'
               },{
                   data: 'end_time',
                   name: 'end_time'
               },{
                   data: 'more',
                   name: 'more'
               },{
                   data: 'action',
                   name: 'action'
               }
           ],columnDefs: [{
            targets: 1,
            render: function (data) {
                    return '<img src="'+data+'" style="width:250px;height:150px;border-radius:10px"/>';                
            }
        },{
            targets: 6,
            render: function (data) {
                    return '<a href="'+data+'" class="btn btn-primary" target="_blank">More</a>';                
            }
        }],
           order: [
               [3, "DESC"]
           ]
    });
</script>
@stop