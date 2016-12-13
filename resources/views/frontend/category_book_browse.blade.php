<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WE Distribution | @foreach($category_many_books as $title) {{$title->category_name}} @endforeach</title>
    <link rel="stylesheet" href="../../frontend_css/bootstrap.min.css">
    <link rel="stylesheet" href="../../frontend_css/custom.css">
</head>
<body>


<nav class="navbar navbar-default" id="nav-custom">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#wemobile">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="#" class="navbar-brand">
                <img src="../../img/logo.png" alt="WE Distribution">
            </a>
        </div>
         <div class="collapse navbar-collapse" id="wemobile">
            <ul class="nav navbar-nav">
                <li class=""><a href="/">Book</a></li>
                <li><a href="/ebook">Ebook</a></li>
            </ul>
        </div>
    </div>
</nav>

<div id="nav-fix">
    <ul id="customer-service">
        <li><span></span></li>
        <li><a href="#">(09) 250091913 <span class="glyphicon glyphicon-phone-alt"></span></a></li>
    </ul>
</div>

<div class="container content">
    <div class="row" id="browse-title">
    @foreach($category_many_books as $category_many_book)
        <div>{{$category_many_book->category_name}}</div>
    @endforeach
        <div>

        </div>
        <hr>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div id="browse-ads">
                ads
            </div>
            <div id="browse-book-title">
                browse books
            </div>
            <div class="custom-divider"></div>

            <div class="browse-book-sub-title">
               <div>category</div>
                <div>
                @foreach($categories as $category)
                    <a href="/category/{{$category->category_id}}/{{$category->category_name}}">{{$category->category_name}}</a>
                @endforeach

                </div>
            </div><!--end category-->


            <!--authors-->
            <div class="browse-book-sub-title">
                <div>authors</div>
                <div>
                @foreach($authors as $author)
                    <a href="/author/{{$author->author_id}}/{{$author->author_name}}">{{$author->author_name}}</a>
                @endforeach
                </div>
            </div><!--end authors-->
        </div>
        <div class="col-md-9" id="browse-list">
            <!--content-->
            <div class="separate-stand">
            <div class="row">
            @foreach($category_many_books as $category_many_book)
            @foreach($category_many_book->book as $book)
            <div class="col-sm-2">
                <div>
                    <div>
                        <a href="/book_detail/{{$book->book_id}}/{{$book->book_title}}"><img src="../../book_cover/{{$book->book_cover}}" alt="book1"></a>
                    </div>
                    <div class="thumbnail-detail">
                        <div class="row">
                            <a href="/book_detail/{{$book->book_id}}/{{$book->book_title}}" class="col-sm-12">{{$book->book_title}}</a>
                        </div>
                        <div>
                            <a href="/author/{{$book->author_id}}/{{$book->author_name}}">{{$book->author_name}}</a>
                        </div>
                        <div>
                            <?php 
                    
                    $rating=DB::table('comments')->where('book_id',$book->book_id)->avg('rating');?>
                        <input type="number" name="rating" class="rating" data-clearable="remove" value="<?php echo floor($rating); ?>" data-readonly />
                        </div>
                        <div>
                            {{$book->sale_price}}Ks
                        </div>
                    </div>
                </div>
         
            </div>
            @endforeach
            @endforeach
            </div>
            </div>
            <!--end content-->

            <!--pagination-->
            <!--end pagination-->
        </div>
    </div>
</div>

<footer class="footer browse">
    <ul id="footer-custom">
        <li>
            <p class="footer-title">site map</p>
            <div class="footer-sub-title">
                <p><a href="">Home</a></p>
                <p><a href="">Publishers</a></p>
                <p><a href="">Authors</a></p>
                <p><a href="">Help</a></p>
            </div>
        </li>
        <li>
            <p class="footer-title">site map</p>
            <div class="footer-sub-title">
                <p><a href="">Home</a></p>
                <p><a href="">Publishers</a></p>
                <p><a href="">Authors</a></p>
                <p><a href="">Help</a></p>
            </div>
        </li>
        <li>
            <p class="footer-title">site map</p>
            <div class="footer-sub-title">
                <p><a href="">Home</a></p>
                <p><a href="">Publishers</a></p>
                <p><a href="">Authors</a></p>
                <p><a href="">Help</a></p>
            </div>
        </li>
        <li>
            <p class="footer-title">contact us</p>
            <div class="footer-sub-title">
                <p>Address - Pearl Condo, Bahan Tsp, Yangon, Myanmar</p>
                <p>Mail to - nbspbooks@gmail.com</p>
                <p>Phone - (09) 2050 091 913</p>
            </div>
        </li>
    </ul>
    <div class="footer-divider">
        <div class="custom-divider"></div>
    </div>
    <div id="footer-last">
        <div>Copyright &copy; 2016 - WE Distribution </div>
        <ul>
            <li><a href=""><img src="img/facebook-logo-button.png" alt=""></a></li>
            <li><a href=""><img src="img/twitter-logo-button.png" alt=""></a></li>
        </ul>
    </div>
</footer>

<script src="../../frontend_js/jquery.min.js"></script>
<script src="../../frontend_js/bootstrap.min.js"></script>
<script src="../../frontend_js/bootstrap-rating-input.js"></script>
</body>
</html>