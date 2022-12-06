@extends('admin.layout.index')
@section('title')
Curating Cars - {{$userdata->username}} Cars List
@stop
@section('content')
<div class="app-page-title">
   <div class="page-title-wrapper">
      <div class="page-title-heading">
         <div class="page-title-icon">
            <i class="pe-7s-car icon-gradient bg-mean-fruit"></i>
         </div>
         <div>
            {{$userdata->username}} Cars List
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
       <div class="row" style="margin-left: 5px;margin-bottom: 10px;">
         <a href="{{route('save-car', ['user_id'=>$user_id,'id'=>0,'tab'=>0])}}" class="btn btn-primary">Add New Car</a>
      </div>
      <input type="hidden" id="current_user_id" value="{{$user_id}}">
      <table style="width: 100%;" id="cartable" class="table table-hover table-striped table-bordered">
         <thead>
            <tr>
               <th>#</th>
               <th>Image</th>
               <th>Title</th>
               <th>View</th>
               <th>Auction Time</th>
               <th>Status</th>
               <th>Action</th>
            </tr>
         </thead>
         <tfoot>
            <tr>
               <th>#</th>
               <th>Image</th>
               <th>Title</th>
               <th>View</th>
               <th>Auction Time</th>
               <th>Status</th>
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
   ajax: '{{url("admin/users_cars_data_table?query=")}}'+$("#current_user_id").val(),
   columns: [{  data: 'DT_RowIndex',
               name: 'DT_RowIndex',
               orderable: false,
               searchable: false 
            },{
           data: 'banner',
           name: 'banner'
       },{
           data: 'title',
           name: 'title'
       },{
           data: 'view',
           name: 'view'
       },{
           data: 'aucation_time',
           name: 'aucation_time'
       },{
           data: 'status',
           name: 'status'
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
            targets: 4,
            render: function (data) {
                   if(data!=""){
                     var str = data.split('@');
                     return str[0]+'</br>'+str[1];     
                   }
                              
            }
        },{
            targets: 3,
            render: function (data) {
                    var path = '{{url("vehicle_detail?query=")}}'+data;
                    return '<a href="'+path+'" class="btn btn-primary" target="_blank">View</a>';                
            }
        },{
            targets: 5,
            render: function (data) {
               if(data==1){
                  return '<p class="btn-danger" style="text-align: center;width: 50px;border-radius: 6px;">Live</p>';  
               }else if(data==2){
                  return '<p class="btn-secondary" style="text-align: center;width: 108px;border-radius: 11px;padding: 4px;">Coming Soon</p>'; 
               }else if(data==3){
                  return '<p class="btn-warning" style="text-align: center;width: 75px;border-radius: 6px;">Buy Now</p>'; 
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
         var msg = "Are you sure you want to delete this News?";
         if (confirm(msg)) {                
                 window.location.href = url;                 
         } else {
             window.location.reload();
         }
     } 

   
</script>
@stop