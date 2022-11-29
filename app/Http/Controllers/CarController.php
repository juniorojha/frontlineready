<?php

namespace App\Http\Controllers;

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
            ->editColumn('aucation_status', function ($car) {
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
    
    public function settle_car(Request $request){
          try{
                $data = Car::find($request->get("id"));
                if($data){
                    $data->payment_status = '2';
                    $data->save();
                    Session::flash('message',"This Car Payment Settle Successfully"); 
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
                    $msg = "Car Add Successfully";
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
                    $msg = "Car Update Successfully";
                    if(empty($store)){
                        Session::flash('message',"Something Getting Wrong"); 
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
                $dates = explode(" - ",$request->get("aucation_date"));
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

  
    
    public function show_live_car_data_table(){
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
        return view("admin.cars.live");
    }

    public function show_coming_soon(){
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
}
