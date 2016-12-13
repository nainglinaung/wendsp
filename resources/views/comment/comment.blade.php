@extends('master')

@section('content')
            <div class="row">
                <div class="list-title">
                    <span>Comments List</span>
                </div>
                <div class="list">
                    <!--comment list header -->
                    <div class="row list-header">
                        <div class="col-sm-3">NAME</div>
                        <div class="col-sm-4">COMMENTS</div>
                        <div class="col-sm-3">IN RESPONSE TO</div>
                        <div class="col-sm-2">TIME</div>
                    </div>
                    <div class="custom-bg-divider"></div>   <!--comment list header -->
                    <!--comment list-->
                    @foreach($comments as $comment)
                    <div class="list-content">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="name-detail">
                                    <div class="team-avatar">
                                        <span class="glyphicon glyphicon-user"></span>
                                    </div>
                                    <div class="team-name comment">
                                        <span>Comment ID - {{$comment->comment_id}}</span>
                                        <span>{{$comment->email}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <span class="comment-text">
                                    {{$comment->comment}}
                                </span>
                                <div class="comment-action">
                                    <a href="#reply" data-toggle="collapse">
                                        <span class="glyphicon glyphicon-share-alt"></span>Reply
                                    </a>
                                    <a href="" class="text-warning">
                                        <span class="glyphicon glyphicon-trash"></span>Trash
                                    </a>
                                </div>
                                <div class="collapse reply-collapse" id="reply">
                                    <form>
                                        <div>
                                            <textarea name="reply" id="reply-msg"  rows="3" class="form-control"></textarea>
                                        </div>
                                        <div>
                                            <button type="submit" class="btn btn-default btn-info">SEND</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-sm-3">
                            <?php 
                            $book_name=DB::table('books')->where('book_id','=',$comment->book_id)->value('book_title');
                            echo $book_name;
                            ?>
                            </div>
                            <div class="col-sm-2">
                                {{$comment->created_at}}
                            </div>
                        </div>
                        <div class="custom-divider"></div>
                    </div>  <!--comment list-->
                    <!--comment list-->
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')

@stop