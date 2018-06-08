<div class="log_title">
	<div class="w-circle">
        <span class="circle"><i class="fa fa-user"></i></span>
    </div>
    <p>
    	Máy Tính Đông Tây <br />
		Đăng nhập tài khoản
    </p>
</div>
<div class="row">

	<div class="col-md-12 col-xs-12 col-df">
		<div id="login">
			<form action="?mod=customer&site=login" method="post" id="validate">
				
				<div class="login-fields">
					<p class="error">{$message}</p>
					<div class="field">
						<label for="username">{$arg.trans.user_name}:</label> 
						<input type="text" class="form-control" name="username" value="" placeholder="Username" class="login username-field required">
					</div>
					<!-- /field -->
					<div class="field">
						<label for="password">{$arg.trans.password}:</label> 
						<input type="password" class="form-control" name="password" value="" placeholder="Password" class="login password-field required">
					</div>
					<!-- /password -->
				</div>
				<!-- /login-fields -->
			
				<div class="login-actions">
					<button class="button btn btn-success btn-large" name="submit">{$arg.trans.login}</button>
					<a class="" href="?mod=customer&site=register">{$arg.trans.register}</a>
				</div>
				<!-- .actions -->
			</form>
		</div>
	</div>
</div>