<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\admin as admin_model;
use App\Http\Requests\admin as admin_request;
use DB;

class admins extends Controller
{
    public function admin_panel(){
    	$admins=DB::table('admins')->get();
    	return view('admin.admin',compact('admins'));
    }

    public function admin_add(admin_model $model, admin_request $request){

        $this->validate($request, [
        'username' => 'required|max:255|unique:admins,username',
        'password' => 'required'
        ]);
    	$bcrypt_password=bcrypt($request->password);
    	$data=$model;
    	$data->username=$request->username;
    	$data->password=$bcrypt_password;
    	$data->save();

    	return back();
    }
    public function admin_delete(admin_model $model, admin_request $request,$admin_id){
    	DB::table('admins')->where('id','=',$admin_id)->delete();
    	return back();
    }

    public function admin_login(){
    	return view('admin.login');
    }
}
