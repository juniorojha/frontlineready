<?php

namespace App\Console\Commands;
use App\Models\CarInfo;
use App\Models\Car;
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
use Mail;
class LiveAuction extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'live:auction';

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
        $getlivecars = Car::where("status",'1')->whereDate('end_date', $date)->whereTime('end_date','<=',$time)->get();
       
        if(count($getlivecars)>0){
            foreach($getlivecars as $g){
                $getcomment = Comment::find($g->current_bid_id);
                if($getcomment){                    
                    $g->status = 4;
                    $g->sold_date = date('Y-m-d');
                    $g->total_bid = count(Comment::where("car_id",$g->id)->where("type",'1')->get());                                       
                    $g->winning_bid = $getcomment->amount;
                    $g->save();
                    $g->email = $setting->email;
                    $g->username = "Front Line Ready";
                    $g->bid_amount = $g->winning_bid;
                    $g->stock = $g->stock;
                    $g->current_bid_name = User::find($g->current_bid_id)?User::find($g->current_bid_id)->name:'';
                    Mail::send('email.live_auction', ['user' => $g], function($message) use ($g){
                        $message->to($g->email,$g->username)->subject('Front Line Ready');
                    });
                    \Log::info("bid save");
                }
            }
        }
       // $this->log("success");
       \Log::info("Cron is working fine!");
       
       $getlivecars = Car::where("status",'2')->whereDate('start_date',"<=",$date)->whereTime('start_date','>=',$time)->get();
       //echo "<pre>";print_r($getlivecars);exit;
       foreach($getlivecars as $g){
           $g->status = 1;
           $g->save();
       }
        \Log::info("Live Car change fine!");
    }

    public function getsitedate(){
            $setting=Setting::find(1);
            date_default_timezone_set('Asia/Calcutta');   
            return date('d-m-Y h:i:s');                    
    }

    
}
