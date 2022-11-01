<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FRQ;
use App\Models\Pages;
use App\Models\Setting;
use Session;
use DataTables;
use App\Models\BidGaps;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Exceptions\Handler;
use Log;
use DateTimeZone;
use DateTime;
use App\Models\Removecard;
use App\Models\User;
class SettingController extends Controller
{
    
    public function show_frq_list(){
        return view("admin.setting.frq");
    }
    
    public function show_setting(){
        $setting = Setting::find(1);
        $timezone=$this->generate_timezone_list();
        return view("admin.setting.editsetting",compact('setting','timezone'));
    }
    
    public function remove_card_request(){
        return view("admin.remove_card_request");
    }
    
    public function request_card_data_table(){
         $contact =Removecard::all();
         return DataTables::of($contact)
            ->editColumn('id', function ($contact) {
                return $contact->id;
            })
            ->editColumn('name', function ($contact) {
                return User::find($contact->user_id)?User::find($contact->user_id)->username:'';
            })
            ->editColumn('status', function ($contact) {
                if($contact->status==0){
                    return "Process";
                }
                if($contact->status==1){
                    return "Accepted";
                }
                if($contact->status==2){
                    return "Rejected";
                }
            })
            
            ->editColumn('action', function ($contact) {
                     if($contact->status==0){
                        $accept_card = route('change_request_card_status', ['id'=>$contact->id,'status'=>1]);
                        $remove_card = route('change_request_card_status', ['id'=>$contact->id,'status'=>2]);
                return '<a class="btn btn-success" href="'.$accept_card.'" >Accept</a><a class="btn btn-danger" style="margin-left:10px" href="'.$remove_card.'" >Reject</a>';
                    }
            }) 
            ->addIndexColumn()                
            ->make(true);
    }
    
    public function change_request_card_status(Request $request){
       // dd($request->all());
        $data = Removecard::find($request->get("id"));
        if(isset($data)){
                if($request->get("status")==1){
                    $msg = "Request Remove Card Accept Successfully";
                }
                if($request->get("status")==2){
                    $msg = "Request Remove Card Reject Successfully";
                }
                $data->status = $request->get("status");
                $data->save();
                Session::flash('message',$msg); 
                Session::flash('alert-class', 'alert-success');
                return redirect()->back();
        }else{
                Session::flash('message',"Record Not Found"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
        }
    }

    static public function generate_timezone_list(){
            static $regions = array(
              DateTimeZone::AFRICA,
              DateTimeZone::AMERICA,
              DateTimeZone::ANTARCTICA,
              DateTimeZone::ASIA,
              DateTimeZone::ATLANTIC,
              DateTimeZone::AUSTRALIA,
              DateTimeZone::EUROPE,
              DateTimeZone::INDIAN,
              DateTimeZone::PACIFIC,
            );
        
            $timezones = array();
            foreach($regions as $region) {
              $timezones = array_merge($timezones, DateTimeZone::listIdentifiers($region));
            }
        
            $timezone_offsets = array();
            foreach($timezones as $timezone) {
              $tz = new DateTimeZone($timezone);
              $timezone_offsets[$timezone] = $tz->getOffset(new DateTime);
            }
        
            asort($timezone_offsets);
        
            $timezone_list = array();
            
            foreach($timezone_offsets as $timezone=>$offset){
              $offset_prefix = $offset < 0 ? '-' : '+';
              $offset_formatted = gmdate('H:i', abs($offset));
              $pretty_offset = "UTC${offset_prefix}${offset_formatted}";
              $timezone_list[] = "(${pretty_offset}) $timezone";
            }
        
            return $timezone_list;
            ob_end_flush();
    }
    
    public function update_setting(Request $request){
        try{
                $getsetting = Setting::find(1);
                if(empty($getsetting)){
                    $getsetting = new Setting();
                    $getsetting->id = 1;
                }
                $getsetting->email = $request->get("email");
                $getsetting->phone = $request->get("phone");
                $getsetting->address = $request->get("address");
                $getsetting->facebook_id = $request->get("facebook_id");
                $getsetting->twitter_id = $request->get("twitter_id");
                $getsetting->instgram_id = $request->get("instgram_id");
                $getsetting->fees_info = $request->get("fees_info");
                $getsetting->timezone  =$request->get("timezone");
                //$getsetting->timezone = 1;
                $getsetting->txt_charge = $request->get("txt_charge");
                $getsetting->save();
                Session::flash('message',"General Setting Update Successfully"); 
                Session::flash('alert-class', 'alert-success');
                return redirect()->route('setting');
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

    public function show_bid_gaps(){
        $data = BidGaps::all();
        return view("admin.setting.bid_gaps",compact("data"));
    }

    public function update_bid_gaps(Request $request){
            try{
                $data = BidGaps::all();
                $getgap = $request->get("gap");
                $i = 0;
                foreach($data as $g){
                    $g->gap = $getgap[$i];
                    $i++;
                    $g->save();
                }
                Session::flash('message',"Data Update Successfully"); 
                Session::flash('alert-class', 'alert-success');
                return redirect()->back();
            }catch(Exception $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
            }
    }

    public function payment_setting(Request $request){
        $setting = Setting::find(1);
        return view("admin.setting.payment_keys",compact('setting'));
    }

    public function update_payment_setting(Request $request){   
        try{    
            $setting = Setting::find(1);
            $setting->stripe_key = $request->get("key");
            $setting->stripe_secret = $request->get("secert");
            $setting->save();
            Session::flash('message',"Data Update Successfully"); 
            Session::flash('alert-class', 'alert-success');
            return redirect()->back();
        }catch(Exception $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
        }
    }
}
