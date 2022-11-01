<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\CarInfo;
use App\Models\Make;
use App\Models\Country;
use App\Models\State;
use App\Models\Currency;
use App\Models\City;
use App\Models\CarExterior;
use App\Models\CarInterior;
use App\Models\CarMechanics;
use App\Models\CarMedia;
use App\Models\CarHistory;
use App\Models\CarsHistoryData;
use App\Models\Comment;
use App\Models\payment_history;
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
        return view("admin.cars.allcar");
    }

    public function show_all_cars_data_table(){
         $car =CarInfo::whereNull('deleted_at')->get();
         return DataTables::of($car)          
            ->editColumn('reg_no', function ($car) {
                return $car->reg_no;
            }) 
            ->editColumn('seller_name', function ($car) {
                return User::find($car->user_id)?User::find($car->user_id)->username:'';
            })
            
            ->editColumn('name', function ($car) {
                return $car->name;
            })
            
            ->editColumn('more', function ($car) {
                return url('vehicle_detail?query=').$this->encryptstring($car->id);
            }) 
            ->editColumn('aucation_status', function ($car) {
                return $car->status;
            })   
            ->editColumn('action', function ($car) {
               $edit = route('save-car', ['user_id'=>$car->user_id,'id'=>$car->id,'tab'=>0]);
               $delete = route('delete-car', ['id'=>$car->id]);
               $change_car_status = route('change-car-status', ['query'=>$this->encryptstring($car->id)]);
               $add = "";
               $status = "";
              
               if($car->is_approve==1){
                    $status = '<a  href="'.$change_car_status.'" rel="tooltip"  class="btn btn-success" data-original-title="banner" style="margin-right: 10px;color: white !important;">Enable</a>';
               }else{
                    $status = '<a  href="'.$change_car_status.'" rel="tooltip"  class="btn btn-secondary" data-original-title="banner" style="margin-right: 10px;color: white !important;">Disable</a>';
               }
               
              
                return '<a  href="'.$edit.'" rel="tooltip"  class="btn btn-primary" data-original-title="banner" style="margin-right: 10px;color: white !important;">Edit</a><a onclick="delete_record(' . "'" . $delete. "'" . ')" rel="tooltip"  class="btn btn-danger" data-original-title="Remove" style="margin-right: 10px;color:white !important">Delete</a>'.$add.$status;              
            })  
            ->addIndexColumn()         
            ->make(true);
    }

    public function change_car_status(Request $request){
        try{
                $car = CarInfo::find($this->decyptstring($request->get('query')));
                if($car->is_approve=='1'){
                    $car->is_approve = '0';
                    $msg = "Car Disable Successfully";
                }else{
                    $car->is_approve = '1';
                     $msg = "Car Enable Successfully";
                }
                $car->save();
                Session::flash('message',$msg); 
                Session::flash('alert-class', 'alert-success');
                return redirect()->back();

        }catch(Exception $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
        }catch (DecryptException $e) {
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
        }catch (\Illuminate\Database\QueryException $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
        }        
    }


    public function show_save_car($user_id,$id,$tab){
        try{
                $make_data = Make::whereNull('deleted_at')->get();
                $data = CarInfo::find($id);
                $country = Country::all();
                $currency = Currency::all();
                $city_data = array();
                if(isset($data)){
                    $city_data = $this->get_city_by_country_id($data->country_id);
                    $data->exterior = CarExterior::where("car_id",$id)->first();
                    $data->exteriormedia = CarMedia::where("car_id",$id)->where("type",'1')->get();
                    $data->interior = CarInterior::where("car_id",$id)->first();
                    $data->interiormedia = CarMedia::where("car_id",$id)->where("type",'2')->get();
                    $data->mechanics = CarMechanics::where("car_id",$id)->first();
                    $data->mechanicsmedia = CarMedia::where("car_id",$id)->where("type",'3')->get();
                    $data->history = CarHistory::where("car_id",$id)->first();
                    $data->historymedia = CarMedia::where("car_id",$id)->where("type",'4')->get();
                    $data->historydata =  CarsHistoryData::where("car_id",$id)->get();
                    $data->videodata = CarMedia::where("car_id",$id)->where("type",'5')->get();

                    $timestamp = $data->aucation_enddate.' '.$data->aucation_endtime;
                    $date = Carbon::createFromFormat('Y-m-d H:i:s', $timestamp, 'UTC');
                    $new_date = $date->setTimezone($this->get_time_zone_name());
                    
                    
                    $data->aucation_enddate =  Carbon::parse($new_date)->format('Y-m-d');
                    $data->aucation_endtime = Carbon::parse($new_date)->format('H:i');
                }
                return view("admin.cars.save_car",compact("id","tab","make_data","data","country","currency","city_data","user_id"));
        }catch(Exception $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
        }catch (DecryptException $e) {
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng"); 
                Session::flash('alert-class', 'alert-danger');
                 return redirect()->back();
        }catch (\Illuminate\Database\QueryException $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
        }
    }

    public function show_delete_car($id){
             try{
                $data = CarInfo::find($id);
                if($data){
                    $data->delete();
                    Session::flash('message',"Cars Delete Successfully"); 
                    Session::flash('alert-class', 'alert-success');
                    return redirect()->back();
                }else{
                    Session::flash('message',"Something Getting worng"); 
                    Session::flash('alert-class', 'alert-danger');
                    return redirect()->back();
                }
            }catch(Exception $e){
                    \Log::info($e->getMessage());
                    Session::flash('message',"Something Getting Worng"); 
                    Session::flash('alert-class', 'alert-danger');
                    return redirect()->back();
            }catch (DecryptException $e) {
                    \Log::info($e->getMessage());
                    Session::flash('message',"Something Getting Worng"); 
                    Session::flash('alert-class', 'alert-danger');
                    return redirect()->back();
            }catch (\Illuminate\Database\QueryException $e){
                    \Log::info($e->getMessage());
                    Session::flash('message',"Something Getting Worng"); 
                    Session::flash('alert-class', 'alert-danger');
                    return redirect()->back();
            }    
    
    }

    public function save_aucation_time(Request $request){
            try{
                    $data = CarInfo::find($request->get("car_id"));
                    if($data){
                        $str = explode("@",$request->get("datefilter"));
                        $data->aucation_start_datetime = date("Y-m-d H:i",strtotime($str[0]));
                        $data->aucation_end_datetime = date("Y-m-d H:i",strtotime($str[1]));
                        $data->status = '2';
                        $data->save();
                        Session::flash('message',"Car Aucation Time Set Successfully"); 
                        Session::flash('alert-class', 'alert-success');
                        return redirect()->back();
                    }else{
                        Session::flash('message',"Car Detail Not Found"); 
                        Session::flash('alert-class', 'alert-danger');
                        return redirect()->back();
                    }
            }catch(Exception $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
            }catch (DecryptException $e) {
                    \Log::info($e->getMessage());
                    Session::flash('message',"Something Getting Worng");
                    Session::flash('alert-class', 'alert-danger');
                     return redirect()->back();
            }catch (\Illuminate\Database\QueryException $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
            }           
    }

    public function get_media($type,$id){
        $data = CarMedia::where("car_id",$id)->where("type",$type)->get();
        $ls = array();
        $i=1;
        $folder_type = "";
        if($type==1){
            $folder_type = "exterior";
        }else if($type==2){
            $folder_type = "interior";
        }else if($type==3){
            $folder_type = "mechanics";
        }else if($type==4){
            $folder_type = "history";
        }else if($type==5){
            $folder_type = "video";
        }else{

        }
        foreach($data as $d){

            $a['id'] = $d->id;
            $a['src'] = asset('storage/app/public/cars/').'/'.$folder_type.'/'.$d->media;
            $ls[] = $a;
        }
        return json_encode($ls);
    }

    public function get_city_list_by_country_id($id){ 
        return json_encode($this->get_city_by_country_id($id));
    }

    public function get_city_by_country_id($id){
        $city = array();
        $get_state = State::where("country_id",$id)->get();
        foreach ($get_state as $gs) {
            $get_city = City::where("state_id",$gs->id)->get();           
            foreach($get_city as $gc){
                $gc->state_name = $gs->name;
                $gc->country_id = $gs->country_id;
                $city[]=$gc;
            }
        }
        $keys = array_column($city, 'name');
        array_multisort($keys, SORT_ASC, $city);
        return $city;
    }

    public function post_car_general_info(Request $request){
        try{
                if($request->get('car_id')==0){
                    $store = new CarInfo(); 
                    $request->validate([
                            'name' => 'required',
                            'reg_no'=>'required|unique:car_infos',
                            'make_id'=>'required',
                            'model'=>'required',
                            'variant' => 'required',
                            'year' => 'required',
                            'mileage' => 'required',
                            'gearbox' => 'required',
                            'steering_position' => 'required',
                            'engine_size' => 'required',
                            'color' => 'required',
                            'city_id' => 'required',
                            'seller_type' => 'required',
                            'former_keepers' => 'required',
                            'currency' => 'required',
                            'reserve_price' => 'required',
                            'description' => 'required',
                            'banner' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
                    ]);               
                    $msg = "General Information Add Successfully";
                    $store->user_id = $this->decyptstring($request->get("user_id"));
                }else{
                    $store = CarInfo::find($request->get('car_id'));
                    $request->validate([
                            'name' => 'required',
                            'make_id'=>'required',
                            'model'=>'required',
                            'variant' => 'required',
                            'year' => 'required',
                            'mileage' => 'required',
                            'gearbox' => 'required',
                            'steering_position' => 'required',
                            'engine_size' => 'required',
                            'color' => 'required',
                            'city_id' => 'required',
                            'seller_type' => 'required',
                            'former_keepers' => 'required',
                            'currency' => 'required',
                            'reserve_price' => 'required',
                            'description' => 'required',
                        ]);
                    $msg = "General Information Update Successfully";
                    
                }
                
                if(empty($store)){
                    Session::flash('message',"Something Getting Wrong"); 
                    Session::flash('alert-class', 'alert-danger');
                    return redirect()->back();
                }
                
                $store->name = $request->get("name");
                $store->reg_no = $request->get("reg_no");
                $store->short_desc = $request->get("short_desc");
                $store->make_id = $request->get("make_id");
                $store->model = $request->get("model");
                $store->variant = $request->get("variant");
                $store->year = $request->get("year");
                $store->mileage = $request->get("mileage");
                $store->gearbox = $request->get("gearbox");
                $store->steering_position = $request->get("steering_position");
                $store->engine_size = $request->get("engine_size");
                $store->color = $request->get("color");
                $store->chassis_no = $request->get("chassis_no");
                $store->country_id = $request->get("country_id");
                $store->city_id = $request->get("city_id");
                $store->seller_type = $request->get("seller_type");
                $store->former_keepers = $request->get("former_keepers");
                $store->currency = $request->get("currency");
                $store->reserve_price = $request->get("reserve_price");
                $store->status = $request->get("status");
                if($request->get("status")==1){
                    $timestamp = $request->get("aucation_enddate").' '.$request->get("aucation_endtime");  
                    
                    $date = Carbon::createFromFormat('Y-m-d H:i', $timestamp, $this->get_time_zone_name());
                    $date->setTimezone('UTC');
                    $store->aucation_enddate = Carbon::parse($date)->format('Y-m-d');
                    $store->aucation_endtime = Carbon::parse($date)->format('H:i');
                }
                if($request->get("status")==4){
                    $store->sold_date = $request->get("sold_date");
                    $store->total_bid = $request->get("total_bid");
                    $store->winning_bid = $request->get("winning_bid");
                    
                }
                $store->description = $request->get("description");            
                if($request->file("banner")){
                            $old_image = $store->banner;
                            $f = $request->file("banner");
                            $filename = $f->getClientOriginalName();
                            $extension = $f->getClientOriginalExtension() ?: 'png';               
                            $picture = rand().time() . '.' . $extension;
                            $destinationPath = Storage_path("app/public/cars/banner");
                            $f->move($destinationPath, $picture); 
                            $store->banner = $picture;
                            if($old_image!=""){
                                $this->removeImage(storage_path("app/public/cars/banner").'/'.$old_image);  
                            }
                }  
                $store->save();
                Session::flash('message',$msg); 
                Session::flash('alert-class', 'alert-success');
                return redirect()->route('save-car',['user_id'=>$store->user_id,'id'=>$store->id,'tab'=>1]);
        }catch(Exception $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
        }catch (DecryptException $e) {
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
        }catch (\Illuminate\Database\QueryException $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
        }
    }

    public function update_car_exterior(Request $request){
        //dd($request->all());
        try{
                    if($request->get("car_id")==0){
                        Session::flash('message',"Please First Fill Up Car General Information Then Proceed Ahead"); 
                        Session::flash('alert-class', 'alert-danger');
                        return redirect()->route('save-car',['user_id'=>$request->get("user_id"),'id'=>0,'tab'=>1]);
                    }
                    $get_exterior = CarExterior::where("car_id",$request->get("car_id"))->first();
                    if(empty($get_exterior)){
                         $request->validate([
                                'wheels_tyres' => 'required',
                                'bodywork'=>'required',
                                'paint'=>'required',
                                'glass_trim' => 'required',
                                'video_type' => 'required',
                                'banner' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
                        ]);
                        $get_exterior = new CarExterior();
                        $get_exterior->car_id = $request->get("car_id");
                        $msg = "Car Exterior Information Add Successfully";
                    }else{
                            $request->validate([
                                'wheels_tyres' => 'required',
                                'bodywork'=>'required',
                                'paint'=>'required',
                                'glass_trim' => 'required',
                                'video_type' => 'required'
                            ]);
                        $msg = "Car Exterior Information Update Successfully";
                    }
                    $get_exterior->car_id = $request->get("car_id");
                    $get_exterior->wheels_tyres = $request->get("wheels_tyres");
                    $get_exterior->bodywork = $request->get("bodywork");
                    $get_exterior->paint = $request->get("paint");
                    $get_exterior->glass_trim = $request->get("glass_trim"); 
                    if($request->file("banner")){
                            $old_image = $get_exterior->banner;
                            $f = $request->file("banner");
                            $filename = $f->getClientOriginalName();
                            $extension = $f->getClientOriginalExtension() ?: 'png';               
                            $picture = rand().time() . '.' . $extension;
                            $destinationPath = Storage_path("app/public/cars/exterior");
                            $f->move($destinationPath, $picture); 
                            $get_exterior->banner = $picture;
                            if($old_image!=""){
                                $this->removeImage(storage_path("app/public/cars/exterior").'/'.$old_image);  
                            }
                    }  
                    if($request->get("video_type")==1){//video
                        if($request->file("video")){
                            $old_video = $get_exterior->media;
                            $f = $request->file("video");
                            $filename = $f->getClientOriginalName();
                            $extension = $f->getClientOriginalExtension() ?: 'png';               
                            $picture = rand().time() . '.' . $extension;
                            $destinationPath = Storage_path("app/public/cars/video");
                            $f->move($destinationPath, $picture); 
                            $get_exterior->media = $picture;
                            if($old_video!=""){
                                $this->removeImage(storage_path("app/public/cars/exterior").'/'.$old_image);  
                            }
                        }  
                    }else{
                        $get_exterior->media = $request->get("video_url");
                    }
                    $get_exterior->video_type = $request->get("video_type");
                    $get_exterior->save();
                    if($request->get('old')){
                        $getarr = $request->get('old');
                        $data = CarMedia::whereNotIn('id',$getarr)->where("car_id",$get_exterior->id)->where("type",'1')->get();
                        foreach($data as $d){
                            if($d->media!=""){
                                $this->removeImage(storage_path("app/public/cars/exterior").'/'.$d->media);
                                $d->delete();
                            }                
                        }
                    }    
                    if($request->file("photos")){
                            foreach($request->file("photos") as $f){
                                $filename = $f->getClientOriginalName();
                                $extension = $f->getClientOriginalExtension() ?: 'png';               
                                $picture = rand().time() . '.' . $extension;
                                $destinationPath = Storage_path("app/public/cars/exterior");
                                $f->move($destinationPath, $picture);                
                                $add = new CarMedia();
                                $add->car_id = $request->get("car_id");
                                $add->type = 1;
                                $add->media = $picture;
                                $add->save();
                        }
                    }    
                    
                    Session::flash('message',$msg); 
                    Session::flash('alert-class', 'alert-success');
                    return redirect()->route('save-car',['user_id'=>$request->get("user_id"),'id'=>$get_exterior->id,'tab'=>2]);
        }catch(Exception $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
        }catch (DecryptException $e) {
               \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng");
                Session::flash('alert-class', 'alert-danger');
               return redirect()->back();
        }catch (\Illuminate\Database\QueryException $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Getting Issue in Data");
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
        } 
    }

    public function update_car_interior(Request $request){
        //dd($request->all());
        try{
                if($request->get("car_id")==0){
                    Session::flash('message',"Please First Fill Up Car General Information Then Proceed Ahead"); 
                    Session::flash('alert-class', 'alert-danger');
                    return redirect()->route('save-car',['user_id'=>$request->get("user_id"),'id'=>0,'tab'=>2]);
                }
                $store = CarInterior::where("car_id",$request->get("car_id"))->first();
                if(empty($store)){
                    $request->validate([
                            'seats' => 'required',
                            'dashboard'=>'required',
                            'steering_wheel'=>'required',
                            'banner' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
                    ]);
                    $store = new CarInterior();
                    $store->car_id = $request->get("car_id");
                    $msg = "Car Interior Information Add Successfully";
                }else{
                     $request->validate([
                            'seats' => 'required',
                            'dashboard'=>'required',
                            'steering_wheel'=>'required'
                    ]);
                    $msg = "Car Interior Information Update Successfully";
                }
                $store->car_id = $request->get("car_id");
                $store->seats = $request->get("seats");
                $store->dashboard = $request->get("dashboard");
                $store->steering_wheel = $request->get("steering_wheel");
                if($request->file("banner")){
                        $old_image = $store->banner;
                        $f = $request->file("banner");
                        $filename = $f->getClientOriginalName();
                        $extension = $f->getClientOriginalExtension() ?: 'png';               
                        $picture = rand().time() . '.' . $extension;
                        $destinationPath = Storage_path("app/public/cars/interior");
                        $f->move($destinationPath, $picture); 
                        $store->banner = $picture;
                        if($old_image!=""){
                            $this->removeImage(storage_path("app/public/cars/interior").'/'.$old_image);  
                        }
                }  
                if($request->get("video_type")==1){//video
                    if($request->file("video")){
                        $old_video = $store->media;
                        $f = $request->file("video");
                        $filename = $f->getClientOriginalName();
                        $extension = $f->getClientOriginalExtension() ?: 'png';               
                        $picture = rand().time() . '.' . $extension;
                        $destinationPath = Storage_path("app/public/cars/video");
                        $f->move($destinationPath, $picture); 
                        $store->media = $picture;
                        if($old_video!=""){
                            $this->removeImage(storage_path("app/public/cars/video").'/'.$old_image);  
                        }
                    }  
                }else{
                    $store->media = $request->get("video_url");
                }
                $store->video_type = $request->get("video_type");
                $store->save();
                if($request->get('old')){
                    $getarr = $request->get('old');
                    $data = CarMedia::whereNotIn('id',$getarr)->where("car_id",$store->id)->where("type",'2')->get();
                    foreach($data as $d){
                        if($d->media!=""){
                            $this->removeImage(storage_path("app/public/cars/interior").'/'.$d->media);
                            $d->delete();
                        }                
                    }
                }else{
                    $data = CarMedia::where("car_id",$store->id)->where("type",'2')->get();
                    foreach($data as $d){
                        $this->removeImage(storage_path("app/public/cars/interior").'/'.$d->media);
                        $d->delete();
                    }
                }
                if($request->file("photos")){
                    foreach($request->file("photos") as $f){
                            $filename = $f->getClientOriginalName();
                            $extension = $f->getClientOriginalExtension() ?: 'png';               
                            $picture = rand().time() . '.' . $extension;
                            $destinationPath = Storage_path("app/public/cars/interior");
                            $f->move($destinationPath, $picture);                
                            $add = new CarMedia();
                            $add->car_id = $request->get("car_id");
                            $add->type = 2;
                            $add->media = $picture;
                            $add->save();
                    }
                }
                Session::flash('message',$msg); 
                Session::flash('alert-class', 'alert-success');
                return redirect()->route('save-car',['user_id'=>$request->get("user_id"),'id'=>$store->id,'tab'=>3]);
        }catch(Exception $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
        }catch (DecryptException $e) {
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
        }catch (\Illuminate\Database\QueryException $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Getting Issue in Data"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
        }
    }

    public function update_car_mechanics_info(Request $request){
       // dd($request->all());
        try{
                if($request->get("car_id")==0){
                    Session::flash('message',"Please First Fill Up Car General Information Then Proceed Ahead"); 
                    Session::flash('alert-class', 'alert-danger');
                    return redirect()->route('save-car',['user_id'=>$request->get("user_id"),'id'=>0,'tab'=>3]);
                }
                $store = CarMechanics::where("car_id",$request->get("car_id"))->first();
                if(empty($store)){
                    $request->validate([
                            'engine_gearbox' => 'required',
                            'suspension_brakes'=>'required',
                            'the_drive'=>'required',
                            'electrics'=>'required'
                    ]);
                    $store = new CarMechanics();
                    $store->car_id = $request->get("car_id");
                    $msg = "Car Mechanics Information Add Successfully";
                }else{
                    $request->validate([
                            'engine_gearbox' => 'required',
                            'suspension_brakes'=>'required',
                            'the_drive'=>'required',
                            'electrics'=>'required'
                    ]);
                    $msg = "Car Mechanics Information Update Successfully";
                }
                $store->car_id = $request->get("car_id");
                $store->engine_gearbox = $request->get("engine_gearbox");
                $store->suspension_brakes = $request->get("suspension_brakes");
                $store->the_drive = $request->get("the_drive");
                $store->electrics = $request->get("electrics");
                if($request->file("banner")){
                        $old_image = $store->banner;
                        $f = $request->file("banner");
                        $filename = $f->getClientOriginalName();
                        $extension = $f->getClientOriginalExtension() ?: 'png';               
                        $picture = rand().time() . '.' . $extension;
                        $destinationPath = Storage_path("app/public/cars/mechanics");
                        $f->move($destinationPath, $picture); 
                        $store->banner = $picture;
                        if($old_image!=""){
                            $this->removeImage(storage_path("app/public/cars/mechanics").'/'.$old_image);  
                        }
                }  
                if($request->get("video_type")==1){//video
                    if($request->file("video")){
                        $old_video = $store->media;
                        $f = $request->file("video");
                        $filename = $f->getClientOriginalName();
                        $extension = $f->getClientOriginalExtension() ?: 'png';               
                        $picture = rand().time() . '.' . $extension;
                        $destinationPath = Storage_path("app/public/cars/video");
                        $f->move($destinationPath, $picture); 
                        $store->media = $picture;
                        if($old_video!=""){
                            $this->removeImage(storage_path("app/public/cars/video").'/'.$old_image);  
                        }
                    }  
                }else{
                    $store->media = $request->get("video_url");
                }
                $store->video_type = $request->get("video_type");
                $store->save();
                if($request->get('old')){
                    $getarr = $request->get('old');
                    $data = CarMedia::whereNotIn('id',$getarr)->where("car_id",$store->id)->where("type",'3')->get();
                    foreach($data as $d){
                        $this->removeImage(storage_path("app/public/cars/mechanics").'/'.$d->media);
                        $d->delete();
                    }
                }
                if($request->file("photos")){
                    foreach($request->file("photos") as $f){
                            $filename = $f->getClientOriginalName();
                            $extension = $f->getClientOriginalExtension() ?: 'png';               
                            $picture = rand().time() . '.' . $extension;
                            $destinationPath = Storage_path("app/public/cars/mechanics");
                            $f->move($destinationPath, $picture);                
                            $add = new CarMedia();
                            $add->car_id = $request->get("car_id");
                            $add->type = 3;
                            $add->media = $picture;
                            $add->save();
                    }
                }
                Session::flash('message',$msg); 
                Session::flash('alert-class', 'alert-success');
                return redirect()->route('save-car',['user_id'=>$request->get("user_id"),'id'=>$store->id,'tab'=>4]);
        }catch(Exception $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
        }catch (DecryptException $e) {
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
        }catch (\Illuminate\Database\QueryException $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Getting Issue in Data"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
        }
    }

    public function update_car_history(Request $request){
        //dd($request->all());
        try{
                if($request->get("car_id")==0){
                    Session::flash('message',"Please First Fill Up Car General Information Then Proceed Ahead"); 
                    Session::flash('alert-class', 'alert-danger');
                    return redirect()->route('save-car',['user_id'=>$request->get("user_id"),'id'=>0,'tab'=>4]);
                }
                $store = CarHistory::where("car_id",$request->get("car_id"))->first();
                if(empty($store)){
                    $request->validate([
                            'vehicle_history' => 'required'
                    ]);
                    $store = new CarHistory();
                    $store->car_id = $request->get("car_id");
                    $msg = "Car History Information Add Successfully";
                }else{
                    $request->validate([
                            'vehicle_history' => 'required'
                    ]);
                    $msg = "Car History Information Update Successfully";
                }
                $store->car_id = $request->get("car_id");
                $store->description = $request->get("vehicle_history");
                if($request->file("banner")){
                        $old_image = $store->banner;
                        $f = $request->file("banner");
                        $filename = $f->getClientOriginalName();
                        $extension = $f->getClientOriginalExtension() ?: 'png';               
                        $picture = rand().time() . '.' . $extension;
                        $destinationPath = Storage_path("app/public/cars/history");
                        $f->move($destinationPath, $picture); 
                        $store->banner = $picture;
                        if($old_image!=""){
                            $this->removeImage(storage_path("app/public/cars/history").'/'.$old_image);  
                        }
                }  
                $store->save();
                if($request->get('old')){
                    $getarr = $request->get('old');
                    $data = CarMedia::whereNotIn('id',$getarr)->where("car_id",$store->id)->where("type",'4')->get();
                    foreach($data as $d){
                        $this->removeImage(storage_path("app/public/cars/history").'/'.$d->media);
                        $d->delete();
                    }
                }
                if($request->file("photos")){
                    foreach($request->file("photos") as $f){
                            $filename = $f->getClientOriginalName();
                            $extension = $f->getClientOriginalExtension() ?: 'png';               
                            $picture = rand().time() . '.' . $extension;
                            $destinationPath = Storage_path("app/public/cars/history");
                            $f->move($destinationPath, $picture);                
                            $add = new CarMedia();
                            $add->car_id = $request->get("car_id");
                            $add->type = 4;
                            $add->media = $picture;
                            $add->save();
                    }
                }
                $date = $request->get("date");
                $type = $request->get("type");
                $mileage = $request->get("mileage");
                CarsHistoryData::where("car_id",$request->get("car_id"))->delete();
                for($i=0;$i<count($date);$i++){
                    $add = new CarsHistoryData();
                    $add->car_id = $request->get("car_id");
                    $add->date = $date[$i];
                    $add->type = $type[$i];
                    $add->mileage = $mileage[$i];
                    $add->save();
                }
                Session::flash('message',$msg); 
                Session::flash('alert-class', 'alert-success');
                return redirect()->route('user-cars-list',['id'=>$this->encryptstring($request->get("user_id"))]);
        }catch(Exception $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
        }catch (DecryptException $e) {
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
        }catch (\Illuminate\Database\QueryException $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Getting Issue in Data"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
        } 
    }

    public function update_car_video(Request $request){
      //  dd($request->all());
        try{
                    if($request->get("car_id")==0){
                        Session::flash('message',"Please First Fill Up Car General Information Then Proceed Ahead"); 
                        Session::flash('alert-class', 'alert-danger');
                        return redirect()->route('save-car',['id'=>0,'tab'=>4]);
                    }
                    if($request->get('old_video')){
                        $getarr = array_filter($request->get('old_video'));
                        $data = CarMedia::whereNotIn('id',$getarr)->where("car_id",$request->get("car_id"))->where("type",5)->get();
                       // echo "<pre>";print_r($data);print_r($getarr);exit;
                        foreach($data as $d){
                            $this->removeImage(storage_path("app/public/cars/video").'/'.$d->media);
                            $d->delete();
                        }
                    }
                    if($request->file("video")){
                        foreach($request->file("video") as $f){
                                $filename = $f->getClientOriginalName();
                                $extension = $f->getClientOriginalExtension() ?: 'png';               
                                $picture = rand().time() . '.' . $extension;
                                $destinationPath = Storage_path("app/public/cars/video");
                                $f->move($destinationPath, $picture);                
                                $add = new CarMedia();
                                $add->car_id = $request->get("car_id");
                                $add->type = 5;
                                $add->media = $picture;
                                $add->save();
                        }
                    }
                    Session::flash('message',"Video Upload Successfully"); 
                    Session::flash('alert-class', 'alert-success');
                    return redirect()->route('save-car',['id'=>$request->get("car_id"),'tab'=>5]);
        }catch(Exception $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
        }catch (DecryptException $e) {
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
        }catch (\Illuminate\Database\QueryException $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Getting Issue in Data"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
        } 
    }
    
    public function show_live_car_data_table(){
        $car =CarInfo::whereNull('deleted_at')->where("status",'1')->get();
         return DataTables::of($car)
            ->editColumn('reg_no', function ($car) {
                return $car->reg_no;
            }) 
            ->editColumn('name', function ($car) {
                return User::find($car->user_id)?User::find($car->user_id)->username:'';
            }) 
            
            ->editColumn('car_name', function ($car) {
                return $car->name;
            })
            
            
            ->editColumn('current_bid', function ($car) {
                if(isset($car->current_bid_id)){
                    $data = Comment::find($car->current_bid_id);
                    return User::find($data->user_id)?User::find($data->user_id)->username:'';
                }
            }) 
            ->editColumn('bid_by', function ($car) {
                return '';
            })   
             ->editColumn('total_bid', function ($car) {
                return count(Comment::where('car_id',$car->id)->where('type','1')->get());
            })
              ->editColumn('reverse_met', function ($car) {
                  $getcurrenctamount = Comment::find($car->current_bid_id)?Comment::find($car->current_bid_id)->amount:'0';
                   $bid_price = str_replace(",","",$getcurrenctamount);
                    if($car->reserve_price<=$bid_price){
                        return "RESERVE MET";
                    }
                    else{
                        $minus = $car->reserve_price-$bid_price;
                        if($minus<=1000){
                            return "RESERVE NEARLY MET";
                        }else{
                            return "RESERVE NOT MET";
                        }                        
                    }   
            })
            ->editColumn('end_time', function ($car) {
                return $car->aucation_enddate.' '.$car->aucation_endtime;
            })
            ->editColumn('more', function ($car) {
                return url('vehicle_detail?query=').$this->encryptstring($car->id);
            })
            ->editColumn('action', function ($car) {
                 $edit = route('save-car', ['user_id'=>$car->user_id,'id'=>$car->id,'tab'=>0]);
               $delete = route('delete-car', ['id'=>$car->id]);
               $change_car_status = route('change-car-status', ['query'=>$this->encryptstring($car->id)]);
               $add = "";
               $status = "";
               if($car->status==0&&$car->is_aucation=='1'){
                  //  $add = '<button type="button" class="btn mr-2  btn-primary" onclick="set_car_id(' .$car->id. ')" data-toggle="modal" data-target="#exampleModal">Set Aucation</button>';
               }
               if($car->is_approve==1){
                    $status = '<a  href="'.$change_car_status.'" rel="tooltip"  class="btn btn-success" data-original-title="banner" style="margin-right: 10px;color: white !important;">Enable</a>';
               }else{
                    $status = '<a  href="'.$change_car_status.'" rel="tooltip"  class="btn btn-secondary" data-original-title="banner" style="margin-right: 10px;color: white !important;">Disable</a>';
               }
               
              
                return '<a  href="'.$edit.'" rel="tooltip"  class="btn btn-primary" data-original-title="banner" style="margin-right: 10px;color: white !important;">Edit</a><a onclick="delete_record(' . "'" . $delete. "'" . ')" rel="tooltip"  class="btn btn-danger" data-original-title="Remove" style="margin-right: 10px;color:white !important">Delete</a>'.$add.$status;              
            })
            ->addIndexColumn()         
            ->make(true);
    }

    public function show_live_car(){
        return view("admin.cars.live");
    }

    public function show_coming_soon(){
         return view("admin.cars.coming_soon");
    }

    public function coming_soon_cars_data_table(){
         $car =CarInfo::whereNull('deleted_at')->where("status",'2')->get();
         return DataTables::of($car)           
            ->editColumn('reg_no', function ($car) {
                return $car->reg_no;
            }) 
            ->editColumn('name', function ($car) {
                return User::find($car->user_id)?User::find($car->user_id)->username:'';
            }) 
          ->editColumn('car_name', function ($car) {
                return $car->name;
            })
           
            ->editColumn('more', function ($car) {
                return url('vehicle_detail?query=').$this->encryptstring($car->id);
            })
            ->editColumn('action', function ($car) {
                $edit = route('save-car', ['user_id'=>$car->user_id,'id'=>$car->id,'tab'=>0]);
               $delete = route('delete-car', ['id'=>$car->id]);
               $change_car_status = route('change-car-status', ['query'=>$this->encryptstring($car->id)]);
               $add = "";
               $status = "";
               if($car->status==0&&$car->is_aucation=='1'){
                  //  $add = '<button type="button" class="btn mr-2  btn-primary" onclick="set_car_id(' .$car->id. ')" data-toggle="modal" data-target="#exampleModal">Set Aucation</button>';
               }
               if($car->is_approve==1){
                    $status = '<a  href="'.$change_car_status.'" rel="tooltip"  class="btn btn-success" data-original-title="banner" style="margin-right: 10px;color: white !important;">Enable</a>';
               }else{
                    $status = '<a  href="'.$change_car_status.'" rel="tooltip"  class="btn btn-secondary" data-original-title="banner" style="margin-right: 10px;color: white !important;">Disable</a>';
               }
               
              
                return '<a  href="'.$edit.'" rel="tooltip"  class="btn btn-primary" data-original-title="banner" style="margin-right: 10px;color: white !important;">Edit</a><a onclick="delete_record(' . "'" . $delete. "'" . ')" rel="tooltip"  class="btn btn-danger" data-original-title="Remove" style="margin-right: 10px;color:white !important">Delete</a>'.$add.$status;              
            })
            ->addIndexColumn()         
            ->make(true);
    }

    public function show_buy_now_cars(){
        return view("admin.cars.buy_now");
    }

    public function buy_now_cars_data_table(){
         $car =CarInfo::whereNull('deleted_at')->where("status",'3')->get();
         return DataTables::of($car)
            ->editColumn('reg_no', function ($car) {
                return $car->reg_no;
            }) 
            ->editColumn('name', function ($car) {
                return User::find($car->user_id)?User::find($car->user_id)->username:'';
            }) 
            
            ->editColumn('price', function ($car) {
                $str = explode("-",$car->currency);
                $currency_symbol = isset($str[1])?$str[1]:'';
                return $currency_symbol.$car->reserve_price;
            })
           
            ->editColumn('more', function ($car) {
                 return url('vehicle_detail?query=').$this->encryptstring($car->id);
            })
            ->editColumn('action', function ($car) {
                 $edit = route('save-car', ['user_id'=>$car->user_id,'id'=>$car->id,'tab'=>0]);
               $delete = route('delete-car', ['id'=>$car->id]);
               $change_car_status = route('change-car-status', ['query'=>$this->encryptstring($car->id)]);
               $add = "";
               $status = "";
               if($car->status==0&&$car->is_aucation=='1'){
                  //  $add = '<button type="button" class="btn mr-2  btn-primary" onclick="set_car_id(' .$car->id. ')" data-toggle="modal" data-target="#exampleModal">Set Aucation</button>';
               }
               if($car->is_approve==1){
                    $status = '<a  href="'.$change_car_status.'" rel="tooltip"  class="btn btn-success" data-original-title="banner" style="margin-right: 10px;color: white !important;">Enable</a>';
               }else{
                    $status = '<a  href="'.$change_car_status.'" rel="tooltip"  class="btn btn-secondary" data-original-title="banner" style="margin-right: 10px;color: white !important;">Disable</a>';
               }
               
              
                return '<a  href="'.$edit.'" rel="tooltip"  class="btn btn-primary" data-original-title="banner" style="margin-right: 10px;color: white !important;">Edit</a><a onclick="delete_record(' . "'" . $delete. "'" . ')" rel="tooltip"  class="btn btn-danger" data-original-title="Remove" style="margin-right: 10px;color:white !important">Delete</a>'.$add.$status;              
            })
            ->addIndexColumn()         
            ->make(true);
    }

    public function show_sold_cars(){
        return view("admin.cars.sold");
    }

    public function sold_cars_data_table(){
        $car =CarInfo::whereNull('deleted_at')->where("status",4)->orderby('id','DESC')->get();
         return DataTables::of($car)            
            ->editColumn('image', function ($car) {
                return asset("storage/app/public/cars/banner").'/'.$car->banner;
            }) 
            ->editColumn('reg_no', function ($car) {
                return $car->reg_no;
            }) 
            ->editColumn('seller_name', function ($car) {
                return User::find($car->user_id)?User::find($car->user_id)->username:'';
            })   
            ->editColumn('more', function ($car) {
                return url('vehicle_detail?query=').$this->encryptstring($car->id);
            })
              ->editColumn('buyer_name', function ($car) {
                if($car->current_bid_id!=""){
                    $user_id = Comment::find($car->current_bid_id)?Comment::find($car->current_bid_id)->user_id:0;
                    return User::find($user_id)?User::find($user_id)->username:'';
                }else{
                    return "Generate By System";
                }
                return ;
            })
            ->editColumn('sold_date', function ($car) {
                return $car->sold_date;
            })
            ->editColumn('transaction_id', function ($car) {
                $data = payment_history::where("car_id",$car->id)->first();
                if(isset($data)){
                    return $data->transaction_id;
                }
            })
            ->editColumn('amount', function ($car) {
               $data = payment_history::where("car_id",$car->id)->first();
                if(isset($data)){
                    return $data->currency.$data->amount;
                }
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
                return '';              
            }) 
            ->addIndexColumn()              
            ->make(true);
    }
}
