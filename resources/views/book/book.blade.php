@extends('master')

@section('content')
           <div class="row">
               <div class="list-title">
                  <span>Books List</span>
                   <a href="{{route('add_book') }}" class="btn btn-default">ADD BOOK</a>
               </div>
               
               <div class="list">
                <table class="table">
                  <thead>
                    <tr>
                    <th>#</th>
                    <th>Book Title</th>
                    <th>Categories</th>
                    <th>Author</th>
                    <th>Publisher</th>
                    <th>Edition</th>
                    <th>Assigned</th>
                    <th>Instock</th>
                    <th>Buy Price</th>
                    <th>Sale Price</th>
                    <th>Action</th>
                    </tr>
                  </thead>
                <tbody>
                @foreach($books as $book)
                <tr>
                <td>{{$book->book_id}}</td>
                <td>{{$book->book_title}}</td>
                <td>
                    <?php
                    $categories=DB::table('book_category')->where('book_id','=',$book->book_id)
                    ->leftJoin('categories','categories.category_id','=','book_category.category_id')
                    ->select('categories.category_name')
                    ->get();

                    foreach ($categories as $category) {
                        echo $category->category_name;
                        echo ",</br>";
                    }


                    
                    ?>

                </td>
                <td>
                <?php 
                $author=DB::table('authors')->where('author_id','=',$book->author_id)->value('author_name');
                echo $author;
                ?>                  
                </td>
                <td>
                <?php 
                $publisher=DB::table('publishers')->where('publisher_id','=',$book->publisher_id)->value('publisher_name');
                echo $publisher;
                ?>                  
                </td>

                <td>
                <?php 
                $edition=DB::table('editions')->where('edition_id','=',$book->edition_id)->value('edition_name');
                echo $edition;
                ?>                  
                </td>
                <td>{{$book->assigned}}</td>
                <td>{{$book->in_stock}}</td>
                <td>{{$book->buy_price}}</td>
                <td>{{$book->sale_price}}</td>
                <td><a href="/admin/book/book_update/{{$book->book_id}}"><span class="glyphicon glyphicon-edit text-warning"></span></a>
                <a href="/admin/book/book_delete/{{$book->book_id}}/delete"><span class="glyphicon glyphicon-trash text-danger"></span></a>
                </td>
                </tr>
                @endforeach
                </tbody>
  </table>
               </div>
           </div>
@stop

@section('script')
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
@stop