@extends('admin.layout.index')
@section('title')
 Private Sales Cars
@stop
@section('content')
<div class="app-page-title">
   <div class="page-title-wrapper">
      <div class="page-title-heading">
         <div class="page-title-icon">
            <i class="pe-7s-car icon-gradient bg-mean-fruit"></i>
         </div>
         <div>
             Private Sales Cars
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
      <table style="width: 100%;" id="BuyNowCarstable" class="table table-hover table-striped table-bordered">
         <thead>
            <tr>
               <th>Id</th>
               <th>Register No</th>
               <th>Seller Name</th>
               <th>More</th>
               <th>Price</th>
               <th>Action</th>
            </tr>
         </thead>
         <tfoot>
            <tr>
               <th>Id</th>
               <th>Register No</th>
               <th>Seller Name</th>
               <th>More</th>
               <th>Price</th>
               <th>Action</th>
            </tr>
         </tfoot>
      </table>
   </div>
</div>
@stop
@section('footer')
<script type="text/javascript">
   $('#BuyNowCarstable').DataTable({
   processing: true,
   serverSide: true,
   ajax: '{{route("buy-now-cars-data-table")}}',
   columns: [{  data: 'DT_RowIndex',
               name: 'DT_RowIndex',
               orderable: false,
               searchable: false 
            },{
           data: 'reg_no',
           name: 'reg_no'
       },{
           data: 'name',
           name: 'name'
       },{
           data: 'more',
           name: 'more'
       },{
           data: 'price',
           name: 'price'
       },{
           data: 'action',
           name: 'action'
       }
   ],columnDefs: [{
            targets: 3,
            render: function (data) {
                 // var path = '{{url("vehicle_detail?id=")}}'+data;
                    return '<a href="'+data+'" class="btn btn-primary" target="_blank">More</a>';             
            }
        }],
   order: [
       [0, "DESC"]
   ]
   });
</script>
@stop