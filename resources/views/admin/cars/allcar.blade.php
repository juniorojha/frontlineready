@extends('admin.layout.index')
@section('title')
All Cars
@stop
@section('content')
<div class="app-page-title">
   <div class="page-title-wrapper">
      <div class="page-title-heading">
         <div class="page-title-icon">
            <i class="pe-7s-car icon-gradient bg-mean-fruit"></i>
         </div>
         <div>
            All Cars
            <div class="page-title-subheading"></div>
         </div>
      </div>
      <div class="page-title-actions">
      </div>
   </div>
</div>
<div class="main-card mb-3 card">
   <div class="card-body">
     <!--  -->
      @if(Session::has('message'))
      <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show" role="alert">
         <button type="button" class="close" aria-label="Close" data-dismiss="alert">
         <span aria-hidden="true">×</span>
         </button>
         {{ Session::get('message') }}
      </div>
      @endif
      <table style="width: 100%;" id="cartable" class="table table-hover table-striped table-bordered">
         <thead>
            <tr>
               <th>Id</th>
               <th>Register No</th>
               <th>Name</th>
               <th>Seller Name</th>
               <th>View</th>
               <th>Aucation Status</th>
               <th>Action</th>
            </tr>
         </thead>
         <tfoot>
            <tr>
               <th>Id</th>
               <th>Register No</th>
               <th>Name</th>
               <th>Seller Name</th>
               <th>View</th>
               <th>Aucation Status</th>
               <th>Action</th>
            </tr>
         </tfoot>
      </table>
   </div>
</div>

@stop
@section('footer')
<script type="text/javascript">
   $('#cartable').DataTable({
   processing: true,
   serverSide: true,
   ajax: '{{route("all-cars-data-table")}}',
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
           data: 'seller_name',
           name: 'seller_name'
       },{
           data: 'more',
           name: 'more'
       },{
           data: 'aucation_status',
           name: 'aucation_status'
       },{
           data: 'action',
           name: 'action'
       }
   ],columnDefs: [{
            targets: 4,
            render: function (data) {
                   // var path = '{{url("vehicle_detail?query=")}}'+data;
                    return '<a href="'+data+'" class="btn btn-primary" target="_blank">More</a>';                
            }
        },{
            targets: 5,
            render: function (data) {
               if(data==1){
                  return '<p class="btn-danger" style="text-align: center;width: 50px;border-radius: 6px;">Live</p>';  
               }else if(data==2){
                  return '<p class="btn-secondary" style="text-align: center;width: 108px;border-radius: 11px;padding: 4px;">Coming Soon</p>'; 
               }else if(data==3){
                  return '<p class="btn-warning" style="text-align: center;width: 75px;border-radius: 6px;">Private sales</p>'; 
               }else if(data==4){
                  return '<p class="btn-info" style="text-align: center;width: 50px;border-radius: 6px;">Sold</p>'; 
               }else{
                  return '<p class="btn-success" style="text-align: center;width: 50px;border-radius: 6px;">New</p>'; 
               }
                             
            }
        }],
   order: [
       [0, "DESC"]
   ]
   });

   function set_car_id(val){
      $("#auct_car_id").val(val);

   }

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