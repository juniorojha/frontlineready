<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FRQMain;
use App\Models\FRQ;
use Session;
use DataTables;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Exceptions\Handler;
use Log;
class FRQController extends Controller
{

    public function show_frqlist(){
        $id = $this->encryptstring(0);
        return view("admin.frq.frq_default",compact('id'));
    }

    public function frq_main_data_table(){
         $frq =FRQMain::all();
         return DataTables::of($frq)
            ->editColumn('topic_name', function ($frq) {
                return $frq->topic;
            })
            ->editColumn('action', function ($frq) {
                $edit = route('save-topic', ['id'=>$this->encryptstring($frq->id)]);
                $delete = route('delete-topic', ['id'=>$this->encryptstring($frq->id)]);
                $addfrq = route('show-frq', ['id'=>$this->encryptstring($frq->id)]);
                return '<a  href="'.$edit.'" rel="tooltip"  class="btn btn-primary" data-original-title="banner" style="margin-right: 10px;color: white !important;">Edit</a><a onclick="delete_record(' . "'" . $delete. "'" . ')" rel="tooltip"  class="btn btn-danger" data-original-title="Remove" style="margin-right: 10px;color:white !important">Delete</a><a  href="'.$addfrq.'" rel="tooltip"  class="btn btn-warning" data-original-title="banner" style="margin-right: 10px;color: white !important;">Add Topic</a>';         
            })     
            ->addIndexColumn()       
            ->make(true);
    }

    public function save_topic(Request $request){
        try{
                $id = $request->get("id");;                         
                $data = FRQMain::find($this->decyptstring($request->get("id")));          
                return view("admin.frq.save_frq",compact('id','data'));
        }catch(Exception $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something went wrong"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('frqlist');
        }catch (DecryptException $e) {
                \Log::info($e->getMessage());
                Session::flash('message',"Something went wrong"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('frqlist');
        }catch (\Illuminate\Database\QueryException $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something went wrong"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
        } 
    }

    public function update_frq_main(Request $request){
        try{
                if($this->decyptstring($request->get("id"))=='0'){
                    $store = new FRQMain();
                    $msg = "FAQ Topic Add Successfully";
                }else{
                    $store = FRQMain::find($this->decyptstring($request->get("id")));
                    $msg = "FAQ Topic Update Successfully";
                }
                $store->topic = $request->get("topic");
                $store->save();
                Session::flash('message',$msg); 
                Session::flash('alert-class', 'alert-success');
                return redirect()->route('frqlist');
        }catch(Exception $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something went wrong"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('frqlist');
        }catch (DecryptException $e) {
                \Log::info($e->getMessage());
                Session::flash('message',"Something went wrong"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('frqlist');
        }catch (\Illuminate\Database\QueryException $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something went wrong"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
        } 
    }

    public function delete_faq(Request $request){
        try{
                $data = FRQMain::find($this->decyptstring($request->get("id")));
                if($data){
                    $data->delete();
                    FRQ::where('topic_id',$this->decyptstring($request->get("id")))->delete();
                    Session::flash('message',"FAQ Topic Delete Successfully"); 
                    Session::flash('alert-class', 'alert-success');
                    return redirect()->route("frqlist");
                }else{
                    Session::flash('message',"Something went wrong"); 
                    Session::flash('alert-class', 'alert-danger');
                    return redirect()->route("frqlist");
                }
        }catch(Exception $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something went wrong"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('frqlist');
        }catch (DecryptException $e) {
                \Log::info($e->getMessage());
                Session::flash('message',"Something went wrong"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('frqlist');
        }catch (\Illuminate\Database\QueryException $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something went wrong"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
        } 
    }

    public function delete_topic(Request $request){
        try{
                $data = FRQ::find($this->decyptstring($request->get("id")));
                if($data){
                    $data->delete();

                    Session::flash('message',"FAQ Delete Successfully"); 
                    Session::flash('alert-class', 'alert-success');
                    return redirect()->route("frqlist");
                }else{
                    Session::flash('message',"Something went wrong"); 
                    Session::flash('alert-class', 'alert-danger');
                    return redirect()->route("frqlist");
                }
        }catch(Exception $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something went wrong");
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('frqlist');
        }catch (DecryptException $e) {
                \Log::info($e->getMessage());
                Session::flash('message',"Something went wrong");
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('frqlist');
        }catch (\Illuminate\Database\QueryException $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something went wrong"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
        }   
    }



    public function show_frq_list(Request $request){
        //dd($request->all());
        try{
               
                $data = FRQMain::find($this->decyptstring($request->get("id")));
                $id = $this->encryptstring('0');
                $query = $request->get("id");
                return view("admin.frq.show_list_frq",compact('data','id','query'));
        }catch(Exception $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something went wrong"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('frqlist');
        }catch (DecryptException $e) {
                \Log::info($e->getMessage());
                Session::flash('message',"Something went wrong"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('frqlist');
        }catch (\Illuminate\Database\QueryException $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something went wrong"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
        }
    }

    public function frq_ques_data_table(Request $request){
         $frq =FRQ::where("topic_id",$this->decyptstring($request->get("query")))->get();
         return DataTables::of($frq)
            ->editColumn('question', function ($frq) {
                return $frq->question;
            })
           
            ->editColumn('action', function ($frq) {
                $edit = route('save-ques', ['id'=>$this->encryptstring($frq->id),'topic_id'=>$frq->topic_id]);
                $delete = route('delete-ques', ['id'=>$this->encryptstring($frq->id)]);
                return '<a  href="'.$edit.'" rel="tooltip"  class="btn btn-primary" data-original-title="banner" style="margin-right: 10px;color: white !important;">Edit</a><a onclick="delete_record(' . "'" . $delete. "'" . ')" rel="tooltip"  class="btn btn-danger" data-original-title="Remove" style="margin-right: 10px;color:white !important">Delete</a>';         
            })     
            ->addIndexColumn()       
            ->make(true);
    }

    public function save_ques(Request $request){
        try{
                $id = $request->get("id");
                $topic_id = $request->get("topic_id");                           
                $data = FRQ::find($this->decyptstring($request->get("id")));         
                return view("admin.frq.save_quest",compact('id','data','topic_id'));
        }catch(Exception $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something went wrong"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('frqlist');
        }catch (DecryptException $e) {
                \Log::info($e->getMessage());
                Session::flash('message',"Something went wrong"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('frqlist');
        }catch (\Illuminate\Database\QueryException $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something went wrong"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
        }
    }

    public function update_frq_ques(Request $request){
         try{
                if($this->decyptstring($request->get("id"))=='0'){
                    $store = new FRQ();
                    $msg = "FAQ Add Successfully";
                }else{
                    $store = FRQ::find($this->decyptstring($request->get("id")));
                    $msg = "FAQ Update Successfully";
                }
                $store->question = $request->get("question");
                $store->answer = $request->get("answer");
                $store->topic_id = $request->get("topic_id");
                $store->save();
                Session::flash('message',$msg); 
                Session::flash('alert-class', 'alert-success');
                return redirect()->route('show-frq',['id'=>$this->encryptstring($store->topic_id)]);
        }catch(Exception $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something went wrong"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('frqlist');
        }catch (DecryptException $e) {
                \Log::info($e->getMessage());
                Session::flash('message',"Something went wrong"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('frqlist');
        }catch (\Illuminate\Database\QueryException $e){
                \Log::info($e->getMessage());
                Session::flash('message',"Something went wrong"); 
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
        } 
    }
   
}
