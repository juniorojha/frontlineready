<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportCar;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\CarInfo;
use App\Models\Make;
use App\Models\Comment;
use App\Models\Car;
use App\Models\CarImages;
use Hash;
use Session;
use DataTables;
use Log;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Exceptions\Handler;
class CarController extends Controller
{
    public function show_all_cars(){
        Session::put("main_menu","cars");
        Session::put("sub_menu","01");
        return view("admin.cars.allcar");
    }

    public function show_all_cars_data_table(){
         $car =Car::whereNull('deleted_at')->get();
         return DataTables::of($car)          
            ->editColumn('vin', function ($car) {
                return $car->vin;
            }) 
            ->editColumn('image', function ($car) {
                return url('/')."/storage/app/public/cars/banner"."/".$car->thumbail;
            }) 
            ->editColumn('more', function ($car) {
                return url('vehicle_detail?query=').$this->encryptstring($car->id);
            }) 
            ->editColumn('auction_status', function ($car) {
                return $car->status;
            })
            ->editColumn('flr_report', function ($car) {
                return url('/')."/storage/app/public/cars/report"."/".$car->flr_report;
            })    
            
            ->editColumn('action', function ($car) {
               $edit = route('save-car', ['id'=>$car->id]);
               $delete = route('delete-car', ['id'=>$car->id]);
               return '<a  href="'.$edit.'" rel="tooltip"  class="btn btn-primary" data-original-title="banner" style="margin-right: 10px;color: white !important;">Edit</a><a onclick="delete_record(' . "'" . $delete. "'" . ')" rel="tooltip"  class="btn btn-danger" data-original-title="Remove" style="margin-right: 10px;color:white !important">Delete</a>';              
            })  
            ->addIndexColumn()         
            ->make(true);
    }

  

    public function show_save_car($id){
        Session::put("main_menu","cars");
        Session::put("sub_menu","");
        try{
                $make_data = Make::whereNull('deleted_at')->get();
                $data = Car::find($id);
                if(isset($data)){ 
                    $timestamp = $data->start_date;
                    $date = Carbon::createFromFormat('Y-m-d H:i', $timestamp, 'UTC');
                    $new_date = $date->setTimezone($this->get_time_zone_name()); 
                    $data->start_date =  Carbon::parse($new_date)->format('Y-m-d H:i');
                    $timestamp = $data->end_date;
                    $date = Carbon::createFromFormat('Y-m-d H:i', $timestamp, 'UTC');
                    $new_date = $date->setTimezone($this->get_time_zone_name()); 
                    $data->end_date =  Carbon::parse($new_date)->format('Y-m-d H:i');
                    
                }
                return view("admin.cars.save_car",compact("id","make_data","data"));
        }catch(Exception $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something went wrong"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
        }catch (DecryptException $e) {
                \Log::info($e->getMessage());
                Session::flash('message',"Something went wrong"); 
                Session::flash('alert-class', 'alert-danger');
                 return redirect()->back();
        }catch (\Illuminate\Database\QueryException $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something went wrong"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
        }
    }
    
    public function settle_car(Request $request){
        Session::put("main_menu","cars");
        Session::put("sub_menu","04");
          try{
                $data = Car::find($request->get("id"));
                if($data){
                    $data->payment_status = '2';
                    $data->save();
                    Session::flash('message',"Payment for this car has been settled successfully"); 
                    Session::flash('alert-class', 'alert-success');
                    return redirect()->back();
                }else{
                    Session::flash('message',"Something went wrong"); 
                    Session::flash('alert-class', 'alert-danger');
                    return redirect()->back();
                }
            }catch(Exception $e){
                    \Log::info($e->getMessage());
                    Session::flash('message',"Something went wrong"); 
                    Session::flash('alert-class', 'alert-danger');
                    return redirect()->back();
            }catch (DecryptException $e) {
                    \Log::info($e->getMessage());
                    Session::flash('message',"Something went wrong"); 
                    Session::flash('alert-class', 'alert-danger');
                    return redirect()->back();
            }catch (\Illuminate\Database\QueryException $e){
                    \Log::info($e->getMessage());
                    Session::flash('message',"Something went wrong"); 
                    Session::flash('alert-class', 'alert-danger');
                    return redirect()->back();
            }    
    }

    public function show_delete_car($id){
             try{
                $data = Car::find($id);
                if($data){
                    $data->delete();
                    Session::flash('message',"Cars deleted successfully"); 
                    Session::flash('alert-class', 'alert-success');
                    return redirect()->back();
                }else{
                    Session::flash('message',"Something went wrong"); 
                    Session::flash('alert-class', 'alert-danger');
                    return redirect()->back();
                }
            }catch(Exception $e){
                    \Log::info($e->getMessage());
                    Session::flash('message',"Something went wrong"); 
                    Session::flash('alert-class', 'alert-danger');
                    return redirect()->back();
            }catch (DecryptException $e) {
                    \Log::info($e->getMessage());
                    Session::flash('message',"Something went wrong"); 
                    Session::flash('alert-class', 'alert-danger');
                    return redirect()->back();
            }catch (\Illuminate\Database\QueryException $e){
                    \Log::info($e->getMessage());
                    Session::flash('message',"Something went wrong"); 
                    Session::flash('alert-class', 'alert-danger');
                    return redirect()->back();
            }    
    
    }

   
    public function get_media($id){
        $data = CarImages::where("car_id",$id)->get();
       
        foreach($data as $d){

            $a['id'] = $d->id;
            $a['src'] = asset('storage/app/public/cars/banner/').'/'.$d->image;
            $ls[] = $a;
        }
        return json_encode($data);
    }

   

    public function post_car_general_info(Request $request){
        try{
                if($request->get('car_id')==0){
                    $store = new Car(); 
                    $request->validate([
                            'stock' => 'required',
                            'vin'=>'required|unique:cars',
                            'make_id'=>'required',
                            'model'=>'required',
                            'year' => 'required',
                            'mileage' => 'required',
                            'engine_size' => 'required',                           
                            'transmission' => 'required',
                            'exterior_color' => 'required',
                            'interior_color' => 'required',
                            'interior_materia' => 'required',
                            'buy_now_price' => 'required',
                            'base_price' => 'required',
                            'banner' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
                    ]);               
                    $msg = "Car added successfully";
                }else{
                    $store = Car::find($request->get('car_id'));
                    $request->validate([
                            'stock' => 'required',
                            'make_id'=>'required',
                            'model'=>'required',
                            'year' => 'required',
                            'mileage' => 'required',
                            'engine_size' => 'required',                           
                            'transmission' => 'required',
                            'exterior_color' => 'required',
                            'interior_color' => 'required',
                            'interior_materia' => 'required',
                            'buy_now_price' => 'required',
                            'base_price' => 'required'
                        ]);
                    $msg = "Car details updated successfully";
                    if(empty($store)){
                        Session::flash('message',"Something went wrong"); 
                        Session::flash('alert-class', 'alert-danger');
                        return redirect()->back();
                    }
                    
                }
                
               
                
                $store->stock = $request->get("stock");
                $store->vin = $request->get("vin");
                $store->transmission = $request->get("transmission");
                $store->make = $request->get("make_id");
                $store->model = $request->get("model");
                $store->year = $request->get("year");
                $store->mileage = $request->get("mileage");
                $store->exterior_color = $request->get("exterior_color");               
                $store->engine_size = $request->get("engine_size");
                $store->interior_materia = $request->get("interior_materia");
                $store->interior_color = $request->get("interior_color");
                $store->buy_now_price = $request->get("buy_now_price");
                $store->base_price = $request->get("base_price");
                $store->status = '2';
                $dates = explode(" - ",$request->get("auction_date"));
                if(isset($dates[0])){
                    $date = Carbon::createFromFormat('Y-m-d H:i',date("Y-m-d H:i",strtotime($dates[0])), $this->get_time_zone_name());
                    $date->setTimezone('UTC');
                    $store->start_date = Carbon::parse($date)->format('Y-m-d H:i');
                }
                if(isset($dates[1])){
                    $date = Carbon::createFromFormat('Y-m-d H:i',date("Y-m-d H:i",strtotime($dates[1])), $this->get_time_zone_name());
                    $date->setTimezone('UTC');
                    $store->end_date = Carbon::parse($date)->format('Y-m-d H:i');
                }         
                if($request->file("banner")){
                            $old_image = $store->thumbail;
                            $f = $request->file("banner");
                            $filename = $f->getClientOriginalName();
                            $extension = $f->getClientOriginalExtension() ?: 'png';               
                            $picture = rand().time() . '.' . $extension;
                            $destinationPath = Storage_path("app/public/cars/banner");
                            $f->move($destinationPath, $picture); 
                            $store->thumbail = $picture;
                            if($old_image!=""){
                                $this->removeImage(storage_path("app/public/cars/banner").'/'.$old_image);  
                            }
                }  
                if($request->file("flr_report")){
                            $old_image = $store->flr_report;
                            $f = $request->file("flr_report");
                            $filename = $f->getClientOriginalName();
                            $extension = $f->getClientOriginalExtension() ?: 'png';               
                            $picture = rand().time() . '.' . $extension;
                            $destinationPath = Storage_path("app/public/cars/report");
                            $f->move($destinationPath, $picture); 
                            $store->flr_report = $picture;
                            if($old_image!=""){
                                $this->removeImage(storage_path("app/public/cars/report").'/'.$old_image);  
                            }
                }  
                $store->save();
                if($request->file("photos")){
                            foreach($request->file("photos") as $f){
                                $filename = $f->getClientOriginalName();
                                $extension = $f->getClientOriginalExtension() ?: 'png';               
                                $picture = rand().time() . '.' . $extension;
                                $destinationPath = Storage_path("app/public/cars/banner");
                                $f->move($destinationPath, $picture);                
                                $add = new CarImages();
                                $add->car_id = $store->id;
                                $add->image = $picture;
                                $add->save();
                        }
                    }  
                Session::flash('message',$msg); 
                Session::flash('alert-class', 'alert-success');
                return redirect()->route('all-cars');
        }catch(Exception $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something went wrong"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
        }catch (DecryptException $e) {
                \Log::info($e->getMessage());
                Session::flash('message',"Something went wrong"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
        }catch (\Illuminate\Database\QueryException $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something went wrong"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
        }
    }

  
    
    public function show_live_car_data_table(){
        Session::put("main_menu","cars");
        Session::put("sub_menu","02");
        $car =Car::whereNull('deleted_at')->where("status",'1')->get();
         return DataTables::of($car)
            ->editColumn('vin', function ($car) {
                return $car->vin;
            }) 
            
            
            ->editColumn('current_bid', function ($car) {
                if(isset($car->current_bid_id)){
                    $data = Comment::find($car->current_bid_id);
                    if($data){
                        return User::find($data->user_id)?User::find($data->user_id)->username:'';
                    }
                    
                }
            }) 
             ->editColumn('image', function ($car) {
                return url('/')."/storage/app/public/cars/banner"."/".$car->thumbail;
            }) 
            ->editColumn('bid_by', function ($car) {
                return '';
            })   
             ->editColumn('total_bid', function ($car) {
                return count(Comment::where('car_id',$car->id)->where('type','1')->get());
            })
            ->editColumn('end_time', function ($car) {
                    $timestamp = $car->end_date;
                    $date = Carbon::createFromFormat('Y-m-d H:i', $timestamp, 'UTC');
                    $new_date = $date->setTimezone($this->get_time_zone_name()); 
                    return Carbon::parse($new_date)->format('Y-m-d H:i');
            })
            ->editColumn('more', function ($car) {
                return url('vehicle_detail?query=').$this->encryptstring($car->id);
            })
            ->editColumn('action', function ($car) {
                $edit = route('save-car', ['user_id'=>$car->user_id,'id'=>$car->id,'tab'=>0]);
                $delete = route('delete-car', ['id'=>$car->id]);              
                return '<a  href="'.$edit.'" rel="tooltip"  class="btn btn-primary" data-original-title="banner" style="margin-right: 10px;color: white !important;">Edit</a><a onclick="delete_record(' . "'" . $delete. "'" . ')" rel="tooltip"  class="btn btn-danger" data-original-title="Remove" style="margin-right: 10px;color:white !important">Delete</a>';              
            })
            ->addIndexColumn()         
            ->make(true);
    }

    public function show_live_car(){
        Session::put("main_menu","cars");
        Session::put("sub_menu","02");
        return view("admin.cars.live");
    }

    public function show_coming_soon(){
        Session::put("main_menu","cars");
        Session::put("sub_menu","03");
         return view("admin.cars.coming_soon");
    }

    public function coming_soon_cars_data_table(){
         $car =Car::whereNull('deleted_at')->where("status",'2')->get();
         return DataTables::of($car)           
            ->editColumn('vin', function ($car) {
                return $car->vin;
            }) 
            ->editColumn('image', function ($car) {
                return url('/')."/storage/app/public/cars/banner"."/".$car->thumbail;
            }) 
           
            ->editColumn('more', function ($car) {
                return url('vehicle_detail?query=').$this->encryptstring($car->id);
            })
            ->editColumn('action', function ($car) {
               $edit = route('save-car', ['user_id'=>$car->user_id,'id'=>$car->id,'tab'=>0]);
               $delete = route('delete-car', ['id'=>$car->id]);
               
               
              
                return '<a  href="'.$edit.'" rel="tooltip"  class="btn btn-primary" data-original-title="banner" style="margin-right: 10px;color: white !important;">Edit</a><a onclick="delete_record(' . "'" . $delete. "'" . ')" rel="tooltip"  class="btn btn-danger" data-original-title="Remove" style="margin-right: 10px;color:white !important">Delete</a>';              
            })
            ->addIndexColumn()         
            ->make(true);
    }

   
    public function show_sold_cars(){
        Session::put("main_menu","cars");
        Session::put("sub_menu","04");
        return view("admin.cars.sold");
    }

    public function sold_cars_data_table(){
        $car =Car::whereNull('deleted_at')->where("status",4)->orderby('id','DESC')->get();
         return DataTables::of($car)            
            ->editColumn('image', function ($car) {
                return asset("storage/app/public/cars/banner").'/'.$car->thumbail;
            }) 
            ->editColumn('vin', function ($car) {
                return $car->vin;
            }) 
             
            ->editColumn('more', function ($car) {
                return url('vehicle_detail?query=').$this->encryptstring($car->id);
            })
              ->editColumn('buyer_name', function ($car) {
                if($car->current_bid_id!=""){
                    $user_id = Comment::find($car->current_bid_id)?Comment::find($car->current_bid_id)->user_id:0;
                    return User::find($user_id)?User::find($user_id)->dealership_name:'';
                }else{
                    return "Generate By System";
                }
                return ;
            })
            ->editColumn('sold_date', function ($car) {
                return $car->sold_date;
            })
            ->editColumn('payment_status', function ($car) {
              
                    return $car->payment_status;
                
            })
            ->editColumn('winning_bid', function ($car) {
                $str = explode("-",$car->currency);
                $currency_symbol = isset($str[1])?$str[1]:'';
                return $currency_symbol.$car->winning_bid;
            })
            ->editColumn('total_bid', function ($car) {
                return $car->total_bid;
            })
            ->editColumn('action', function ($car) { 
                $delete = route('settle-car', ['id'=>$car->id]);
                if($car->payment_status==1){
                     return '<a onclick="delete_record(' . "'" . $delete. "'" . ')" rel="tooltip"  class="btn btn-danger" data-original-title="Remove" style="margin-right: 10px;color:white !important">Settle Payment</a>';
                }
                             
            }) 
            ->addIndexColumn()              
            ->make(true);
    }

    public function update_car_sync_data(){
        $users = [];
        if (($open = fopen(asset('upload/fready.CSV'), "r")) !== FALSE) {
            while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
                $users[] = $data;
            }
            fclose($open);
        }
        $start_date_time = $this->getsitedate();
        $total_record = 0;
        $new_record = 0;
        $update_record = array();
        $duplicate_record = array();

        foreach($users as $u){
            if(!empty($u[10])){
                    $store = Car::where("stock",$u[0])->first();
                    if(empty($store)){
                        $store = new Car();
                        $new_record++;
                    }else{
                        $update_record[]=$u[0];
                    }
                    $store->stock = $u[0];
                    $store->vin = $u[10];
                    $get_make = Make::where('name', 'LIKE', '%'.$u[2].'%')->first();
                    if($get_make){
                        $store->make = $get_make->id;
                    }else{
                        $get_make = new Make();
                        $get_make->name = $u[2];
                        $get_make->save();
                        $store->make = $get_make->id;
                    }
                    $store->model = $u[3]." ".$u[4];
                    $store->year = '2020';
                    if($u[1]!=""){
                        $store->year = $u[1];
                    }
                    if(empty($u[1])){
                        $duplicate_record[] = "Empty Year for Stock number ".$u[10].", skipping";
                    }
                    $store->mileage = $u[11];
                    if($u[5]>4){
                        $store->engine_size = $u[7]."V".$u[5];
                    }else{
                        $store->engine_size = $u[7];
                    }
                    $store->transmission = $u[6];
                    $store->exterior_color = $u[12];
                    $store->interior_color = !empty($u[13])?$u[13]:'Unknown';
                    $store->interior_materia = !empty($u[37])?$u[37]:'Unavailable';
                    $store->buy_now_price = $u[22];
                    if(empty($u[22])){
                        $store->buy_now_price = 5000+$u[20];                        
                    }
                    $store->base_price = isset($u[20])?$u[20]:'20000';
                    if(empty($u[20])){
                        $duplicate_record[] = "Empty Base price for Stock number ".$u[20].", skipping";
                    }
                    if(!empty($u[18])){
                        $str = explode(",", $u[18]);
                        if(isset($str[0])){
                            $fname = str_replace("ftp.gauravojha.com/","",$str[0]);
                            copy(asset('upload/'.$fname),storage_path('app/public/cars/banner').'/'.$fname);
                            $store->thumbail = $fname; 
                        }else{
                            $file_name = rand()."222.png";
                            copy(asset('public/default.png'),storage_path('app/public/cars/banner').'/'.$file_name);
                            $store->thumbail = $file_name; 
                        }                
                    }else{
                        $file_name = rand()."222.png";
                        copy(asset('public/default.png'),storage_path('app/public/cars/banner').'/'.$file_name);
                        $store->thumbail = $file_name; 
                    }
                    if(!empty($u[38])){
                        $start_date = date("Y-m-d",strtotime($u[38]));
                        $store->start_date = $start_date." 00:00:00";                
                        $store->end_date = date("Y-m-d", strtotime("$start_date +10 days"))." 23:59:59";
                    }else{
                        $start_date = date("Y-m-d",strtotime("-1 days"));
                        $store->start_date = $start_date;                
                        $store->end_date = date("Y-m-d", strtotime("$start_date +9 days"));
                    }
                    $store->save();
                    if(!empty($u[18])){
                        $str = explode(",", $u[18]);
                        if(count($str)>=1){
                            $i=0;
                            foreach($str as $s){
                                if($i!=0){
                                    $fname = str_replace("ftp.gauravojha.com/","",$s);
                                    copy(asset('upload/'.$fname),storage_path('app/public/cars/banner').'/'.$fname);
                                    $add = new CarImages();
                                    $add->car_id = $store->id;
                                    $add->image = $fname;
                                    $add->save();
                                }
                                $i++;
                            }
                        }
                    }
            }else{
                $duplicate_record[] = "Empty VIN for Stock number ".$u[10].", skipping";
            }          
            $total_record++;
        }
        $fail = 0;
        return json_encode(array("start_datetime"=>$start_date_time,"total_record"=>$total_record,"duplicate_record"=>$duplicate_record,"new_record"=>$new_record,"update_record"=>$update_record,"fail"=>$fail));
    }
}