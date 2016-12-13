<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/book/book_panel',['middleware'=>'auth_access','as'=>'book_panel','uses'=>'books@book_panel']);

Route::get('/admin/book/add',['middleware'=>'auth_access','as'=>'add_book','uses'=>'books@add_book']);

Route::get('/admin/comment/comment_panel',['middleware'=>'auth_access','as'=>'comment_panel','uses'=>'comments@comment_panel']);

Route::get('/admin/e_comment/e_comment_panel',['middleware'=>'auth_access','as'=>'e_comment_panel','uses'=>'e_comments@e_comment_panel']);

Route::get('/admin/order/order_panel',['middleware'=>'auth_access','as'=>'order_panel','uses'=>'orders@order_panel']);

Route::get('/admin/admin/admin_panel',['middleware'=>'auth_access','as'=>'admin_panel','uses'=>'admins@admin_panel']);

Route::get('/admin/pos/pos_panel',['middleware'=>'auth_access','as'=>'pos_panel','uses'=>'pos@pos_panel']);

Route::get('/admin/book/e_book_panel',['middleware'=>'auth_access','as'=>'e_book_panel','uses'=>'e_books@e_book_panel']);

Route::get('/admin/book/add_ebook',['middleware'=>'auth_access','as'=>'add_e_book','uses'=>'e_books@add_e_book']);

Route::get('/admin/cover_image/cover_image_panel',['middleware'=>'auth_access','as'=>'cover_image','uses'=>'cover_image@cover_image']);

//Books

//BOOKS ADD
Route::post('/admin/book/book_add',['middleware'=>'auth_access','as'=>'book_add','uses'=>'books@book_add']);

//BOOKS UPDATE
Route::get('/admin/book/book_update/{book_id}',['middleware'=>'auth_access','as'=>'book_update','uses'=>'books@book_update']);
Route::post('/admin/book/book_update/{book_id}/update',['middleware'=>'auth_access','as'=>'book_update_now','uses'=>'books@book_update_now']);
//BOOKS DELETE
Route::get('/admin/book/book_delete/{book_id}/delete',['middleware'=>'auth_access','as'=>'book_delete','uses'=>'books@book_delete']);

//E-BOOK ADD
Route::post('/admin/book/ebook_add',['middleware'=>'auth_access','as'=>'e_book_add','uses'=>'e_books@e_book_add']);



//E-BOOK Update
Route::get('/admin/book/e_book_update/{book_id}',['middleware'=>'auth_access','as'=>'e_book_update','uses'=>'e_books@e_book_update']);
Route::post('/admin/book/e_book_update/{book_id}/update',['middleware'=>'auth_access','as'=>'book_update_now','uses'=>'e_books@e_book_update_now']);
//E-BOOK DELETE
Route::get('/admin/book/e_book_delete/{book_id}/delete',['middleware'=>'auth_access','as'=>'book_delete','uses'=>'e_books@e_book_delete']);


//Categories
Route::post('/admin/book/category_add',['middleware'=>'auth_access','as'=>'category_add','uses'=>'categories@category_add']);



//Authors

Route::post('/admin/book/author_add',['middleware'=>'auth_access','as'=>'author_add','uses'=>'authors@author_add']);

//Publishers

Route::post('/admin/book/publisher_add',['middleware'=>'auth_access','as'=>'publisher_add','uses'=>'publishers@publisher_add']);

//Editions

Route::post('/admin/book/edition_add',['middleware'=>'auth_access','as'=>'edition_add','uses'=>'editions@edition_add']);


//CoverPhoto
//ADD
Route::post('/admin/cover_image/cover_image_add',['middleware'=>'auth_access','as'=>'cover_image_add','uses'=>'cover_image@cover_image_add']);
//DELETE
Route::get('/admin/cover_image/delete/{cover_image_id}',['middleware'=>'auth_access','as'=>'cover_image_delete','uses'=>'cover_image@cover_image_delete']);



//Admin
Route::post('/admin/admin/admin_panel/add',['middleware'=>'auth_access','as'=>'admin_add','uses'=>'admins@admin_add']);
Route::get('/admin/admin/admin_panel/delete/{admin_id}',['middleware'=>'auth_access','as'=>'admin_delete','uses'=>'admins@admin_delete']);

//Comments 
Route::get('/admin/comment/add/{book_id}/{email}/{comment}/{rating}',['as'=>'comment_add','uses'=>'comments@comment_add']);

//E_Comments
Route::get('/admin/e_comment/add/{e_book_id}/{email}/{comment}/{rating}',['as'=>'e_comment_add','uses'=>'e_comments@e_comment_add']);

//Orders
Route::get('/admin/order/add/{book_id}/{email}/{phonenumber}/{address}/{amount}',['as'=>'order_add','uses'=>'orders@order_add']);

Route::get('/admin/order/delete/{order_id}',['middleware'=>'auth_access','as'=>'order_delete','uses'=>'orders@order_delete']);

Route::post('/admin/order/update',['middleware'=>'auth_access','as'=>'order_update','uses'=>'orders@order_update']);

//ADMIN AUTH
Route::get('/admin/login',['as'=>'admin_login','uses'=>'admins@admin_login']);

Route::post('/admin/login_access',['as'=>'login_access','uses'=>'Auth\LoginController@login_access']);
Route::get('/admin/logout',['as'=>'logout','uses'=>'Auth\LoginController@logout']);
//Testing Nest
//Editions
//APIS

Route::get('/api/all_book',['as'=>'all_book','uses'=>'api@all_book']);

Route::get('api/only_one_book/{book_id}',['as'=>'only_one_book','uses'=>'api@only_one_book']);

Route::get('/api/all_author',['as'=>'all_author','uses'=>'api@all_author']);

Route::get('/api/all_edition',['as'=>'all_edition','uses'=>'api@all_edition']);

Route::get('/api/all_publisher',['as'=>'all_publisher','uses'=>'api@all_publisher']);

Route::get('/api/all_category',['as'=>'all_category','uses'=>'api@all_category']);

Route::get('/api/author_many_books',['as'=>'author_many_books','uses'=>'api@author_many_books']);

Route::get('/api/edition_many_books',['as'=>'edition_many_books','uses'=>'api@edition_many_books']);

Route::get('/api/publisher_many_books',['as'=>'publisher_many_books','uses'=>'api@publisher_many_books']);
//Need to change 
Route::get('/api/book_many_categories',['as'=>'book_many_categories','uses'=>'api@book_many_categories']);
Route::get('/api/category_many_books',['as'=>'category_many_books','uses'=>'api@category_many_books']);

//Best Seeling And International
Route::get('/api/best_seeling_books',['as'=>'best_seeling_books','uses'=>'api@best_seeling_books']);
Route::get('/api/international_books',['as'=>'international_books','uses'=>'api@international_books']);





//E Books
Route::get('/api/all_e_book',['as'=>'all_e_book','uses'=>'api@all_e_book']);

Route::get('api/only_one_e_book/{book_id}',['as'=>'only_one_e_book','uses'=>'api@only_one_e_book']);

Route::get('/api/author_many_e_books',['as'=>'author_many_e_books','uses'=>'api@author_many_e_books']);

Route::get('/api/edition_many_e_books',['as'=>'edition_many_e_books','uses'=>'api@edition_many_e_books']);

Route::get('/api/publisher_many_e_books',['as'=>'publisher_many_e_books','uses'=>'api@publisher_many_e_books']);

//Need to change 
Route::get('/api/e_book_many_categories',['as'=>'e_book_many_categories','uses'=>'api@e_book_many_categories']);
Route::get('/api/category_many_e_books',['as'=>'category_many_e_books','uses'=>'api@category_many_e_books']);


//Comment
Route::get('/api/book_many_comments',['as'=>'book_many_comments','uses'=>'api@book_many_comments']);

//E_Comment
Route::get('/api/e_book_many_e_comments',['as'=>'e_book_many_e_comments','uses'=>'api@e_book_many_e_comments']);

//Images
Route::get('/api/image/book_cover/{book_cover}',['as'=>'book_cover','uses'=>'api@book_cover']);

Route::get('/api/image/e_book_cover/{e_book_cover}',['as'=>'e_book_cover','uses'=>'api@e_book_cover']);

Route::get('/api/image/cover_image/{cover_image}',['as'=>'cover_image_source','uses'=>'api@cover_image_source']);




//FRONT END

//FRONT END

//FRONT END

//FRONT END

//FRONT END
Route::get('/',['as'=>'home','uses'=>'front_end@home']);

Route::get('/book_detail/{book_id}/{book_name}',['as'=>'book_detail','uses'=>'front_end@book_detail']);

//Category Book
Route::get('/category/{category_id}/{category_name}',['as'=>'category_many_book','uses'=>'front_end@category_many_book']);

//Author Book
Route::get('/author/{author_id}/{author_name}',['as'=>'author_many_book','uses'=>'front_end@author_many_book']);

//Publisher Book
Route::get('/publisher/{publisher_id}/{publisher_name}',['as'=>'publisher_many_book','uses'=>'front_end@publisher_many_book']);

//E BOOK HOME
Route::get('/ebook',['as'=>'ebook_home','uses'=>'ebook_frontend@ebook_home']);

Route::get('ebook/book_detail/{book_id}/{book_name}',['as'=>'e_book_detail','uses'=>'ebook_frontend@e_book_detail']);



//Category E Book
Route::get('ebook/category/{category_id}/{category_name}',['as'=>'category_many_e_book','uses'=>'ebook_frontend@category_many_e_book']);

//Author E Book
Route::get('ebook/author/{author_id}/{author_name}',['as'=>'author_many_e_book','uses'=>'ebook_frontend@author_many_e_book']);

//Publisher E Book
Route::get('ebook/publisher/{publisher_id}/{publisher_name}',['as'=>'publisher_many_e_book','uses'=>'ebook_frontend@publisher_many_e_book']);





//Comment Add
Route::post('/comment/add/{book_id}',['as'=>'post_comment','uses'=>'comments@post_comment']);

//E_Comment Add
Route::post('/e_comment/add/{e_book_id}',['as'=>'post_e_comment','uses'=>'e_comments@post_e_comment']);


//Publisher Book
Route::post('/order/add/{book_id}',['as'=>'order_book','uses'=>'orders@order_book']);

//E Book Source
Route::get('/e_book/book_source/{e_book_id}/{e_book_download}',['as'=>'e_book_source','uses'=>'e_books@e_book_source']);


//POS
Route::post('/admin/pos/update',['middleware'=>'auth_access','as'=>'pos_update','uses'=>'pos@pos_update']);

Route::get('/admin/pos/delete/{pos_id}',['middleware'=>'auth_access','as'=>'pos_delete','uses'=>'pos@pos_delete']);