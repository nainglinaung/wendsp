<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\e_book_comment as e_comment_model;
use App\Http\Requests\e_comment as e_comment_request;
use DB;
use Validator;
use Response;
class e_comments extends Controller
{
    public function e_comment_add(e_comment_model $model,e_comment_request $request,$e_book_id,$email,$comment){

    	$data=$model;
    	$data->e_book_id=$request->e_book_id;
    	$data->email=$request->email;
    	$data->comment=$request->comment;
        $data->rating=$request->rating;
    	$data->save();
    }

    public function e_comment_panel(){
    	$e_comments=DB::table('e_comments')->get();
    	return view ('e_comment.e_comment',compact('e_comments'));
    }

    public function post_e_comment(e_comment_model $model,e_comment_request $request,$e_book_id)
    {

        $this->validate($request, [
       'email' => 'required|max:255',
       'comment' => 'required',
        ]); 

        $data=$model;
        $data->e_book_id=$request->e_book_id;
        $data->email=$request->email;
        $data->comment=$request->comment;
        $data->rating=$request->rating;
        $data->save();

        return back();
    }
}
