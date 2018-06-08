<div class="log_title">
	<div class="w-circle">
        <span class="circle"><i class="fa fa-user"></i></span>
    </div>
  	<p>  
  	Máy Tính Đông Tây <br />
	Đăng ký tài khoản
	</p>
</div>
	<div class="col-md-12 col-xs-12 col-default">
		<div id="login">
			<form action="?mod=customer&site=register" method="post" id="validate">
				
				<div class="login-fields">
					<p>{$message}</p>
					<div class="field">
						<label>{$arg.trans.account}:</label> 
						<input type="text" name="email" value="" placeholder="Email" class="form-control required" />
					</div>
					<!-- /field -->
					<div class="field">
						<label for="password">{$arg.trans.password}:</label> 
						<input type="password" name="password" placeholder="Password" class="form-control required" />
					</div>
					<!-- /password -->
					<div class="field">
						<label for="password">{$arg.trans.re_pasword}:</label> 
						<input type="password" name="repassword" value="" placeholder="Password" class="form-control required" />
					</div>
					<!-- /password -->
					<br>
					
					<div class="field">
						<label>{$arg.trans.name}:</label> 
						<input type="text" name="name" value="" placeholder="Name" class="form-control required" />
					</div>
					<!-- /field -->
					<div class="field">
						<label>{$arg.trans.phone}:</label> 
						<input type="text" name="phone" value="" placeholder="Phone" class="form-control required" />
					</div>
					<!-- /field -->
					<div class="field">
						<label>{$arg.trans.address}:</label> 
						<input type="text" name="address" value="" placeholder="Address" class="form-control required" />
					</div>
					<!-- /field -->
				</div>
				<!-- /login-fields -->
			
				<div class="login-actions">
					<button class="button btn btn-success btn-large" name="submit">{$arg.trans.register}</button>
				</div>
				<!-- .actions -->
			</form>
		</div>
	</div>


<script src="{$arg.stylesheet}js/validate.js"></script>
<script>
	$("#validate").validate();
</script>