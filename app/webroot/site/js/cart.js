// JavaScript Document

(function($) {
	$(document).ready(function(e) {
		/* --- CART --- */
		$("#delete_cart").click(function(){
			$.post('?mod=cart&site=handle',{
				hand: 'delete'
			}).done(function(){
				alert("Xoá giỏ hàng thành công !");
			},function(){
				window.location.reload(true);
			});
			return false;
		});

		$(".cart-display").load("?mod=cart&site=ajax_load_cart_info");
		$(".cart-display-list").load("?mod=cart&site=ajax_load_cart_list");

	});

}(jQuery));


function addToCart(id){
	$.post('./?mc=cart&site=add',{
		'id': id
	}).done(function(data){
		$("#cart-number").html(`${data} sản phẩm`);
		MessageModal("Đã đưa sản phẩm vào giỏ hàng của bạn !");
		return false;
	});
	return false;
}

function addNumberToCart(id){
	var number = parseInt($("#CartNumber"+id).val());
	if(number==0)
		number = 1;
	$.post('?mod=cart&site=ajax_add_number_to_cart',{
		'id': id, 'number':number
	}).done(function(){
		MessageModal("Đã đưa sản phẩm vào giỏ hàng của bạn !");
		return false;
	});
	return false;
}

function updateCart(value, id){
	if(value <= 0)
		value =1;
	$.post('./?mc=cart&site=update',{
		id: id, value: value
	}).done(function(){
		window.location.reload(true);
	});
}

function delateItemCart(id){
	$.post('./?mc=cart&site=delete',{
		id: id
	}).done(function(){
		window.location.reload(true);
	});
}

function DeleteAll()
{
	$.post('./?mc=cart&site=delete_all').done(function(){
		window.location.reload(true);
	});
}
