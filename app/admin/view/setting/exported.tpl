<div class="widget widget-table action-table">
	<div class="widget-header">
		<i class="icon-th-list"></i>
		<h3>Thiết lập thông tin bán hàng</h3>
	</div>
	<!-- /widget-header -->
	<div class="widget-content">

		<div>
			<form method="post" class="form-horizontal form" id="validate">
				<fieldset>

					<div class="control-group">
						<label class="control-label" for="firstname">Phương thức</label>
						<div class="controls">
							<label class="radio"> <input type="radio" name="method" {if $out.method eq '1'}checked{/if} value="1"> Nhập sản phẩm bằng tay</label>
							<label class="radio"> <input type="radio" name="method" {if $out.method eq '2'}checked{/if} value="2"> Quét mã vạch sản phẩm</label>
						</div>
						<!-- /controls -->
					</div>
					<!-- /control-group -->

					<!-- <div class="control-group">
						<label class="control-label" for="firstname">Địa chỉ</label>
						<div class="controls">
							<input type="text" class="span3 required" name="address" value="{$out.address}">
						</div>
						/controls
					</div> -->
					<!-- /control-group -->
					<br />

					<div class="form-actions">
						<button type="submit" class="btn btn-primary" name="submit">Lưu lại</button>
						<a href="./?mod=setting&site=index" class="btn">Hủy bỏ</a>
					</div>
					<!-- /form-actions -->
				</fieldset>
			</form>
		</div>
	</div>
</div>

<script src="{$arg.stylesheet}js/validate.js"></script>
<script>
	$("#validate").validate();
</script>