<div class="">
	<a class="hiddenanchor" id="toregister"></a> <a class="hiddenanchor" id="tologin"></a>

	<div id="wrapper">
		<div id="login" class="animate form">
			<section class="login_content">
				<form method="post" action="" id="validate">
					<h1>Đăng ký bản quyền</h1>
					<div class="alert alert-info" role="alert">Vui lòng nhập key được cung cấp để kích hoạt hệ thống</div>
					<div><input type="text" class="form-control"  name="keygen" value="{$value.keygen}" placeholder="Keygen" /></div>
					<div><input type="text" class="form-control"  name="name" value="{$value.name}" placeholder="Name" /></div>
					<div><input type="text" class="form-control" name="phone" value="{$value.phone}" placeholder="Phone" /></div>
					<div><input type="email" class="form-control"  name="email" value="{$value.email}" placeholder="Email" /></div>
					<div><input type="text" class="form-control" name="address" value="{$value.address}" placeholder="Địa chỉ" /></div>
					<div><button type="button" class="btn btn-success btn-lg" onclick="submitKeygen();">Lưu thông tin</button></div>
					<div class="clearfix"></div>
					<div class="separator">
						<div class="clearfix"></div>
						<br />
						<div>
							<h1><i class="fa fa-paw" style="font-size: 26px;"></i> HLSELLING</h1>
							<p>Hlstar.com © 2016 All Rights Reserved.</p>
						</div>
					</div>
				</form>
				<!-- form -->
			</section>
			<!-- content -->
		</div>
	</div>
</div>

<script>
var url = '{$out.url}';
var hkey = '{$out.hkey}';
var cusid = '{$out.cusid}';
var save_keygen = '{$out.keygen}';
</script>
{literal}
<script>
function submitKeygen(){
	var keygen = $("input[name=keygen]").val();
	var name = $("input[name=name]").val();
	var phone = $("input[name=phone]").val();
	var email = $("input[name=email]").val();
	var address = $("input[name=address]").val();
	
	if(keygen!=save_keygen){
		$(".alert").html("Vui lòng nhập đúng keygen được cấp !");
		return false;
	}
	
	url = url + "&keygen=" + encodeURI(keygen);
	url = url + "&hkey=" + encodeURI(hkey);
	url = url + "&cusid=" + cusid;
	url = url + "&cusname=" + encodeURI(name);
	url = url + "&cusphone=" + encodeURI(phone);
	url = url + "&cusemail=" + encodeURI(email);
	
	$.ajax({
	    url: url,
	    context: document.body,
	    error: function(jqXHR, exception) {
			$(".alert").html("Vui lòng kết nối mạng !");
			return false;
	    },
	    success: function(data) {
	    	var data = JSON.parse(data);
	    	if(data.cusid==0 || data.error != ''){
	    		$(".alert").html("Thông tin đăng ký không chính xác !");
	    		return false;
	    	}else{
	    		data['ajax'] = "save_keygen";
	    		data['keygen'] = keygen;
		    	$.post("?mod=install&site=keygen", data).done(function(e){
		    		location.reload();
		    	});
	    	}
	    }
	});
	
	
}
</script>
{/literal}
