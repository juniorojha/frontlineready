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
         
               <form class="" action="{{route('post-car-general-info')}}" method="post" enctype="multipart/form-data" id="general_info_form">
                  <input type="hidden" name="car_id" value="{{$id}}">
                  {{csrf_field()}}
                  <div class="row">
                         <div class="form-group col-md-6">
                           <label for="stock" class="">Stock<span class="error">*</span></label>
                           <input name="stock" id="stock" placeholder="Please enter stock" type="text" class="form-control" value="{{isset($data->stock)?$data->stock:''}}" required="">
                        </div>
                        <div class="form-group col-md-6">
                           <label for="vin" class="">VIN<span class="error">*</span></label>
                           <input name="vin" id="vin" placeholder="Please Enter vin" type="text" class="form-control" value="{{isset($data->vin)?$data->vin:''}}" required="">
                        </div>
                  </div>
                 
                  <div class="row">
                     <div class="form-group col-md-6">
                        <label for="make_id" class="">Make<span class="error">*</span></label>
                        <select name="make_id" id="make_id" class="form-control" required="">
                           <option value="">Select Make</option>
                           @foreach($make_data as $m)
                           <option value="{{$m->id}}" <?=isset($data->make)&&$data->make==$m->id?'selected="selected"':''?>>{{$m->name}}</option>
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
                        <?php $years = range(date('Y'), 1900);?>
                        <label for="year" class="">Year<span class="error">*</span></label>
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
                     <div class="form-group col-md-6">
                        <label for="mileage" class="">Mileage<span class="error">*</span></label>
                        <input name="mileage" id="mileage" placeholder="Please Enter Your Vehicle Mileage" required="" value="{{isset($data->mileage)?$data->mileage:''}}" type="text" class="form-control">
                     </div>
                  </div>
                 
                  <div class="row">                    
                     <div class="form-group col-md-6">
                        <label for="engine_size" class="">Engine Size<span class="error">*</span></label>
                        <input name="engine_size" value="{{isset($data->engine_size)?$data->engine_size:''}}" required="" id="engine_size" placeholder="Please Enter Your Vehicle Engine Size" type="text" class="form-control">
                     </div>
                     <div class="form-group col-md-6">
                        <label for="transmission" class="">Transmission<span class="error">*</span></label>
                        <select id="transmission" name="transmission" class="form-control">
                            <option value="Automatic">Automatic</option>
                            <option value="Manual">Manual</option>
                            <option value="Continuously Variable">Continuously Variable</option>
                        </select>
                     </div>
                  </div>
                 
                  <div class="row">                    
                     <div class="form-group col-md-6">
                        <label for="exterior_color" class="">Exterior Color<span class="error">*</span></label>
                        <input name="exterior_color" value="{{isset($data->exterior_color)?$data->exterior_color:''}}" required="" id="exterior_color" placeholder="Please Enter Your Vehicle Exterior Color" type="text" class="form-control">
                     </div>
                     <div class="form-group col-md-6">
                        <label for="interior_color" class="">Interior Color<span class="error">*</span></label>
                        <input name="interior_color" value="{{isset($data->interior_color)?$data->interior_color:''}}" required="" id="interior_color" placeholder="Please Enter Your Vehicle Interior Color" type="text" class="form-control">
                     </div>
                  </div>
                  <div class="row">                    
                     <div class="form-group col-md-6">
                        <label for="interior_materia" class="">Interior Material<span class="error">*</span></label>
                        <input name="interior_materia" value="{{isset($data->interior_materia)?$data->interior_materia:''}}" required="" id="interior_materia" placeholder="Please Enter Your Vehicle Interior Material" type="text" class="form-control">
                     </div>
                     <div class="form-group col-md-6">
                        <label for="flr_report" class="">FLR Vehicle Condition Report</label>
                        <input name="flr_report" value="{{isset($data->flr_report)?$data->flr_report:''}}"  id="flr_report" placeholder="" type="file" class="form-control">
                     </div>
                  </div>
                  <div class="row">                    
                     <div class="form-group col-md-6">
                        <label for="buy_now_price" class="">Buy Now Price<span class="error">*</span></label>
                        <input name="buy_now_price" value="{{isset($data->buy_now_price)?$data->buy_now_price:''}}" required="" id="buy_now_price" placeholder="Please Enter Your Vehicle Buy Now Price" type="text" class="form-control">
                     </div>
                     <div class="form-group col-md-6">
                        <label for="base_price" class="">Base price<span class="error">*</span></label>
                        <input name="base_price" value="{{isset($data->base_price)?$data->base_price:''}}" required="" id="base_price" placeholder="Please Enter Your Vehicle Base Price" type="text" class="form-control">
                     </div>
                  </div>
                 
                  <div class="row">                    
                     <div class="form-group col-md-6 " id="auction_end_datetime_div">
                        <?php 
                                 $start_date = date('m/d/Y  h:m A');
                                 $end_date = date('m/d/Y  h:m A');
                                 if(isset($data->start_date)){
                                    $start_date = date("m/d/Y  h:m A",strtotime($data->start_date));      
                                 }
                                 //$end_date = "";
                                 if(isset($data->end_date)){
                                    $end_date = date("m/d/Y   h:m A",strtotime($data->end_date));      
                                 }
                               

                        ?>
                        <label for="auction_enddate" class="">Auction Start & End Date<span class="error">*</span></label>
                        <input type="text" name="auction_date" id="demo" class="form-control" value="{{$start_date}} - {{$end_date}}">
                        <input type="hidden" id="car_start_date" value="{{$start_date}}"> 
                        <input type="hidden" id="car_end_date" value="{{$end_date}}">                        
                     </div>                     
                  </div>
                 
                  <div class="position-relative form-group">
                     <label for="image" class="">Thumbnail<span class="error">*</span></label>
                     <div id="uploaded_image">
                        <div class="upload-btn-wrapper" style="    width: 100%;">
                           <button class="btn imgcatlog" type="button">
                           <?php 
                              if(isset($data->thumbail)){
                                 $path= url('/')."/storage/app/public/cars/banner"."/".$data->thumbail;
                              }
                              else{
                                 $path=asset('public/images/car_placeholder.png');
                              }
                           ?>
                           <img src="{{$path}}" alt="..." class="img-thumbnail1" id="basic_img" >
                           </button>
                           <input type="hidden" id="basic_img1"/>
                           @if(isset($data->thumbail))
                           <input type="file" name="banner" style="height: 200px;width: 350px;" class="form-control" id="upload_image" />
                           @else
                           <input type="file"  required="" class="form-control"  style="height: 200px;width: 350px;" name="banner" id="upload_image" />
                           @endif
                        </div>
                     </div>
                  </div>
                  <div class="input-field">
                     <label class="active">Banner<button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Click anywhere inside the box to upload images" style="margin-left: 15px;border: 1px solid;padding: 0px 8px;border-radius: 30px;"><i class="fa fa-info"></i></button></label></br>                    
                     
                     <div class="input-images-1" style="padding-top: .5rem;padding-bottom: .5rem;"></div>
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
<script type="text/javascript" src="{{asset('public/js/car.js?v=1')}}"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

<script type="text/javascript">
 

   $.ajax({
         url: "{{url('admin/get_media/')}}"+'/'+$("#car_id").val(),
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
    



 $(document).ready(function() {
             $("#general_info_form").validate({
                 rules: {
                     stock: { required: true },
                     vin: { required: true },
                     make_id: { required: true },
                     model: { required: true },
                     year: { required: true },
                     transmission: { required: true },
                     engine_size: { required: true },
                     exterior_color: { required: true },
                     interior_color: { required: true },
                     interior_materia: { required: true },
                     buy_now_price: { required: true },
                     base_price: { required: true }
                 }
             });
});


//$('#demo').daterangepicker({ startDate: $("#car_start_date").val(), endDate: $("#car_end_date").val() });
</script>
<script type="text/javascript">
$(function() {
    $('#demo').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        locale: {
            format: 'MM/DD/YYYY h:mm A'
        }
    });
});
</script>
@stop