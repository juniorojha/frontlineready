<?php

namespace App\Console\Commands;
use App\Models\CarImages;
use App\Models\Car;
use App\Models\Make;
use Illuminate\Console\Command;
use DateTime;
use DateTimeZone;
use Log;
use Carbon\Carbon;
use App\Models\Setting;
use Mail;
class CarRead extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'car:read';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import csv data on car tables';

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
        \Log::info("Car CSV Read Cron is Start!");
        \Log::info("Sync started at ".$start_date_time);
        \Log::info("Total number of records ".$total_record);
        foreach($duplicate_record as $d){
            \Log::info($d);
        }
        \Log::info($new_record."records processed successfully.");
        foreach($update_record as $d){
            \Log::info('Records with stock numbers '.$d.' already existed and were updated');
        }
        \Log::info("0 records failed. Details above.");
        \Log::info("Car CSV Read Cron End!");
      
    }

    public function getsitedate(){
            $setting=Setting::find(1);
            $date_zone=array();
            $timezone=$this->generate_timezone_list();
                foreach($timezone as $key=>$value){
                      if($setting->timezone==$key){
                              $date_zone=$value;
                      }
                }
            date_default_timezone_set($date_zone); 
            return date('d-m-Y h:i:s');                       
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
                          $timezone_list[] = "$timezone";
                 }

                 return $timezone_list;
                ob_end_flush();
       }

       public function gettimezonename($timezone_id){
              $getall=$this->generate_timezone_list();
              foreach ($getall as $k=>$val) {
                 if($k==$timezone_id){
                     return $val;
                 }
              }
       }

    
}
