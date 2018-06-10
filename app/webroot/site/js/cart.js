// JavaScript Document



function addToCart(id){
	$.post('./?mc=cart&site=add',{
		'id': id
	}).done(function(data){
		data = JSON.parse(data);
		console.log(data);
		$("#cart-number").html(`${data.product} sản phẩm  ${data.service} dịch vụ`);
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
//service
function addService(id){
	$.post('./?mc=cart&site=addService',{
		'id': id
	}).done(function(data){
		data = JSON.parse(data);
		$("#cart-number").html(`${data.product} sản phẩm  ${data.service} dịch vụ`);
		MessageModal("Đã đưa dịch vụ vào giỏ hàng của bạn !");
		return false;
	});
	return false;
}

function updateService(value, id){
	if(value <= 0)
		value =1;
	$.post('./?mc=cart&site=updateService',{
		id: id, value: value
	}).done(function(){
		window.location.reload(true);
	});
}

function deleteService(id){
	$.post('./?mc=cart&site=deleteService',{
		id: id
	}).done(function(){
		window.location.reload(true);
	});
}