@extends('admin.layout.index')
@section('title')
Sold Cars
@stop
@section('content')
<div class="app-page-title">
   <div class="page-title-wrapper">
      <div class="page-title-heading">
         <div class="page-title-icon">
            <i class="pe-7s-car icon-gradient bg-mean-fruit"></i>
         </div>
         <div>
            Sold Cars
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
      <table style="width: 100%;" id="sold_car_table" class="table table-hover table-striped table-bordered">
         <thead>
            <tr>
               <th>Id</th>
               <th>Image</th>
               <th>VIN</th>
               <th>Dealership Name</th>
               <th>Sold Date</th>
               <th>Winning Bid</th>
               <th>Total Bid</th>
               <th>Payment Status</th>
               <th>More</th>
               <th>Action</th>
            </tr>
         </thead>
         <tfoot>
            <tr>
               <th>Id</th>
               <th>Image</th>
               <th>VIN</th>
               <th>Dealership Name</th>
               <th>Sold Date</th>
               <th>Winning Bid</th>
               <th>Total Bid</th>
               <th>Payment Status</th>
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
   $('#sold_car_table').DataTable({
   processing: true,
   serverSide: true,
   ajax: '{{route("sold-cars-data-table")}}',
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
           data: 'buyer_name',
           name: 'buyer_name'
       },{
           data: 'sold_date',
           name: 'sold_date'
       },{
           data: 'winning_bid',
           name: 'winning_bid'
       },{
           data: 'total_bid',
           name: 'total_bid'
       },{
           data: 'payment_status',
           name: 'payment_status'
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
                    return '<img src="'+data+'" style="width:250px"/>';                
            }
        },{
            targets: 8,
            render: function (data) {
                // var path = '{{url("vehicle_detail?id=")}}'+data;
                    return '<a href="'+data+'" class="btn btn-primary" target="_blank">More</a>';             
            }
        }
   ],
   order: [
       [0, "DESC"]
   ]
   });
</script>
@stop