@extends('master2')

@section('content')

@foreach($books as $book)
    <form action="/admin/book/e_book_update/{{$book->e_book_id}}/update" method="POST" enctype="multipart/form-data">
            <div class="row" id="publish-position">
                <button type="submit" class="btn btn-default right" id="add_book">UPDATE</button>
            </div>
            <div class="row">
                <div class="col-sm-8">

                    <div class="form-group">
                        <label for="book_title">E-Book Title:</label>
                        <input type="text" class="form-control" id="book_title" name="book_title" value="{{$book->e_book_title}}">
                    </div>

                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" rows="5" id="description" name="description">{{$book->e_book_description}}</textarea>
                    </div>
@endforeach
                    <div class="col-sm-3">
                        <label for="sel1">Category list:</label>
                            <select class="form-control" id="category" name="category_1">
                            @foreach($categories as $category)
                                <option value="{{$category->category_id}}">{{$category->category_name}}</option>     
                            @endforeach
                            </select>

                            <select class="form-control" id="category" name="category_2">
                            <option value="0">---</option>
                            @foreach($categories as $category)
                                <option value="{{$category->category_id}}">{{$category->category_name}}</option>     
                            @endforeach
                            </select>

                            <select class="form-control" id="category" name="category_3">
                            <option value="0">---</option>
                            @foreach($categories as $category)
                                <option value="{{$category->category_id}}">{{$category->category_name}}</option>     
                            @endforeach
                            </select>

                            <select class="form-control" id="category" name="category_4">
                            <option value="0">---</option>
                            @foreach($categories as $category)
                                <option value="{{$category->category_id}}">{{$category->category_name}}</option>     
                            @endforeach
                            </select>

                            <select class="form-control" id="category" name="category_5">
                            <option value="0">---</option>
                            @foreach($categories as $category)
                                <option value="{{$category->category_id}}">{{$category->category_name}}</option>     
                            @endforeach
                            </select>


                    </div>

                    <div class="col-sm-3">
                        <label for="sel1">Author list:</label>
                            <select class="form-control" id="author" name="author">
                            @foreach($authors as $author)
                                <option value="{{$author->author_id}}">{{$author->author_name}}</option>     
                            @endforeach
                            </select>
                    </div>

                    <div class="col-sm-3">
                        <label for="sel1">Publisher list:</label>
                            <select class="form-control" id="publisher" name="publisher">
                            @foreach($publishers as $publisher)
                                <option value="{{$publisher->publisher_id}}">{{$publisher->publisher_name}}</option>     
                            @endforeach
                            </select>
                    </div>

                    <div class="col-sm-3">
                        <label for="sel1">Edition list:</label>
                            <select class="form-control" id="edition" name="edition">
                            @foreach($editions as $edition)
                                <option value="{{$edition->edition_id}}">{{$edition->edition_name}}</option>     
                            @endforeach
                            </select>
                    </div>
                    {{ csrf_field() }}
                    </form>
                </div>
                <div class="col-sm-3">
                    <div class="tag">
                        <div class="tag-frame">
                            <span>CATEGORY</span>
                            <div class="tag-action">
                                <form action="{{route('category_add')}}" method="POST">
                                <span>

                                    <input type="text"  placeholder="add new category" name="add_category">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-info btn-sm">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                </span>
                                </form>
                            </div>

                            <div class="tag-action">
                                <form action="{{route('author_add')}}" method="POST">
                                <span>

                                    <input type="text"  placeholder="add new author" name="add_author">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-info btn-sm">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                </span>
                                </form>
                            </div>

                            <div class="tag-action">
                                <form action="{{route('publisher_add')}}" method="POST">
                                <span>

                                    <input type="text"  placeholder="add new publisher" name="add_publisher">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-info btn-sm">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                </span>
                                </form>
                            </div>

                            <div class="tag-action">
                                <form action="{{route('edition_add')}}" method="POST">
                                <span>

                                    <input type="text"  placeholder="add new edition" name="add_edition">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-info btn-sm">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                </span>
                                </form>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

@stop


@section('script')
<script src="../../../js/jquery.min.js"></script>
<script src="../../../js/bootstrap.min.js"></script>


@stop