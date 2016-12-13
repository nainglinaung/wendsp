$(document).on('click','.confirm_order',function(){
var email=$(this).data('email');
var phonenumber=$(this).data('phonenumber');
var address=$(this).data('address');

$('.replace_email').replaceWith("<p>"+email+"</p>");
$('.replace_phonenumber').replaceWith("<p>"+phonenumber+"</p>");
$('.replace_address').replaceWith("<p>"+address+"</p>");
$('#order_id_edit').val($(this).data('id'));
});