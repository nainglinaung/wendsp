<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\edition as edition_request;
use App\edition as edition_model;
use Validator;
use Response;
class editions extends Controller
{
	public function edition_add(edition_request $request,edition_model $model){
        $this->validate($request, [
       'add_edition' => 'required|max:255|unique:editions,edition_name'
        ]);	

       $data=$model;
       $data->edition_name=$request->add_edition;
       $data->save();
       return back();
	}
}
