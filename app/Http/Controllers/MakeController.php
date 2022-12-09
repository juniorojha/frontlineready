<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Make;
use Session;
use DataTables;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Exceptions\Handler;
use Log;
class MakeController extends Controller
{
    
    public function show_make_list(){
        $id = $this->encryptstring(0);
        return view("admin.make.default",compact('id'));
    }

    public function show_save_make(Request $request){
        try{
                $id = $request->get("id");
                $data = Make::find($this->decyptstring($request->get("id")));
                return view("admin.make.save",compact('id','data'));
        }catch(Exception $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something went wrong"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('make');
        }catch (DecryptException $e) {
                \Log::info($e->getMessage());
                Session::flash('message',"Something went wrong"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('make');
        }catch (\Illuminate\Database\QueryException $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something went wrong"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
        }
    }

    public function update_make(Request $request){
        try{
                if($this->decyptstring($request->get("id"))=='0'){
                    $store = new Make();
                    $msg = "Make Add Successfully";
                }else{
                    $store = Make::find($this->decyptstring($request->get("id")));
                    $msg = "Make Update Successfully";
                }
                $store->name = $request->get("name");
                $store->save();
                Session::flash('message',$msg); 
                Session::flash('alert-class', 'alert-success');
                return redirect()->route('make');
        }catch(Exception $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something went wrong"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('make');
        }catch (DecryptException $e) {
                \Log::info($e->getMessage());
                Session::flash('message',"Something went wrong"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('make');
        }catch (\Illuminate\Database\QueryException $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something went wrong"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
        }
        
    }

    public function make_data_table(){
            $make =Make::whereNull('deleted_at')->orderby('id','DESC')->get();
            return DataTables::of($make)           
                ->editColumn('name', function ($make) {
                    return isset($make->name)?$make->name:'';
                })   
                ->editColumn('action', function ($make) {
                    $edit = route('save-make', ['id'=>$this->encryptstring($make->id)]);
                    $delete = route('delete-make', ['id'=>$this->encryptstring($make->id)]);
                    return '<a  href="'.$edit.'" rel="tooltip"  class="btn btn-primary" data-original-title="banner" style="margin-right: 10px;color: white !important;">Edit</a><a onclick="delete_record(' . "'" . $delete. "'" . ')" rel="tooltip"  class="btn btn-danger" data-original-title="Remove" style="margin-right: 10px;color:white !important">Delete</a>';              
                }) 
                ->addIndexColumn()          
                ->make(true);
    }

    public function delete_make(Request $request){
        try{
                $data = Make::find($this->decyptstring($request->get("id")));
                if($data){
                    $data->delete();
                    Session::flash('message',"Make Delete Successfully"); 
                    Session::flash('alert-class', 'alert-success');
                    return redirect()->route("make");
                }else{
                    Session::flash('message',"Something went wrong"); 
                    Session::flash('alert-class', 'alert-danger');
                    return redirect()->route("make");
                }
        }catch(Exception $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something went wrong"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('make');
        }catch (DecryptException $e) {
                \Log::info($e->getMessage());
                Session::flash('message',"Something went wrong");
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('make');
        }catch (\Illuminate\Database\QueryException $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something went wrong"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
        }    
    }
}
