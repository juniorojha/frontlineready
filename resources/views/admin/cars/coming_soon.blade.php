@extends('admin.layout.index')
@section('title')
Coming Soon Cars
@stop
@section('content')
<div class="app-page-title">
   <div class="page-title-wrapper">
      <div class="page-title-heading">
         <div class="page-title-icon">
            <i class="pe-7s-car icon-gradient bg-mean-fruit"></i>
         </div>
         <div>
            Coming Soon Cars
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
      <table style="width: 100%;" id="coming_soon_table" class="table table-hover table-striped table-bordered">
         <thead>
            <tr>
               <th>Id</th>
               <th>Register No</th>
               <th>Name</th>
               <th>Seller Name</th>
               <th>More</th>
               <th>Action</th>
            </tr>
         </thead>
         <tfoot>
            <tr>
               <th>Id</th>
               <th>Register No</th>
               <th>Name</th>
               <th>Seller Name</th>
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
   $('#coming_soon_table').DataTable({
   processing: true,
   serverSide: true,
   ajax: '{{route("coming-soon-cars-data-table")}}',
   columns: [{  data: 'DT_RowIndex',
               name: 'DT_RowIndex',
               orderable: false,
               searchable: false 
            },{
           data: 'reg_no',
           name: 'reg_no'
       },{
           data: 'car_name',
           name: 'car_name'
       },{
           data: 'name',
           name: 'name'
       },{
           data: 'more',
           name: 'more'
       },{
           data: 'action',
           name: 'action'
       }
   ],columnDefs: [{
            targets: 4,
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