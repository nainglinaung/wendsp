<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\order as order_request;
use App\order as order_model;
use DB;

class orders extends Controller
{
    public function order_panel(){
    	$orders=DB::table('orders')->get();
    	return view('order.order',compact('orders'));
    }


  	public function order_add(order_request $request,order_model $model,$book_id,$email,$phonenumber,$address,$amount){
  		$book_id=$request->book_id;

  		$sale_price=DB::table('books')->where('book_id','=',$book_id)->value('sale_price');

  		$amount=$request->amount;

  		$total=$sale_price*$amount;

  		$data=$model;
  		$data->book_id=$request->book_id;
  		$data->email=$request->email;
  		$data->phonenumber=$request->phonenumber;
  		$data->address=$request->address;
  		$data->amount=$request->amount;
  		$data->total=$total;
      $data->on_the_way=0;
      $data->delievered=0;
  		$data->save();
  	}

    public function order_delete($order_id){
      DB::table('orders')->where('order_id','=',$order_id)->delete();

      return back();
    }

    public function order_update(order_request $request,order_model$model){
      $order_id=$request->order_id;
      $on_the_way=$request->on_the_way;
      $delievered=$request->deliever_state;

    DB::table('orders')->where('order_id','=',$order_id)->
        update(['on_the_way'=>$on_the_way,'delievered'=>$delievered]);

    $deliever_state=DB::table('orders')->where('order_id',$order_id)->value('delievered');

    if($deliever_state===1){

      //GETTING REQUIRED DATA
      $book_id=DB::table('orders')->where('order_id',$order_id)->value('book_id');
      $order_amount=DB::table('orders')->where('order_id',$order_id)->value('amount');
      $sale_price=DB::table('books')->where('book_id',$book_id)->value('sale_price');

      //FOR DECREASING BOOK AMOUNT
      $book_stock=DB::table('books')->where('book_id',$book_id)->value('in_stock');
      if($book_stock>$order_amount){
        $book_left=$book_stock-$order_amount;

      DB::table('books')->where('book_id','=',$book_id)->
        update(['in_stock'=>$book_left]);
      }
      else
      {
        return "Not Enough Stock";
      }

      //POS
      $opening_quantity=DB::table('pos')->where('book_id',$book_id)->value('opening_quantity');
      $receive_quantity=DB::table('pos')->where('book_id',$book_id)->value('receive_quantity');
      $total_stock_quantity=$opening_quantity+$receive_quantity;

      $sale_quantity=DB::table('pos')->where('book_id',$book_id)->value('sale_quantity');
      $total_sale_quantity=$order_amount+$sale_quantity;

      $closing_quantity=$total_stock_quantity-$total_sale_quantity;
      DB::table('pos')->where('book_id',$book_id)->update(['sale_quantity'=>$total_sale_quantity,'sale_amount'=>$total_sale_quantity*$sale_price,'closing_quantity'=>$closing_quantity,'closing_amount'=>$closing_quantity*$sale_price]);



    }
    //return back();
    }

    public function order_book(order_request $request,order_model $model,$book_id){
        $this->validate($request, [
       'email' => 'required|max:255',
       'phonenumber' => 'required',
       'address' =>'required'
        ]); 
      $sale_price=DB::table('books')->where('book_id','=',$book_id)->value('sale_price');

      $amount=$request->amount;

      $total=$sale_price*$amount;

      $data=$model;
      $data->book_id=$request->book_id;
      $data->email=$request->email;
      $data->phonenumber=$request->phonenumber;
      $data->address=$request->address;
      $data->amount=$request->amount;
      $data->total=$total;
      $data->on_the_way=0;
      $data->delievered=0;
      $data->save();

      return back();
    }
}
