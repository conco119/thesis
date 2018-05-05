<div class="">
	<div class="row">
		<div class="col-md-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Thống kê kho hàng</h2>
					<ul class="nav navbar-right panel_toolbox">
						<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">

					<div class="h_content">
						<div class="form-group form-inline">
						<input type="text" class="left form-control" id="key" placeholder="Mã / tên sản phẩm" value="{$out.key}">
						<select class="left form-control" id="category">
							<option value="">Nhóm sản phẩm</option>
							{$out.categories}
						</select>
						<button type="button" class="left btn btn-primary form-control" onclick="filter();">Tìm kiếm sản phẩm</button>
						</div>
						<a href="?mod=export&site=create" class="btn btn-primary"><i class="fa fa-pencil"></i> Tạo hóa đơn</a>
						<div class="clearfix"></div>
					</div>

					<!-- start project list -->
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Mã</th>
								<th>Sản phẩm</th>
								{if $arg.setting.use_trademark  eq 1} <th>Thương hiệu</th>{/if}
								{if $arg.setting.use_origin  eq 1}<th>Xuất xứ</th>{/if}
								<th class="text-right">Giá nhập</th>
								<th class="text-right">Số lượng</th>
								<th class="text-right">Hạn SD</th>
							</tr>
						</thead>
						<tbody>
						
							{foreach from=$result item=list}
							<tr class="{$list.style}">
								<td>#</td>
								<td>{$list.code}</td>
								<td>{$list.name}</td>
								{if $arg.setting.use_trademark  eq 1} <td>{$list.trademark}</td>{/if}
								{if $arg.setting.use_origin  eq 1}<td>{$list.origin}</td>{/if}
								<td class="text-right">{$list.price|number_format} đ</td>
								<td class="text-right">{$list.number}</td>
								<td class="text-right">{$list.expiry}</td>
							</tr>
							{/foreach}
							
						</tbody>
					</table>
					<!-- end project list -->

					<div class="paging">{$paging.paging}</div>
				</div>
			</div>
		</div>
		
	</div>
</div>

<script src="{$arg.stylesheet}js/moment/moment.min.js"></script>
{literal}
<script>
function filter(){
	var key = $("#key").val();
	var category = $("#category").val();
	
	var url = "./?mod=product&site=whdetail";
	url += "&category=" + category;
	url += "&key=" + key;
	window.location.href = url;
}
</script>
{/literal}
