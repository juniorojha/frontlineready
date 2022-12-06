<!doctype html>
<html lang="en">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <!-- /Added by HTTrack -->
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta http-equiv="Content-Language" content="en">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>@yield('title')</title>
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
      <meta name="description" content="This is an example dashboard created using build-in elements and components.">
      <meta name="msapplication-tap-highlight" content="no">
      <link href="{{asset('public/atheme/main.css')}}" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="">
       <script type="text/javascript" src="{{asset('public/ckeditor/ckeditor.js?v=644')}}"></script> 
      <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
     
<link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css" rel="stylesheet">

   </head>
   <body>
      <div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
         <div class="app-header header-shadow bg-royal header-text-light">
             @include('admin.layout.header')
         </div>
         <div class="ui-theme-settings">
         
         </div>
         <div class="app-main">
            <div class="app-sidebar sidebar-shadow bg-royal sidebar-text-light">
               <div class="app-header__logo">
                  <?php $logo = asset('public/logo/transparent_logo.png');?>
                  <div class="logo-src" style="background-image:url('{{$logo}}')"></div>
                  <div class="header__pane ml-auto">
                     <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                        <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                        </span>
                        </button>
                     </div>
                  </div>
               </div>
               <div class="app-header__mobile-menu">
                  <div>
                     <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                     <span class="hamburger-box">
                     <span class="hamburger-inner"></span>
                     </span>
                     </button>
                  </div>
               </div>
               <div class="app-header__menu">
                  <span>
                  <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                  <span class="btn-icon-wrapper">
                  <i class="fa fa-ellipsis-v fa-w-6"></i>
                  </span>
                  </button>
                  </span>
               </div>
               @include('admin.layout.sidemenu')
            </div>
            <div class="app-main__outer">
               <div class="app-main__inner">
                  @yield('content')
               </div>
               <div class="app-wrapper-footer">
                  <div class="app-footer">
                     <div class="app-footer__inner">
                        <div class="app-footer-left">
                           <div class="footer-dots">
                            
                           </div>
                        </div>
                        <div class="app-footer-right">
                          
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="app-drawer-wrapper">
         <div class="drawer-nav-btn">
            <!--<button type="button" class="hamburger hamburger--elastic is-active">
            <span class="hamburger-box"><span class="hamburger-inner"></span></span>
            </button>-->
         </div>
         <div class="drawer-content-wrapper">
            <div class="scrollbar-container">
              
            </div>
         </div>
      </div>
      <div class="app-drawer-overlay d-none animated fadeIn"></div>
      <script type="text/javascript" src="{{asset('public/atheme/assets/scripts/main.js?v=31')}}"></script>
      <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
      <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
      
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

      @yield('footer')
   </body>
</html>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Set Car Auction Time</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="" id="saveaucationinfo" action="{{route('save-aucation-time')}}" method="post" enctype="multipart/form-data">
            <div class="modal-body">                 
                  <input type="hidden" name="car_id" id="auct_car_id" value="">
                  {{csrf_field()}}                      
                  <div class="form-group">
                           <label for="end_time" class="">Select Aucation Time<span class="error">*</span></label>
                           <input type="text" class="form-control" id="demo" name="datefilter" value="" />

                  </div>                           
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="invoice_address" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Invoice Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">                 
                 <p><b>Company Name : </b> <span id="company_name_invoice"></span></p>
                 <p><b>Billing Address : </b> <span id="billing_address_invoice"></span></p>
                 <p><b>Country : </b> <span id="country_invoice"></span></p>
                 <p><b>State : </b> <span id="state_invoice"></span></p>
                 <p><b>City : </b> <span id="city_invoice"></span></p> 
                 <p><b>Pincode : </b> <span id="pincode_invoice"></span></p> 
                 <p><b>Phone : </b> <span id="phone_invoice"></span></p> 
                 <p><b>Vat No : </b> <span id="vat_invoice"></span></p>      
                                   
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            
        </div>
    </div>
</div>

<div class="modal fade" id="payment_info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Payment Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">                 
                 <p><b>Name On Card: </b> <span id="name_on_card_payment"></span></p>
                 <p><b>Billing Address : </b> <span id="billing_address_payment"></span></p>
                 <p><b>Country : </b> <span id="country_payment"></span></p>
                 <p><b>State : </b> <span id="state_payment"></span></p>
                 <p><b>City : </b> <span id="city_payment"></span></p> 
                 <p><b>Pincode : </b> <span id="pincode_payment"></span></p> 
                 <p><b>Phone : </b> <span id="phone_payment"></span></p> 
                 <p><b>Stripe Customer Id : </b> <span id="stripe_customer_id_payment"></span></p>                        
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
           
        </div>
    </div>
</div>

<div class="modal fade" id="user_info_data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">User Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                 <div class="row">
                     <div class="col-md-4">
                         <img src="{{asset('storage/app/public/profile/user-thumb.jpg')}}" id="data_image" style="width: 150px;height: 150px;"/> 
                     </div>
                     <div class="col-md-8">
                         <p><b>Username: </b> <span id="data_username"></span></p>
                 <p><b>Country : </b> <span id="data_country"></span></p>
                 <p><b>Phone : </b> <span id="data_phone"></span></p>
                 <p><b>Email : </b> <span id="data_email"></span></p>
                 <p><b>Trade News Email Notification : </b> <span id="data_trade_news_email_notification"></span></p> 
                 <p><b>Promotions Email Notification : </b> <span id="data_promotions_email_notification"></span></p> 
                 <p><b>Email Verification : </b> <span id="data_email_verification"></span></p> 
                     </div>
                 </div>
                                 
                 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
           
        </div>
    </div>
</div>


