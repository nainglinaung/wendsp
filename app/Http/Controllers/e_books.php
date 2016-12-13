<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\e_book as e_book_request;
use App\e_book as e_book_model;
use DB;
use Illuminate\Support\Facades\Input as Input;
use Illuminate\Support\Facades\Storage;
use Validator;
use Response;
use File;
class e_books extends Controller
{
	public function e_book_panel(){
		$books=DB::table('e_books')->get();
		return view('e_book.e_book',compact('books'));
	}

	public function add_e_book(){

    	$categories=DB::table('categories')->get();
    	$authors=DB::table('authors')->get();
    	$publishers=DB::table('publishers')->get();
    	$editions=DB::table('editions')->get();
    	return view('e_book.addebook',compact('categories','authors','publishers','editions'));
	}

 public function e_book_add(e_book_request $request,e_book_model $model){
    	
        $this->validate($request, [
        'book_title' => 'required|max:255|unique:e_books,e_book_title',
        'book_cover' => 'required|file|image|mimes:jpeg,jpg,png',
        'description'=> 'required',
        'book_source'=> 'required|mimes:pdf|max:10000'
        ]);
        

        $ext=Input::file('book_cover')->getClientOriginalExtension();
        $filename=$request->book_title.'.'.$ext;
        $file = Input::file('book_cover');
        $file->move('e_book_cover/',$filename);
        $image_source=$filename;

        $ext_book=Input::file('book_source')->getClientOriginalExtension();
        $filename_book=$request->book_title.'.'.$ext_book;
        $file_book = Input::file('book_source');
        $file_book->move('book_source/',$filename_book);
        $ebook_source=$filename_book;

    	$data=$model;
    	$data->e_book_title=$request->book_title;
    	$data->e_book_description="$request->description";
    	$data->author_id=$request->author;
    	$data->publisher_id=$request->publisher;
    	$data->edition_id=$request->edition;
    	$data->e_book_cover=$image_source;
    	$data->e_book_download=$ebook_source;
		$data->save();


        DB::table('e_book_category')->insert(['e_book_id'=>$data->e_book_id,'category_id'=>$request->category_1]);

        if($request->category_2==="0")
        {

        }
        else
        {
            DB::table('e_book_category')->insert(['e_book_id'=>$data->e_book_id,'category_id'=>$request->category_2]);
        }

        if($request->category_3==="0")
        {

        }
        else
        {
            DB::table('e_book_category')->insert(['e_book_id'=>$data->e_book_id,'category_id'=>$request->category_3]);
        }

        if($request->category_4==="0")
        {

        }
        else
        {
            DB::table('e_book_category')->insert(['e_book_id'=>$data->e_book_id,'category_id'=>$request->category_4]);
        }


        if($request->category_5==="0")
        {

        }
        else
        {
            DB::table('e_book_category')->insert(['e_book_id'=>$data->e_book_id,'category_id'=>$request->category_5]);
        }

    	return back();
		
    }

        public function e_book_update($book_id){
        $books=DB::table('e_books')->where('e_book_id','=',$book_id)->get();
        $categories=DB::table('categories')->get();
        $authors=DB::table('authors')->get();
        $publishers=DB::table('publishers')->get();
        $editions=DB::table('editions')->get();
        return view('e_book.updateebook',compact('books','categories','authors','publishers','editions'));
    }

    public function e_book_update_now($book_id,e_book_request $request){

        $this->validate($request, [
        'book_title' => 'required|max:255'
        ]);

        DB::table('e_books')
            ->where('e_book_id',$book_id)
            ->update([
                'e_book_title'=>$request->book_title,
                'e_book_description'=>$request->description,
                'author_id'=>$request->author,
                'publisher_id'=>$request->publisher,
                'edition_id'=>$request->edition,
                ]);
        DB::table('e_book_category')->where('e_book_id',$book_id)->delete();

        DB::table('e_book_category')->insert(['e_book_id'=>$book_id,'category_id'=>$request->category_1]);

        if($request->category_2==="0")
        {

        }
        else
        {
            DB::table('e_book_category')->insert(['e_book_id'=>$book_id,'category_id'=>$request->category_2]);
        }

        if($request->category_3==="0")
        {

        }
        else
        {
            DB::table('e_book_category')->insert(['e_book_id'=>$book_id,'category_id'=>$request->category_3]);
        }

        if($request->category_4==="0")
        {

        }
        else
        {
            DB::table('e_book_category')->insert(['e_book_id'=>$book_id,'category_id'=>$request->category_4]);
        }


        if($request->category_5==="0")
        {

        }
        else
        {
            DB::table('e_book_category')->insert(['e_book_id'=>$book_id,'category_id'=>$request->category_5]);
        }
        
        return back();
    }

        public function e_book_delete($book_id){
        $delete=DB::table('e_books')->where('e_book_id',$book_id)->first();

        File::delete('e_book_cover/'.$delete->e_book_cover);
        File::delete('book_source/'.$delete->e_book_download);

        DB::table('e_books')->where('e_book_id',$book_id)->delete();

        return back();
    }

    public function e_book_source($book_id,$e_book_download){
    $file = File::get('book_source/'.$e_book_download);
      $response=response()->make($file);
      $response->header('Content-Type', 'pdf/application');
      return $response;
    }
}
