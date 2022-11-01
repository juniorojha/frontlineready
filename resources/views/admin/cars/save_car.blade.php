@extends('admin.layout.index')
@section('title')
Save Car Information
@stop
@section('content')
<style type="text/css">
   .hide{
      display: none;
   }
   #upload_image-error{
      display: block;
   }
</style>
<link type="text/css" rel="stylesheet" href="{{asset('public/imageupload/image-uploader.min.css')}}">
<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<div class="app-page-title">
   <div class="page-title-wrapper">
      <div class="page-title-heading">
         <div class="page-title-icon">
            <i class="pe-7s-paint-bucket icon-gradient bg-mean-fruit"></i>
         </div>
         <div>
            Save Car Information
            <div class="page-title-subheading"></div>
         </div>
      </div>
      <div class="page-title-actions">
      </div>
   </div>
</div>
<div class="main-card mb-3 " style="display: flex;justify-content: center;">
   <div class="col-md-9 card">
      <div class="card-header">
         <i class="header-icon lnr-gift icon-gradient bg-grow-early"> </i> Save Car Information
         <div class="btn-actions-pane-right">
            <div class="nav">
               <a data-toggle="tab" href="#tab-eg4-0" class="border-0 btn-pill btn-wide btn-transition <?=$tab==0?'active':''?> btn btn-outline-danger">General Information</a>
               <a data-toggle="tab" href="#tab-eg4-1" class="mr-1 ml-1 btn-pill btn-wide border-0 btn-transition <?=$tab==1?'active':''?> btn btn-outline-danger">Exterior</a>
               <a data-toggle="tab" href="#tab-eg4-2" class="border-0 btn-pill btn-wide btn-transition <?=$tab==2?'active':''?>  btn btn-outline-danger">Interior</a>
               <a data-toggle="tab" href="#tab-eg4-3" class="border-0 btn-pill btn-wide btn-transition <?=$tab==3?'active':''?> btn btn-outline-danger">Mechanics</a>
               <a data-toggle="tab" href="#tab-eg4-4" class="border-0 btn-pill btn-wide btn-transition <?=$tab==4?'active':''?> btn btn-outline-danger">History & Paperwork</a>
               
            </div>
         </div>
      </div>
      <div class="card-body">
         @if(Session::has('message'))
         <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show" role="alert">
            <button type="button" class="close" aria-label="Close" data-dismiss="alert">
            <span aria-hidden="true">×</span>
            </button>
            {{ Session::get('message') }}
         </div>
         @endif
         <ul class="error">
              @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
         </ul>
         <input type="hidden" id="car_id" value="{{$id}}">
         <input type="hidden" name="user_id" value="{{$user_id}}">
         <div class="tab-content">
            <div class="tab-pane <?=$tab==0?'active':''?>" id="tab-eg4-0" role="tabpanel">
               <form class="" action="{{route('post-car-general-info')}}" method="post" enctype="multipart/form-data" id="general_info_form">
                  <input type="hidden" name="car_id" value="{{$id}}">
                  <input type="hidden" name="user_id" value="{{$user_id}}">
                  {{csrf_field()}}
                  <div class="row">
                        <div class="form-group col-md-6">
                           <label for="name" class="">Name<span class="error">*</span></label>
                           <input name="name" id="name" placeholder="Please Enter Your Vehicle Name" type="text" class="form-control" value="{{isset($data->name)?$data->name:''}}" required="">
                        </div>
                        <div class="form-group col-md-6">
                           <label for="reg_no" class="">Vehicle Registration Number<span class="error">*</span></label>
                           <input name="reg_no" id="reg_no" placeholder="Please Enter Your Vehicle Registration Number" type="text" class="form-control" value="{{isset($data->reg_no)?$data->reg_no:''}}" required="">
                        </div>
                  </div>
                 <div class="row">
                     <div class="form-group col-md-12">
                          <label for="short_desc" class="">Short Description<span class="error">*</span></label>
                           <input name="short_desc" id="short_desc" placeholder="Please Enter Your Vehicle Short Description" type="text" class="form-control" value="{{isset($data->short_desc)?$data->short_desc:''}}" required="">
                     </div>
                </div>
                  <div class="row">
                     <div class="form-group col-md-6">
                        <label for="make_id" class="">Make<span class="error">*</span></label>
                        <select name="make_id" id="make_id" class="form-control" required="">
                           <option value="">Select Make</option>
                           @foreach($make_data as $m)
                           <option value="{{$m->id}}" <?=isset($data->make_id)&&$data->make_id==$m->id?'selected="selected"':''?>>{{$m->name}}</option>
                           @endforeach
                        </select>
                     </div>
                     <div class="form-group col-md-6">
                        <label for="model" class="">Model<span class="error">*</span></label>
                        <input name="model" id="model" required="" placeholder="Please Enter Your Vehicle Model" value="{{isset($data->model)?$data->model:''}}" type="text" class="form-control">
                     </div>
                  </div>
                  <div class="row">
                     <div class="form-group col-md-6">
                        <label for="variant" class="">Variant<span class="error">*</span></label>
                        <input name="variant" id="variant" required="" placeholder="Please Enter Your Vehicle Variant"  value="{{isset($data->variant)?$data->variant:''}}" type="text" class="form-control">
                     </div>
                     <div class="form-group col-md-6">
                        <?php $years = range(date('Y'), 1900);?>
                        <label for="year" class="">Manufacture Year<span class="error">*</span></label>
                        <select name="year" id="year" class="form-control" required="">
                           <option value="">Select Year</option>
                           <?php 
                              for($i=0;$i<count($years);$i++){
                                 if(isset($data->year)&&$data->year==$years[$i]){
                                    $class = "selected='selected'";
                                 }else{
                                    $class = '';
                                 }
                                 echo '<option value="'.$years[$i].'" '.$class.'>'.$years[$i].'</option>';
                              }
                              ?>                      
                        </select>
                     </div>
                  </div>
                  <div class="row">
                     <div class="form-group col-md-6">
                        <label for="mileage" class="">Mileage<span class="error">*</span></label>
                        <input name="mileage" id="mileage" placeholder="Please Enter Your Vehicle Mileage" required="" value="{{isset($data->mileage)?$data->mileage:''}}" type="text" class="form-control">
                     </div>
                     <div class="form-group col-md-6">
                        <label for="gearbox" class="">Gearbox<span class="error">*</span></label>
                        <select name="gearbox" id="gearbox" class="form-control" required="">
                           <option value="">Select Gearbox</option>
                           <option value="Auto" <?=isset($data->gearbox)&&$data->gearbox=='Auto'?'selected="selected"':''?>>Auto</option>
                           <option value="Manual" <?=isset($data->gearbox)&&$data->gearbox=='Manual'?'selected="selected"':''?>>Manual</option>
                           <option value="Semi" <?=isset($data->gearbox)&&$data->gearbox=='Semi'?'selected="selected"':''?>>Semi</option>
                           <option value="Electric" <?=isset($data->gearbox)&&$data->gearbox=='Electric'?'selected="selected"':''?>>Electric</option>
                           
                        </select>
                     </div>
                  </div>
                  <div class="row">
                     <div class="form-group col-md-6">
                        <label for="steering_position" class="">Steering Position<span class="error">*</span></label>
                        <select name="steering_position" id="steering_position" class="form-control" required="">
                           <option value="">Select Steering Position</option>
                           <option value="1" <?=isset($data->steering_position)&&$data->steering_position=='1'?'selected="selected"':''?>>Left-hand Drive</option>
                           <option value="2" <?=isset($data->steering_position)&&$data->steering_position=='2'?'selected="selected"':''?>>Right-hand Drive</option>
                        </select>
                     </div>
                     <div class="form-group col-md-6">
                        <label for="engine_size" class="">Engine Size<span class="error">*</span></label>
                        <input name="engine_size" value="{{isset($data->engine_size)?$data->engine_size:''}}" required="" id="engine_size" placeholder="Please Enter Your Vehicle Engine Size" type="text" class="form-control">
                     </div>
                  </div>
                  <div class="row">
                     <div class="form-group col-md-6">
                        <label for="color" class="">Color<span class="error">*</span></label>
                        <input name="color" id="color"  value="{{isset($data->color)?$data->color:''}}" required="" placeholder="Please Enter Your Vehicle Color" type="text" class="form-control">
                     </div>
                     <div class="form-group col-md-6">
                        <label for="chassis_no" class="">Chassis Number</label>
                        <input name="chassis_no" id="chassis_no"  value="{{isset($data->chassis_no)?$data->chassis_no:''}}" required=""  placeholder="Please Enter Your Vehicle Chassis Number" type="text" class="form-control">
                     </div>
                  </div>
                  <div class="row">
                     <div class="form-group col-md-6">
                        <label for="country_id" class="">In What Country Is The Vehicle Located?<span class="error">*</span></label>
                        <select name="country_id" id="country_id" required="" class="form-control" onchange="getcitylistbycountry(this.value)">
                           <option value="">Select Country</option>
                           @foreach($country as $c)
                           <option value="{{$c->id}}" <?=isset($data->country_id)&&$data->country_id==$c->id?'selected="selected"':''?>>{{$c->name}}</option>
                           @endforeach
                        </select>
                     </div>
                     <div class="form-group col-md-6">
                        <label for="city_id" class="">Where Is The Vehicle Located(Town/City)?<span class="error">*</span></label>
                        <select name="city_id" id="city_id" class="form-control" required="">
                           <option value="">Select City</option>
                           @if(count($city_data)>0)
                           @foreach($city_data as $cd)
                           <option value="{{$cd->id}}" <?=isset($data->city_id)&&$data->city_id==$cd->id?'selected="selected"':''?>>{{$cd->name}}</option>
                           @endforeach
                           @endif
                        </select>
                     </div>
                  </div>
                  <div class="row">
                     <div class="form-group col-md-6">
                        <label for="seller_type" class="">Sell Type<span class="error">*</span></label>
                        <select name="seller_type" id="seller_type" class="form-control" required="">
                           <option value="1" <?=isset($data->seller_type)&&$data->seller_type=='1'?'selected="selected"':''?>>Trade</option>
                           <option value="2" <?=isset($data->seller_type)&&$data->seller_type=='2'?'selected="selected"':''?>>Private</option>
                           <option value="3" <?=isset($data->seller_type)&&$data->seller_type=='3'?'selected="selected"':''?>>Managed</option>
                          
                        </select>
                     </div>
                    
                     <div class="form-group col-md-6">
                        <label for="former_keepers" class="">Former Keepers<span class="error">*</span></label>
                         <select name="former_keepers" id="former_keepers" class="form-control" required="">
                           <option value="">Select Former Keepers</option>
                           <option value="1" <?=isset($data->former_keepers)&&$data->former_keepers=='1'?'selected="selected"':''?>>1</option>
                           <option value="2" <?=isset($data->former_keepers)&&$data->former_keepers=='2'?'selected="selected"':''?>>2</option>
                           <option value="3" <?=isset($data->former_keepers)&&$data->former_keepers=='3'?'selected="selected"':''?>>3</option>
                           <option value="More Then 3" <?=isset($data->former_keepers)&&$data->former_keepers=='More Then 3'?'selected="selected"':''?>>More Then 3</option>
                           <option value="Not Sure" <?=isset($data->former_keepers)&&$data->former_keepers=='Not Sure'?'selected="selected"':''?>>Not Sure</option>
                           
                        </select>
                     </div>
                  </div>
                  <div class="row">
                     <div class="form-group col-md-6">
                        <label for="currency" class="">Currency<span class="error">*</span></label>
                        <select name="currency" id="currency" class="form-control" required="">
                           <option value="">Select Currency</option>
                           @foreach($currency as $c)
                           <option value="{{$c->code}} - {{$c->symbol}}" <?=isset($data->currency)&&$data->currency==$c->code.' - '.$c->symbol?'selected="selected"':''?> >{{$c->code}} - {{$c->symbol}}</option>
                           @endforeach
                        </select>
                     </div>
                     <div class="form-group col-md-6">
                        <label for="reserve_price" class="">Set a Reserve( Leave 0 For No Reserve)<span class="error">*</span></label>
                        <input name="reserve_price"  value="{{isset($data->reserve_price)?$data->reserve_price:''}}" required="" id="reserve_price" placeholder="Please Set Your Reserve" type="text" class="form-control">
                     </div>
                  </div>
                  <div class="row">
                     <div class="form-group col-md-6">
                        <label for="status" class="">Status<span class="error">*</span></label>
                        <select name="status" id="status" required class="form-control" onchange="changeaucationtime(this.value)">
                           <option value="2">Coming Soon</option>
                           <option value="1" <?=isset($data->status)&&$data->status==1?'selected="selected"':''?>>Live</option>                          
                           <option value="3" <?=isset($data->status)&&$data->status==3?'selected="selected"':''?>>Private Sales</option>
                            <option value="4" <?=isset($data->status)&&$data->status=='4'?'selected="selected"':''?>>Sold</option>
                        </select>
                     </div>
                     
                     <div class="form-group col-md-6 <?=isset($data->status)&&$data->status==1?'':'hide'?>" id="aucation_end_datetime_div">
                        <label for="aucation_enddate" class="">Select Aucation End Date<span class="error">*</span></label>
                        <div class="row col-md-12">
                                <input type="date" name="aucation_enddate" min='{{date("Y-m-d")}}' id="aucation_enddate" value="{{isset($data->aucation_enddate)?$data->aucation_enddate:''}}" class="form-control col-md-6">
                                <input type="time" name="aucation_endtime" min='' id="aucation_endtime" value="{{isset($data->aucation_endtime)?$data->aucation_endtime:''}}" class="form-control col-md-5" style="margin-left:10px">
                        </div>
                     </div>
                     
                     <div class="row col-md-12 <?=isset($data->status)&&$data->status==4?'':'hide'?>" id="sold_div">
                         <div class="form-group col-md-4">
                            <label for="sold_date" class="">Sold Date<span class="error">*</span></label>
                            
                                    <input type="date" name="sold_date" id="sold_date" value="{{isset($data->sold_date)?$data->sold_date:''}}" class="form-control">
                            
                         </div>
                         <div class="form-group col-md-4">
                            <label for="total_bid" class="">Total Bid<span class="error">*</span></label>
                            
                                    <input type="number" name="total_bid"  id="total_bid" value="{{isset($data->total_bid)?$data->total_bid:''}}" class="form-control">
                            
                         </div>
                         <div class="form-group col-md-4">
                            <label for="winning_bid" class="">Winning Bid<span class="error">*</span></label>
                            
                                    <input type="text" name="winning_bid"  id="winning_bid" value="{{isset($data->winning_bid)?$data->winning_bid:''}}" class="form-control">
                            
                         </div>
                     </div>
                     
                     
                     
                  </div>
                  <div class="form-group">
                     <label for="description" class="">Vehicle Description<span class="error">*</span></label>
                     <textarea class="form-control" name="description" id="description" required="" placeholder="Please Enter About Your Vehicle">{{isset($data->description)?$data->description:''}}</textarea>
                  </div>
                  <div class="position-relative form-group">
                     <label for="image" class="">Banner<span class="error">*</span></label>
                     <div id="uploaded_image">
                        <div class="upload-btn-wrapper" style="    width: 100%;">
                           <button class="btn imgcatlog" type="button">
                           <?php 
                              if(isset($data->banner)){
                                  $path= url('/')."/storage/app/public/cars/banner"."/".$data->banner;
                              }
                              else{
                                  $path=asset('public/images/car_placeholder.png');
                              }
                              ?>
                           <img src="{{$path}}" alt="..." class="img-thumbnail1" id="basic_img" >
                           </button>
                           <input type="hidden" id="basic_img1"/>
                           @if(isset($data->banner))
                           <input type="file" name="banner" style="height: 200px;width: 350px;" class="form-control" id="upload_image" />
                           @else
                           <input type="file"  required="" class="form-control"  style="height: 200px;width: 350px;" name="banner" id="upload_image" />
                           @endif
                        </div>
                     </div>
                  </div>
                  <button class="mt-1 btn btn-primary">Submit</button>
               </form>
            </div>
            <div class="tab-pane <?=$tab==1?'active':''?>" id="tab-eg4-1" role="tabpanel">
               <form class="" action="{{route('save-car-exterior')}}" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="car_id" value="{{$id}}">
                  <input type="hidden" name="user_id" value="{{$user_id}}">
                  {{csrf_field()}}
                  <div class="form-group">
                     <label for="wheels_tyres" class="">Wheels & Tyres<span class="error">*</span></label>
                     <textarea class="form-control" name="wheels_tyres" id="wheels_tyres" required="" placeholder="Please Enter About Wheels & Tyres">{{isset($data->exterior->wheels_tyres)?$data->exterior->wheels_tyres:''}}</textarea>
                  </div>
                  <div class="form-group">
                     <label for="bodywork" class="">Bodywork<span class="error">*</span></label>
                     <textarea class="form-control" name="bodywork" id="bodywork" required=""  placeholder="Please Enter About Bodywork">{{isset($data->exterior->bodywork)?$data->exterior->bodywork:''}}</textarea>
                  </div>
                  <div class="form-group">
                     <label for="paint" class="">Paint<span class="error">*</span></label>
                     <textarea class="form-control" name="paint" id="paint" required="" placeholder="Please Enter About Paint">{{isset($data->exterior->paint)?$data->exterior->paint:''}}</textarea>
                  </div>
                  <div class="form-group">
                     <label for="glass_trim" class="">Glass & Trim<span class="error">*</span></label>
                     <textarea class="form-control" name="glass_trim" id="glass_trim" required="" placeholder="Please Enter About Glass & Trim">{{isset($data->exterior->glass_trim)?$data->exterior->glass_trim:''}}</textarea>
                  </div>
                  <div class="position-relative form-group">
                     <label for="image" class="">Video Thumbail<span class="error">*</span></label>
                     <div id="uploaded_image2">
                        <div class="upload-btn-wrapper" style="    width: 100%;">
                           <button class="btn imgcatlog" type="button">
                           <?php 
                              if(isset($data->exterior->banner)){
                                  $path= url('/')."/storage/app/public/cars/exterior"."/".$data->exterior->banner;
                              }
                              else{
                                  $path=asset('public/images/car_placeholder.png');
                              }
                              ?>
                           <img src="{{$path}}" alt="..." class="img-thumbnail1" id="basic_img2" >
                           </button>
                           <input type="hidden" id="basic_img2"/>
                           @if(isset($data->exterior->banner))
                           <input type="file" name="banner" class="form-control" style="height: 200px;width: 350px;" id="upload_image2" />
                           @else
                           <input type="file" required="" class="form-control"style="height: 200px;width: 350px;" name="banner" id="upload_image2" />
                           @endif
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="form-group col-md-6">
                        <label for="glass_trim" class="">Video Type<span class="error">*</span></label>
                        <select class="form-control" name="video_type" id="video_type" required="" onchange="videosection(this.value,'ex')">
                           <option value="">Select Video Type</option>
                           <option value="2" <?=isset($data->exterior->video_type)&&$data->exterior->video_type==2?'selected="selected"':''?> >Video Url</option>
                           <option value="1" <?=isset($data->exterior->video_type)&&$data->exterior->video_type==1?'selected="selected"':''?>>Video Upload</option>
                        </select>
                     </div>
                      <?php 
                           if(isset($data->exterior->video_type)&&$data->exterior->video_type==1){
                               $class2 = "block";
                               $class1 = "none";
                           }else{
                              $class2 = "none";
                               $class1 = "block";
                           }
                     ?>
                     <div class="form-group col-md-6" id="video_ex_url" style="display:<?=$class1?>">
                        <label for="video_url" class="">Video Url<span class="error">*</span></label>
                        <input name="video_url"  value="{{isset($data->exterior->media)?$data->exterior->media:''}}" id="video_url_ex" placeholder="Please Enter Video Url" type="text" class="form-control">
                     </div>
                  </div>                 

                   <div class="form-group" id="video_ex_upload" style="display:<?=$class2?>">
                     <label for="video" class="">Video<span class="error">*</span></label></br>
                     <video width="500" height="240" controls style="margin-top: 15px">
                        @if(isset($data->exterior->media)&&$data->exterior->video_type==1)
                           <?php $path= url('/')."/storage/app/public/cars/video"."/".$data->exterior->media; ?>
                           <source src="{{$path}}" id="video_here_ex" type="video/mp4">
                        @else
                           <source src="#" id="video_here_ex" type="video/mp4">
                        @endif
                     </video></br>
                     <input type="file" style="margin-top: 10px;" name="video" onchange="uploadalt('ex')" id="video_ex" accept="video/*">
                  </div>
                  <div class="input-field">
                     <label class="active">Photos</label></br>
                    
                     
                     <div class="input-images-1" style="padding-top: .5rem;"></div>
                  </div>
                  <button class="mt-1 btn btn-primary">Submit</button>
               </form>
            </div>
            <div class="tab-pane <?=$tab==2?'active':''?>" id="tab-eg4-2" role="tabpanel">
               <form class="" action="{{route('update-car-interior')}}" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="car_id" value="{{$id}}">
                  <input type="hidden" name="user_id" value="{{$user_id}}">
                  {{csrf_field()}}
                  <div class="form-group">
                     <label for="seats" class="">Seats & Carpets<span class="error">*</span></label>
                     <textarea class="form-control" required="" name="seats" id="seats" placeholder="Please Enter About Seats & Carpets">{{isset($data->interior->seats)?$data->interior->seats:''}}</textarea>
                  </div>
                  <div class="form-group">
                     <label for="dashboard" class="">Dashboard<span class="error">*</span></label>
                     <textarea class="form-control" required="" name="dashboard" id="dashboard" placeholder="Please Enter About Dashboard">{{isset($data->interior->dashboard)?$data->interior->dashboard:''}}</textarea>
                  </div>
                  <div class="form-group">
                     <label for="steering_wheel" class="">Steering Wheel / Gear Stick<span class="error">*</span></label>
                     <textarea class="form-control" required="" name="steering_wheel" id="steering_wheel" placeholder="Please Enter About Steering Wheel / Gear Stick">{{isset($data->interior->steering_wheel)?$data->interior->steering_wheel:''}}</textarea>
                  </div>
                 <div class="position-relative form-group">
                     <label for="image" class="">Video Thumbail<span class="error">*</span></label>
                     <div id="uploaded_image3">
                        <div class="upload-btn-wrapper" style="    width: 100%;">
                           <button class="btn imgcatlog" type="button">
                           <?php 
                              if(isset($data->interior->banner)){
                                  $path= url('/')."/storage/app/public/cars/interior"."/".$data->interior->banner;
                              }
                              else{
                                  $path=asset('public/images/car_placeholder.png');
                              }
                              ?>
                           <img src="{{$path}}" alt="..." class="img-thumbnail1" id="basic_img3" >
                           </button>
                           <input type="hidden" id="basic_img3"/>
                           @if(isset($data->interior->banner))
                           <input type="file" name="banner" class="form-control" style="height: 200px;width: 350px;" id="upload_image3" />
                           @else
                           <input type="file" required="" class="form-control" name="banner" style="height: 200px;width: 350px;" id="upload_image3" />
                           @endif
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="form-group col-md-6">
                        <label for="glass_trim" class="">Video Type<span class="error">*</span></label>
                        <select class="form-control" name="video_type" required="" id="video_type" onchange="videosection(this.value,'in')">
                           <option value="">Select Video Type</option>
                           <option value="2" <?=isset($data->interior->video_type)&&$data->interior->video_type==2?'selected="selected"':''?> >Video Url</option>
                           <option value="1" <?=isset($data->interior->video_type)&&$data->interior->video_type==1?'selected="selected"':''?>>Video Upload</option>
                        </select>
                     </div>
                     <?php 
                           if(isset($data->interior->video_type)&&$data->interior->video_type==1){
                               $class2 = "block";
                               $class1 = "none";
                           }else{
                              $class2 = "none";
                               $class1 = "block";
                           }
                     ?>
                     <div class="form-group col-md-6" id="video_in_url" style="display:<?=$class1?>">
                        <label for="video_url" class="">Video Url<span class="error">*</span></label>
                        <input name="video_url"  value="{{isset($data->interior->media)?$data->interior->media:''}}" id="video_url_in" placeholder="Please Enter Video Url" type="text" class="form-control">
                     </div>
                  </div>                 

                   <div class="form-group" id="video_in_upload" style="display:<?=$class2?>">
                     <label for="video" class="">Video<span class="error">*</span></label></br>
                     <video width="500" height="240" controls style="margin-top: 15px">
                        @if(isset($data->interior->media)&&$data->interior->video_type==1)
                           <?php $path= url('/')."/storage/app/public/cars/video"."/".$data->interior->media; ?>
                           <source src="{{$path}}" id="video_here_in" type="video/mp4">
                        @else
                           <source src="#" id="video_here_in" type="video/mp4">
                        @endif
                     </video></br>
                     <input type="file" style="margin-top: 10px;" name="video" onchange="uploadalt('in')" id="video_in" accept="video/*">
                  </div>
                 
                  <div class="input-field">
                     <label class="active">Photos</label></br>
                     
                     <div class="input-images-2" style="padding-top: .5rem;"></div>
                  </div>
                  <button class="mt-1 btn btn-primary">Submit</button>
               </form>
            </div>
            <div class="tab-pane <?=$tab==3?'active':''?>" id="tab-eg4-3" role="tabpanel">
               <form class=""  action="{{route('update-car-mechanics-info')}}" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="car_id" value="{{$id}}">
                  <input type="hidden" name="user_id" value="{{$user_id}}">
                  {{csrf_field()}}
                  <div class="form-group">
                     <label for="engine_gearbox" class="">Engine & Gearbox<span class="error">*</span></label>
                     <textarea class="form-control" required="" name="engine_gearbox" id="engine_gearbox" placeholder="Please Enter About Engine & Gearbox">{{isset($data->mechanics->engine_gearbox)?$data->mechanics->engine_gearbox:''}}</textarea>
                  </div>
                  <div class="form-group">
                     <label for="suspension_brakes" class="">Suspension & Brakes<span class="error">*</span></label>
                     <textarea class="form-control" required="" name="suspension_brakes" id="suspension_brakes" placeholder="Please Enter About Suspension & Brakes">{{isset($data->mechanics->suspension_brakes)?$data->mechanics->suspension_brakes:''}}</textarea>
                  </div>
                  <div class="form-group">
                     <label for="the_drive" class="">The Drive<span class="error">*</span></label>
                     <textarea class="form-control" required="" name="the_drive" id="the_drive" placeholder="Please Enter About The Drive">{{isset($data->mechanics->the_drive)?$data->mechanics->the_drive:''}}</textarea>
                  </div>
                  <div class="form-group">
                     <label for="electrics" class="">Electrics & Other<span class="error">*</span></label>
                     <textarea class="form-control"  required="" name="electrics" id="electrics" placeholder="Please Enter About Electrics & Other">{{isset($data->mechanics->electrics)?$data->mechanics->electrics:''}}</textarea>
                  </div>
                  <div class="position-relative form-group">
                     <label for="image" class="">Video Thumbail<span class="error">*</span></label>
                     <div id="uploaded_image4">
                        <div class="upload-btn-wrapper" style="    width: 100%;">
                           <button class="btn imgcatlog" type="button">
                           <?php 
                              if(isset($data->mechanics->banner)){
                                  $path= url('/')."/storage/app/public/cars/mechanics"."/".$data->mechanics->banner;
                              }
                              else{
                                  $path=asset('public/images/car_placeholder.png');
                              }
                              ?>
                           <img src="{{$path}}" alt="..." class="img-thumbnail1" id="basic_img4" >
                           </button>
                           <input type="hidden" id="basic_img4"/>
                           @if(isset($data->mechanics->banner))
                           <input type="file" name="banner" class="form-control" id="upload_image4" style="height: 200px;width: 350px;" />
                           @else
                           <input type="file" required="" class="form-control" name="banner" id="upload_image4" style="height: 200px;width: 350px;" />
                           @endif
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="form-group col-md-6">
                        <label for="glass_trim" class="">Video Type<span class="error">*</span></label>
                        <select class="form-control" name="video_type" required="" id="video_type" onchange="videosection(this.value,'ma')">
                           <option value="">Select Video Type</option>
                           <option value="2" <?=isset($data->mechanics->video_type)&&$data->mechanics->video_type==2?'selected="selected"':''?> >Video Url</option>
                           <option value="1" <?=isset($data->mechanics->video_type)&&$data->mechanics->video_type==1?'selected="selected"':''?>>Video Upload</option>
                        </select>
                     </div>
                     <?php 
                           if(isset($data->mechanics->video_type)&&$data->mechanics->video_type==1){
                               $class2 = "block";
                               $class1 = "none";
                           }else{
                              $class2 = "none";
                               $class1 = "block";
                           }
                     ?>
                     <div class="form-group col-md-6" id="video_ma_url" style="display:<?=$class1?>">
                        <label for="video_url" class="">Video Url<span class="error">*</span></label>
                        <input name="video_url"  value="{{isset($data->mechanics->media)?$data->mechanics->media:''}}" id="video_url_ma" placeholder="Please Enter Video Url" type="text" class="form-control">
                     </div>
                  </div>                 

                   <div class="form-group" id="video_ma_upload" style="display:<?=$class2?>">
                     <label for="video" class="">Video<span class="error">*</span></label></br>
                     <video width="500" height="240" controls style="margin-top: 15px">
                        @if(isset($data->mechanics->media)&&$data->mechanics->video_type==1)
                           <?php $path= url('/')."/storage/app/public/cars/video"."/".$data->mechanics->media; ?>
                           <source src="{{$path}}" id="video_here_ma" type="video/mp4">
                        @else
                           <source src="#" id="video_here_ma" type="video/mp4">
                        @endif
                     </video></br>
                     <input type="file" style="margin-top: 10px;" name="video" onchange="uploadalt('ma')" id="video_ma" accept="video/*">
                  </div>
                  <div class="input-field">
                     <label class="active">Photos</label></br>
                     
                     <div class="input-images-3" style="padding-top: .5rem;"></div>
                  </div>
                  <button class="mt-1 btn btn-primary">Submit</button>
               </form>
            </div>
            <div class="tab-pane <?=$tab==4?'active':''?>" id="tab-eg4-4" role="tabpanel">
               <form class="" action="{{route('update-car-history')}}" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="car_id" value="{{$id}}">
                  <input type="hidden" name="user_id" value="{{$user_id}}">
                  {{csrf_field()}}
                  <div class="form-group">
                     <label for="vehicle_history" class="">Enter History About Vehicle<span class="error">*</span></label>
                     <textarea class="form-control" required="" name="vehicle_history" id="vehicle_history" placeholder="Please Enter History About Vehicle">{{isset($data->history->description)?$data->history->description:''}}</textarea>
                  </div>
                  
                  <div class="position-relative form-group">
                     <label for="image" class="">Banner<span class="error">*</span></label>
                     <div id="uploaded_image5">
                        <div class="upload-btn-wrapper" style="    width: 100%;">
                           <button class="btn imgcatlog" type="button">
                           <?php 
                              if(isset($data->history->banner)){
                                  $path= url('/')."/storage/app/public/cars/history"."/".$data->history->banner;
                              }
                              else{
                                  $path=asset('public/images/car_placeholder.png');
                              }
                              ?>
                           <img src="{{$path}}" alt="..." class="img-thumbnail1" id="basic_img5" >
                           </button>
                           <input type="hidden" id="basic_img5"/>
                           @if(isset($data->history->banner))
                           <input type="file" name="banner" class="form-control" id="upload_image5" style="height: 200px;width: 350px;" />
                           @else
                           <input type="file" required="" class="form-control" name="banner" id="upload_image5" style="height: 200px;width: 350px;" />
                           @endif
                        </div>
                     </div>
                  </div>
                  
                  <div class="col-md-12" style="margin-left: -15px">
                     <label for="vehicle_history" class="">Enter History Data<span class="error">*</span></label>
                     <div class="table-responsive">
                        <table id="test-table" class="table table-condensed" style="width:100%">
                           <thead>
                              <tr>
                                 <th>Date</th>
                                 <th>Type</th>
                                 <th>Mileage</th>
                                 <th></th>
                              </tr>
                           </thead>
                           <tbody id="test-body">
                              <?php $i=0;?>
                              @if(isset($data->historydata)&&count($data->historydata)>0)
                              @foreach($data->historydata as $dh)
                              <tr id="row0">
                                 <td>
                                    <input name='date[]' required="" value='{{$dh->date}}' type='date' class='form-control' />
                                 </td>
                                 <td>
                                    <input name='type[]' required="" value='{{$dh->type}}' type='text' class='form-control' />
                                 </td>
                                 <td>
                                    <input name='mileage[]' required="" value='{{$dh->mileage}}' type='text' class='form-control input-md' />
                                 </td>
                                 <td>
                                    <input class='delete-row btn btn-primary' type='button' value='Delete' />
                                 </td>
                              </tr>
                              @endforeach
                              @else
                              <tr id="row0">
                                 <td>
                                    <input name='date[]' required="" value='' type='date' class='form-control' />
                                 </td>
                                 <td>
                                    <input name='type[]' required="" value='' type='text' class='form-control' />
                                 </td>
                                 <td>
                                    <input name='mileage[]' required="" value='' type='text' class='form-control input-md' />
                                 </td>
                                 <td>
                                    <input class='delete-row btn btn-primary' type='button' value='Delete' />
                                 </td>
                              </tr>
                              @endif
                           </tbody>
                        </table>
                        <input type="hidden" name="total_row" id="total_row" value="{{$i}}">
                        <input id='add-row' class='btn btn-primary' type='button' value='Add' />
                     </div>
                  </div>
                  <div class="input-field">
                     <label class="active">Photos</label></br>
                    
                     <div class="input-images-4" style="padding-top: .5rem;"></div>
                  </div>
                  <button class="mt-1 btn btn-primary">Submit</button>
               </form>
            </div>
           
         </div>
      </div>
   </div>
</div>
@stop
@section('footer')
<input type="hidden" id="siteurl" value="{{url('/')}}">
<script type="text/javascript" src="{{asset('public/imageupload/image-uploader.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/car.js?v=3.222')}}"></script>
<script type="text/javascript">
   function getcitylistbycountry(id){
    $.ajax({
       url: "{{url('admin/get_city_list_by_country_id')}}"+"/"+id,
       method:"get",
       success: function( data ) {
          var str = JSON.parse(data);
          var txt = "<option value=''>Select City</option>";
          for(var i=0;i<str.length;i++){
               txt = txt+'<option value="'+str[i].id+'">'+str[i].name+'</option>';
          }
          $("#city_id").html(txt);
       }
    });
}

   $.ajax({
         url: "{{url('admin/get_media/1')}}"+'/'+$("#car_id").val(),
         data: { },
         success: function( data ) {
               var str = JSON.parse(data);
               $('.input-images-1').imageUploader({
                   preloaded: str,
                   imagesInputName: 'photos',
                   preloadedInputName: 'old',
                   maxSize: 2 * 1024 * 1024,
                   maxFiles: 100
               });
         }
   });
    $.ajax({
         url: "{{url('admin/get_media/2')}}"+'/'+$("#car_id").val(),
         data: { },
         success: function( data ) {
               var str = JSON.parse(data);
               $('.input-images-2').imageUploader({
                   preloaded: str,
                   imagesInputName: 'photos',
                   preloadedInputName: 'old',
                   maxSize: 2 * 1024 * 1024,
                   maxFiles: 100
               });
         }
   });
     $.ajax({
         url: "{{url('admin/get_media/3')}}"+'/'+$("#car_id").val(),
         data: { },
         success: function( data ) {
               var str = JSON.parse(data);
               $('.input-images-3').imageUploader({
                   preloaded: str,
                   imagesInputName: 'photos',
                   preloadedInputName: 'old',
                   maxSize: 2 * 1024 * 1024,
                   maxFiles: 100
               });
         }
   });
      $.ajax({
         url: "{{url('admin/get_media/4')}}"+'/'+$("#car_id").val(),
         data: { },
         success: function( data ) {
               var str = JSON.parse(data);
               $('.input-images-4').imageUploader({
                   preloaded: str,
                   imagesInputName: 'photos',
                   preloadedInputName: 'old',
                   maxSize: 2 * 1024 * 1024,
                   maxFiles: 100
               });
         }
   });
   
function updateTextView(_obj){
  var num = getNumber(_obj.val());
  if(num==0){
    _obj.val('');
  }else{
    _obj.val(num.toLocaleString());
  }
}
function getNumber(_str){
  var arr = _str.split('');
  var out = new Array();
  for(var cnt=0;cnt<arr.length;cnt++){
    if(isNaN(arr[cnt])==false){
      out.push(arr[cnt]);
    }
  }
  return Number(out.join(''));
}
$(document).ready(function(){
  $('#winning_bid').on('keyup',function(){
    updateTextView($(this));
  });
});


 $(document).ready(function() {
             $("#general_info_form").validate({
                 rules: {
                     name: { required: true },
                     reg_no: { required: true },
                     short_desc: { required: true },
                     make_id: { required: true },
                     model: { required: true },
                     variant: { required: true },
                     year: { required: true },
                     steering_position: { required: true },
                     engine_size: { required: true },
                     color: { required: true },
                     chassis_no: { required: true },
                     country_id: { required: true },
                     city_id: { required: true },
                     seller_type: { required: true },
                      former_keepers: { required: true },
                     currency: { required: true },
                     aucation_enddate: { required: true },
                     status: { required: true },
                     /*banner: {
                      required: true,
                      extension: "jpeg|jpg|png|gif",
                      filesize: 4000000
                    },*/
                 }
             });
         });

</script>
@stop