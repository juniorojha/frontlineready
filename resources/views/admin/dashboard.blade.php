@extends('admin.layout.index')
@section('title')
Dashboard
@stop
@section('content')
<div class="app-page-title">
   <div class="page-title-wrapper">
      <div class="page-title-heading">
         <div class="page-title-icon">
            <i class="pe-7s-rocket icon-gradient bg-mean-fruit"></i>
         </div>
         <div>
            Dashboard
            <div class="page-title-subheading"></div>
         </div>
      </div>
      <div class="page-title-actions">
      </div>
   </div>
</div>
<div class="row">
   <div class="col-md-6 col-xl-3">
      <div class="card mb-3 widget-content bg-night-fade">
         <div class="widget-content-wrapper text-white">
            <div class="widget-content-left">
               <div class="widget-heading">Total</div>
               <div class="widget-subheading">All Cars</div>
            </div>
            <div class="widget-content-right">
               <div class="widget-numbers text-white"><span>{{$allcars}}</span></div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-md-6 col-xl-3">
      <div class="card mb-3 widget-content bg-arielle-smile">
         <div class="widget-content-wrapper text-white">
            <div class="widget-content-left">
               <div class="widget-heading">Total Cars</div>
               <div class="widget-heading">For Live </div>
            </div>
            <div class="widget-content-right">
               <div class="widget-numbers text-white"><span>{{$livecars}}</span></div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-md-6 col-xl-3">
      <div class="card mb-3 widget-content bg-happy-green">
         <div class="widget-content-wrapper text-white">
            <div class="widget-content-left">
               <div class="widget-heading">Total Cars</div>
               <div class="widget-heading">For Coming Soon</div>
            </div>
            <div class="widget-content-right">
               <div class="widget-numbers text-white"><span>{{$comingsooncars}}</span></div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-md-6 col-xl-3">
      <div class="card mb-3 widget-content bg-happy-itmeo">
         <div class="widget-content-wrapper text-white">
            <div class="widget-content-left">
               <div class="widget-heading">Total Cars</div>
               <div class="widget-heading"> For Private Sales</div>
            </div>
            <div class="widget-content-right">
               <div class="widget-numbers text-white"><span>{{$privatesales}}</span></div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="main-card mb-3 card">
    <div class="card-header">
        Live Cars
    </div>
   <div class="card-body">      
      <table style="width: 100%;" id="LiveCarTable" class="table table-hover table-striped table-bordered">
         <thead>
            <tr>
               <th>Id</th>
               <th>Register No</th>
               <th>Seller Name</th>
               <th>Current Bid</th>
               <th>Total Bid</th>
               <th>Reverse Met</th>
               <th>Aucation EndTime</th>
               <th>More</th>
               <th>Action</th>
            </tr>
         </thead>
         <tfoot>
            <tr>
               <th>Id</th>
               <th>Register No</th>
               <th>Seller Name</th>
               <th>Current Bid</th>
               <th>Total Bid</th>
               <th>Reverse Met</th>
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
                   data: 'reg_no',
                   name: 'reg_no'
               },{
                   data: 'name',
                   name: 'name'
               },{
                   data: 'current_bid',
                   name: 'current_bid'
               },{
                   data: 'total_bid',
                   name: 'total_bid'
               },{
                   data: 'reverse_met',
                   name: 'reverse_met'
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
            targets: 7,
            render: function (data) {
                 // var path = '{{url("vehicle_detail?id=")}}'+data;
                    return '<a href="'+data+'" class="btn btn-primary" target="_blank">More</a>';             
            }
        }],
           order: [
               [3, "DESC"]
           ]
    });
</script>
@stop