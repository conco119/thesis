<div class="container remove-container-js">
	<div class="col-md-9 col-xs-8 col-default conent">

		{include file="../layouts/includes/breadcrumbs.tpl"}

		<div class="full-content cart-cont-page">
			<h3 class="title-page">Thanh toán khi nhận hàng</h3>

			{if $customer neq NULL}
			<form class="form-horizontal" action="" method="post">
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Họ
						và tên</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="inputEmail3"
							placeholder="name" name="name">
					</div>
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="col-sm-2 control-label">Email</label>
					<div class="col-sm-10">
						<input type="email" class="form-control" id="inputPassword3"
							placeholder="email" name="email">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Số
						điện thoại</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="inputEmail3"
							placeholder="phone" name="phone">
					</div>
				</div>

				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Địa
						chỉ</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="inputEmail3"
							placeholder="address" name="address">
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-default" name="FrmSubmit">Gửi
							hóa đơn</button>
					</div>
				</div>
			</form>
			{else}
			<a href="?mod=cart&site=types" class="btn btn-primary">Đăng nhập thành viên</a>
			{/if}
		</div>

		<!--end .content-->

		<div class="full-content cart-cont-page">
			<h3 class="title-page">Thanh toán qua ngân lượng</h3>
			<a class="" target="_blank"
				href="https://www.nganluong.vn/button_payment.php?receiver=chungnd.dsc@gmail.com&product_name=HD002&price={$sum_cart}&return_url=(URL thanh toán thành công)&comments=(Ghi chú về đơn hàng)">
				<img src="https://www.nganluong.vn/data/images/buttons/11.gif"
				border="0" />
			</a>
			
			<div class="img">
				<img alt="ngan luong" src="{$arg.domain}site/upload/generals/nganluong.jpg">
			</div>
		</div>

	</div>

	{include file="../layouts/includes/appsize.tpl"}

</div>