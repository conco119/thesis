<div class="">
	<a class="hiddenanchor" id="toregister"></a> <a class="hiddenanchor" id="tologin"></a>

	<div id="wrapper">
		<div id="login" class="animate form">
			<section class="login_content">
				<form method="post" action="" id="validate">
					<h1>Kết nối database</h1>
					<p>Nhập chính xác thông tin kết nối tới mysql</p>
					<p>trên máy tính của bạn.</p>
					<div><input type="text" class="form-control" name="server" value="{$value.server}"placeholder="Server" /></div>
					<div><input type="text" class="form-control" name="data_user" value="{$value.data_user}" placeholder="Account" /></div>
					<div><input type="password" class="form-control" name="data_pass" value="{$value.data_pass}" placeholder="Password" /></div>
					<div><input type="text" class="form-control" name="data_name" value="{$value.data_name}" placeholder="Database name" /></div>
					<div><input type="submit" class="btn btn-default submit" name="ConnInfo" value="Lưu thông tin kết nối"></div>
					<div class="clearfix"></div>
					<div class="separator">
						<div class="clearfix"></div>
						<br />
						<div>
							<h1><i class="fa fa-paw" style="font-size: 26px;"></i> HLStar Admin</h1>
							<p>©2015 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
						</div>
					</div>
				</form>
				<!-- form -->
			</section>
			<!-- content -->
		</div>
	</div>
</div>
