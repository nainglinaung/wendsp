<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WE Distribution | @foreach($books as $book) {{$book->book_title}} @endforeach</title>
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

<div class="container content detail">
    <!--book detail and ads-->
    <div class="row">
        <div class="col-sm-12 col-md-8 book-detail">
        @foreach($books as $book)
        <?php $book_id=$book->book_id; ?>
            <div id="book-detail-thumbnail">
                <div class="col-sm-5">
                    <img src="../../book_cover/{{$book->book_cover}}" alt="">
                </div>
                <div class="col-sm-7">
                    <p>{{$book->book_title}}</p>
                    <p>{{$book->author->author_name}}</p>
                    <p>

                    <?php 
                    $book_id=$book->book_id;
                    $rating=DB::table('comments')->where('book_id',$book->book_id)->avg('rating');?>
                        <input type="number" name="rating" class="rating" data-clearable="remove" value="<?php echo floor($rating); ?>" data-readonly />

                    </p>
                    <p><span id='book_price'>{{$book->sale_price}}</span>Ks</p>

                    <ul>
                        <li>Publisher : <a href="/publisher/{{$book->publisher->publisher_id}}/{{$book->publisher->publisher_name}}">{{$book->publisher->publisher_name}}</a></li>
                        <li>Edition : {{$book->edition->edition_name}}</li>

                        <li>Category : 
                        @foreach($book->category as $category)
                        <a href="/category/{{$category->category_id}}/{{$category->category_name}}">{{$category->category_name}}</a>,
                        @endforeach
                        </li>
                        <?php if($book->in_stock===0){?>
                        <li style="color:red;">In Stock : Out Of Stock</li>

                        <?php } else {?>
                        <li>In Stock : {{$book->in_stock}}</li>
                        <?php } ?>
                    </ul>
                    <div>
                    <?php 
                    $in_stock=$book->in_stock;
                    if($book->in_stock===0){?>
                        <a href="" disabled class="btn btn-info" data-toggle="modal">Order<span class="glyphicon glyphicon-shopping-cart"></span></a>

                        <?php } else {?>

                        <label>Amount ::</label>

                        <input type="number" placeholder="0"  id="book-amount" min="1" max="{{$book->in_stock}}"/>

                        <button href="#book-order" class="btn btn-info" id="order_button" data-toggle="modal">Order<span class="glyphicon glyphicon-shopping-cart"></span></button>
                        <?php } ?>
                        
                    </div>
                    @if (count($errors) > 0)
                    <div class="alert alert-danger" style="margin-top:20px;">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
            <div id="book-detail-description">
                <div class="book-detail-subtitle">
                    <div>DESCRIPTION</div>
                    <div></div>
                </div>
                <p>
                {{$book->book_description}}
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
            @foreach($book_by_same_author->books as $same_author_book)
            <div class="same-author-book">
                <div class="same-author-book-img">
                <a href="/book_detail/{{$same_author_book->book_id}}/{{$same_author_book->book_title}}">
                    <img src="../../book_cover/{{$same_author_book->book_cover}}" alt="">
                </a>
                </div>
                <div class="thumbnail-detail same-author-book-detail">
                    <div>
                        <a href="/book_detail/{{$same_author_book->book_id}}/{{$same_author_book->book_title}}">{{$same_author_book->book_title}}</a>
                    </div>
                    <div>
                        <a href="/publisher/{{$same_author_book->publisher_id}}/{{$same_author_book->publisher_name}}">{{$same_author_book->publisher_name}}</a>
                    </div>
                    <div>
                    <?php 
                    
                    $same_author_rating=DB::table('comments')->where('book_id',$same_author_book->book_id)->avg('rating');?>
                        <input type="number" name="rating" class="rating" data-clearable="remove" value="<?php echo floor($same_author_rating); ?>" data-readonly />
                    </div>
                    <div>{{$same_author_book->sale_price}}Ks</div>
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
                    <?php $review_count=DB::table('comments')->where('book_id',$book_id)->count(); ?>
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
                                <form action="/comment/add/<?php echo $book_id; ?>" class="form-horizontal" method="POST">
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
                    @foreach($similar_category->book as $similar_book)
                        <div class="col-sm-2">
                            <div>

                                <a href="/book_detail/{{$similar_book->book_id}}/{{$similar_book->book_title}}"><img src="../../book_cover/{{$similar_book->book_cover}}"></a>
                            </div>
                            <div class="thumbnail-detail">
                                <div class="row">
                                    <a href="/book_detail/{{$similar_book->book_id}}/{{$similar_book->book_title}}" class="col-sm-10">{{$similar_book->book_title}}</a>
                                </div>
                                <div>
                                    <a href="/author/{{$similar_book->author_id}}/{{$similar_book->author_name}}">{{$similar_book->author_name}}</a>
                                </div>
                                <div>
                                <?php 
                                $similar_book_rating=DB::table('comments')->where('book_id',$similar_book->book_id)->avg('rating');?>
                        <input type="number" name="rating" class="rating" data-clearable="remove" value="<?php echo floor($similar_book_rating); ?>" data-readonly />
                                </div>
                                <div>
                                    {{$similar_book->sale_price}}Ks
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
                <!--ORDER PRODESS-->
                <div class="modal fade" id="book-order" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                <h4 class="modal-title">Order Book</h4>
                            </div>
                            <div class="modal-body">
                                <form action="/order/add/<?php echo $book_id; ?>" class="form-horizontal" method="POST">
                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" placeholder="Email*" name="email">
                                        </div>

                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" placeholder="Phonenumber*" name="phonenumber">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" placeholder="Address*" name="address">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="total_price" disabled name="total">
                                        </div>
                                        <div class="col-sm-6">
                                        <input type="number" class="form-control"   id="order_amount" min="1" max="<?php echo $in_stock;?>" name="amount" style="display: none"/>
                                        </div>


                                    
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="col-sm-2 col-lg-offset-10">
                                            {{csrf_field()}}
                                            <button class="btn btn-info">ORDER<span class="glyphicon glyphicon-shopping-cart"></span></button>
                                            
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

<script src="../../frontend_js/jquery.min.js"></script>
<script src="../../frontend_js/bootstrap.min.js"></script>
<script src="../../frontend_js/bootstrap-rating-input.js"></script>
<script src="../../frontend_js/book_detail.js"></script>
</body>
</html>