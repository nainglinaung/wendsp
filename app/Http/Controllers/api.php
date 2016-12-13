<?php

namespace App\Http\Controllers;
use App\Http\Requests\book as book_request;
use Illuminate\Http\Request;
use App\book as book_model;
use App\e_book as e_book_model;
use App\author as author_model;
use App\publisher as publisher_model;
use App\category as category_model;
use App\edition as edition_model;
use App\book_category as book_category;
use DB;
use Validator;
use Response;
use File;
class api extends Controller
{

	public function all_author(){
		$authors=DB::table('authors')->get();

		return response()->json($authors);
	}

	public function all_edition(){
		$editions=DB::table('editions')->get();

		return response()->json($editions);
	}

	public function all_publisher(){
		$publishers=DB::table('publishers')->get();

		return response()->json($publishers);
	}

	public function all_category()
	{
		$categories=DB::table('categories')->get();

		return response()->json($categories);
	}

	public function all_book()
	{
        return book_model::with(['category'=>
        	function($query){
        		$query
        		->leftJoin('categories','book_category.category_id','=','categories.category_id')
        		->select();
        	}

        	,'author','edition','publisher'])
        ->get();
	}

    public function all_e_book()
    {
        return e_book_model::with(['category'=>
            function($query){
                $query
                ->leftJoin('categories','e_book_category.category_id','=','categories.category_id')
                ->select();
            }

            ,'author','edition','publisher'])
        ->get();
    }

    public function author_many_books(book_model $model,book_request $request,author_model $author_model){

        return $author_model->with(['books'=>
        	function($query){
        		$query
        		->leftJoin('editions','editions.edition_id','=','books.edition_id')
        		->leftJoin('publishers','publishers.publisher_id','=','books.publisher_id')
        		->leftJoin('authors','authors.author_id','=','books.author_id')
        		->select('book_id','book_title','books.author_id','book_description','authors.author_name','publishers.publisher_name','editions.edition_name','assigned','in_stock','buy_price','sale_price','book_cover','books.created_at','books.updated_at');
        	}


        	])->get();

    }
    public function edition_many_books(book_request $request,edition_model $model){

        return edition_model::with(['books'=>
        	function($query){
        		$query
        		->leftJoin('editions','editions.edition_id','=','books.edition_id')
        		->leftJoin('publishers','publishers.publisher_id','=','books.publisher_id')
        		->leftJoin('authors','authors.author_id','=','books.author_id')
        		->select('book_id','book_title','book_description','books.edition_id','authors.author_name','publishers.publisher_name','editions.edition_name','assigned','in_stock','buy_price','sale_price','book_cover','books.created_at','books.updated_at');
        	}
        	])->get();
    }

    public function publisher_many_books(book_request $request,publisher_model $model){

        return publisher_model::with(['books'=>
        	function($query){
        		$query
        		->leftJoin('editions','editions.edition_id','=','books.edition_id')
        		->leftJoin('publishers','publishers.publisher_id','=','books.publisher_id')
        		->leftJoin('authors','authors.author_id','=','books.author_id')
        		->select('book_id','book_title','book_description','books.publisher_id','authors.author_name','publishers.publisher_name','editions.edition_name','assigned','in_stock','buy_price','sale_price','book_cover','books.created_at','books.updated_at');
        	}


        	])->get();
    }

//Need to change 
    public function book_many_categories(book_request $request,category_model $model){

        return book_model::with(['category'=>
        	function($query){
        		$query
        		->leftJoin('categories','book_category.category_id','=','categories.category_id')
        		->select();
        	}

        	,'author','edition','publisher'])
        ->get();
    }

    public function category_many_books(book_request $request,category_model $model){

        return category_model::with(['book'=>
        	function($query){
        		$query
        		->leftJoin('books','book_category.book_id','=','books.book_id')
        		->leftJoin('editions','editions.edition_id','=','books.edition_id')
        		->leftJoin('publishers','publishers.publisher_id','=','books.publisher_id')
        		->leftJoin('authors','authors.author_id','=','books.author_id')
        		->select('book_category.book_id','book_category.category_id','books.book_title','books.book_description','authors.author_name','publishers.publisher_name','editions.edition_name','books.assigned','books.in_stock','books.buy_price','books.sale_price','books.book_cover','books.created_at','books.updated_at');
        }	
        	])->get();
    }










    public function author_many_e_books(book_model $model,book_request $request,author_model $author_model){

        return $author_model->with(['e_books'=>
        	function($query){
        		$query
        		->leftJoin('editions','editions.edition_id','=','e_books.edition_id')
        		->leftJoin('publishers','publishers.publisher_id','=','e_books.publisher_id')
        		->leftJoin('authors','authors.author_id','=','e_books.author_id')
        		->select('e_book_id','e_book_title','e_book_description','e_books.author_id','authors.author_name','publishers.publisher_name','editions.edition_name','e_book_cover','e_book_download','e_books.created_at','e_books.updated_at');
        	}


        	])->get();

    }

    public function edition_many_e_books(book_request $request,edition_model $model){

        return edition_model::with(['e_books'=>
        	function($query){
        		$query
        		->leftJoin('editions','editions.edition_id','=','e_books.edition_id')
        		->leftJoin('publishers','publishers.publisher_id','=','e_books.publisher_id')
        		->leftJoin('authors','authors.author_id','=','e_books.author_id')
        		->select('e_book_id','e_book_title','e_book_description','e_books.edition_id','authors.author_name','publishers.publisher_name','editions.edition_name','e_book_cover','e_book_download','e_books.created_at','e_books.updated_at');
        	}
        	])->get();
    }

    public function publisher_many_e_books(book_request $request,publisher_model $model){

        return publisher_model::with(['e_books'=>
        	function($query){
        		$query
        		->leftJoin('editions','editions.edition_id','=','e_books.edition_id')
        		->leftJoin('publishers','publishers.publisher_id','=','e_books.publisher_id')
        		->leftJoin('authors','authors.author_id','=','e_books.author_id')
        		->select('e_book_id','e_book_title','e_book_description','e_books.publisher_id','authors.author_name','publishers.publisher_name','editions.edition_name','e_book_cover','e_book_download','e_books.created_at','e_books.updated_at');
        	}


        	])->get();
    }

//Need to change 
    public function e_book_many_categories(book_request $request,category_model $model){


        return e_book_model::with(['category'=>
        	function($query){
        		$query
        		->leftJoin('categories','e_book_category.category_id','=','categories.category_id')
        		->select();
        	}

        	,'author','edition','publisher'])
        ->get();

    }

    public function category_many_e_books(book_request $request,category_model $model){

        return category_model::with(['e_book'=>
        	function($query){
        		$query
        		->leftJoin('e_books','e_book_category.e_book_id','=','e_books.e_book_id')
        		->leftJoin('editions','editions.edition_id','=','e_books.edition_id')
        		->leftJoin('publishers','publishers.publisher_id','=','e_books.publisher_id')
        		->leftJoin('authors','authors.author_id','=','e_books.author_id')
        		->select('e_book_category.e_book_id','e_book_category.category_id','e_books.e_book_title','e_books.e_book_description','authors.author_name','publishers.publisher_name','editions.edition_name','e_books.e_book_cover','e_books.e_book_download','e_books.created_at','e_books.updated_at');
        }
        	])->get();
    }

    public function book_many_comments(){

        return book_model::with(['comment','author','edition','publisher','category'=>
            function($query){
                $query
                ->leftJoin('categories','book_category.category_id','=','categories.category_id')
                ->select();
            }

            ])->get();
    }

    public function e_book_many_e_comments(){
        return e_book_model::with(['comment','author','edition','publisher','category'=>
            function($query){
                $query
                ->leftJoin('categories','e_book_category.category_id','=','categories.category_id')
                ->select();
            }

            ])->get();
    }

    public function only_one_book($book_id){

        return book_model::where('book_id',$book_id)->with(['category'=>
            function($query){
                $query
                ->leftJoin('categories','book_category.category_id','=','categories.category_id')
                ->select();
            }

            ,'author','edition','publisher','comment'])
        ->get();
    }

    public function only_one_e_book($book_id){

        return e_book_model::where('e_book_id',$book_id)->with(['category'=>
            function($query){
                $query
                ->leftJoin('categories','e_book_category.category_id','=','categories.category_id')
                ->select();
            }

            ,'author','edition','publisher','comment'])
        ->get();
    }

    public function book_cover($book_cover){
      
      $file = File::get('book_cover/'.$book_cover);
      $response=response()->make($file);
      $response->header('Content-Type', 'image/jpg');
      $response->header('Content-Type', 'image/jpeg');
      $response->header('Content-Type', 'image/png');
      return $response;
    }

    public function e_book_cover($e_book_cover){
      
      $file = File::get('e_book_cover/'.$e_book_cover);
      $response=response()->make($file);
      $response->header('Content-Type', 'image/jpg');
      $response->header('Content-Type', 'image/jpeg');
      $response->header('Content-Type', 'image/png');
      return $response;
    }

    public function cover_image_source($cover_image){
      
      $file = File::get('cover_image/'.$cover_image);
      $response=response()->make($file);
      $response->header('Content-Type', 'image/jpg');
      $response->header('Content-Type', 'image/jpeg');
      $response->header('Content-Type', 'image/png');
      return $response;

    }

    public function best_seeling_books(){
    $category= category_model::with(['book'=>
            function($query){
                $query
                ->leftJoin('books','book_category.book_id','=','books.book_id')
                ->leftJoin('editions','editions.edition_id','=','books.edition_id')
                ->leftJoin('publishers','publishers.publisher_id','=','books.publisher_id')
                ->leftJoin('authors','authors.author_id','=','books.author_id')
                ->select('book_category.book_id','book_category.category_id','books.book_title','books.book_description','authors.author_name','publishers.publisher_name','editions.edition_name','books.assigned','books.in_stock','books.buy_price','books.sale_price','books.book_cover','books.created_at','books.updated_at');
        },'best_selling_category'])
    ->where('category_name','Best Selling')
    ->get();

    $book=book_model::with(['category'=>
            function($query){
                $query
                ->leftJoin('categories','book_category.category_id','=','categories.category_id')
                ->select();
            }

            ,'author','edition','publisher'])
        ->get();

    return $category;
    }

}
