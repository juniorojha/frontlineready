<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\Country;
use App\Models\Car;
use App\Models\Make;
use DataTables;
use Session;
use DB;
use Mail;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Exceptions\Handler;
use Log;
class SearchCarsController extends Controller
{
    
    public function searchcars(Request $request){
        $data = array();
        if($request->get("search_cars")!=""){
            
            $data = Car::select("cars.*")
                ->join("makes","makes.id","=","cars.make")
                ->orWhere('makes.name', 'like', '%' . $request->get("search_cars") . '%')
                ->orWhere('cars.stock', 'like', '%' . $request->get("search_cars") . '%')
                ->orWhere('cars.model', 'like', '%' . $request->get("search_cars") . '%')
                ->orWhere('cars.year', 'like', '%' . $request->get("search_cars") . '%')
                ->whereNull('cars.deleted_at')
                ->get();


            //$data = Car::orWhere('stock', 'like', '%' . $request->get("search_cars") . '%')->orWhere('model', 'like', '%' . $request->get("search_cars") . '%')->orWhere('year', 'like', '%' . $request->get("search_cars") . '%')->whereNull('deleted_at')->get();
        }else{                
                $query = Car::query();               
                $data = $query->whereNull('deleted_at')->get();                
        }
        if(count($data)>0){
                $livecount = 0;
                $comingcount = 0;
                $soldcount = 0;
                $livetxt = "";
                $comingtxt = "";
                $soldtxt = "";
                foreach($data as $gc){
                    $gc->make = Make::find($gc->make)?Make::find($gc->make)->name:'';
                    if($gc->status==1){
                        $livecount++;
                        $livetxt = $livetxt.'<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"><div class="product-box"><div class="product-img-heading"><div class="attributes"><ul><li><p class="live">LIVE</p></li></ul></div><div class="img-hold"><a href="'.route('vehicle-detail',['query'=>$gc->key_id]).'"><img src="'.asset('storage/app/public/cars/banner').'/'.$gc->thumbail.'"></a></div><div class="heading-hold"><a href="'.route('vehicle-detail',['query'=>$gc->key_id]).'"><h4>'.$gc->year.' | '.$gc->make.' | '.$gc->model.' | '.$gc->mileage.'</h4></a><ul class="icons-section"></ul></div></div><div class="product-content"></div><div class="product-shadow-box"><div class="timging-tage"><p>Ends In : <span id="end_time_'.$gc->id.'">';
                              
                                      $timestamp = date("Y-m-d H:i:s",strtotime($gc->end_date));
                                      $date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $timestamp, Session::get('current_timezone'));
                                      $new_date = $date->setTimezone('UTC');
                                      $date =  \Carbon\Carbon::parse($new_date)->format('Y-m-d');
                                      $time = \Carbon\Carbon::parse($new_date)->format('H:i:s');
                                      $date1 = $date." ".$time;
                              
                            $livetxt = $livetxt.'<script type="text/javascript">updateTimer(' . "'" . $date1. "'" . ',' . "'" . $gc->id. "'" . ');</script></span></p></div><div class="current-bids"><p>Current Bid: $ '.$gc->base_price.'</p></div></div></div></div>';
                    }
                    if($gc->status==2){
                       $comingcount++;
                       $comingtxt = $comingtxt.'<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"><div class="product-box"><div class="product-img-heading"> <div class="attributes"><ul><li><p class="live">Coming Soon</p></li></ul></div><div class="img-hold"><a href="'.route('vehicle-detail',['query'=>$gc->key_id]).'"><img src="'.asset('storage/app/public/cars/banner').'/'.$gc->thumbail.'"></a></div><div class="heading-hold" style="    border: 1px solid black;padding: 7px;margin-bottom: 13px;"><a href="'.route('vehicle-detail',['query'=>$gc->key_id]).'"><h4>'.$gc->year.' | '.$gc->make.' | '.$gc->model.' | '.$gc->mileage.'</h4></a><ul class="icons-section"></ul></div></div></div></div>';
                    }
                    
                    if($gc->status==4){
                       $soldcount++;
                       $soldtxt = $soldtxt.'<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"><div class="product-box"><div class="product-img-heading"> <div class="attributes"><ul><li><p class="live">Coming Soon</p></li></ul></div><div class="img-hold"><a href="'.route('vehicle-detail',['query'=>$gc->key_id]).'"><img src="'.asset('storage/app/public/cars/banner').'/'.$gc->thumbail.'"></a></div><div class="heading-hold" style="    border: 1px solid black;padding: 7px;margin-bottom: 13px;"><a href="'.route('vehicle-detail',['query'=>$gc->key_id]).'"><h4>'.$gc->year.' | '.$gc->make.' | '.$gc->model.' | '.$gc->mileage.'</h4></a><ul class="icons-section"></ul></div></div></div></div>';
                    }
               }
        }else{
                $livecount = 0;
                $comingcount = 0;
                $soldcount = 0;
                $livetxt = '<h1>No Result Found</h1>';
                $comingtxt = '<h1>No Result Found</h1>';
                $soldtxt = '<h1>No Result Found</h1>';
        }
        $arr = array("livecount"=>$livecount,"comingcount"=>$comingcount,"soldcount"=>$soldcount,"livetxt"=>$livetxt,"comingtxt"=>$comingtxt,"soldtxt"=>$soldtxt);
        return json_encode($arr);
    }
   

}
