@extends('master')

@section('content')
            <div class="row">
                <!--pos title-->
                <div class="list-title pos-list-title">
                    <!--publisher-->
                    <select name="publisher-list" id="publisher-list" class="form-control input-sm">
                        <option value="0" disabled>Publishers</option>
                        <option value="1">စိတ်ကူးကူးချိုချို အနုပညာ (၁)</option>
                        <option value="2">စိတ်ကူးကူးချိုချို အနုပညာ (၂)</option>
                    </select><!--end publisher-->
                    <div id="list-title-select">
                        <!--Month-->
                        <select name="month" id="month" class="form-control input-sm">
                            <option value="0" disabled>Month</option>
                            <option value="1">JAN</option>
                            <option value="2">FEB</option>
                            <option value="3">MAR</option>
                            <option value="4">APR</option>
                            <option value="5">MAY</option>
                            <option value="6">JUN</option>
                            <option value="7">JUL</option>
                            <option value="8">AUG</option>
                            <option value="9">SEPT</option>
                            <option value="10">OCT</option>
                            <option value="11">NOV</option>
                            <option value="12">DEC</option>
                        </select><!-- end Month-->
                        <!--Year-->
                        <select name="year" id="year" class="form-control input-sm">
                            <option value="0" disabled>Year</option>
                            <option value="1">2015</option>
                            <option value="2">2016</option>
                            <option value="3">2017</option>
                        </select><!--end Year-->
                    </div>
                </div>
                <div class="list">
                    <!--pos header-->
                    <div class="row list-pos-header">
                        <div>DES</div>
                        <div>
                            <span>OPENING</span>
                            <div class="custom-divider pos"></div>
                            <div class="qty-amt">
                                <span>Qty</span>

                                <span>Amt</span>
                            </div>
                        </div>
                        <div>
                            <span>RECEIVE</span>
                            <div class="custom-divider pos"></div>
                            <div class="qty-amt">
                                <span>Qty</span>
                                <span>Amt</span>
                            </div>
                        </div>
                        <div>
                            <span>SALES</span>
                            <div class="custom-divider pos"></div>
                            <div class="qty-amt">
                                <span>Qty</span>
                                <span>Amt</span>
                            </div>
                        </div>
                        <div>
                            <span>RETURN</span>
                            <div class="custom-divider pos"></div>
                            <div class="qty-amt">
                                <span>Qty</span>
                                <span>Amt</span>
                            </div>
                        </div>
                        <div>
                            <span>CLOSING</span>
                            <div class="custom-divider pos"></div>
                            <div class="qty-amt">
                                <span>Qty</span>
                                <span>Amt</span>
                            </div>
                        </div>
                        <div>COMM</div>
                    </div><!--end pos header-->
                    <div class="custom-bg-divider"></div><!--end pos title-->
                    <!--pos content-->
                    @foreach($pos_result as $pos)
                    <div class="list-content pos-content">
                        <div><?php $book_name=DB::table('books')->where('book_id',$pos->book_id)->value('book_title'); echo $book_name;?></div>
                        <div>
                            <div>{{$pos->opening_quantity}}</div>
                            <div>{{$pos->opening_amount}}</div>
                        </div>
                        <div>
                            <div>{{$pos->receive_quantity}}</div>
                            <div>{{$pos->receive_amount}}</div>
                        </div>
                        <div>
                            <div>{{$pos->sale_quantity}}</div>
                            <div>{{$pos->sale_amount}}</div>
                        </div>
                        <div>
                            <div>{{$pos->return_quantity}}</div>
                            <div>{{$pos->return_amount}}</div>
                        </div>
                        <div>
                            <div>{{$pos->closing_quantity}}</div>
                            <div>{{$pos->closing_amount}}</div>
                        </div>
                        <div class="book-action pos-action">
                            <span>
                                <a href="#" class="addingcomment" data-toggle="modal" data-target="#addcomment" data-id="{{$pos->pos_id}}"><span class="glyphicon glyphicon-pencil text-warning"></span></a>
                                <a href="/admin/pos/delete/{{$pos->pos_id}}"><span class="glyphicon glyphicon-trash text-danger"></span></a>
                            </span>
                            <span>{{$pos->remark}}</span>
                        </div>
                    </div>
                    <div class="custom-divider pos-divider"></div>
                    @endforeach
                    <!--end pos content-->
                    <!--pos content-->
    <!--end pos content-->
                </div>
            </div>
<!--MODAL-->
<div id="addcomment" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Adding Comment</h4>
      </div>
      <div class="modal-body">
      <form action="{{route('pos_update')}}" method="POST">
      <div class="data_output">
      <input type="hidden" id="pos_id_edit" name="pos_id">
      {{ csrf_field() }}
      </div>
      <div class="form-group">
                        <label for="description">Comment:</label>
                        <textarea class="form-control" rows="5" id="description" name="remark"></textarea>
     </div>
    </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">ADD</button>
    </div>

      </div>
    </div>

  </div>
@stop

@section('script')
<script src="../../js/jquery.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/pos.js"></script>
@stop