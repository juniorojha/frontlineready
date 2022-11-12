<!doctype html>
<html lang="en">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta http-equiv="Content-Language" content="en">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>Front Line Ready - Admin Login</title>
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
      <meta name="description" content="ArchitectUI HTML Bootstrap 4 Dashboard Template">
      <meta name="msapplication-tap-highlight" content="no">
      <link href="{{asset('public/atheme/main.css?v=00')}}" rel="stylesheet">
   </head>
   <body>
      <div class="app-container app-theme-white body-tabs-shadow">
         <div class="app-container">
            <div class="h-100 bg-plum-plate bg-animation">
               <div class="d-flex h-100 justify-content-center align-items-center">
                  <div class="mx-auto app-login-box col-md-8">
                     <div class="app-logo-inverse mx-auto mb-3 logot"><img src="{{asset('public/logo/transparent_logo.png')}}" style="width: 224px;height: 141px;" /></div>
                     <div class="modal-dialog w-100 mx-auto">
                        <div class="modal-content">
                           
                           <form class="" id="loginForm" action="{{route('admin-post-login')}}" method="post">
                              {{csrf_field()}}
                              <div class="modal-body">
                                 <div class="h5 modal-title text-center">
                                    <h4 class="mt-2">
                                       <div>Welcome back,</div>
                                       <span>Please sign in to your account below.</span>
                                    </h4>
                                    @if(Session::has('message'))
                           <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show" role="alert">
                              <button type="button" class="close" aria-label="Close" data-dismiss="alert">
                              <span aria-hidden="true">×</span>
                              </button>
                              {{ Session::get('message') }}
                           </div>
                           @endif
                                 </div>
                                 <div class="form-row">
                                    <div class="col-md-12">
                                       <div class="position-relative form-group">
                                          <input name="email" id="email" value="{{isset($_COOKIE['email'])?$_COOKIE['email']:''}}" placeholder="Email here..." type="email" class="form-control">
                                       </div>
                                    </div>
                                    <div class="col-md-12">
                                       <div class="position-relative form-group">
                                          <input name="password" id="password" value="{{isset($_COOKIE['password'])?$_COOKIE['password']:''}}" placeholder="Password here..." type="password" class="form-control">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="position-relative form-check">
                                    @if(isset($_COOKIE['rem_me'])&&$_COOKIE['rem_me']=='1')
                                        <input name="rem_me" id="rem_me" value="1" type="checkbox" checked class="form-check-input">
                                    @else
                                        <input name="rem_me" id="rem_me" value="1" type="checkbox" class="form-check-input">
                                    @endif
                                    <label for="rem_me" class="form-check-label">Keep me logged in</label>
                                 </div>
                              </div>
                              <div class="modal-footer clearfix">
                                 <div class="float-right">
                                    <button class="btn btn-primary btn-lg">Login to Dashboard</button>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                     <div class="text-center text-white opacity-8 mt-3">Copyright © {{date('Y')}} Front Line Ready</div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <script type="text/javascript" src="{{asset('public/atheme/assets/scripts/main.js')}}"></script>
      <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
      <script>
         $(document).ready(function() {
             $("#loginForm").validate({
                 rules: {
                     email: {
                         required: true,
                         email: true
                     },
                     password: {
                         required: true
                     }
                 }
             });
         });
      </script>
   </body>
</html>