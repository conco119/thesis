$(document).ready(function() {


});

function compareProduct(id){
	$.post('?mod=product&site=ajax_set_compare_product',{
		'id': id
	}).done(function(rt){
		if($rt=='1'){
			alert("Đã thêm sản phẩm vào so sánh !");
			return false;
		}
		else if($rt=='2'){
			alert("Sản phẩm đã được đưa vào so sánh !");
			return false;
		}
		//$('#showcart').load('?mod=cart&site=number_cart');
		//window.location = ('?mod=cart&site=index');
	});
	return false;
}