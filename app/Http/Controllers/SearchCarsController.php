<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\Country;
use App\Models\CarInfo;
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
            $data = CarInfo::Where('name', 'like', '%' . $request->get("search_cars") . '%')->whereNull('deleted_at')->where("is_approve",'1')->get();
        }else if($request->get("search_cars")==""&&$request->get("makelist")==""&&$request->get("sellertype")==""&&$request->get("country_list")==""&&$request->get("steering_position")==""){
                $data = CarInfo::whereNull('deleted_at')->where("is_approve",'1')->get();
        }else{
                $makelist = explode(",",$request->get("makelist"));
                $sellertype = explode(",",$request->get("sellertype"));
                $country_list = explode(",",$request->get("country_list"));
                $steering_position = explode(",",$request->get("steering_position"));
                $query = CarInfo::query();
                if ($request->get("makelist")!="") {
                  $query = $query->whereIn('make_id', $makelist);
                }
                if ($request->get("sellertype")!="") {
                  $query = $query->whereIn('seller_type', $sellertype);
                }
                if ($request->get("country_list")!="") {
                  $query = $query->whereIn('country_id', $country_list);
                }
                if ($request->get("steering_position")!="") {
                  $query = $query->whereIn('steering_position', $steering_position);
                }
                $data = $query->whereNull('deleted_at')->where("is_approve",'1')->get();
                
        }
        if(count($data)>0){
                $livecount = 0;
                $comingcount = 0;
                $privatecount = 0;
                $soldcount = 0;
                $livetxt = "";
                $comingtxt = "";
                $privatetxt = "";
                $soldtxt = "";
                foreach($data as $gc){
                    $gc->country_name = Country::find($gc->country_id)?Country::find($gc->country_id)->name:'';
                    $gc->country_sortname = Country::find($gc->country_id)?strtolower(Country::find($gc->country_id)->sortname):'';
                    if($gc->status==1){
                        $livecount++;
                        $livetxt = $livetxt.'<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><div class="product-box"><div class="product-img-heading"><div class="attributes"><ul><li><p class="live">LIVE</p></li></ul></div><div class="img-hold"><a href="'.route('vehicle-detail',['query'=>$gc->key_id]).'"><img src="'.asset('storage/app/public/cars/banner').'/'.$gc->banner.'"></a></div><div class="heading-hold"><a href="'.route('vehicle-detail',['query'=>$gc->key_id]).'"><h4>'.$gc->name.'</h4></a><ul class="icons-section"><li><a href=""><i class="fas fa-bookmark"></i></a></li><li><a href=""><i class="fas fa-share-alt"></i></a></li></ul></div></div><div class="product-content"><p class="double-border">'.$gc->short_desc.'</p><span><p>'.$gc->year.'</p>|';
                        if($gc->steering_position==1){
                            $livetxt = $livetxt.'<p>LHD</p>';
                        }else{
                            $livetxt = $livetxt.'<p>RHD</p>';
                        } 
                        $livetxt = $livetxt.'|<p>'.$gc->country_name.' <img src="https://ipdata.co/flags/'.$gc->country_sortname.'.png"></p></span></div><div class="product-shadow-box"><div class="head-bg-color red"><p>RESERVE NOT MET</p></div><div class="timging-tage">
                           <p>Ends In : 10:12:37</p></div><div class="current-bids"><p>Current Bids : €20,000</p></div></div></div></div>';
                    }
                    if($gc->status==2){
                        $comingcount++;
                        $comingtxt = $comingtxt.'<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><div class="product-box"><div class="product-img-heading"><div class="attributes"><ul><li><p class="live">Coming Soon</p></li></ul></div><div class="img-hold"><a href="'.route('vehicle-detail',['query'=>$gc->key_id]).'"><img src="'.asset('storage/app/public/cars/banner').'/'.$gc->banner.'"></a></div><div class="heading-hold"><a href="'.route('vehicle-detail',['query'=>$gc->key_id]).'"><h4>'.$gc->name.'</h4></a><ul class="icons-section"><li><a href=""><i class="fas fa-bookmark"></i></a></li><li><a href=""><i class="fas fa-share-alt"></i></a></li></ul></div></div><div class="product-content"><p class="double-border">Fantastic Condition - Very Well Cared For</p><span><p>'.$gc->year.'</p>|';
                        if($gc->steering_position==1){
                            $comingtxt = $comingtxt.'<p>LHD</p>';
                        }else{
                            $comingtxt = $comingtxt.'<p>RHD</p>';
                        } 
                        $comingtxt = $comingtxt.'|<p>United State <img src="'.asset('public/theme/images/uniter-img.jpg').'"></p></span></div><div class="product-shadow-box"><div class="head-bg-color red"><p>RESERVE NOT MET</p></div><div class="timging-tage">
                           <p>Ends In : 10:12:37</p></div><div class="current-bids"><p>Current Bids : €20,000</p></div></div></div></div>';
                    }
                    if($gc->status==3){
                        $privatecount++;
                        $privatetxt = $privatetxt.'<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><div class="product-box"><div class="product-img-heading"><div class="attributes"><ul><li><p class="live">Private sales</p></li></ul></div><div class="img-hold"><a href="'.route('vehicle-detail',['query'=>$gc->key_id]).'"><img src="'.asset('storage/app/public/cars/banner').'/'.$gc->banner.'"></a></div><div class="heading-hold"><a href="'.route('vehicle-detail',['query'=>$gc->key_id]).'"><h4>'.$gc->name.'</h4></a><ul class="icons-section"><li><a href=""><i class="fas fa-bookmark"></i></a></li><li><a href=""><i class="fas fa-share-alt"></i></a></li></ul></div></div><div class="product-content"><p class="double-border">Fantastic Condition - Very Well Cared For</p><span><p>'.$gc->year.'</p>|';
                        if($gc->steering_position==1){
                            $privatetxt = $privatetxt.'<p>LHD</p>';
                        }else{
                            $privatetxt = $privatetxt.'<p>RHD</p>';
                        } 
                        $privatetxt = $privatetxt.'|<p>United State <img src="'.asset('public/theme/images/uniter-img.jpg').'"></p></span></div><div class="product-shadow-box"><div class="head-bg-color red"><p>RESERVE NOT MET</p></div><div class="timging-tage">
                           <p>Ends In : 10:12:37</p></div><div class="current-bids"><p>Current Bids : €20,000</p></div></div></div></div>';
                    }
                    if($gc->status==4){
                        $soldcount++;
                        $soldtxt = $soldtxt.'<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><div class="product-box"><div class="product-img-heading"><div class="attributes"><ul><li><p class="live">Sold</p></li></ul></div><div class="img-hold"><a href="'.route('vehicle-detail',['query'=>$gc->key_id]).'"><img src="'.asset('storage/app/public/cars/banner').'/'.$gc->banner.'"></a></div><div class="heading-hold"><a href="'.route('vehicle-detail',['query'=>$gc->key_id]).'"><h4>'.$gc->name.'</h4></a><ul class="icons-section"><li><a href=""><i class="fas fa-bookmark"></i></a></li><li><a href=""><i class="fas fa-share-alt"></i></a></li></ul></div></div><div class="product-content"><p class="double-border">Fantastic Condition - Very Well Cared For</p><span><p>'.$gc->year.'</p>|';
                        if($gc->steering_position==1){
                            $soldtxt = $soldtxt.'<p>LHD</p>';
                        }else{
                            $soldtxt = $soldtxt.'<p>RHD</p>';
                        } 
                        $soldtxt = $soldtxt.'|<p>United State <img src="'.asset('public/theme/images/uniter-img.jpg').'"></p></span></div><div class="product-shadow-box"><div class="head-bg-color red"><p>RESERVE NOT MET</p></div><div class="timging-tage">
                           <p>Ends In : 10:12:37</p></div><div class="current-bids"><p>Current Bids : €20,000</p></div></div></div></div>';
                    }
               }
        }else{
                $livecount = 0;
                $comingcount = 0;
                $privatecount = 0;
                $soldcount = 0;
                $livetxt = '<h1>No Result Found</h1>';
                $comingtxt = '<h1>No Result Found</h1>';
                $privatetxt = '<h1>No Result Found</h1>';
                $soldtxt = '<h1>No Result Found</h1>';
        }
        $arr = array("livecount"=>$livecount,"comingcount"=>$comingcount,"privatecount"=>$privatecount,"soldcount"=>$soldcount,"livetxt"=>$livetxt,"comingtxt"=>$comingtxt,"privatetxt"=>$privatetxt,"soldtxt"=>$soldtxt);
        return json_encode($arr);
    }
   

}
