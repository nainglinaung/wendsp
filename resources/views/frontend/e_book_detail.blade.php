<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WE Distribution | @foreach($books as $book) {{$book->e_book_title}} @endforeach</title>
    <link rel="stylesheet" href="../../../frontend_css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../frontend_css/custom.css">
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
                <img src="../../../img/logo.png" alt="WE Distribution">
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

<div class="container content detail">
    <!--book detail and ads-->
    <div class="row">
        <div class="col-sm-12 col-md-8 book-detail">
        @foreach($books as $book)
        <?php $book_id=$book->e_book_id; ?>
            <div id="book-detail-thumbnail">
                <div class="col-sm-5">
                    <img src="../../../e_book_cover/{{$book->e_book_cover}}" alt="">
                </div>
                <div class="col-sm-7">
                    <p>{{$book->e_book_title}}</p>
                    <p>{{$book->author->author_name}}</p>
                    <p>

                    <?php 
                    $book_id=$book->e_book_id;
                    $rating=DB::table('e_comments')->where('e_book_id',$book->e_book_id)->avg('rating');?>
                        <input type="number" name="rating" class="rating" data-clearable="remove" value="<?php echo floor($rating); ?>" data-readonly />

                    </p>
                 

                    <ul>
                        <li>Publisher : <a href="../../../ebook/publisher/{{$book->publisher->publisher_id}}/{{$book->publisher->publisher_name}}">{{$book->publisher->publisher_name}}</a></li>
                        <li>Edition : {{$book->edition->edition_name}}</li>

                        <li>Category : 
                        @foreach($book->category as $category)
                        <a href="../../../ebook/category/{{$category->category_id}}/{{$category->category_name}}">{{$category->category_name}}</a>,
                        @endforeach
                        </br>
                    <a href="/e_book/book_source/{{$book->e_book_id}}/{{$book->e_book_download}}">Download<span class="glyphicon glyphicon-download"></span></a>
                    </ul>
                    <div>
             
                    </div>
                </div>
            </div>
            <div id="book-detail-description">
                <div class="book-detail-subtitle">
                    <div>DESCRIPTION</div>
                    <div></div>
                </div>
                <p>
                {{$book->e_book_description}}
                </p>
            </div>
        @endforeach
        </div>
        <div class="col-md-4 ads">
        @foreach($books_by_same_author as $book_by_same_author)
            <div class="ads-pos">
                <div class="ads-book-detail">ads</div>
            </div>
            <div>BOOKS BY {{$book_by_same_author->author_name}}</div>
            <div class="custom-bg-divider"></div>
            @foreach($book_by_same_author->e_books as $same_author_book)
            <div class="same-author-book">
                <div class="same-author-book-img">
                <a href="../../../ebook/book_detail/{{$same_author_book->e_book_id}}/{{$same_author_book->e_book_title}}">
                    <img src="../../../e_book_cover/{{$same_author_book->e_book_cover}}" alt="">
                </a>
                </div>
                <div class="thumbnail-detail same-author-book-detail">
                    <div>
                        <a href="../../../ebook/book_detail/{{$same_author_book->e_book_id}}/{{$same_author_book->e_book_title}}">{{$same_author_book->e_book_title}}</a>
                    </div>
                    <div>
                        <a href="../../../ebook/publisher/{{$same_author_book->publisher_id}}/{{$same_author_book->publisher_name}}">{{$same_author_book->publisher_name}}</a>
                    </div>
                    <div>
                    <?php 
                    
                    $same_author_rating=DB::table('e_comments')->where('e_book_id',$same_author_book->e_book_id)->avg('rating');?>
                        <input type="number" name="rating" class="rating" data-clearable="remove" value="<?php echo floor($same_author_rating); ?>" data-readonly />
                    </div>
                    
                </div>
            </div>
            @endforeach
        @endforeach
        </div>
    </div><!--end book detail and ads-->
    <hr>
    <div class="row review">
        <div class="book-detail-subtitle review">
            <div>REVIEW</div>
            <div></div>
        </div>
        <div id="review-section">
            <!--rating show-->
            <div class="col-md-3" id="rating-section">
                <div id="rating-review">
                    <div>
                    <?php $review_count=DB::table('e_comments')->where('e_book_id',$book_id)->count(); ?>
                        <?php echo $review_count; ?> review(s)
                    </div>
                    <div>
                        <?php echo floor($rating); ?>
                    </div>
                    <div>
                        <input type="number" name="rating" class="rating" data-clearable="remove" value=" <?php echo floor($rating); ?>" data-readonly />
                    </div>
                    <div>
                        <a href="#write-review" class="btn btn-info" data-toggle="modal">WRITE REVIEW <span class="glyphicon glyphicon-pencil"></span></a>
                    </div>
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
                <!--write rating modal-->
                <div class="modal fade" id="write-review" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                <h4 class="modal-title">Review</h4>
                            </div>
                            <div class="modal-body">
                                <form action="/e_comment/add/<?php echo $book_id; ?>" class="form-horizontal" method="POST">
                                    <div class="form-group">
                                        <label for="rating-star" class="col-sm-2">Your Rating</label>
                                        <div class="col-sm-10">

                                            <input type="number" name="rating" id="rating-star" name="rating" class="rating" data-clearable="remove" />
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" placeholder="Email*" name="email">

                                            
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <textarea name="comment" class="form-control" rows="3" placeholder="Comments*" name="comment"></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="col-sm-2 col-lg-offset-10">
                                            {{csrf_field()}}
                                            <button class="btn btn-info">SUBMIT</button>
                                            
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--end rating show-->
            <div class="col-md-9">
                <!--comments-->
                @foreach($comments as $book)
                @foreach($book->comment as $comment)
                <div class="reviewed-comment">
                    <div>
                        <div>
                            <span class="glyphicon glyphicon-user"></span>
                        </div>
                        <div>
                            {{$comment->email}}
                        </div>
                        <div>

                            <input type="number" name="rating" class="rating" data-clearable="remove" value="{{$comment->rating}}" data-readonly />
                        </div>
                    </div>
                    <div>
                        {{$comment->comment}}
                    </div>
                </div>
                @endforeach
                @endforeach
                
                </div>
<!--end comments-->
                <!--pagination-->
                <!--
                <nav>
                    <ul class="pagination pagination-sm">
                        <li class="disabled"><a href=""><span>&laquo;</span></a></li>
                        <li class="active"><a href="">1 <span class="sr-only">( current )</span></a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                        <li><a href="">4</a></li>
                        <li><a href="">5</a></li>
                        <li><a href=""><span>&raquo;</span></a></li>
                    </ul>
                </nav>
                --><!--end pagination-->
            </div>
        </div>
    </div>

    <div class="row related-book">
        <div class="book-detail-subtitle review">
            <div>RELATED BOOKS</div>
            <div></div>
        </div>
        <div class="carousel slide best-latest-slide" id="best-slide-list">
            <!--wrapper for slides-->
            <div class="carousel-inner">
                <div>

                    <div class="row">
                    @foreach($similar_books as $similar_category)
                    @foreach($similar_category->e_book as $similar_book)
                        <div class="col-sm-2">
                            <div>

                                <a href="../../../ebook/book_detail/{{$similar_book->e_book_id}}/{{$similar_book->e_book_title}}"><img src="../../../e_book_cover/{{$similar_book->e_book_cover}}"></a>
                            </div>
                            <div class="thumbnail-detail">
                                <div class="row">
                                    <a href="../../../ebook/book_detail/{{$similar_book->e_book_id}}/{{$similar_book->e_book_title}}" class="col-sm-10">{{$similar_book->e_book_title}}</a>
                                </div>
                                <div>
                                    <a href="../../../ebook/author/{{$similar_book->author_id}}/{{$similar_book->author_name}}">{{$similar_book->author_name}}</a>
                                </div>
                                <div>
                                <?php 
                                $similar_book_rating=DB::table('e_comments')->where('e_book_id',$similar_book->e_book_id)->avg('rating');?>
                        <input type="number" name="rating" class="rating" data-clearable="remove" value="<?php echo floor($similar_book_rating); ?>" data-readonly />
                                </div>
                        
                            </div>
                        </div>
                    @endforeach
                    @endforeach


        </div><!--end slide show-->
    </div>
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
               

<script src="../../../frontend_js/jquery.min.js"></script>
<script src="../../../frontend_js/bootstrap.min.js"></script>
<script src="../../../frontend_js/bootstrap-rating-input.js"></script>
<script src="../../../frontend_js/book_detail.js"></script>
</body>
</html>