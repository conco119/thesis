<div class="widget">
	<div class="widget-header">
		<i class="icon-bookmark"></i>
		<h3>Cài đặt ứng dụng</h3>
	</div>
	<!-- /widget-header -->
	<div class="widget-content">

		<form method="post" class="form-horizontal form">
			<div class="control-group">
				<label class="control-label" for="firstname"></label>
				<div class="controls">
					<h3>Thông tin sử dụng</h3><br>
					<p>Bạn đang dùng hệ thống quản lý bán hàng của <a href="http://hlstar.com" title="hlstar">Hlstar</a></p>
					<p>Phiên bản: {$value.version}</p>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="firstname">Ngày khởi tạo</label>
				<div class="controls">
					<input type="text" class="span3 " disabled value="{$value.ctime}">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="firstname">Ngày hết hạn</label>
				<div class="controls">
					<input type="text" class="span3 " disabled value="{$value.dua_date}">
				</div>
			</div>
			<br><br>

			<div class="control-group">
				<label class="control-label" for="firstname"></label>
				<div class="controls">
					<h3>Thông tin người dùng</h3>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="firstname">Name</label>
				<div class="controls">
					<input type="text" class="span3 " disabled value="{$value.name}">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="firstname">Điện thoại</label>
				<div class="controls">
					<input type="text" class="span3 " disabled value="{$value.phone}">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="firstname">Email</label>
				<div class="controls">
					<input type="text" class="span3" disabled value="{$value.email}">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="firstname">Địa chỉ</label>
				<div class="controls">
					<input type="text" class="span3 " disabled value="{$value.address}">
				</div>
			</div>


			<br>
			<div class="control-group">
				<label class="control-label" for="firstname"></label>
				<div class="controls">
					<button type="button" class="btn btn-success"><i class="btn-icon-only icon-check"></i> Gia hạn sử dụng</button>
				</div>
			</div>
		</form>

	</div>
	<!-- /widget-content -->
</div>
<!-- /widget -->
