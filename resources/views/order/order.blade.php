@extends('master')

@section('content')
                <div class="row">
                <div class="list-title">
                    <span>Orders List</span>
                </div>
                <div class="list">

                    <div class="custom-bg-divider"></div>   <!--order list header-->
                    <div class="list-content">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>ORDER INFO</th>
                            <th>BOOK NAME</th>
                            <th>AMOUNT</th>
                            <th>PRICE</th>
                            <th>TOTAL</th>
                            <th>ORDER DATE</th>
                            <th>STATUS</th>
                            <th>ACTIONS</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{$order->order_id}}</td>
                            <td>
                            <span class="glyphicon glyphicon-envelope"></span>  {{$order->email}}</br>
                            <span class="glyphicon glyphicon glyphicon-phone"></span>  {{$order->phonenumber}}</br>
                            <span class="glyphicon glyphicon    glyphicon glyphicon-home"></span>  {{$order->address}}</br>
                            </td>

                            <td>
                            <?php 
                            $book_name=DB::table('books')->where('book_id','=',$order->book_id)->value('book_title');
                            echo $book_name;
                            ?>
                            </td>
                            <td>{{$order->amount}} pcs</td>
                            <td><?php $price=$order->total/$order->amount; echo $price; ?></td>
                            <td>{{$order->total}} ks</td>
                            <td>{{$order->created_at}}</td>
                            <td>
                            <?php 
                            if($order->on_the_way===0 AND $order->delievered===0)
                            {
                                echo "<p class='text text-danger'>Unconfirm</p>";
                            }
                            elseif($order->on_the_way===1 AND $order->delievered===0)
                            {
                                echo "<p class='text text-warning'>On The Way</p>";
                            }
                            elseif($order->on_the_way===1 AND $order->delievered===1)
                            {
                                echo "<p class='text text-success'>Delievered</p>";
                            }
                            ?>     
                            </td>
                            <td>
      <?php $deliever_state=DB::table('orders')->where('order_id',$order->order_id)->value('delievered');
      if($deliever_state===1){
      ?>
      <p>The Book is successfully handed to the person</p>
      <?php } 
      elseif($deliever_state===0){
      ?>
                            <a href="#" class="confirm_order" data-id="{{$order->order_id}}" data-email="{{$order->email}}" data-address="{{$order->address}}" data-phonenumber="{{$order->phonenumber}}" data-otw="{{$order->on_the_way}}" data-delievered="{{$order->delievered}}" data-toggle="modal" data-target="#confirmingOrder"><span class="glyphicon glyphicon-edit text-warning"></span></a>
                            <a href="/admin/order/delete/{{$order->order_id}}" style="padding-left:20px;"><span class="glyphicon glyphicon-trash text-danger"></span></a>
    <?php } ?>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>

                    </table>
                    </div>
                </div>
            </div>


<!-- Modal -->
<div id="confirmingOrder" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Confirming Order</h4>
      </div>
      <div class="modal-body">
      <label>Email:</label>
      <p class="replace_email"></p>
      <label>Phonenumber:</label>
      <p class="replace_phonenumber"></p>
      <label>Address:</label>
      <p class="replace_address"></p>
      <form action="{{route('order_update')}}" method="POST">
      <div class="data_output">
      <input type="hidden" id="order_id_edit" name="order_id">
      {{ csrf_field() }}
      </div>


         <div class="form-group">
            <label for="on_the_way">On The Way</label>
                <select class="form-control" id="on_the_way" name="on_the_way">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
        </div>

         <div class="form-group">
            <label for="deliever_state">Deliever State</label>
                <select class="form-control" id="deliever_state" name="deliever_state">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>

        </div>

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Update</button>
    </div>

      </div>
    </div>

  </div>
</div>
@stop

@section('script')
<script src="../../js/jquery.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/orders.js"></script>
@stop