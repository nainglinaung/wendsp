<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\publisher as publisher_request;
use App\publisher as publisher_model;
use Validator;
use Response;

class publishers extends Controller
{
    public function publisher_add(publisher_request $request,publisher_model $model){
        $this->validate($request, [
       'add_publisher' => 'required|max:255|unique:publishers,publisher_name'
        ]);	

       $data=$model;
       $data->publisher_name=$request->add_publisher;
       $data->save();
       return back();
    }
}
