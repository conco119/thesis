<div class="log_title">
  	<h2>
	Đăng ký tài khoản
	</h2>
</div>
	<div class="col-md-12 col-xs-12 col-default">
		<div id="login">
			<form  method="post" id="validate">

				<div class="login-fields">
					<p>{$message}</p>
					<div class="field">
						<label>Tài khoản:</label>
						<input type="text" name="email" value="" placeholder="Account name" class="form-control required" />
					</div>
					<!-- /field -->
					<div class="field">
						<label for="password">Mật khẩu:</label>
						<input type="password" name="password" placeholder="Password" class="form-control required" />
					</div>
					<!-- /password -->
					<div class="field">
						<label for="password">Xác nhận mật khẩu:</label>
						<input type="password" name="repassword" value="" placeholder="Password" class="form-control required" />
					</div>
					<!-- /password -->
					<br>

					<div class="field">
						<label>Họ tên:</label>
						<input type="text" name="name" value="" placeholder="Name" class="form-control required" />
					</div>
					<!-- /field -->
					<div class="field">
						<label>Điện thoại:</label>
						<input type="text" name="phone" value="" placeholder="Phone" class="form-control required" />
					</div>
					<!-- /field -->
					<div class="field">
						<label>Địa chỉ:</label>
						<input type="text" name="address" value="" placeholder="Address" class="form-control required" />
					</div>
					<!-- /field -->
				</div>
				<!-- /login-fields -->

				<div class="login-actions">
					<button class="button btn btn-success btn-large" name="submit">Đăng ký</button>
				</div>
				<!-- .actions -->
			</form>
		</div>
	</div>


<script src="{$arg.stylesheet}js/validate.js"></script>
<script>
	$("#validate").validate();
</script>