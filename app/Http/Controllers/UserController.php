<?php

namespace App\Http\Controllers;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Exceptions\Handler;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use App\Models\CarExterior;
use App\Models\CarInterior;
use App\Models\CarMechanics;
use App\Models\CarMedia;
use App\Models\CarHistory;
use App\Models\CarsHistoryData;
use App\Models\CarInfo;
use Session;
use App\Models\UserPaymentMethod;
use App\Models\UserInvoiceAddress;
use App\Models\State;
use App\Models\City;
use DataTables;
use Log;
class UserController extends Controller
{

    public function show_users_list(){
        return view('admin.users.default');
    }
   
    public function get_user_data(Request $request){
        $user =User::find($request->get("id"));
         if($user){
            $user->country_name = Country::find($user->country_id)?Country::find($user->country_id)->name:'';
            
        }
        return json_encode($user);
    }
    
    public function user_data_table(){
         $user =User::where("user_type",'0')->whereNull("deleted_at")->get();
         return DataTables::of($user)
            ->editColumn('id', function ($user) {
                return $user->id;
            })
            ->editColumn('username', function ($user) {
                return $user->name;
            })            
            ->editColumn('country', function ($user) {
                return Country::find($user->country_id)?Country::find($user->country_id)->name:'';
            })
            ->editColumn('email', function ($user) {
                return $user->email;
            })
            ->editColumn('phone', function ($user) {
                return $user->phone;
            })
            ->editColumn('invoice_address', function ($user) {
                return $user->id;
            })
            ->editColumn('payment_method', function ($user) {
                return $user->id;
            })
            ->editColumn('view', function ($user) {
                return $user->id;
            })
            ->editColumn('status', function ($user) {
                if($user->email_verification==0){
                    return "Inactive";
                }else{
                    return "Active";
                }
            })
            ->editColumn('action', function ($user) {
                
                $delete = route('delete-user', ['query'=>$this->encryptstring($user->id)]);
                $edit = route('user-cars-list', ['id'=>$this->encryptstring($user->id)]);
                $approve = route('email-verified', ['query'=>$this->encryptstring($user->id)]);
                $txt="";
                if($user->email_verification==0){
                    $txt = '<a  href="'.$approve.'" rel="tooltip"  class="btn btn-success" data-original-title="banner" style="margin-right: 10px;color: white !important;">Approve</a>';
                }
                return '<a onclick="delete_record(' . "'" . $delete. "'" . ')" rel="tooltip"  class="btn btn-danger" data-original-title="Remove" style="margin-right: 10px;color:white !important">Delete</a>'.$txt;  

            })    
            ->addIndexColumn()           
            ->make(true);
    }

    public function delete_user(Request $request){
        try{
                $data = User::find($this->decyptstring($request->get('query')));
                if($data){           
                    $data->delete();
                    Session::flash('message',"User Delete Successfully"); 
                    Session::flash('alert-class', 'alert-success');
                    return redirect()->route("users");
                }else{
                    Session::flash('message',"Something Getting worng"); 
                    Session::flash('alert-class', 'alert-danger');
                    return redirect()->route("users");
                }
        }catch(Exception $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('users');
        }catch (DecryptException $e) {
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('users');
        }catch (\Illuminate\Database\QueryException $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng");
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
        }
    }

    public function show_user_cars_list(Request $request){
        $userdata = User::find($this->decyptstring($request->get("id")));
        $user_id = $request->get("id");
        return view("admin.users.car_list",compact("userdata","user_id"));
    }

    public function show_users_cars_data_table(Request $request){    
        //echo   $this->decyptstring($request->get('query'));exit;
        $car =CarInfo::whereNull('deleted_at')->where("user_id",$this->decyptstring($request->get('query')))->get();
         return DataTables::of($car)
            ->editColumn('id', function ($car) {
                return $car->id;
            })
            ->editColumn('banner', function ($car) {
                return asset("storage/app/public/cars/banner").'/'.$car->banner;
            }) 
            ->editColumn('title', function ($car) {
                return $car->name;
            }) 
            ->editColumn('view', function ($car) {
                return $this->encryptstring($car->id);
            }) 
            ->editColumn('aucation_time', function ($car) {
                if($car->aucation_start_datetime!=""&&$car->aucation_end_datetime!=""){
                    return $car->aucation_start_datetime.'@'.$car->aucation_end_datetime;
                }else{
                   return "@";
                }
            }) 
            ->editColumn('status', function ($car) {
                return $car->status;
            })   
            ->editColumn('action', function ($car) {
               $edit = route('save-car', ['user_id'=>$car->user_id,'id'=>$car->id,'tab'=>0]);
               $delete = route('delete-car', ['id'=>$car->id]);
               $change_car_status = route('change-car-status', ['query'=>$this->encryptstring($car->id)]);
               $add = "";
               if($car->status==0&&$car->is_aucation=='1'){
                    $add = '<button type="button" class="btn mr-2  btn-primary" onclick="set_car_id(' .$car->id. ')" data-toggle="modal" data-target="#exampleModal">Set Aucation</button>';
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

    public function get_invoice_data(Request $request){
        $data = UserInvoiceAddress::where("user_id",$request->get("id"))->first();
        if($data){
            $data->country_name = Country::find($data->country_id)?Country::find($data->country_id)->name:'';
            $data->state_name = State::find($data->state_id)?State::find($data->state_id)->name:'';
            $data->city_name = City::find($data->city_id)?City::find($data->city_id)->name:'';
        }
        return json_encode($data);
    }

    public function get_payment_data(Request $request){
        $data = UserPaymentMethod::where("user_id",$request->get("id"))->first();
        if($data){
            $data->country_name = Country::find($data->country_id)?Country::find($data->country_id)->name:'';
            $data->state_name = State::find($data->state_id)?State::find($data->state_id)->name:'';
            $data->city_name = City::find($data->city_id)?City::find($data->city_id)->name:'';
        }
        return json_encode($data);
    }
}
