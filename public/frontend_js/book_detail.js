$(document).on('click','#order_button',function(){
    var amount=$('#book-amount').val();
    var price=$('#book_price').text();
    var total=amount*price;
    console.log(total);

    $('#total_price').val("Total price is "+total+"Ks");
    $('#order_amount').val(amount);
});

