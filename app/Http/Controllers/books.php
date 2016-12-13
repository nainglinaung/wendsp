<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\Http\Requests\book as book_request;
use App\Http\Requests\po as pos_request;
use App\book as book_model;
use App\book_category as book_category_model;
use App\author as author_model;
use App\po as pos_model;
use Validator;
use Response;
use File;
use Illuminate\Support\Facades\Input as Input;
use Illuminate\Support\Facades\Storage;

class books extends Controller
{
    public function book_panel(){
    	$books=DB::table('books')->get();
    	return view('book.book',compact('books'));
    }

    public function add_book(){

    	$categories=DB::table('categories')->get();
    	$authors=DB::table('authors')->get();
    	$publishers=DB::table('publishers')->get();
    	$editions=DB::table('editions')->get();
    	return view('book.addbook',compact('categories','authors','publishers','editions'));
    }

    public function book_add(book_request $request,book_model $model,pos_request $pos_request,pos_model $pos_model){
    	
        $this->validate($request, [
        'book_title' => 'required|max:255',
        'book_cover' => 'required|file|image|mimes:jpeg,jpg,png',
        'description'=> 'required',
        'assigned'=>'required',
        'instock'=>'required',
        'buy_price'=>'required',
        'sale_price'=>'required'

        ]);
        

        $ext=Input::file('book_cover')->getClientOriginalExtension();
        $filename=$request->book_title.'.'.$ext;
        $file = Input::file('book_cover');
        $file->move('book_cover/',$filename);
        $image_source=$filename;


    	$data=$model;
    	$data->book_title=$request->book_title;
    	$data->book_description="$request->description";
    	$data->author_id=$request->author;
    	$data->publisher_id=$request->publisher;
    	$data->edition_id=$request->edition;
    	$data->assigned=$request->assigned;
    	$data->in_stock=$request->instock;
    	$data->buy_price=$request->buy_price;
    	$data->sale_price=$request->sale_price;
    	$data->book_cover=$image_source;
		$data->save();

        $closing_total_quantity=$request->assigned+$request->instock;
        $closing_total_amount=$closing_total_quantity*$request->sale_price;

        $pos_data=$pos_model;
        $pos_data->book_id=$data->book_id;
        $pos_data->opening_quantity=$request->assigned;
        $pos_data->opening_amount=$request->assigned*$request->buy_price;
        $pos_data->receive_quantity=$request->instock;
        $pos_data->receive_amount=$request->instock*$request->sale_price;
        $pos_data->sale_quantity=0;
        $pos_data->sale_amount=0;
        $pos_data->return_quantity=0;
        $pos_data->return_amount=0;
        $pos_data->closing_quantity=$closing_total_quantity;
        $pos_data->closing_amount=$closing_total_amount;
        $pos_data->remark="No Remark";
        $pos_data->save();

      


        DB::table('book_category')->insert(['book_id'=>$data->book_id,'category_id'=>$request->category_1]);

        if($request->category_2==="0")
        {

        }
        else
        {
            DB::table('book_category')->insert(['book_id'=>$data->book_id,'category_id'=>$request->category_2]);
        }

        if($request->category_3==="0")
        {

        }
        else
        {
            DB::table('book_category')->insert(['book_id'=>$data->book_id,'category_id'=>$request->category_3]);
        }

        if($request->category_4==="0")
        {

        }
        else
        {
            DB::table('book_category')->insert(['book_id'=>$data->book_id,'category_id'=>$request->category_4]);
        }


        if($request->category_5==="0")
        {

        }
        else
        {
            DB::table('book_category')->insert(['book_id'=>$data->book_id,'category_id'=>$request->category_5]);
        }

    	return back();
		
    }

    public function book_update($book_id){
        $books=DB::table('books')->where('book_id','=',$book_id)->get();
        $categories=DB::table('categories')->get();
        $authors=DB::table('authors')->get();
        $publishers=DB::table('publishers')->get();
        $editions=DB::table('editions')->get();
        return view('book.updatebook',compact('books','categories','authors','publishers','editions'));
    }

    public function book_update_now($book_id,book_request $request){

        $this->validate($request, [
        'book_title' => 'required|max:255'
        ]);

        DB::table('books')
            ->where('book_id',$book_id)
            ->update([
                'book_title'=>$request->book_title,
                'book_description'=>$request->description,
                'author_id'=>$request->author,
                'publisher_id'=>$request->publisher,
                'edition_id'=>$request->edition,
                'assigned'=>$request->assigned,
                'in_stock'=>$request->instock,
                'buy_price'=>$request->buy_price,
                'sale_price'=>$request->sale_price
                ]);
        DB::table('book_category')->where('book_id',$book_id)->delete();

        DB::table('book_category')->insert(['book_id'=>$book_id,'category_id'=>$request->category_1]);

        if($request->category_2==="0")
        {

        }
        else
        {
            DB::table('book_category')->insert(['book_id'=>$book_id,'category_id'=>$request->category_2]);
        }

        if($request->category_3==="0")
        {

        }
        else
        {
            DB::table('book_category')->insert(['book_id'=>$book_id,'category_id'=>$request->category_3]);
        }

        if($request->category_4==="0")
        {

        }
        else
        {
            DB::table('book_category')->insert(['book_id'=>$book_id,'category_id'=>$request->category_4]);
        }


        if($request->category_5==="0")
        {

        }
        else
        {
            DB::table('book_category')->insert(['book_id'=>$book_id,'category_id'=>$request->category_5]);
        }
        
        return back();
    }

    public function book_delete($book_id){
        $delete=DB::table('books')->where('book_id',$book_id)->first();

        File::delete('book_cover/'.$delete->book_cover);

        DB::table('books')->where('book_id',$book_id)->delete();

        return back();
    }

    public function testing_nest(book_model $model,book_request $request,author_model $author_model){


        //return $author_model->books()->get(); 


        return author_model::with('books')->get();
        /*
        $authors=DB::table('authors')->select('author_id')->get();

        $books=DB::table('books')->get();

        return response()->json($authors);
        */
    }
}
