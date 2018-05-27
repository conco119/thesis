<div class="widget widget-table action-table">
	<div class="widget-header">
		<i class="icon-th-list"></i>
		<h3>Cập nhật và lưu trữ dữ liệu</h3>
	</div>
	<!-- /widget-header -->
	<div class="widget-content">

		<div>
			<form method="post" class="form-horizontal form" id="validate">
				<fieldset>

					<div class="control-group">
						<label class="control-label"></label>
						<div class="controls">
							<label class="checkbox inline"> <input type="checkbox" {if $out.auto eq 1}checked{/if} name="auto" value="1">Tự động lưu trữ dữ liệu</label> 
						</div>
						<!-- /controls -->
					</div>
					<!-- /control-group -->

					<div class="control-group">
						<label class="control-label" for="firstname">Thời gian lặp (ngày)</label>
						<div class="controls">
							<input type="number" class="span1 required number" name="time" value="{$out.time}">
						</div>
						<!-- /controls -->
					</div>
					<!-- /control-group -->


					<div class="control-group">
						<label class="control-label" for="firstname"></label>
						<div class="controls">
							<button type="submit" class="btn btn-primary" name="export"><i class="shortcut-icon icon-circle-arrow-left"></i> Thực hiện cập nhật ngay</button>
						</div>
						<!-- /controls -->
					</div>
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