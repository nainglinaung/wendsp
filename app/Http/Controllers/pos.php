<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\po as pos_request;
use DB;
class pos extends Controller
{
    public function pos_panel(){
    	$pos_result=DB::table('pos')->get();
    	return view('pos.pos',compact('pos_result'));
    }

    public function pos_update(pos_request $request){
    	DB::table('pos')->where('pos_id',$request->pos_id)->update(['remark'=>$request->remark]);
    	return back();
    }

    public function pos_delete(pos_request $request,$pos_id){
    	DB::table('pos')->where('pos_id',$pos_id)->delete();
    	return back();
    }
}
