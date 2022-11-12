<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Hash;
use App\Models\ContactUs;
use App\Models\SalesInquiry;
use App\Models\Country;
use App\Models\Subscriber;
use App\Models\Setting;
use App\Models\SpotLight;
use App\Models\CarInfo;
use App\Models\Make;
use App\Models\State;
use App\Models\Currency;
use App\Models\City;
use App\Models\CarExterior;
use App\Models\CarInterior;
use App\Models\CarMechanics;
use App\Models\CarMedia;
use App\Models\CarHistory;
use App\Models\CarsHistoryData;
use App\Models\UserOld;
use App\Models\ResetPassword;
use App\Models\UserInvoiceAddress;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Exceptions\Handler;
use App\Models\FRQ;
use App\Models\FRQMain;
use App\Models\MaxBid;
use App\Models\CarBid;
use App\Models\payment_history;
use App\Models\UserWatching;
use App\Models\BidGaps;
use App\Models\Comment;
use App\Models\UserPaymentMethod;
use App\Models\Removecard;
use DataTables;
use Session;
use Stripe\Stripe;
use Stripe\Charge;
use DB;
use Mail;
use RecaptchaV3;
use Log;
use DateTime;
use DateTimeZone;
use Carbon\Carbon;
class FrontController extends Controller
{
     public function testv3()
    {
        return view('register');
    }
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function storev3(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|same:password_confirmation',
            'password_confirmation' => 'required',
            'g-recaptcha-response' => 'required|recaptchav3:register,0.5'
        ]);
   
        dd('done');
    }
    
    public function remove_card(){
        $store = new Removecard();
        $store->user_id = Auth::id();
        $store->save();
        Session::flash('message_card',"Request Send Successfully"); 
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('billing');
    }
    
    public function get_local_time(){  
        $ip = $_SERVER['REMOTE_ADDR'];
        $ipInfo = file_get_contents('http://ip-api.com/json/' . $ip);
        $ipInfo = json_decode($ipInfo);
        $timezone = isset($ipInfo->timezone)?$ipInfo->timezone:'';
        return $timezone;
    }
    
    public function show_home(Request $request){       
        Session::put("timezone",$this->get_time_zone_name());
        Session::put("current_timezone",$this->get_local_time());
        
       
        try{
                $setting = Setting::find(1);
                $country = Country::all();
                $id = $request->get("id");
                $spotLight = SpotLight::take(3)->orderby("id","DESC")->get();
                foreach($spotLight as $sl){
                    $sl->query_id = $this->encryptstring($sl->id);
                }
                Session::put("menu_active",'1');
                $get_car_coming = CarInfo::whereNull('deleted_at')->where("is_approve",'1')->where("status",'2')->get();
                foreach ($get_car_coming as $k) {
                    $k->key_id = $this->encryptstring($k->id);
                    $k->country_name = Country::find($k->country_id)?Country::find($k->country_id)->name:'';
                    $k->country_sortname = Country::find($k->country_id)?strtolower(Country::find($k->country_id)->sortname):'';
                    $k->is_like = UserWatching::where("car_id",$k->id)->where("user_id",Auth::id())->first()?1:0;
                }
                $get_car_live = CarInfo::whereNull('deleted_at')->where("is_approve",'1')->where("status",'1')->get();
                foreach ($get_car_live as $k) {
                    $k->key_id = $this->encryptstring($k->id);
                    $k->country_name = Country::find($k->country_id)?Country::find($k->country_id)->name:'';
                    $k->country_sortname = Country::find($k->country_id)?strtolower(Country::find($k->country_id)->sortname):'';
                    $k->is_like = UserWatching::where("car_id",$k->id)->where("user_id",Auth::id())->first()?1:0;
                   // $k->reserve_met = 2;
                    $str = explode("-",$k->currency);
                    $k->currency_symbol = isset($str[1])?$str[1]:'';
                    $k->bid_price = Comment::find($k->current_bid_id)?Comment::find($k->current_bid_id)->amount:'0.00';
                    $bid_price = str_replace(",","",$k->bid_price);
                    if($k->reserve_price<=$bid_price){
                        $k->reserve_met = 1;
                    }
                    else{
                        $minus = $k->reserve_price-$bid_price;
                        if($minus<=1000){
                            $k->reserve_met = 3;
                        }else{
                            $k->reserve_met = 2;
                        }                        
                    }
                }
                $get_car_private = CarInfo::whereNull('deleted_at')->where("is_approve",'1')->where("status",'3')->get();
                foreach ($get_car_private as $k) {
                    $k->key_id = $this->encryptstring($k->id);
                    $k->country_name = Country::find($k->country_id)?Country::find($k->country_id)->name:'';
                    $k->country_sortname = Country::find($k->country_id)?strtolower(Country::find($k->country_id)->sortname):'';
                    $k->is_like = UserWatching::where("car_id",$k->id)->where("user_id",Auth::id())->first()?1:0;
                    $str = explode("-",$k->currency);
                    $k->currency_symbol = isset($str[1])?$str[1]:'';
                    
                }
                $get_car_sold = CarInfo::whereNull('deleted_at')->where("is_approve",'1')->where("status",'4')->get();
                foreach ($get_car_sold as $k) {
                    $k->key_id = $this->encryptstring($k->id);
                    $k->country_name = Country::find($k->country_id)?Country::find($k->country_id)->name:'';
                    $k->country_sortname = Country::find($k->country_id)?strtolower(Country::find($k->country_id)->sortname):'';
                    $k->is_like = UserWatching::where("car_id",$k->id)->where("user_id",Auth::id())->first()?1:0;
                    $str = explode("-",$k->currency);
                    $k->currency_symbol = isset($str[1])?$str[1]:'';
                }
                
                $makes = Make::wherenull('deleted_at')->get();
                foreach($makes as $tm){
                    $tm->totalcars = count(CarInfo::whereNull('deleted_at')->where("is_approve",'1')->where("make_id",$tm->id)->get());
                }
                $privatecarcount = count(CarInfo::whereNull('deleted_at')->where("is_approve",'1')->where("seller_type",'2')->get());
                $tradecarcount = count(CarInfo::whereNull('deleted_at')->where("is_approve",'1')->where("seller_type",'1')->get());
                $managedcarcount = count(CarInfo::whereNull('deleted_at')->where("is_approve",'1')->where("seller_type",'3')->get());
                $rhlcar = count(CarInfo::whereNull('deleted_at')->where("is_approve",'1')->where("steering_position",'2')->get());
                $lhlcar = count(CarInfo::whereNull('deleted_at')->where("is_approve",'1')->where("steering_position",'1')->get());
                $get_country_list = DB::table('car_infos') ->select('country_id') ->groupBy('country_id')->get();
                foreach($get_country_list as $gcl){
                     $gcl->total_car = count(CarInfo::where('country_id',$gcl->country_id)->get());
                     $gcl->country_name = Country::find($gcl->country_id)?Country::find($gcl->country_id)->name:'';
                }

                return view("front.home",compact("rhlcar","id","get_country_list","lhlcar","privatecarcount","tradecarcount","managedcarcount","makes","setting","country","spotLight","get_car_coming","get_car_live","get_car_private","get_car_sold"));
        }catch(Exception $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('page_not_found');
        }catch (DecryptException $e) {
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('page_not_found');
        }catch (\Illuminate\Database\QueryException $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('page_not_found');
        } 
    }

    public function getcurrenttime($offset){
        if($offset > 0){
            $new_offset = "-".$offset;
        }
        elseif($offset < 0){
           $new_offset = str_replace("-","",$offset);
        }
        //$timezone_name = timezone_name_from_abbr("", 330*60, false);
       // $timezone_name = timezone_name_from_abbr("", $new_offset*60, false);
        $date = new DateTime("now", new DateTimeZone($this->get_time_zone_name()) );
        $date->setTimeZone(new DateTimeZone('UTC')); 
        Session::put('timezone',$timezone_name);
        $data=array("date"=>$date->format('Y-m-d H:i:s.u'),"timezone"=>$this->get_time_zone_name());
        return json_encode($data);
    }



    public function page_not_found(){
        $setting = Setting::find(1);
        $country = Country::all();
        return view("front.404",compact("setting","country"));
    }


    public function improtolduser(){
        $getall = UserOld::all();
        foreach($getall as $ga){
            $store = new User();
            $store->username = trim($ga->name);
            $store->email = $ga->email;
            $store->password = Hash::make($ga->name.'@123');
            $store->phone = '';
            $getcountry  = Country::where("name",ucwords($ga->country))->first();
            $store->country_id = isset($getcountry)?$getcountry->id:'';
            $store->save();
        }
        echo "done";
        exit;
    }

    public function sendemail(Request $request){
             $user = User::find(3);
             $user->key = 1;
            // $user->email = $request->get('email');
            // try {
                 Mail::send('email.user_verification', ['user' => $user], function($message) use ($user){
                     $message->to($user->email,$user->username)->subject('Front Line Ready');
                });
            // }catch (\Exception $e) {
           //  }
        
             echo "Mail Send Successfully";
    }

    public function save_contact_detail(Request $request){
        $store = new ContactUs();
        $store->name = $request->get("name");
        $store->email = $request->get("email");
        $getcountry  = Country::where("sortname",$request->get("country"))->first();
        $store->country_id = isset($getcountry)?$getcountry->id:'';
        $store->phone = $request->get("countrycode").$request->get("phone");
        $store->message = $request->get("message");
        $store->interested_In = $request->get("interested_in");
        $store->save();
         if($request->get("interested_in")==1){
                    $interested_In = "Only Buying";
                }else if($request->get("interested_in")==2){
                    $interested_In = "Only Selling";
                }else{
                    $interested_In = "Everything We've Got!";
                }
        try{
              $txt = '<html><head><title>New Contact Detail</title></head><body><p><strong>New Contact Detail</strong></p><table><tr><th>Name</th><th>'.$request->get("name").'</th></tr><tr><th>Email</th><th>'.$request->get("email").'</th></tr><tr><th>Country</th><th>'.$store->country.'</th></tr><tr><th>Phone</th><th>'.$request->get("phone").'</th></tr><tr><th>Message</th><th>'.$request->get("message").'</th></tr><tr><th>Country</th><th>'.$interested_In.'</th></tr></table></body></html>';
                $to = "support@frontlinereadyrtx.com";
                $subject = "New Contact Detail";
                $txt = $txt;
                $headers = "From: support@frontlinereadyrtx.com \r\n";
                $headers .= "Reply-To: support@frontlinereadyrtx.com \r\n";
                $headers .= "CC: support@frontlinereadyrtx.com\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                $result = mail($to,$subject,$txt,$headers);
        }catch(\Exception $e){

        }
        return "Thank you For Getting in Touch With Us. We connect with You Very soon";       
    }

    public function emailverified(Request $request){
        try{
                $id = $this->decyptstring($request->get('query'));
                $user = User::find($id);
                if($user){
                        $user->email_verification = 1;
                        $user->save();
                        Session::flash('is_verified_falsh','1'); 
                         return redirect()->route('home');
                }else{
                    
                     Session::flash('message',"Something Wrong"); 
                     Session::flash('alert-class', 'alert-danger');
                     return redirect()->route('home');
                }
               
        }catch(Exception $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng");
                Session::flash('alert-class', 'alert-danger');
                 return redirect()->route('home');
        }catch (DecryptException $e) {
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng"); 
                Session::flash('alert-class', 'alert-danger');
                 return redirect()->route('home');
        }catch (\Illuminate\Database\QueryException $e){
               \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng"); 
                Session::flash('alert-class', 'alert-danger');
                 return redirect()->route('home');
        } 
        
    }

    public function show_frq(){
        $setting = Setting::find(1);
        $country = Country::all();
        $getfrq = FRQMain::all();
        foreach($getfrq as $gf){
            $gf->frqlist = FRQ::where("topic_id",$gf->id)->get();
        }
         Session::put("menu_active",'6');
        return view("front.frq",compact("setting","country","getfrq"));
    }

   

    public function getstatelist(Request $request){
        $getcountry = Country::where("sortname",$request->get("id"))->first();
        if($getcountry){
            $getstate = State::where("country_id",$getcountry->id)->get();
            return json_encode($getstate);
        }
        
    }

    public function getcitylist(Request $request){
        $get_city = City::where("state_id",$request->get("id"))->get();
        return json_encode($get_city);
    }

    public function post_register_user(Request $request){
        //dd($request->all());
        $get_user = User::where("email",$request->get("email"))->where("user_type",'1')->first();
        if(!empty($get_user)){
            return 2;
        }else{
            $store = new User();
            $store->name = $request->get("name");
            $store->dealership_name = $request->get("dealership_name");
            $store->address = $request->get("address");
            $store->dealership_p_number = $request->get("dealership_p_number");
            $store->street_address = $request->get("street_address");
            $store->city = $request->get("city");
            $store->state = $request->get("state");
            $store->postcode = $request->get("postcode");
            $store->email = $request->get("email");
            $store->country = $request->get("country");
            $store->password = Hash::make($request->get("password"));
            $store->phone = $request->get('countrycode')." ".$request->get("phone");
            $getcountry  = Country::where("sortname",$request->get("country"))->first();
            $store->country_id = isset($getcountry)?$getcountry->id:'';
            $store->save();
            if($request->get("allow_newsletter")){
                $getsub = Subscriber::where("email",$request->get("email"))->first();
                if(empty($getsub)){
                    $new = new Subscriber();
                    $new->email = $request->get("email");
                    $new->save();
                }
            }
            $user = User::find($store->id);
            $user->key = $this->encryptstring($user->id);
            try {
                Mail::send('email.user_verification', ['user' => $user], function($message) use ($user){
                    $message->to($user->email,$user->username)->subject('Curatingcars');
                });
            }catch (\Exception $e) {
            }
            return 1;
        }
    }

    public function update_invoice_detail(Request $request){
        $store = UserInvoiceAddress::where("user_id",Auth::id())->first();
        if(empty($store)){
            $store = new UserInvoiceAddress();
            $store->user_id = Auth::id();
        }
        $store->company_name = $request->get("company_name");
        $store->billing_address = $request->get("billing_address");
        $getcountry  = Country::where("sortname",$request->get("country"))->first();
        $store->country_id = isset($getcountry)?$getcountry->id:'';
        $store->state_id = $request->get("state");
        $store->city_id = $request->get("city");
        $store->pincode = $request->get("pincode");
        $store->phone = $request->get("phone");
        $store->vat_no = $request->get("vat_no");
        $store->country_code = $request->get("countrycode");
        $store->save();
        return 1;
    }

    public function update_payment_detail(Request $request){
        
        try{
                $setting = Setting::find(1);
                $store = UserPaymentMethod::where("user_id",Auth::id())->first();
                if(empty($store)){
                    $store = new UserPaymentMethod();
                    $store->user_id = Auth::id();
                    
                    
                    try{
                            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                            $customer = \Stripe\Customer::create([
                                'source' => $request->get('stripe_token'),
                                'email' => Auth::user()->email,
                                'name'=> $request->get("name_on_card"),
                            ]);
                  } catch (\Stripe\Exception\RateLimitException $e) {
                          return $e->getMessage();
                  } catch (\Stripe\Exception\InvalidRequestException $e) {
                          return $e->getMessage();
                  } catch (\Stripe\Exception\AuthenticationException $e) {
                          return $e->getMessage();
                  } catch (\Stripe\Exception\ApiConnectionException $e) {
                          return $e->getMessage();
                  } catch (\Stripe\Exception\ApiErrorException $e) {
                          return $e->getMessage();
                  } catch (Exception $e) {
                          return $e->getMessage();
                  }
                  
                    $store->stripe_customer_id = isset($customer->id)?$customer->id:'';
                }
                $store->name_on_card = $request->get("name_on_card");
                $store->billing_address = $request->get("billing_address");
                $getcountry  = Country::where("sortname",$request->get("country"))->first();
                $store->country_id = isset($getcountry)?$getcountry->id:'';
                $store->state_id = $request->get("state");
                $store->city_id = $request->get("city");
                $store->pincode = $request->get("pincode");
                $store->phone = $request->get("phone");
                $store->country_code = $request->get("countrycode");
                $store->save();
                
                
                 $store = UserInvoiceAddress::where("user_id",Auth::id())->first();
        if(empty($store)){
            $store = new UserInvoiceAddress();
            $store->user_id = Auth::id();
        }
        $store->company_name = $request->get("company_name");
        $store->billing_address = $request->get("billing_address");
        $getcountry  = Country::where("sortname",$request->get("country"))->first();
        $store->country_id = isset($getcountry)?$getcountry->id:'';
        $store->state_id = $request->get("state");
        $store->city_id = $request->get("city");
        $store->pincode = $request->get("pincode");
        $store->phone = $request->get("phone");
        $store->vat_no = $request->get("vat_no");
        $store->country_code = $request->get("countrycode");
        $store->save();
        
                return 1;
        }catch(Exception $e){
                return 0;
        }
        
    }


    public function post_sell_with_us(Request $request){
        try{
                $store = new SalesInquiry();
                $store->name = $request->get("name");
                $store->email = $request->get("email");
                $store->phone = $request->get("countrycode").$request->get("phone");
                $getcountry  = Country::where("sortname",$request->get("country"))->first();
                $store->country_id = isset($getcountry)?$getcountry->id:'';
                $store->model = $request->get("model");
                $store->make = $request->get("make");
                $store->save();
                return 1;
        }catch(Exception $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng"); 
                Session::flash('alert-class', 'alert-danger');
                 return 0;
        }catch (DecryptException $e) {
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng"); 
                Session::flash('alert-class', 'alert-danger');
                 return 0;
        }catch (\Illuminate\Database\QueryException $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng"); 
                Session::flash('alert-class', 'alert-danger');
                 return 0;
        } 
    }

    public function check_username(Request $request){
        $get_user = User::where("username",$request->get("username"))->first();
        if($get_user){
            return 1;
        }else{
            return 0;
        }
    }

    public function show_login_user(Request $request){
        $getuser = User::where("email",$request->get("email"))->where("user_type",'0')->first();
        if($getuser){
            if(Hash::check($request->get("password"), $getuser->password)){
                if($getuser->email_verification==0){
                    return 2;
                }
                Auth::login($getuser);
                return 1;
            }else{
                return 0;
            }            
        }else{
            return 0;
        }  
    }

    public function show_myaccount(){
        if(empty(Auth::id())){
            return redirect()->route('home');
        }
        $setting = Setting::find(1);
        $country = Country::all();
        $getlivecar = CarInfo::where("status",'1')->get();
        $livecars = array();

        foreach($getlivecar as $k){
            $getcars = Comment::where("car_id",$k->id)->where("user_id",Auth::id())->where("type",'1')->first();
            if($getcars){
                    $k->key_id = $this->encryptstring($k->id);
                    $k->country_name = Country::find($k->country_id)?Country::find($k->country_id)->name:'';
                    $k->country_sortname = Country::find($k->country_id)?strtolower(Country::find($k->country_id)->sortname):'';
                    $k->is_like = UserWatching::where("car_id",$k->id)->where("user_id",Auth::id())->first()?1:0;                  
                    $str = explode("-",$k->currency);
                    $k->currency_symbol = isset($str[1])?$str[1]:'';
                    $k->bid_price = Comment::find($k->current_bid_id)?Comment::find($k->current_bid_id)->amount:'0.00';
                    $bid_price = str_replace(",","",$k->bid_price);
                    $k->total_bid = count(Comment::where("car_id",$k->id)->where("type",'1')->get());
                    if($k->reserve_price<=$bid_price){
                        $k->reserve_met = 1;
                    }
                    else{
                        $minus = $k->reserve_price-$bid_price;
                        if($minus<=1000){
                            $k->reserve_met = 3;
                        }else{
                            $k->reserve_met = 2;
                        }                        
                    }                
                $livecars[] = $k;
            }
        }
        $wincars = array();
        $getwincars = payment_history::where("buyer_id",Auth::id())->get();
        foreach($getwincars as $gl){
              $k =CarInfo::find($gl->id);
              if($k){
                    $k->key_id = $this->encryptstring($k->id);
                    $k->country_name = Country::find($k->country_id)?Country::find($k->country_id)->name:'';
                    $k->country_sortname = Country::find($k->country_id)?strtolower(Country::find($k->country_id)->sortname):'';
                    $k->is_like = UserWatching::where("car_id",$k->id)->where("user_id",Auth::id())->first()?1:0;
                    $str = explode("-",$k->currency);
                    $k->currency_symbol = isset($str[1])?$str[1]:'';
                    $wincars[] = $k;
              }                  
           
        }

        /*$get_cars = DB::table('payment_histories')
                 ->select('comments.car_id')
                 ->join('comments', 'comments.car_id', '!=', 'payment_histories.car_id')
                 ->where('comments.type','1')
                 ->where('comments.user_id',Auth::id())
                 ->groupBy('comments.car_id') 
                 ->toSql();*/
                
        Session::put("menu_active",'4');
        return view("front.myaccount",compact("setting","country","livecars","wincars"));
    }

    public function show_cookie_policy(){
        $setting = Setting::find(1);
        $country = Country::all();
        return view("front.cookie_policy",compact("setting","country"));
    }

    public function show_term_and_condition(){
        $setting = Setting::find(1);
        $country = Country::all();
        return view("front.term_and_condition",compact("setting","country"));
    }

    public function show_my_watch(){
        if(empty(Auth::id())){
            return redirect()->route('home');
        }
        $setting = Setting::find(1);
        $country = Country::all();
        Session::put("menu_active",'4');
        $get_my_watch = UserWatching::where("user_id",Auth::id())->get();
        foreach($get_my_watch as $g){
             $g->carInfo = CarInfo::whereNull('deleted_at')->where("is_approve",'1')->where("id",$g->car_id)->first();
             if($g->carInfo){
                $g->carInfo->key_id = $this->encryptstring($g->car_id);
                $g->carInfo->country_name = Country::find($g->carInfo->country_id)?Country::find($g->carInfo->country_id)->name:'';
                $g->carInfo->country_sortname = Country::find($g->carInfo->country_id)?strtolower(Country::find($g->carInfo->country_id)->sortname):'';
                $g->carInfo->is_like = UserWatching::where("car_id",$g->carInfo->id)->where("user_id",Auth::id())->first()?1:0;
             }
        }
        
        return view("front.my_watch",compact("setting","country","get_my_watch"));
    }

    public function show_my_listing(){
        if(empty(Auth::id())){
            return redirect()->route('home');
        }
        $setting = Setting::find(1);
        $country = Country::all();
        Session::put("menu_active",'4');
        $getmycarall = CarInfo::whereNull('deleted_at')->where("is_approve",'1')->where("user_id",Auth::id())->get();
        foreach($getmycarall as $g){
                $g->key_id = $this->encryptstring($g->id);
                $g->country_name = Country::find($g->country_id)?Country::find($g->country_id)->name:'';
                $g->country_sortname = Country::find($g->country_id)?strtolower(Country::find($g->country_id)->sortname):'';
                $g->is_like = UserWatching::where("car_id",$g->id)->where("user_id",Auth::id())->first()?1:0;
        }
        return view("front.my_listing",compact("setting","country","getmycarall"));
    }

    public function show_my_details(){
        if(empty(Auth::id())){
            return redirect()->route('home');
        }
        $setting = Setting::find(1);
        $country = Country::all();
        Session::put("menu_active",'4');
        return view("front.my_details",compact("setting","country"));
    }

    public function show_billing(){
        if(empty(Auth::id())){
            return redirect()->route('home');
        }
        $setting = Setting::find(1);
        $country = Country::all();
        Session::put("menu_active",'4');
        $invoicedata = UserInvoiceAddress::where("user_id",Auth::id())->first();
        $billingdata = UserPaymentMethod::where("user_id",Auth::id())->first();
        $request_removecard = Removecard::where("user_id",Auth::id())->first()?1:0;
        $state_data_invoice= array();
        $city_data_invoice = array();
       

        $state_data_pay= array();
        $city_data_pay = array();
        
        $setting = Setting::find(1);
        $card_data = array();
        $month ="";
        $year = "";
        $last4 = "";
        $brand = "";
        if(isset($billingdata)){
             try{
                             $stripe = new \Stripe\StripeClient($setting->stripe_secret);
                            $card_data = $stripe->customers->allSources(
                                  $billingdata->stripe_customer_id,
                                  ['object' => 'card', 'limit' => 3]
                                );
                                
                                $month = $card_data['data'][0]['exp_month'];
                                $year = $card_data['data'][0]['exp_year'];
                                $last4 = $card_data['data'][0]['last4'];
                                $brand = $card_data['data'][0]['brand'];
                           
                    } catch (\Stripe\Exception\RateLimitException $e) {
                         /* Session::flash('message', $e->getMessage()); 
                          Session::flash('alert-class', 'alert-danger');
                          return redirect()->back();*/
                    } catch (\Stripe\Exception\InvalidRequestException $e) {
                         /* Session::flash('message', $e->getMessage()); 
                          Session::flash('alert-class', 'alert-danger');
                          return redirect()->back();*/
                    } catch (\Stripe\Exception\AuthenticationException $e) {
                         /* Session::flash('message', $e->getMessage()); 
                          Session::flash('alert-class', 'alert-danger');
                          return redirect()->back();*/
                    } catch (\Stripe\Exception\ApiConnectionException $e) {
                         /* Session::flash('message', $e->getMessage()); 
                          Session::flash('alert-class', 'alert-danger');
                          return redirect()->back();*/
                    } catch (\Stripe\Exception\ApiErrorException $e) {
                       /*   Session::flash('message', $e->getMessage()); 
                          Session::flash('alert-class', 'alert-danger');
                          return redirect()->back();*/
                    } catch (Exception $e) {
                        /*  Session::flash('message', $e->getMessage()); 
                          Session::flash('alert-class', 'alert-danger');
                          return redirect()->back();*/
                   }
           

        }
        
        return view("front.billing",compact("setting","country","invoicedata","state_data_invoice","city_data_invoice","state_data_pay","city_data_pay","billingdata","month","year","last4","brand",'request_removecard'));
    }

    public function user_logout(){
        Auth::logout();
        return redirect()->route('home');
    }


    public function show_news_details(Request $request){
        try{
                $setting = Setting::find(1);
                $country = Country::all();
                $data = SpotLight::find($this->decyptstring($request->get("id")));
                $id = $request->get("id");
                $spotLight = SpotLight::take(3)->orderby("id","DESC")->get();
                foreach($spotLight as $sl){
                    $sl->query_id = $this->encryptstring($sl->id);
                }
                $filels = "";
                if($data){
                        $file_name = storage_path("app/public/newsfiles").'/'.$data->description;
                        $myfile = fopen($file_name, "r");
                        $filels= fread($myfile,filesize($file_name));
                        fclose($myfile);
                }
                $data->filels = $filels;
                Session::put("menu_active",'3');
                return view("front.news_detail",compact("setting","country","data","id","spotLight"));
        }catch(Exception $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng"); 
                Session::flash('alert-class', 'alert-danger');
                 return redirect()->route('home');
        }catch (DecryptException $e) {
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng"); 
                Session::flash('alert-class', 'alert-danger');
                 return redirect()->route('home');
        }catch (\Illuminate\Database\QueryException $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng"); 
                Session::flash('alert-class', 'alert-danger');
                 return redirect()->route('home');
        } 
        
    }

    public function show_spotlight(){
        $setting = Setting::find(1);
        $country = Country::all();
        $data = SpotLight::orderby("id","DESC")->get();
        foreach($data as $sl){
            $sl->query_id = $this->encryptstring($sl->id);
        }
         Session::put("menu_active",'3');
        
        return view("front.news",compact("setting","country","data"));
    }

    public function sell_with_us(){
        $setting = Setting::find(1);
        $country = Country::all();
        $make_list = Make::all();
         Session::put("menu_active",'2');
        return view("front.sell_with_us",compact("setting","country","make_list"));
    }

    public function post_newsletter_user(Request $request){
        $news = Subscriber::where("email",$request->get("email"))->first();
        if(empty($news)){
            $store = new Subscriber();
            $store->email = $request->get("email");
            $store->save();
        }
        return 1;
    }

    public function sell_your_vehicle(){
        $setting = Setting::find(1);
        $country = Country::all();
         Session::put("menu_active",'2');
        return view("front.sell_your_vehicle",compact("setting","country"));
    }

    public function vehicle_detail(Request $request){
     try{
                $id = $this->decyptstring($request->get("query"));
              
                $make_data = Make::whereNull('deleted_at')->get();
                $data = CarInfo::find($id);
                $country = Country::all();
                $currency = Currency::all();
                $setting = Setting::find(1);
                $city_data = array();
                views($data)->record();
                if(isset($data)){
                    $data->exterior = CarExterior::where("car_id",$id)->first();
                    $data->make_id = Make::find($data->make_id)?Make::find($data->make_id)->name:'';
                    $data->country_id = Country::find($data->country_id)?Country::find($data->country_id)->name:'';
                    $data->city_id = City::find($data->city_id)?City::find($data->city_id)->name:'';
                    $data->exteriormedia = CarMedia::where("car_id",$id)->where("type",'1')->get();
                    $data->interior = CarInterior::where("car_id",$id)->first();
                    $data->interiormedia = CarMedia::where("car_id",$id)->where("type",'2')->get();
                    $data->mechanics = CarMechanics::where("car_id",$id)->first();
                    $data->mechanicsmedia = CarMedia::where("car_id",$id)->where("type",'3')->get();
                    $data->history = CarHistory::where("car_id",$id)->first();
                    $data->historymedia = CarMedia::where("car_id",$id)->where("type",'4')->get();
                    $data->historydata =  CarsHistoryData::where("car_id",$id)->get();
                    $data->videodata = CarMedia::where("car_id",$id)->where("type",'5')->get();
                    $data->user_name = User::find($data->user_id)?User::find($data->user_id)->username:'';
                    $data->is_like = UserWatching::where("car_id",$data->id)->where("user_id",Auth::id())->first()?1:0;
                    $data->reserve_met = 2;

                    $str = explode("-",$data->currency);
                    $data->currency_symbol = isset($str[1])?$str[1]:'';
                    $data->bid_price = 0;
                    if(isset($data->price)&&$data->current_bid_id!=""){
                        
                        $data->bid_price = Comment::find($data->current_bid_id)?Comment::find($data->current_bid_id)->amount:$data->price;
                    }
                    $data->totalViews = views($data)->unique()->count();                    
                    $data->Comment = Comment::where('car_id',$data->id)->get();
                    foreach($data->Comment as $dc){
                           if($dc->type==2){
                                    date_default_timezone_set('Asia/Calcutta');
                                    $datetime = new DateTime($dc->datetime);
                                    if(!empty(Session::get('timezone'))){
                                        $la_time = new DateTimeZone(Session::get('timezone'));
                                        $datetime->setTimezone($la_time);
                                        $dc->datetime = $datetime->format('Y-m-d H:i');
                                    }                                    
                           }                          
                    }
                    if($data->status==1){

                            date_default_timezone_set('Asia/Calcutta');
                            $datetime = new DateTime($data->aucation_enddate." ".$data->aucation_endtime);
                            if(!empty(Session::get('timezone'))){
                                $la_time = new DateTimeZone(Session::get('timezone'));
                                $datetime->setTimezone($la_time);
                                $data->livedatetime = $datetime->format('Y-m-d H:i');

                            } 
                    }
                   



                    $bid_price = str_replace(",","",$data->bid_price);
                    if($data->reserve_price<=$bid_price){
                        $data->reserve_met = 1;
                    }
                    else{
                        $minus = $data->reserve_price-$bid_price;
                        if($minus<=1000){
                            $data->reserve_met = 3;
                        }else{
                            $data->reserve_met = 2;
                        }                        
                    }
                    
                    foreach($data->Comment as $dc){
                        $dc->username = User::find($dc->user_id)?User::find($dc->user_id)->username:'';
                        $ls = User::find($dc->user_id);
                        if($ls){
                             if($ls->image==""){
                                 $dc->image = asset('storage/app/public/profile/user-thumb.jpg');
                             }else{
                                 $dc->image = asset('storage/app/public/profile').'/'.$ls->image;
                             }
                        }else{
                            $dc->image = asset('storage/app/public/profile/user-thumb.jpg');
                        }
                    }
                }

               

                if(Auth::id()){
                    Session::put("menu_active",'4');
                }else{
                    Session::put("menu_active",'5');
                }
                $is_payment_added  = UserPaymentMethod::where("user_id",Auth::id())->first()?1:0;
                return view("front.vehicle_detail",compact("setting","country","data","id","make_data",'is_payment_added'));
        }catch(Exception $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng"); 
                Session::flash('alert-class', 'alert-danger');
                 return redirect()->route('home');
        }catch (DecryptException $e) {
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng"); 
                Session::flash('alert-class', 'alert-danger');
                 return redirect()->route('home');
        }catch (\Illuminate\Database\QueryException $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something Getting Worng"); 
                Session::flash('alert-class', 'alert-danger');
                 return redirect()->route('home');
        } 
        
    }

    public function get_txt(Request $request){
        $txt = Setting::find(1)?Setting::find(1)->txt_charge:'0';
        if($txt!=0){
            $per = $txt*$request->get('bid_amount');
            return $per/100;
        }
        return 0;
    }

    public function fetch_visitor(Request $request){
        $data = CarInfo::find($request->get('car_id'));
        if(isset($data)){
            $views = views($data)->unique()->count();
            $bid_amount = Comment::find($data->current_bid_id)?Comment::find($data->current_bid_id)->amount:0;
           
            $current_amount = str_replace(",","",$bid_amount);
            if($current_amount<=10000){
                $getgap = BidGaps::find(1);
                $minmum_amount = $current_amount+$getgap->gap;
            }else{
                $getgap = BidGaps::find(2);
                $minmum_amount = $current_amount+$getgap->gap;
            }
            $bid_price = str_replace(",","",$bid_amount);
                    if($data->reserve_price<=$bid_price){
                        $reserve_met = 1;
                    }
                    else{
                        $minus = $data->reserve_price-$bid_price;
                        if($minus<=1000){
                            $reserve_met = 3;
                        }else{
                            $reserve_met = 2;
                        }                        
                    }
            $arr = array("views"=>$views,"bid_amount"=>$bid_amount,'minmum_amount_next_bid'=>$minmum_amount,"reserve_met"=>$reserve_met);          
            return json_encode($arr);
        }else{
            return 0;
        }
    }

    public function post_check_username(Request $request){
        $getuser = User::where("username",$request->get("username"))->where("id","!=",Auth::id())->first();        
        if($getuser){
            return 1;
        }else{
            return 0;
        }       
    }
    
    public function add_live_bid(Request $request){
        if($request->get("type")==1){
            $store = new Comment();
            $store->car_id = $request->get("car_id");
            $store->user_id = Auth::id();
            $store->datetime = $this->getsitedatecomment();
            $store->amount = $request->get("bid_amount");
            $store->type = 1;
            $store->save();
            CarInfo::where("id",$request->get("car_id"))->update(["current_bid_id"=>$store->id]);
            $getmaxbid = MaxBid::where("car_id",$request->get("car_id"))->get();
            foreach($getmaxbid as $ge){
                
                $get_current_bid = Comment::where("car_id",$request->get("car_id"))->orderby('id','DESC')->where("type",1)->first();
                if($get_current_bid){
                    $current_amount = str_replace(",","",$get_current_bid->amount);
                    if($current_amount<=10000){
                        $getgap = BidGaps::find(1);
                        $minmum_amount = $current_amount+$getgap->gap;
                    }else{
                        $getgap = BidGaps::find(2);
                        $minmum_amount = $current_amount+$getgap->gap;
                    }
                    $max_bid_amount = str_replace(",","",$ge->amount);
                    if($max_bid_amount>$minmum_amount){
                        $store = new Comment();
                        $store->car_id = $request->get("car_id");
                        $store->user_id = Auth::id();
                        $store->datetime = $this->getsitedatecomment();
                        $store->amount = number_format($minmum_amount);
                        $store->type = 1;
                        $store->save();
                        CarInfo::where("id",$request->get("car_id"))->update(["current_bid_id"=>$store->id]);
                    }
                }
                
            }
            return Auth::user()->username;
        }
        if($request->get("type")==2){
            $store = MaxBid::where("car_id",$request->get("car_id"))->where("user_id",Auth::id())->first();
            if(empty($store)){
                $store = new MaxBid();
            }
            $store->car_id = $request->get("car_id");
            $store->user_id = Auth::id();
            $store->amount = $request->get("bid_amount");
            $store->status = 0;
            $store->save();
            $get_current_bid = Comment::where("car_id",$request->get("car_id"))->orderby('id','DESC')->where("type",1)->first();
                if($get_current_bid){
                $current_amount = str_replace(",","",$get_current_bid->amount);
                if($current_amount<=10000){
                    $getgap = BidGaps::find(1);
                    $minmum_amount = $current_amount+$getgap->gap;
                }else{
                    $getgap = BidGaps::find(2);
                    $minmum_amount = $current_amount+$getgap->gap;
                }
                $store = new Comment();
                $store->car_id = $request->get("car_id");
                $store->user_id = Auth::id();
                $store->datetime = $this->getsitedatecomment();
                $store->amount = number_format($minmum_amount);
                $store->type = 1;
                $store->save();
                CarInfo::where("id",$request->get("car_id"))->update(["current_bid_id"=>$store->id]);
            }
            return Auth::user()->username;
        }
    }

    public function check_email(Request $request){
        $getuser = User::where("email",$request->get("email"))->where("id","!=",Auth::id())->first();        
        if($getuser){
            return 1;
        }else{
            return 0;
        } 
    }

    public function check_user_pwd(Request $request){
        if(Hash::check($request->get("password"),Auth::user()->password)){
            return 1;
        }else{
            return 0;
        }
    }
    
    public function add_book_Car(Request $request){
        if(Auth::id()){
            $user = UserWatching::where("car_id",$request->get("id"))->where("user_id",Auth::id())->first();
            if($user){
                $user->delete();
                return 0;
            }else{
                $store = new UserWatching();
                $store->user_id = Auth::id();
                $store->car_id = $request->get("id");
                $store->save();
                return 1;
            }
        }else{
            return 0;
        }
    }
    
    public function add_comment(Request $request){
        $store = new Comment();
        $store->car_id = $request->get("car_id");
        $store->user_id = Auth::id();
        $store->datetime = $this->getsitedatecomment();
        $store->comment = $request->get("desc");
        $store->type = 2;
        $store->save();
        
        $txt = '<li class="chat-bg-color" style=""><div class="chat-box"><div class="img-holder"><img src="'.asset('storage/app/public/profile').'/'.Auth::user()->image.'"></div><div class="chatt-innter-content"><span>'.Auth::user()->username.'</span><p>'.$request->get("desc").'</p><p class="time-show">2 days ago</p></div></div>';
        return $txt;
    }

    public function update_my_detail(Request $request){
        $getUser = User::where("username",$request->get("username"))->where("id","!=",Auth::id())->first();
        if(empty($getUser)){
            $user = Auth::user();
            $user->username = $request->get("username");
            if($request->file("file")){
                if($user->image!=""){
                    $this->removeImage(storage_path("app/public/profile").'/'.$user->image);
                }             
                $user->image = $this->fileuploadFileImage($request,'profile','file');
            }
            $user->save();
            return 1;
        }else{
            return 0;
        }
           
            
    }

    public function update_my_password(Request $request){
        $user=Auth::user();
        if (Hash::check($request->get('cpwd'), $user->password))
            {
                $user->password = Hash::make($request->get("npwd"));
                $user->save();
                return 1;
        }
        else{
               return 0;
        }
    }

    public function emailsubscription(Request $request){
        $user = Auth::user();
        $user->promotions_email_notification = $request->get("promotions_email_notification");
        $user->trade_news_email_notification = $request->get("trade_news_email_notification");
        $user->save();
        return 1;
    }

    public function notificationuser(Request $request){
        $user = Auth::user();
        $user->outbid_sms_notification = $request->get("outbid_sms_notification");
        $user->watcher_comment_notification = $request->get("watcher_comment_notification");
        $user->save();
        return 1;
    }

    public function forgotpassword(Request $request){
        $get_user=User::where("email",$request->get("email"))->first();
        if($get_user){
                $code=mt_rand(100000, 999999);                
                $get_user->code=$this->encryptstring($code);
                $add = new ResetPassword();
                $add->user_id=$get_user->id;
                $add->code=$code;
                $add->save();
               try {
                        Mail::send('email.forgotpassword', ['user' => $get_user], function($message) use ($get_user){
                                $message->to($get_user->email,$get_user->username)->subject('Curating Cars');
                        });
               } catch (\Exception $e) {
                }
                return 1; 
        }else{
                return 0; 
        }       
    }

    
     public function show_reset_password(Request $request){ 
            $setting = Setting::find(1);
            $country = Country::all();
            try{
                
               $data=ResetPassword::where("code",$this->decyptstring($request->get("code")))->first();
            }catch (DecryptException $e) {
                \Log::info($e->getMessage());
                
                return redirect()->route('page_not_found');
            }
            if($data){
              $code = $request->get("code");
              return view('front.resetpwd',compact("code","data","setting","country"));
            }else{
                $msg = 'Reset Code Expired You Need Reset Again';
              return view('front.resetpwd',compact("msg","setting","country"));
            }
      }
      public function reset_new_password(Request $request){
            $setting = Setting::find(1);
            $country = Country::all();
            if($request->get('id')==""){
                $msg = "Reset Code Expired You Need Reset Again";
                return 0;
            }else{     
                    $msg = "Your Password Reset Successfully";           
                    $user=User::find($request->get('id'));               
                    $user->password= Hash::make($request->get('npwd'));
                    $user->save();
                    $codedel=ResetPassword::where('user_id',$request->get("id"))->delete();
                    return 1;
            }
      }



   

}
