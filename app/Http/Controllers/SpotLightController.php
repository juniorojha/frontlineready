<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SpotLight;
use Session;
use DataTables;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Exceptions\Handler;
use Log;
class SpotLightController extends Controller
{
    
    public function show_news(){
        $id = $this->encryptstring(0);
        return view("admin.spotlight.news",compact('id'));
    }

    public function show_news_save(Request $request){
         try{
                $data = SpotLight::find($this->decyptstring($request->get("id")));
                $filels = "";
                if($data){
                        $file_name = storage_path("app/public/newsfiles").'/'.$data->description;
                        $myfile = fopen($file_name, "r");
                        if(file_exists($file_name)){
                            $filels= fread($myfile,filesize($file_name));
                        fclose($myfile);
                        $data->filels = $filels; 
                        }else{
                             $data->filels = "";
                        }
                            
                }
                 
                $id = $request->get("id"); 
                return view("admin.spotlight.save_news",compact('id','data'));
        }catch(Exception $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something went wrong");  
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('news');
        }catch (DecryptException $e) {
                \Log::info($e->getMessage());
                Session::flash('message',"Something went wrong"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('news');
        }catch (\Illuminate\Database\QueryException $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something went wrong"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
        }
    }

    public function update_news(Request $request){ 
        try{
                if($this->decyptstring($request->get("id"))==0){
                    $store = new SpotLight();
                    $msg = "News Add Successfully";
                    $fname = rand().time().".txt";
                }else{
                    $store = SpotLight::find($this->decyptstring($request->get("id")));
                    $msg = "News Update Successfully";
                    $fname = $store->description;
                }

                $file_name = storage_path("app/public/newsfiles").'/'.$fname;
                $myfile = fopen($file_name, "w");
                $txt = $request->get("description");
                fwrite($myfile, $txt);
                fclose($myfile);
                $store->title = $request->get("title");
                $store->short_desc = $request->get("short_desc");
                $store->description = $fname;
                if($request->file("upload_image")){
                    if($store->image!=""){
                         $this->removeImage(storage_path("app/public/news").'/'.$store->image);
                    }             
                    $store->image = $this->fileuploadFileImage($request,'news','upload_image');
                }
                $store->save();
                Session::flash('message',$msg); 
                Session::flash('alert-class', 'alert-success');
                return redirect()->route('news');
        }catch(Exception $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something went wrong"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('news');
        }catch (DecryptException $e) {
                \Log::info($e->getMessage());
                Session::flash('message',"Something went wrong"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('news');
        }catch (\Illuminate\Database\QueryException $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something went wrong"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
        }
    }

    public function show_news_data_table(){
         $news =SpotLight::all();
         return DataTables::of($news)
            ->editColumn('name', function ($news) {
                return $news->title;
            })
            ->editColumn('image', function ($news) {
                return url("storage/app/public/news").'/'.$news->image;
            })
            ->editColumn('short_desc', function ($news) {
                return $news->short_desc;
            })
            ->editColumn('action', function ($news) {
                $edit = route('save-news', ['id'=>$this->encryptstring($news->id)]);
                $delete = route('delete-news', ['id'=>$this->encryptstring($news->id)]);
                return '<a  href="'.$edit.'" rel="tooltip"  class="btn btn-primary" data-original-title="banner" style="margin-right: 10px;color: white !important;">Edit</a><a onclick="delete_record(' . "'" . $delete. "'" . ')" rel="tooltip"  class="btn btn-danger" data-original-title="Remove" style="margin-right: 10px;color:white !important">Delete</a>';              
            })     
            ->addIndexColumn()       
            ->make(true);
    }

    public function delete_news(Request $request){
        try{
                $data = SpotLight::find($this->decyptstring($request->get("id")));
                if($data){
                    if($data->image!=""){
                         $this->removeImage(storage_path("app/public/news").'/'.$data->image);
                    }  
                    $data->delete();
                    Session::flash('message',"News Delete Successfully"); 
                    Session::flash('alert-class', 'alert-success');
                    return redirect()->route("news");
                }else{
                    Session::flash('message',"Something went wrong"); 
                    Session::flash('alert-class', 'alert-danger');
                    return redirect()->route("news");
                }
        }catch(Exception $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something went wrong");  
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('news');
        }catch (DecryptException $e) {
                \Log::info($e->getMessage());
                Session::flash('message',"Something went wrong"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('news');
        }catch (\Illuminate\Database\QueryException $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something went wrong"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
        }
    }
}
