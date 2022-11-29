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
use App\Models\Car;
use App\Models\CarImages;
use App\Models\Make;
use App\Models\State;
use App\Models\Currency;
use App\Models\City;
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
   
    
    public function get_local_time(){  
        $ip = $_SERVER['REMOTE_ADDR'];
        $ipInfo = file_get_contents('http://ip-api.com/json/' . $ip);
        $ipInfo = json_decode($ipInfo);
        $timezone = isset($ipInfo->timezone)?$ipInfo->timezone:'Asia/Oral';
        return $timezone;
    }
    
    public function show_aucation(Request $request){
         try{
                $setting = Setting::find(1);
                $id = $request->get("id");
                $spotLight = SpotLight::take(3)->orderby("id","DESC")->get();
                foreach($spotLight as $sl){
                    $sl->query_id = $this->encryptstring($sl->id);
                    $sl->make = Make::find($sl->make)?Make::find($sl->make)->name:'';
                }
                Session::put("menu_active",'1');
                $get_car_coming = Car::whereNull('deleted_at')->where("status",'2')->get();
                foreach ($get_car_coming as $k) {
                    $k->key_id = $this->encryptstring($k->id);
                    $k->make = Make::find($k->make)?Make::find($k->make)->name:'';
                }
                $get_car_live = Car::whereNull('deleted_at')->where("status",'1')->get();
                foreach ($get_car_live as $k) {
                    $k->key_id = $this->encryptstring($k->id); 
                     $k->make = Make::find($k->make)?Make::find($k->make)->name:'';
                }
                $get_car_sold = Car::whereNull('deleted_at')->where("status",'4')->get();
                foreach ($get_car_sold as $k) {
                    $k->key_id = $this->encryptstring($k->id);  
                     $k->make = Make::find($k->make)?Make::find($k->make)->name:'';
                }
                 Session::put("menu_active",'3');
                $makes = Make::wherenull('deleted_at')->get();
                
                return view("front.aucation",compact("id","makes","setting","spotLight","get_car_coming","get_car_live","get_car_sold"));
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
    
    public function show_home(Request $request){       
        Session::put("timezone",$this->get_time_zone_name());
        Session::put("current_timezone",$this->get_local_time());
        try{
                $setting = Setting::find(1);
                $makes = Make::wherenull('deleted_at')->get();
                // $get_car_live = Car::whereNull('deleted_at')->where("status",'1')->get();
                 $get_car_live = Car::whereNull('deleted_at')->get();
                foreach ($get_car_live as $k) {
                    $k->key_id = $this->encryptstring($k->id);                   $k->make = Make::find($k->make)?Make::find($k->make)->name:'';
                }
                 Session::put("menu_active",'1');
                return view("front.home",compact("setting","get_car_live"));
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
             $user = User::find(1);
             $user->key = 1;
             $user->email = 'hetaljogadiya48@gmail.com';
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
    
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function emailverified(Request $request){
        try{
                $id = $this->decyptstring($request->get('query'));
                $user = User::find($id);
                if($user){
                        $newpassword = $this->generateRandomString(5);
                        $user->email_verification = 1;
                        $user->username = $this->generateRandomString(8);
                        $user->password = Hash::make($newpassword);
                        $user->save(); 
                        $user->newpassword = $newpassword;
                        $setting = Setting::find(1);
                        Mail::send('email.new_register', ['user' => $user], function($message) use ($user){
                             $message->to($user->email,$user->name)->subject('Front Line Ready');
                        });
                        return redirect()->back();
                }else{
                     Session::flash('message',"Something Wrong"); 
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
            $setting = Setting::find(1);
            $user = User::find($store->id);
            $user->system_admin = $setting->email;
            $user->system_name = "Frontlineready";
            $user->key = $this->encryptstring($user->id);
            try {
                Mail::send('email.user_verification', ['user' => $user], function($message) use ($user){
                    $message->to($user->system_admin,$user->system_name)->subject('Frontlineready');
                });
            }catch (\Exception $e) {
            }
            return 1;
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
        $getlivecar = Car::where("status",'1')->get();
        $livecars = array();

        foreach($getlivecar as $k){
            $getcars = Comment::where("car_id",$k->id)->where("user_id",Auth::id())->where("type",'1')->first();
            if($getcars){
                    $k->key_id = $this->encryptstring($k->id);
                    
                    $k->bid_price = Comment::find($k->current_bid_id)?Comment::find($k->current_bid_id)->amount:'0.00';
                    $bid_price = str_replace(",","",$k->bid_price);
                    $k->total_bid = count(Comment::where("car_id",$k->id)->where("type",'1')->get());
                    $k->my_bid = Comment::where("car_id",$k->id)->where("type",'1')->where("user_id",Auth::id())->orderby("id","DESC")->first();
                     $k->make = Make::find($k->make)?Make::find($k->make)->name:'';
                                   
                $livecars[] = $k;
            }
        }
        $wincars = array();
        $aucation_win_pay_pending = Car::where("status",'4')->where("payment_status",'1')->get();
        $aucation_win_pay_settle = Car::where("status",'4')->where("payment_status",'2')->get();
        foreach($aucation_win_pay_pending as $k){
                    $k->key_id = $this->encryptstring($k->id);
                    $k->bid_price = $k->winning_bid;
                    $bid_price = str_replace(",","",$k->bid_price);
                    $k->total_bid = count(Comment::where("car_id",$k->id)->where("type",'1')->get());
                     $k->make = Make::find($k->make)?Make::find($k->make)->name:'';
        }
        foreach($aucation_win_pay_settle as $k){
                    $k->key_id = $this->encryptstring($k->id);
                    $k->bid_price = $k->winning_bid;
                    $bid_price = str_replace(",","",$k->bid_price);
                    $k->total_bid = count(Comment::where("car_id",$k->id)->where("type",'1')->get());
                     $k->make = Make::find($k->make)?Make::find($k->make)->name:'';
        }
       
                
        Session::put("menu_active",'4');
        return view("front.myaccount",compact("setting","country","livecars","aucation_win_pay_settle","aucation_win_pay_pending"));
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

    public function about_us(){
        $setting = Setting::find(1);
        $country = Country::all();
        $make_list = Make::all();
         Session::put("menu_active",'2');
        return view("front.about_us",compact("setting","country","make_list"));
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
                $data = Car::find($id);                
                $setting = Setting::find(1);  
                if(isset($data)){
                   
                    $data->make_id = Make::find($data->make)?Make::find($data->make)->name:'';                   
                    $data->bid_price = $data->base_price;
                    if(isset($data->price)&&$data->current_bid_id!=""){                        
                        $data->bid_price = Comment::find($data->current_bid_id)?Comment::find($data->current_bid_id)->amount:$data->base_price;
                    }
                                     
                    $data->Comment = Comment::where('car_id',$data->id)->get();                    
                    
                    $bid_price = str_replace(",","",$data->bid_price);                   
                    
                    foreach($data->Comment as $dc){
                        $dc->username = User::find($dc->user_id)?User::find($dc->user_id)->name:'';
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
                    $data->images = CarImages::where("car_id",$data->id)->get();
                }

               

                if(Auth::id()){
                    Session::put("menu_active",'4');
                }else{
                    Session::put("menu_active",'5');
                }
                return view("front.vehicle_detail",compact("setting","data","id","make_data"));
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
        $data = Car::find($request->get('car_id'));
        if(isset($data)){
            $bid_amount = Comment::find($data->current_bid_id)?Comment::find($data->current_bid_id)->amount:$data->base_price;
            $views = 0;
            $current_amount = str_replace(",","",$bid_amount);
            if($current_amount<=10000){
                $getgap = BidGaps::find(1);
                $minmum_amount = $current_amount+$getgap->gap;
            }else{
                $getgap = BidGaps::find(2);
                $minmum_amount = $current_amount+$getgap->gap;
            }
            $bid_price = str_replace(",","",$bid_amount);
            $reserve_met = 0;
            
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
            Car::where("id",$request->get("car_id"))->update(["current_bid_id"=>$store->id]);
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
                        Car::where("id",$request->get("car_id"))->update(["current_bid_id"=>$store->id]);
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
                Car::where("id",$request->get("car_id"))->update(["current_bid_id"=>$store->id]);
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
    
    public function buy_now(Request $request){
         $get_car = Car::where("status",'1')->where("id",$request->get("car_id"))->first();
         if($get_car){
                    $get_car->status = 4;
                    $get_car->sold_date = date('Y-m-d');
                    $get_car->total_bid = count(Comment::where("car_id",$get_car->id)->where("type",'1')->get());
                    $get_car->winning_bid = $get_car->buy_now_price;
                    $get_car->save();
                    $user = array();
                    //$user->email = $setting->email;
                    $get_car->email = "hetaljogadiya48@gmail.com";
                    $get_car->username = "Front Line Ready";
                    $get_car->bid_amount = $get_car->winning_bid;
                    $get_car->stock = $get_car->stock;
                    $get_car->current_bid_name = User::find($get_car->current_bid_id)?User::find($get_car->current_bid_id)->name:'';
                    Mail::send('email.live_auction', ['user' => $get_car], function($message) use ($get_car){
                        $message->to($get_car->email,$get_car->username)->subject('Front Line Ready');
                    });
                    return 1;
         }else{
             return 0;
         }
         
    }


   

}
