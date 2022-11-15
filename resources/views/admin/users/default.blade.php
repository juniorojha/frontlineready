@extends('admin.layout.index')
@section('title')
Users List
@stop
@section('content')
<div class="app-page-title">
   <div class="page-title-wrapper">
      <div class="page-title-heading">
         <div class="page-title-icon">
            <i class="pe-7s-users icon-gradient bg-mean-fruit"></i>
         </div>
         <div>
            Users List
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
      <table style="width: 100%;" id="UsersTable" class="table table-hover table-striped table-bordered">
         <thead>
            <tr>
               <th>#</th>
               <th>User Name</th>
               <th>Country</th>
               <th>Email</th>
               <th>Phone</th>
               <th>View</th>
               <th>Status</th>
               <th>Action</th>
            </tr>
         </thead>
         <tfoot>
            <tr>
               <th>#</th>
               <th>User Name</th>
               <th>Country</th>
               <th>Email</th>
               <th>Phone</th>
               <th>View</th>
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
   $('#UsersTable').DataTable({
   processing: true,
   serverSide: true,
   ajax: '{{route("users-data-table")}}',
   columns: [{  data: 'DT_RowIndex',
               name: 'DT_RowIndex',
               orderable: false,
               searchable: false 
            },{
           data: 'username',
           name: 'username'
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
           data: 'view',
           name: 'view'
       },{
           data: 'status',
           name: 'status'
       }, {
           data: 'action',
           name: 'action'
       }
   ],columnDefs: [{
            targets: 5,
            render: function (data) {
                    return '<a href="javascript:void()" onclick="userdata('+data+')" class="btn btn-primary" data-toggle="modal" data-target="#user_info_data">View</a>';                
            }
        }],
   order: [
       [0, "DESC"]
   ]
   });
   function delete_record(url){
         var msg = "Do you Sure Want To Delete This User?";
         if (confirm(msg)) {                
                 window.location.href = url;                 
         } else {
             window.location.reload();
         }
     } 

   function invoicedata(id){      
         $.ajax({
               url: '{{route("get-invoice-data")}}',
               method: 'get',
               data: {id:id},
               success: function(response){
                     if(response!=null){
                        var str = JSON.parse(response);
                        $("#company_name_invoice").html(str.company_name);
                        $("#billing_address_invoice").html(str.billing_address);
                        $("#country_invoice").html(str.country_name);
                        $("#state_invoice").html(str.state_name);
                        $("#city_invoice").html(str.city_name);
                        $("#pincode_invoice").html(str.pincode);
                        $("#phone_invoice").html(str.country_code+str.phone);
                        $("#vat_invoice").html(str.vat_no);
                     }
                     
               }
        });
   }
   
   function userdata(id){
       $.ajax({
               url: '{{route("get-user-data")}}',
               method: 'get',
               data: {id:id},
               success: function(response){
                     if(response!=null){
                        var str = JSON.parse(response);
                        $("#data_username").html(str.username);
                        $("#data_country").html(str.country_name);
                        $("#data_phone").html(str.phone);
                        $("#data_email").html(str.email);
                        if(str.image==""||str.image==null){
                            $("#data_image").attr('src','<?=asset('storage/app/public/profile/user-thumb.jpg')?>');
                        }else{
                             
                              $("#data_image").attr('src','<?=asset('storage/app/public/profile/')?>'+'/'+str.image);
                        }
                       
                        if(str.trade_news_email_notification==1){
                            $("#data_trade_news_email_notification").html("ON");
                        }else{
                            $("#data_trade_news_email_notification").html("OFF");
                        }
                        if(str.promotions_email_notification==1){
                            $("#data_promotions_email_notification").html("ON");
                        }else{
                            $("#data_promotions_email_notification").html("OFF");
                        }
                        if(str.data_email_verification==0){
                            $("#data_email_verification").html("Complete");
                        }else{
                            $("#data_email_verification").html("Pending");
                        }
                     }
                     
               }
        });
   }

   function paymentdata(id){
         $.ajax({
               url: '{{route("get-payment-data")}}',
               method: 'get',
               data: {id:id},
               success: function(response){
                  if(response!=null){
                         var str = JSON.parse(response);
                         console.log(str);
                        $("#name_on_card_payment").html(str.name_on_card);
                        $("#billing_address_payment").html(str.billing_address);
                        $("#country_payment").html(str.country_name);
                        $("#state_payment").html(str.state_name);
                        $("#city_payment").html(str.city_name);
                        $("#pincode_payment").html(str.pincode);
                        $("#phone_payment").html(str.country_code+str.phone);
                        $("#stripe_customer_id_payment").html(str.stripe_customer_id);
                  }
               }
         });
   }
</script>
@stop