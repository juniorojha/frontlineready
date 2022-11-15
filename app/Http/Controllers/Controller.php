<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Storage;
use DateTime;
use Illuminate\Support\Facades\Crypt;
use DateTimeZone;
use App\Models\Setting;
use Session;
use Carbon\Carbon;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function get_local_time(){  
        $ip = $_SERVER['REMOTE_ADDR'];
        $ipInfo = file_get_contents('http://ip-api.com/json/' . $ip);
        $ipInfo = json_decode($ipInfo);
        $timezone = isset($ipInfo->timezone)?$ipInfo->timezone:'Asia/Kolkata';
        return $timezone;
    }
    
    public function __construct(){
        Session::put("timezone",$this->get_time_zone_name());
        Session::put("current_timezone",$this->get_local_time());
    }
    protected function removeImage($image_path)
    {
       
        if(file_exists($image_path)){
            unlink($image_path);
        }        
    }

    public function encryptstring($val){
        return Crypt::encryptString($val);
    }

    public function decyptstring($val){
        return Crypt::decryptString($val);
    }

    public function fileuploadFileImage(Request $request, $uploadFolderName, $inputFileName){

        $image     = $request->file($inputFileName);
        $filename = $image->getClientOriginalName();
        $extension = $image->getClientOriginalExtension() ?: 'png';               
        $picture = rand().time() . '.' . $extension;
        $destinationPath = Storage_path("app/public/").$uploadFolderName;
        $request->file($inputFileName)->move($destinationPath, $picture);
        return $picture;
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

     public function get_time_zone_name(){
         $setting=Setting::find(1);
            $date_zone=array();
            $timezone=$this->generate_timezone_list();
                foreach($timezone as $key=>$value){
                      if($setting->timezone==$key){
                              $date_zone=$value;
                      }
                }
            return $date_zone;  
     }
     
      public function getsitedatecomment(){
            $timestamp = \Carbon\Carbon::now()->setTimezone(Session::get('timezone'));
            $date = Carbon::createFromFormat('Y-m-d H:i:s', $timestamp,Session::get('timezone'));
            $date->setTimezone('UTC');
            return Carbon::parse($date)->format('Y-m-d H:i:s'); 
     }

      public function getsitedateonly(){
            $setting=Setting::find(1);
            $date_zone=array();
            $timezone=$this->generate_timezone_list();
                foreach($timezone as $key=>$value){
                      if($setting->timezone==$key){
                              $date_zone=$value;
                      }
                }
            date_default_timezone_set($date_zone);   
            return date('Y-m-d');                    
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
