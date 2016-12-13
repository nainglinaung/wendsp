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
use Validator;
use Response;
use File;


class ebook_frontend extends Controller
{
	public function ebook_home(){

	$cover_images=DB::table('cover_images')->get();

	$category_many_books=category_model::with(['e_book'=>
        	function($query){
        		$query
        		->leftJoin('e_books','e_book_category.e_book_id','=','e_books.e_book_id')
        		->leftJoin('editions','editions.edition_id','=','e_books.edition_id')
        		->leftJoin('publishers','publishers.publisher_id','=','e_books.publisher_id')
        		->leftJoin('authors','authors.author_id','=','e_books.author_id')
        		->select('e_book_category.e_book_id','e_book_category.category_id','e_books.e_book_title','e_books.e_book_description','authors.author_id','authors.author_name','publishers.publisher_name','editions.edition_name','e_books.e_book_cover','e_books.e_book_download','e_books.created_at','e_books.updated_at');
        }])->get();

		$latest_books=e_book_model::with('author')->orderBy('created_at', 'desc')
               ->take(6)
               ->get();

		$best_sellings=category_model::with(['e_book'=>
        	function($query){
        		$query
        		->leftJoin('e_books','e_book_category.e_book_id','=','e_books.e_book_id')
        		->leftJoin('editions','editions.edition_id','=','e_books.edition_id')
        		->leftJoin('publishers','publishers.publisher_id','=','e_books.publisher_id')
        		->leftJoin('authors','authors.author_id','=','e_books.author_id')
        		->select('e_book_category.e_book_id','e_book_category.category_id','e_books.e_book_title','e_books.e_book_description','authors.author_id','authors.author_name','publishers.publisher_name','editions.edition_name','e_books.e_book_cover','e_books.e_book_download','e_books.created_at','e_books.updated_at')
        		->take(6);
        }])
		->where('category_name','=','Top 10')
		->get();

		$top_10_images=category_model::with(['e_book'=>
        	function($query){
        		$query
        		->leftJoin('e_books','e_book_category.e_book_id','=','e_books.e_book_id')
        		->leftJoin('editions','editions.edition_id','=','e_books.edition_id')
        		->leftJoin('publishers','publishers.publisher_id','=','e_books.publisher_id')
        		->leftJoin('authors','authors.author_id','=','e_books.author_id')
        		->select('e_book_category.e_book_id','e_book_category.category_id','e_books.e_book_title','e_books.e_book_description','authors.author_name','publishers.publisher_name','editions.edition_name','e_books.e_book_cover','e_books.e_book_download','e_books.created_at','e_books.updated_at')
        		 ->orderBy('created_at', 'desc')
        		->take(3);
        }])
		->where('category_name','=','Top 10')
		->get();

		$top_10_panels=category_model::with(['e_book'=>
        	function($query){
        		$query
        		->leftJoin('e_books','e_book_category.e_book_id','=','e_books.e_book_id')
        		->leftJoin('editions','editions.edition_id','=','e_books.edition_id')
        		->leftJoin('publishers','publishers.publisher_id','=','e_books.publisher_id')
        		->leftJoin('authors','authors.author_id','=','e_books.author_id')
        		->select('e_book_category.e_book_id','e_book_category.category_id','e_books.e_book_title','e_books.e_book_description','authors.author_name','publishers.publisher_name','editions.edition_name','e_books.e_book_cover','e_books.e_book_download','e_books.created_at','e_books.updated_at')
        		 ->orderBy('created_at', 'desc')
        		->take(1);
        }])
		->where('category_name','=','Top 10')
		->get();

		$categories=DB::table('categories')->get();
        $authors=DB::table('authors')->get();

        return view('frontend.e_book_home',compact('cover_images','category_many_books','latest_books','categories','authors','best_sellings','top_10_images','top_10_panels'));
	}



	public function e_book_detail($book_id){
		$books=e_book_model::with(['category'=>
        	function($query){
        		$query
        		->leftJoin('categories','e_book_category.category_id','=','categories.category_id')
        		->select();
        	}

        	,'author','edition','publisher'])
		->where('e_book_id','=',$book_id)
        ->get();

//BOOKS BY SAME AUTHOR
        $author_id=DB::table('e_books')->where('e_book_id',$book_id)->value('author_id');

        $books_by_same_author= author_model::with(['e_books'=>
        	function($query){
        		$query
        		->leftJoin('editions','editions.edition_id','=','e_books.edition_id')
        		->leftJoin('publishers','publishers.publisher_id','=','e_books.publisher_id')
        		->leftJoin('authors','authors.author_id','=','e_books.author_id')
        		->select('e_book_id','e_book_title','e_book_description','e_books.author_id','authors.author_name','publishers.publisher_id','publishers.publisher_name','editions.edition_name','e_book_cover','e_book_download','e_books.created_at','e_books.updated_at')
        		->take(3);
        	}])
        ->where('author_id',$author_id)
        ->orderBy('created_at', 'desc')
        ->get();

        //Similar Books
        $category=DB::table('e_book_category')->where('e_book_id','=',$book_id)
                ->leftJoin('categories','e_book_category.category_id','categories.category_id')
                ->value('categories.category_name');

         $similar_books=category_model::with(['e_book'=>
        	function($query){
        		$query
        		->leftJoin('e_books','e_book_category.e_book_id','=','e_books.e_book_id')
        		->leftJoin('editions','editions.edition_id','=','e_books.edition_id')
        		->leftJoin('publishers','publishers.publisher_id','=','e_books.publisher_id')
        		->leftJoin('authors','authors.author_id','=','e_books.author_id')
        		->orderBy('e_books.created_at', 'desc')
        		->select('e_book_category.e_book_id','e_book_category.category_id','e_books.e_book_title','e_books.e_book_description','authors.author_id','authors.author_name','publishers.publisher_name','editions.edition_name','e_books.e_book_cover','e_books.e_book_download','e_books.created_at','e_books.updated_at')
        		->take(6);
        }])
         ->where('categories.category_name','=',$category)
         ->get();

          $comments =e_book_model::with('comment')
                ->where('e_book_id','=',$book_id)
                ->get();

        return view('frontend.e_book_detail',compact('books','comments','books_by_same_author','similar_books'));


	}

	public function category_many_e_book($category_id,$category_name){

	$categories=DB::table('categories')->get();
    $authors=DB::table('authors')->get();

    $category_many_books=category_model::with(['e_book'=>
        	function($query){
        		$query
        		->leftJoin('e_books','e_book_category.e_book_id','=','e_books.e_book_id')
        		->leftJoin('editions','editions.edition_id','=','e_books.edition_id')
        		->leftJoin('publishers','publishers.publisher_id','=','e_books.publisher_id')
        		->leftJoin('authors','authors.author_id','=','e_books.author_id')
        		->select('e_book_category.e_book_id','e_book_category.category_id','e_books.e_book_title','e_books.e_book_description','authors.author_id','authors.author_name','publishers.publisher_name','editions.edition_name','e_books.e_book_cover','e_books.e_book_download','e_books.created_at','e_books.updated_at');
        }])
    ->where('categories.category_id',$category_id)
    ->get();

	return view('frontend.category_e_book_browse',compact('categories','authors','category_many_books'));

	}

	public function author_many_e_book($author_id,$author_name){

	$categories=DB::table('categories')->get();
    $authors=DB::table('authors')->get();

    $author_many_books=author_model::with(['e_books'=>
        	function($query){
        		$query
        		->leftJoin('editions','editions.edition_id','=','e_books.edition_id')
        		->leftJoin('publishers','publishers.publisher_id','=','e_books.publisher_id')
        		->leftJoin('authors','authors.author_id','=','e_books.author_id')
        		->select('e_book_id','e_book_title','e_book_description','e_books.author_id','authors.author_id','authors.author_name','publishers.publisher_name','editions.edition_name','e_book_cover','e_book_download','e_books.created_at','e_books.updated_at');
        	}])
    ->where('authors.author_id',$author_id)
    ->get();

	return view('frontend.author_e_book_browse',compact('categories','authors','author_many_books'));

	}

	public function publisher_many_e_book($publisher_id,$publisher_name){

	$categories=DB::table('categories')->get();
    $authors=DB::table('authors')->get();

    $publisher_many_books=publisher_model::with(['e_books'=>
        	function($query){
        		$query
        		->leftJoin('editions','editions.edition_id','=','e_books.edition_id')
        		->leftJoin('publishers','publishers.publisher_id','=','e_books.publisher_id')
        		->leftJoin('authors','authors.author_id','=','e_books.author_id')
        		->select('e_book_id','e_book_title','e_book_description','e_books.publisher_id','authors.author_id','authors.author_name','publishers.publisher_name','editions.edition_name','e_book_cover','e_book_download','e_books.created_at','e_books.updated_at');
        	}])
    		->where('publishers.publisher_id',$publisher_id)
    		->get();

	return view('frontend.publisher_e_book_browse',compact('categories','authors','publisher_many_books'));   

	}



}
