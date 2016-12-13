<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WE Distribution | HOME</title>
    <link rel="stylesheet" href="../frontend_css/bootstrap.min.css">
    <link rel="stylesheet" href="../frontend_css/custom.css">
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
                <img src="img/logo.png" alt="WE Distribution">
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
    <!--slider and thumbnail section-->
    <div class="row">
        <div class="col-sm-8">
            <!--slide show-->
            <div class="carousel slide" id="latest-slide">
                <!--indicators-->
                <ol class="carousel-indicators">

                </ol>

                <!--wrapper for slides-->
                <div class="carousel-inner">
                    <div class="item active">
                        <img src="img/books.jpg" alt="" class="img-responsive">
                        <div class="carousel-caption">
                        </div>
                    </div>

                    @foreach($cover_images as $cover_image)
                    <div class="item">
                        <img src="cover_image/{{$cover_image->cover_image_source}}" alt="">
                        <div class="carousel-caption">
                        </div>
                    </div>
                    @endforeach
                </div>

                <!--controls-->
                <a href="#latest-slide" class="left carousel-control" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a href="#latest-slide" class="right carousel-control" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div><!--end slide show-->
        </div>

        <div class="col-sm-4">
            <!--top 10 of month thumbnail-->
            <div id="top-10-month-rect">
                <div id="top-10-month-title">
                    top 10 of month
                </div>

                <div id="top-10-preview">
                @foreach($top_10_panels as $top_10_panel)
                @foreach($top_10_panel->e_book as $top_10_book)
                    <span id="top-10-img-preview">
                    <a href="ebook/book_detail/{{$top_10_book->e_book_id}}/{{$top_10_book->e_book_title}}">
                        <img src="../e_book_cover/{{$top_10_book->e_book_cover}}">
                    </a>
                    </span>
                    <span id="top-10-book-detail">
                        <div>{{$top_10_book->e_book_title}}</div>
                        <div>{{$top_10_book->author_name}}</div>
                        <div>
                        <?php $rating=DB::table('e_comments')->where('e_book_id',$top_10_book->e_book_id)->avg('rating');?>
                        <input type="number" name="rating" class="rating" data-clearable="remove" value="<?php echo floor($rating); ?>" data-readonly />

                        </div>
                        
                    </span>
                @endforeach
                @endforeach
                </div>

                <div class="custom-divider"></div>
                <div id="top-10-book-list">
                @foreach($top_10_images as $top_10_image)
                @foreach($top_10_image->e_book as $image)
                <a href="ebook/book_detail/{{$image->e_book_id}}/{{$image->e_book_title}}">
                    <img src="../e_book_cover/{{$image->e_book_cover}}" alt="book" class="img-responsive">
                </a>
                @endforeach
                @endforeach
                </div>
            </div><!--end top 10 of month thumbnail-->
        </div>
    </div>
    <!--latest book slider section-->
    <div class="row">
        <div id="latest-best-slide-thumbnail">
            <!--nav tabs-->
            <ul class="nav nav-tabs">
                <li class="active"><a href="#latest-book-thumb" data-toggle="tab">Latest Books</a></li>
                <li><a href="#best-seller-thumb" data-toggle="tab">Best Seller</a></li>
            </ul>

            <!--tab panel 1-->
            <div class="tab-content">
                <div class="tab-pane active" id="latest-book-thumb">
                    <div class="carousel slide best-latest-slide" id="latest-slide-list">
                        <!--wrapper for slides-->
                        <div class="carousel-inner">

                           
                            <div>
                             
                                <div class="row">
                                    @foreach($latest_books as $latest_book)
                                    <div class="col-sm-2">
                                        <div>
                                            <a href="ebook/book_detail/{{$latest_book->e_book_id}}/{{$latest_book->e_book_title}}"><img src="../e_book_cover/{{$latest_book->e_book_cover}}"></a>
                                        </div>
                                        <div class="thumbnail-detail">
                                            <div class="row">
                                                <a href="ebook/book_detail/{{$latest_book->book_id}}/{{$latest_book->book_title}}" class="col-sm-10">{{$latest_book->book_title}}</a>
                                            </div>
                                            <div>
                                                <a href="ebook/author/{{$latest_book->author_id}}/{{$latest_book->author->author_name}}">{{$latest_book->author->author_name}}</a>
                                            </div>
                                            <div>
                                            <?php $rating_latest_book=DB::table('comments')->where('book_id',$latest_book->book_id)->avg('rating');?>

                                                <input type="number" name="rating" class="rating" data-clearable="remove" value="<?php echo floor($rating_latest_book); ?>" data-readonly />
                                            </div>
                                
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                            </div>
                            

                        </div>
                    </div><!--end slide show-->
                </div><!--end tab panel 1-->

                <!--tab panel 2-->
                <div class="tab-pane" id="best-seller-thumb">
                    <div class="carousel slide best-latest-slide" id="best-slide-list">
                        <!--wrapper for slides-->
                        <div class="carousel-inner">
                            <div>

                                <div class="row">
                                @foreach($best_sellings as $books)
                                @foreach($books->e_book as $best_selling)
                                    <div class="col-sm-2">
                                        <div>
                                            <a href="ebook/book_detail/{{$best_selling->e_book_id}}/{{$best_selling->e_book_title}}"><img src="../e_book_cover/{{$best_selling->e_book_cover}}"></a>
                                        </div>
                                        <div class="thumbnail-detail">
                                            <div class="row">
                                                <a href="ebook/book_detail/{{$best_selling->e_book_id}}/{{$best_selling->e_book_title}}" class="col-sm-10">{{$best_selling->e_book_title}}</a>
                                            </div>
                                            <div>
                                                <a href="ebook/author/{{$best_selling->author_id}}/{{$best_selling->author_name}}">{{$best_selling->author_name}}</a>
                                            </div>
                                            <div>
                                            <?php $rating_best_book=DB::table('e_comments')->where('e_book_id',$best_selling->e_book_id)->avg('rating');?>

                                                <input type="number" name="rating" class="rating" data-clearable="remove" value="<?php echo floor($rating_best_book); ?>" data-readonly />
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @endforeach

                                </div>
                            </div>

                        </div>

                    </div><!--end slide show-->
                </div><!--end tab panel 2-->
            </div>
        </div>
    </div><!--end latest book slider section-->
    <hr>
    <!--browse book + separate category section-->
    <div class="row" id="browse-separate">
        <!--browse book-->
        <div class="col-md-3" id="">
            <div id="browse-book-title">
                browse books
            </div>
            <div class="custom-divider"></div>

            <!--category-->
            <div class="browse-book-sub-title">
               <div>category</div>
                <div>
                @foreach($categories as $category)
                    <a href="ebook/category/{{$category->category_id}}/{{$category->category_name}}">{{$category->category_name}}</a>
                @endforeach

                </div>
            </div><!--end category-->


            <!--authors-->
            <div class="browse-book-sub-title">
                <div>authors</div>
                <div>
                @foreach($authors as $author)
                    <a href="ebook/author/{{$author->author_id}}/{{$author->author_name}}">{{$author->author_name}}</a>
                @endforeach
                </div>
            </div><!--end authors-->

        </div><!--end browse book-->

        <!--separate category-->
        <div class="col-md-9" id="separate-category">
            <!--content 1-->
            @foreach($category_many_books as $category_many_book)
            <div>
                <div class="separate-cat-title">
                    <div>{{$category_many_book->category_name}}</div>
                    <div><a href="ebook/category/{{$category_many_book->category_id}}/{{$category_many_book->category_name}}" class="btn btn-default">load more</a></div>
                </div>
                <div class="custom-divider"></div>

                <div class="separate-stand">
                @foreach($category_many_book->e_book as $book)
                    <div>
                        <div>
                            <a href="ebook/book_detail/{{$book->e_book_id}}/{{$book->e_book_title}}"><img src="../e_book_cover/{{$book->e_book_cover}}" alt="book1"></a>
                        </div>
                        <div class="thumbnail-detail">
                            <div class="row">
                                <a href="ebook/book_detail/{{$book->e_book_id}}/{{$book->e_book_title}}" class="col-sm-12">{{$book->e_book_title}}</a>
                            </div>
                            <div>
                                <a href="ebook/author/{{$book->author_id}}/{{$book->author_name}}">{{$book->author_name}}</a>
                            </div>
                                <div>
                                <?php $rating_categorize_book=DB::table('e_comments')->where('e_book_id',$book->e_book_id)->avg('rating');?>

                                    <input type="number" name="rating" class="rating" data-clearable="remove" value="<?php echo floor($rating_categorize_book); ?>" data-readonly />
                                </div>
                    
                            <div>

                            </div>
                        </div>
                
                    </div>
                @endforeach

                </div>

            </div><!--end content 1-->
        @endforeach
        </div><!--end separate category-->
    </div><!--end browse book + separate category section-->
    <hr>
</div>

<footer class="footer">
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

<script src="../frontend_js/jquery.min.js"></script>
<script src="../frontend_js/bootstrap.min.js"></script>
<script src="../frontend_js/bootstrap-rating-input.js"></script>
</body>
</html>