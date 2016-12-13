<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\comment as comment_model;
use App\Http\Requests\comment as comment_request;
use DB;
use Validator;
use Response;
class comments extends Controller
{
    public function comment_panel(){
    	$comments=DB::table('comments')->get();
    	return view('comment.comment',compact('comments'));
    }

    public function comment_add(comment_model $model,comment_request $request,$book_id,$email,$comment,$rating){

    	$data=$model;
    	$data->book_id=$request->book_id;
    	$data->email=$request->email;
    	$data->comment=$request->comment;
        $data->rating=$request->rating;
    	$data->save();
    }

    public function post_comment(comment_model $model,comment_request $request,$book_id){

        $this->validate($request, [
       'email' => 'required|max:255',
       'comment' => 'required',
        ]); 

        $data=$model;
        $data->book_id=$request->book_id;
        $data->email=$request->email;
        $data->comment=$request->comment;
        $data->rating=$request->rating;
        $data->save();

        return back();
}
}
