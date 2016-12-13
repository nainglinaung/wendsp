<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\author as author_request;
use App\author as author_model;
use Validator;
use Response;
class authors extends Controller
{
    public function author_add(author_request $request,author_model $model){
        $this->validate($request, [
       'add_author' => 'required|max:255|unique:authors,author_name'
        ]);	

       $data=$model;
       $data->author_name=$request->add_author;
       $data->save();
       return back();
    }
}
