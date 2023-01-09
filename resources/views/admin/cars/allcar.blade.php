@extends('admin.layout.index')
@section('title')
All Cars
@stop
@section('content')
<style>
  /* Absolute Center Spinner */
.loading {
  position: fixed;
  z-index: 999;
  height: 2em;
  width: 2em;
  overflow: show;
  margin: auto;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
}
.hide{
  display: none;
}
.show{
  display: block;
}

/* Transparent Overlay */
.loading:before {
  content: '';
  display: block;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
    background: radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0, .8));

  background: -webkit-radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0,.8));
}

/* :not(:required) hides these rules from IE9 and below */
.loading:not(:required) {
  /* hide "loading..." text */
  font: 0/0 a;
  color: transparent;
  text-shadow: none;
  background-color: transparent;
  border: 0;
}

.loading:not(:required):after {
  content: '';
  display: block;
  font-size: 10px;
  width: 1em;
  height: 1em;
  margin-top: -0.5em;
  -webkit-animation: spinner 150ms infinite linear;
  -moz-animation: spinner 150ms infinite linear;
  -ms-animation: spinner 150ms infinite linear;
  -o-animation: spinner 150ms infinite linear;
  animation: spinner 150ms infinite linear;
  border-radius: 0.5em;
  -webkit-box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
}

/* Animation */

@-webkit-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-moz-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-o-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
  </style>
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
      <div class="row" style="margin-left: 5px;margin-bottom: 10px;">
        <a href="{{route('save-car', ['user_id'=>0,'id'=>0,'tab'=>0])}}" class="btn btn-primary">Add New Car</a>
        <a onclick="syncdata()" data-toggle="modal" data-target="#sync_report_info" href="javascript:void(0)" class="btn btn-primary" style="margin-left:15px">Sync Data From Frazer</a>         
      </div>
      <div id="report_area">
          
      </div>
      <table style="width: 100%;" id="cartable" class="table table-hover table-striped table-bordered">
         <thead>
            <tr>
               <th>Id</th>
               <th>Image</th>
               <th>VIN</th>
               <th>View</th>
               <th>FLR Report</th>
               <th>Status</th>
               <th>Action</th>
            </tr>
         </thead>
         <tfoot>
            <tr>
               <th>Id</th>
               <th>Image</th>
               <th>VIN</th>
               <th>View</th>
               <th>FLR Report</th>
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
   ajax: '{{route("all-cars-data-table")}}',
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
           data: 'more',
           name: 'more'
       },{
           data: 'flr_report',
           name: 'flr_report'
       },{
           data: 'auction_status',
           name: 'auction_status'
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
            targets: 3,
            render: function (data) {
                    return '<a href="'+data+'" class="btn btn-primary" target="_blank">More</a>';                
            }
        },{
            targets: 4,
            render: function (data) {
                    return '<a href="'+data+'" class="btn btn-primary" target="_blank">View</a>';                
            }
        },{
            targets: 5,
            render: function (data) {
               if(data==1){
                  return '<p class="btn-danger" style="text-align: center;width: 50px;border-radius: 6px;">Live</p>';  
               }else if(data==2){
                  return '<p class="btn-secondary" style="text-align: center;width: 108px;border-radius: 11px;padding: 4px;">Coming Soon</p>'; 
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

 function syncdata(){
     $(".loading").removeClass("hide");
     $(".loading").addClass("show");
     $.ajax({
              url: "{{route('car-sync-data')}}",
              method: 'get',
              success: function(response){
                  console.log(response);
                  var str = JSON.parse(response);
                  $(".loading").removeClass("show");
                  $(".loading").addClass("hide");
                  var txt = '<p>Sync started at '+str.start_datetime+'</p><p>Total number of records '+str.total_record+'</p><div id="report_list"></div><p>'+str.new_record+' records processed successfully.</p><p>Records with stock numbers 12241, 351351, 13551 already existed and were updated</p><p>1 records failed. Details above.</p>';
                  $("#sync_report_area").html(txt);
              }
        });
     
 }

</script>
@stop