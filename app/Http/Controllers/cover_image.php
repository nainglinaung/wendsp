<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\cover_image as image_request;
use App\cover_image as image_model;
use DB;
use Validator;
use Response;
use File;
use Illuminate\Support\Facades\Input as Input;
use Illuminate\Support\Facades\Storage;

class cover_image extends Controller
{
    public function cover_image(){
    	$coverphotos=DB::table('cover_images')->get();
    	return view('coverphoto.coverphoto',compact('coverphotos'));
    }

    public function cover_image_add(image_request $request,image_model $model){

        $this->validate($request, [
        'cover_image_name' => 'required|max:255|unique:cover_images,cover_image_name',
        'cover_image_source' => 'required|file|image|mimes:jpeg,jpg,png'
        ]);
        

        $ext=Input::file('cover_image_source')->getClientOriginalExtension();
        $filename=$request->cover_image_name.'.'.$ext;
        $file = Input::file('cover_image_source');
        $file->move('cover_image/',$filename);
        $image_source=$filename;

        $data=$model;
        $data->cover_image_name=$request->cover_image_name;
        $data->cover_image_source=$image_source;
        $data->save();

        return response()->json($data);

    }

    public function cover_image_delete($cover_image_id){
        $delete=DB::table('cover_images')->where('cover_image_id',$cover_image_id)->first();

        File::delete('cover_image/'.$delete->cover_image_source);

        DB::table('cover_images')->where('cover_image_id',$cover_image_id)->delete();

        return back();
    }
}
