<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\book as book_model;
use App\e_book as e_book_model;
use App\author as author_model;
use App\publisher as publisher_model;
use App\category as category_model;
use App\edition as edition_model;
use App\book_category as book_category;
use DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Validator;
use Response;
use File;

class front_end extends Controller
{
	public function home(){
		$cover_images=DB::table('cover_images')->get();

		$category_many_books=category_model::with(['book'=>
        	function($query){
        		$query
        		->leftJoin('books','book_category.book_id','=','books.book_id')
        		->leftJoin('editions','editions.edition_id','=','books.edition_id')
        		->leftJoin('publishers','publishers.publisher_id','=','books.publisher_id')
        		->leftJoin('authors','authors.author_id','=','books.author_id')
        		->select('book_category.book_id','book_category.category_id','books.book_title','books.book_description','authors.author_id','authors.author_name','publishers.publisher_name','editions.edition_name','books.assigned','books.in_stock','books.buy_price','books.sale_price','books.book_cover','books.created_at','books.updated_at');
                }])->get();

                $latest_books=book_model::with('author')->orderBy('created_at', 'desc')
               ->take(6)
               ->get();

               $category=category_model::with(['book'=>
                function($query){
                        $query
                        ->leftJoin('books','book_category.book_id','=','books.book_id')
                        ->leftJoin('editions','editions.edition_id','=','books.edition_id')
                        ->leftJoin('publishers','publishers.publisher_id','=','books.publisher_id')
                        ->leftJoin('authors','authors.author_id','=','books.author_id')
                        ->select('book_category.book_id','book_category.category_id','books.book_title','books.book_description','authors.author_name','publishers.publisher_name','editions.edition_name','books.assigned','books.in_stock','books.buy_price','books.sale_price','books.book_cover','books.created_at','books.updated_at')
                        ->take(6);
        }       
        ]);

        $best_sellings=$category
        ->where('category_name','=','Top 10')
        ->get();

        $top_10_images=category_model::with(['book'=>
                function($query){
                        $query
                        ->leftJoin('books','book_category.book_id','=','books.book_id')
                        ->leftJoin('editions','editions.edition_id','=','books.edition_id')
                        ->leftJoin('publishers','publishers.publisher_id','=','books.publisher_id')
                        ->leftJoin('authors','authors.author_id','=','books.author_id')
                        ->select('book_category.book_id','book_category.category_id','books.book_title','books.book_description','authors.author_name','publishers.publisher_name','editions.edition_name','books.assigned','books.in_stock','books.buy_price','books.sale_price','books.book_cover','books.created_at','books.updated_at')
                        ->orderBy('created_at', 'desc')
                        ->take(3);
        }])
        ->where('category_name','=','Top 10')
        ->get();

        $top_10_panels=category_model::with(['book'=>
                function($query){
                        $query
                        ->leftJoin('books','book_category.book_id','=','books.book_id')
                        ->leftJoin('editions','editions.edition_id','=','books.edition_id')
                        ->leftJoin('publishers','publishers.publisher_id','=','books.publisher_id')
                        ->leftJoin('authors','authors.author_id','=','books.author_id')
                        ->select('book_category.book_id','book_category.category_id','books.book_title','books.book_description','authors.author_name','publishers.publisher_name','editions.edition_name','books.assigned','books.in_stock','books.buy_price','books.sale_price','books.book_cover','books.created_at','books.updated_at')
                        ->orderBy('created_at', 'desc')
                        ->take(1);
        }])
        ->where('category_name','=','Top 10')
        ->get();
        /*
        $horrors=$category
        ->where('category_name','=','Horror')
        ->get();

        $comedies=$category
        ->where('category_name','=','Comedy')
        ->get();

        $top_10s=$category
        ->where('category_name','=','Top 10')
        ->get();
        $arts=$category
        ->where('category_name','=','Art')
        ->get();
        $humors=$category
        ->where('category_name','=','Humor')
        ->get();
        $kids=$category
        ->where('category_name','=','Kid')
        ->get();
        $loves=$category
        ->where('category_name','=','Love')
        ->get();
        $romanticks=$category
        ->where('category_name','=','Romanticks')
        ->get();
*/
        $categories=DB::table('categories')->get();
        $authors=DB::table('authors')->get();
	
        return view('frontend.home',compact('cover_images','category_many_books','latest_books','categories','authors','best_sellings','top_10_images','top_10_panels'));
	}

        public function book_detail($book_id){

                $books=book_model::with(['category'=>
                function($query){
                        $query
                        ->leftJoin('categories','book_category.category_id','=','categories.category_id')
                        ->select();
                }

                ,'author','edition','publisher'])
                ->where('book_id','=',$book_id)
                ->get();

                $comments =book_model::with('comment')
                ->where('book_id','=',$book_id)
                ->get();

                //BOOKS BY SAME AUTHOR

                $author_id=DB::table('books')->where('book_id',$book_id)->value('author_id');

                $books_by_same_author= author_model::with(['books'=>
                function($query){
                        $query
                        ->leftJoin('editions','editions.edition_id','=','books.edition_id')
                        ->leftJoin('publishers','publishers.publisher_id','=','books.publisher_id')
                        ->leftJoin('authors','authors.author_id','=','books.author_id')
                        ->select('book_id','book_title','books.author_id','book_description','authors.author_name','publishers.publisher_id','publishers.publisher_name','editions.edition_name','assigned','in_stock','buy_price','sale_price','book_cover','books.created_at','books.updated_at')
                        ->take(3);
                }])
                ->where('author_id',$author_id)
                ->orderBy('created_at', 'desc')

                ->get();

                //Similar Books
                $category=DB::table('book_category')->where('book_id','=',$book_id)
                ->leftJoin('categories','book_category.category_id','categories.category_id')
                ->value('categories.category_name');

                $similar_books=category_model::with(['book'=>
                function($query){
                        $query
                        ->leftJoin('books','book_category.book_id','=','books.book_id')
                        ->leftJoin('editions','editions.edition_id','=','books.edition_id')
                        ->leftJoin('publishers','publishers.publisher_id','=','books.publisher_id')
                        ->leftJoin('authors','authors.author_id','=','books.author_id')
                        ->orderBy('books.created_at', 'desc')
                        ->select('book_category.book_id','book_category.category_id','books.book_title','books.book_description','authors.author_id','authors.author_name','publishers.publisher_name','editions.edition_name','books.assigned','books.in_stock','books.buy_price','books.sale_price','books.book_cover','books.created_at','books.updated_at')
                        ->take(6);
                }])

                ->where('categories.category_name','=',$category)

                ->get();


                return view('frontend.book_detail',compact('books','comments','books_by_same_author','similar_books'));
        }

public function category_many_book($category_id,$category_name){


        $categories=DB::table('categories')->get();
        $authors=DB::table('authors')->get();

        $category_many_books=category_model::with(['book'=>
                function($query){
                        $query
                        ->leftJoin('books','book_category.book_id','=','books.book_id')
                        ->leftJoin('editions','editions.edition_id','=','books.edition_id')
                        ->leftJoin('publishers','publishers.publisher_id','=','books.publisher_id')
                        ->leftJoin('authors','authors.author_id','=','books.author_id')
                        ->select('book_category.book_id','book_category.category_id','books.book_title','books.book_description','authors.author_id','authors.author_name','publishers.publisher_name','editions.edition_name','books.assigned','books.in_stock','books.buy_price','books.sale_price','books.book_cover','books.created_at','books.updated_at')
                        ->paginate(6);
                        ;
        }])
        ->where('categories.category_id',$category_id)
        ->get();


        return view('frontend.category_book_browse',compact('categories','authors','category_many_books'));
}

public function author_many_book($author_id,$author_name){

        $categories=DB::table('categories')->get();
        $authors=DB::table('authors')->get();
        $author_many_books=author_model::with(['books'=>
                function($query){
                        $query
                        ->leftJoin('editions','editions.edition_id','=','books.edition_id')
                        ->leftJoin('publishers','publishers.publisher_id','=','books.publisher_id')
                        ->leftJoin('authors','authors.author_id','=','books.author_id')
                        ->select('book_id','book_title','books.author_id','book_description','authors.author_id','authors.author_name','publishers.publisher_name','editions.edition_name','assigned','in_stock','buy_price','sale_price','book_cover','books.created_at','books.updated_at');
                }])
        ->where('authors.author_id',$author_id)
        ->get();
        
        return view('frontend.author_book_browse',compact('categories','authors','author_many_books'));
}       

public function publisher_many_book($publisher_id,$publisher_name){
        $categories=DB::table('categories')->get();
        $authors=DB::table('authors')->get();
        $publisher_many_books=publisher_model::with(['books'=>
                function($query){
                        $query
                        ->leftJoin('editions','editions.edition_id','=','books.edition_id')
                        ->leftJoin('publishers','publishers.publisher_id','=','books.publisher_id')
                        ->leftJoin('authors','authors.author_id','=','books.author_id')
                        ->select('book_id','book_title','book_description','books.publisher_id','authors.author_id','authors.author_name','publishers.publisher_name','editions.edition_name','assigned','in_stock','buy_price','sale_price','book_cover','books.created_at','books.updated_at');
                }])
                ->where('publishers.publisher_id',$publisher_id)
                ->get();
        return view('frontend.publisher_book_browse',compact('categories','authors','publisher_many_books'));        

}




}
