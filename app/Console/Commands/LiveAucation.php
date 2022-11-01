<?php

namespace App\Console\Commands;
use App\Models\CarInfo;
use Illuminate\Console\Command;
use App\Models\Setting;
use App\Models\payment_history;
use DateTime;
use DateTimeZone;
use Stripe\Stripe;
use Stripe\Charge;
use App\Models\UserPaymentMethod;
use App\Models\Comment;
use Log;
use Carbon\Carbon;
class LiveAucation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'live:aucation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
       
        $setting=Setting::find(1);
        $timestamp = \Carbon\Carbon::now()->setTimezone('UTC');
        $date = Carbon::parse($timestamp)->format('Y-m-d');
        $time = Carbon::parse($timestamp)->format('H:i');
        $getlivecars = CarInfo::where("status",'1')->whereDate('aucation_enddate', $date)->whereTime('aucation_endtime','<=',$time)->get();
       
        if(count($getlivecars)>0){
            foreach($getlivecars as $g){
                $getcomment = Comment::find($g->current_bid_id);
                if($getcomment){
                       
                        $setting = Setting::find(1);
                        $txt = Setting::find(1)?Setting::find(1)->txt_charge:'0';
                        $getpaymentdata = UserPaymentMethod::where("user_id",$getcomment->user_id)->first();
                        $str = explode("-",$g->currency);
                        $currency_symbol = isset($str[0])?trim(strtolower($str[0])):'usd';
                        $per = $txt*str_replace(',', '', $getcomment->amount);
                        
                       
                                    
                                     
                                        $store = new payment_history();
                                        $store->car_id = $g->id;
                                        $store->buyer_id = $getcomment->user_id;
                                        $store->transaction_id = '';
                                        $store->transaction_id = "";
                                        $store->amount = ($per/100);
                                        $store->currency = isset($str[1])?trim(strtolower($str[1])):'$';
                                        $store->status =1;
                                        $store->save();
                                        $g->status = 4;
                                        $g->sold_date = date('Y-m-d');
                                        $g->total_bid = count(Comment::where("car_id",$g->id)->where("type",'1')->get());
                                       
                                        $g->winning_bid = $getcomment->amount;
                                        $g->save();
                                         \Log::info("bid save");
                                       
                      
                }
            }
        }
       // $this->log("success");
       \Log::info("Cron is working fine!");
    }

    public function getsitedate(){
            $setting=Setting::find(1);
            date_default_timezone_set('Asia/Calcutta');   
            return date('d-m-Y h:i:s');                    
    }

    
}
