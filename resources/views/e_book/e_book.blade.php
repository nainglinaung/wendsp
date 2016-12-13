@extends('master')

@section('content')
           <div class="row">
               <div class="list-title">
                  <span>Books List</span>
                   <a href="{{route('add_e_book') }}" class="btn btn-default">ADD E-BOOK</a>
               </div>
               <div class="list">
                <table class="table">
                  <thead>
                    <tr>
                    <th>#</th>
                    <th>E Book Title</th>
                    <th>Categories</th>
                    <th>Author</th>
                    <th>Publisher</th>
                    <th>Edition</th>
                    <th>E-Book Source</th>
                    <th>Action</th>
                    </tr>
                  </thead>
                <tbody>

                @foreach($books as $book)
                <tr>
                <td>{{$book->e_book_id}}</td>
                <td>{{$book->e_book_title}}</td>
                <td>
                    <?php
                    $categories=DB::table('e_book_category')->where('e_book_id','=',$book->e_book_id)
                    ->leftJoin('categories','categories.category_id','=','e_book_category.category_id')
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
                <td>{{$book->e_book_download}}</td>
                <td><a href="/admin/book/e_book_update/{{$book->e_book_id}}"><span class="glyphicon glyphicon-edit text-warning"></span></a>
                <a href="/admin/book/e_book_delete/{{$book->e_book_id}}/delete"><span class="glyphicon glyphicon-trash text-danger"></span></a>
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