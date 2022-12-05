<?php

namespace App\Http\Controllers;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Exceptions\Handler;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Hash;
use App\Models\CarInfo;
use App\Models\Car;
use App\Models\ContactUs;
use App\Models\SalesInquiry;
use App\Models\Country;
use App\Models\Subscriber;
use DataTables;
use Session;
use Log;
use Carbon\Carbon;
class AuthencationController extends Controller
{
    public function show_admin_login(){
        return view("admin.login");
    }
    
    public function testtimezone(){
        /* $date = "2022-07-26 04:03:52";
         echo  Carbon::createFromFormat('Y-m-d H:i:s', $date)->tz('Asia/Kolkata');
         echo  '<br>'.Carbon::createFromFormat('Y-m-d H:i:s', $date)->tz('Asia/Singapore');exit;
         echo Carbon::now()->tz('Asia/Kolkata');;
         echo "</br>".Carbon::now()->tz("Asia/Singapore");;*/
    }

    public function post_login(Request $request){        
        $getuser = User::where("email",$request->get("email"))->where("user_type",'1')->first();
        if($getuser){
           if(Hash::check($request->get("password"), $getuser->password)){
                    Auth::login($getuser);
                    if($request->get("rem_me")==1){
                        setcookie('email', $request->get("email"), time() + (86400 * 30), "/");
                        setcookie('password',$request->get("password"), time() + (86400 * 30), "/");
                        setcookie('rem_me',1, time() + (86400 * 30), "/");
                    } 
                    return redirect()->route('dashboard');
            }else{
                Session::flash('message',"Password Incorrect"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
            }            
        }else{
            Session::flash('message', "Login Credentials Are Wrong"); 
            Session::flash('alert-class', 'alert-danger');
            return redirect()->back();
        }        
    }

    public function show_dashboard(){
        $livecars = count(Car::whereNull('deleted_at')->where("status",'1')->get());
        $comingsooncars = count(Car::whereNull('deleted_at')->where("status",'2')->get());
        $pendingpayment = count(Car::whereNull('deleted_at')->where("status",'4')->where("payment_status",1)->get());
        $settledpayment = count(Car::whereNull('deleted_at')->where("status",'4')->where("payment_status",2)->get());
        $activedealer = count(User::whereNull('deleted_at')->where("user_type",'0')->where("email_verification",1)->get());
        $pendingdealer = count(User::whereNull('deleted_at')->where("user_type",'0')->where("email_verification",0)->get());
        return view("admin.dashboard",compact('livecars','comingsooncars','pendingpayment','settledpayment','activedealer','pendingdealer'));
    }

    public function admin_logout(){
        Auth::logout();
        return redirect()->route('login');
    }

    public function show_contact_us_list(){
        return view('admin.contact_us');
    }

    public function contact_us_data_table(){
         $contact =ContactUs::all();
         return DataTables::of($contact)
            ->editColumn('id', function ($contact) {
                return $contact->id;
            })
            ->editColumn('name', function ($contact) {
                return $contact->name;
            })
            ->editColumn('email', function ($contact) {
                return $contact->email;
            })
            ->editColumn('country', function ($contact) {
                return Country::find($contact->country_id)?Country::find($contact->country_id)->name:'';
            })
            ->editColumn('phone', function ($contact) {
                return $contact->phone;
            })
            ->editColumn('interested_in', function ($contact) {
                 if($contact->interested_In==1){
                    return "Buying";
                }else if($contact->interested_In==1){
                    return "Selling";
                }else{
                    return "Everything";
                }
            })
            ->editColumn('description', function ($contact) {
                return $contact->message;
            })
            ->editColumn('action', function ($contact) {
                if($contact->interested_In==1){
                    $interested = "Buying";
                }else if($contact->interested_In==1){
                    $interested = "Selling";
                }else{
                    $interested = "Everything";
                }
                $delete = route('delete-contact', ['id'=>$contact->id]);
                return '<a class="btn btn-primary" href="https://mail.google.com/mail/?view=cm&fs=1&to='.$contact->email.'&su='.$interested.'&body='.$contact->message.'" target="_blank"><i class="fas fa-envelope"></i></a><a onclick="delete_record(' . "'" . $delete. "'" . ')" rel="tooltip"  class="btn btn-danger" data-original-title="Remove" style="color:white !important;margin-left:5px"><i class="fas fa-trash"></i></a>';              
            }) 
            ->addIndexColumn()                
            ->make(true);
    }

    public function delete_contact($id){
        try{
                $fetch = ContactUs::find($id);
                if($fetch){
                    $fetch->delete();
                    Session::flash('message',"Contact Info Delete Successfully"); 
                    Session::flash('alert-class', 'alert-success');
                    return redirect()->route("contact-us-list");
                }else{
                    Session::flash('message',"Something Getting worng"); 
                    Session::flash('alert-class', 'alert-danger');
                    return redirect()->route("contact-us-list");
                }
        }catch(Exception $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('make');
        }catch (DecryptException $e) {
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('make');
        }catch (\Illuminate\Database\QueryException $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
        }
    }

    public function show_sales_help(){
        return view("admin.sales_help");
    }

    public function sales_help_data_table(){
         $sales =SalesInquiry::all();
         return DataTables::of($sales)
            ->editColumn('id', function ($sales) {
                return $sales->id;
            })
            ->editColumn('name', function ($sales) {
                return $sales->name;
            })
            ->editColumn('email', function ($sales) {
                return $sales->email;
            })
            ->editColumn('country', function ($sales) {
                return Country::find($sales->country_id)?Country::find($sales->country_id)->name:'';
            })
            ->editColumn('phone', function ($sales) {
                return $sales->phone;
            })
            ->editColumn('make', function ($sales) {
                return $sales->make;
            })
            ->editColumn('model', function ($sales) {
                return $sales->model;
            })
            ->editColumn('action', function ($sales) {
                
                $delete = route('delete-sales-inquiry', ['id'=>$sales->id]);
                return '<a class="btn btn-primary" href="https://mail.google.com/mail/?view=cm&fs=1&to='.$sales->email.'&su='.$sales->region.'&body=" target="_blank"><i class="fas fa-envelope"></i></a><a onclick="delete_record(' . "'" . $delete. "'" . ')" rel="tooltip"  class="btn btn-danger" data-original-title="Remove" style="color:white !important;margin-left:5px"><i class="fas fa-trash"></i></a>';              
            })  
            ->addIndexColumn()               
            ->make(true);
    }

    public function delete_sales_inquiry($id){
        try{
                $fetch = SalesInquiry::find($id);
                if($fetch){
                    $fetch->delete();
                    Session::flash('message',"Inquiry Delete Successfully"); 
                    Session::flash('alert-class', 'alert-success');
                    return redirect()->route("sales-help");
                }else{
                    Session::flash('message',"Something Getting worng"); 
                    Session::flash('alert-class', 'alert-danger');
                    return redirect()->route("sales-help");
                }
        }catch(Exception $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('make');
        }catch (DecryptException $e) {
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('make');
        }catch (\Illuminate\Database\QueryException $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
        }
    }

    public function show_subscriber(){
        return view('admin.subscriber');
    }

    public function subscriber_data_table(){
          $sub =Subscriber::all();
         return DataTables::of($sub)
            ->editColumn('id', function ($sub) {
                return $sub->id;
            })
            ->editColumn('email', function ($sub) {
                return $sub->email;
            })       
            ->make(true);
    }

    public function show_my_account(){
        return view("admin.myaccount");
    }

    public function update_profile(Request $request){
       // dd($request->all());
        try{
                $user = Auth::user();
                $user->name = $request->get("name");
                $user->email = $request->get("email");
                if($request->file("upload_image")){
                    if($user->image!=""){
                         $this->removeImage(storage_path("app/public/profile").'/'.$user->image);
                    }             
                    $user->image = $this->fileuploadFileImage($request,'profile','upload_image');
                }
                $user->save();
                Session::flash('message',"Profile Update Successfully"); 
                Session::flash('alert-class', 'alert-success');
                return redirect()->back();
        }catch(Exception $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('make');
        }catch (DecryptException $e) {
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('make');
        }catch (\Illuminate\Database\QueryException $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
        }
    }

    public function show_change_password(){
        return view("admin.change_password");
    }

    public function check_current_password($val){
        if(Hash::check($val,Auth::user()->password)){
            return 1;
        }else{
            return 0;
        }
    }

    public function update_my_password(Request $request){
        try{
                    $user=Auth::user();
                    if (Hash::check($request->get('cpwd'), $user->password))
                        {
                            $user->password = Hash::make($request->get("npwd"));
                            $user->save();
                            Session::flash('message',"Password Update Successfully"); 
                            Session::flash('alert-class', 'alert-success');
                            return redirect()->back();
                    }
                    else{
                            Session::flash('message',"Something Getting worng"); 
                            Session::flash('alert-class', 'alert-danger');
                            return redirect()->back();
                    }
        }catch(Exception $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('make');
        }catch (DecryptException $e) {
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('make');
        }catch (\Illuminate\Database\QueryException $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
        }
    }

}
