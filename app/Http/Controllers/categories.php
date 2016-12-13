<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\Http\Requests\category as cat_request;
use App\category as cat_model;
use Validator;
use Response;

class categories extends Controller
{
    public function category_add(cat_model $model,cat_request $request){
       $this->validate($request, [
       'add_category' => 'required|max:255|unique:categories,category_name'
        ]);	

       $data=$model;
       $data->category_name=$request->add_category;
       $data->save();
       return back();
    }
}
