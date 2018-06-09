<div class="log_title">
  	<h2>
		Đăng nhập
	</h2>
</div>
<div class="row">

	<div class="col-md-12 col-xs-12 col-df">
		<div id="login">
			<form method="post" id="validate">

				<div class="login-fields">
					<p class="error">{$message}</p>
					<div class="field">
						<label for="username">Tài khoản:</label>
						<input type="text" class="form-control" name="username" value="" placeholder="Username" class="login username-field required">
					</div>
					<!-- /field -->
					<div class="field">
						<label for="password">Mật khẩu:</label>
						<input type="password" class="form-control" name="password" value="" placeholder="Password" class="login password-field required">
					</div>
					<!-- /password -->
				</div>
				<!-- /login-fields -->

				<div class="login-actions">
					<button class="button btn btn-success btn-large" name="login_submit">Đăng nhập</button>
				</div>
				<!-- .actions -->
			</form>
		</div>
	</div>
</div>