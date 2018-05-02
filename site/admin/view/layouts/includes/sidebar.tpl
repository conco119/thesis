<div class="left_col scroll-view">

	<div class="navbar nav_title" style="border: 0;">
		<a href="./" class="site_title"><i class="fa fa-laptop"></i><span> MTD - Quản lý bán hàng</span></a>
	</div>
	<div class="clearfix"></div>
	<br />

	<!-- sidebar menu -->
	<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

		<div class="menu_section">
			<h3>Chức năng chính</h3>
			<ul class="nav side-menu">
				<li><a><i class="fa fa-desktop"></i> Bàn làm việc <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu" style="display: none">
						<!--<li id="home_li"><a href="./">Điều khiển</a></li> -->
						<!--<li><a href="?mc=room&site=manager">Phòng hát</a></li>-->
						<li><a href="./admin?mc=export&site=index">Bán hàng</a></li>
						<li><a href="./admin?mc=import&site=create">Nhập hàng</a></li>
						<li><a href="./admin?mc=import&site=reimport">Khách trả hàng</a></li>
						<li><a href="./admin?mc=export&site=distroy">Hủy hàng</a></li>
						<li><a href="./admin?mc=export&site=export_sup">Trả hàng NCC</a></li>
					</ul>
				</li>
				<li><a href="?mc=money&site=index"><i class="fa fa-dollar"></i> Sổ thu chi</a></li>
				<li><a><i class="fa fa-product-hunt"></i> Sản phẩm<span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu" style="display: none">
						<li id="product_index_li"><a href="?mc=product&site=index">Quản lý sản phẩm</a></li>
						<!--<li><a href="?mc=product&site=combo">Quản lý bộ sản phẩm</a></li> -->
						{if $arg.setting.use_service eq 1}<li><a href="?mc=service&site=index">Quản lý dịch vụ</a></li>{/if}
						<li><a href="?mc=product&site=categories">Danh mục sản phẩm</a></li>
						<li><a href="?mc=product&site=units">Đơn vị sản phẩm</a></li>
						<!--<li><a href="?mc=product&site=setup">Báo giá sản phẩm</a></li>-->
					</ul>
				</li>
				<li><a><i class="fa fa-user-md"></i> Đối tác <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu" style="display: none">
						<li><a href="?mc=customer&site=index">Khách hàng</a></li>
						<li><a href="?mc=supplier&site=index">Nhà cung cấp</a></li>
					</ul>
				</li>
				<li><a><i class="fa fa-folder-open"></i> Lưu trữ <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu" style="display: none">
						<!--<li><a href="?mc=product&site=warehouse">Kho hàng</a></li>-->
						<li><a href="?mc=export&site=statistics">Hóa đơn bán hàng</a></li>
						<li><a href="?mc=import&site=statistics">Hóa đơn nhập hàng</a></li>
						<li><a href="?mc=import&site=reimport_list">Phiếu khách trả hàng</a></li>
						<li><a href="?mc=export&site=distroy_list">Phiếu hủy hàng</a></li>
						<li><a href="?mc=export&site=export_sup_list">Phiếu trả hàng nhà cung cấp</a></li>
					</ul>
				</li>
				<li><a><i class="fa fa-bar-chart-o"></i> Báo cáo <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu" style="display: none">
						<li><a href="?mc=report&site=daily">Ghi sổ ngày</a></li>
						<li><a href="?mc=product&site=statistics">Sản phẩm</a></li>
						<li><a href="?mc=service&site=statistics">Dịch vụ</a></li>
						<li><a href="?mc=report&site=performance">Lợi nhuận</a></li>
						<li><a href="?mc=report&site=user">Nhân viên</a></li>
						<!--<li><a href="?mc=cost&site=index"> Tính giá vốn </a></li>-->
					</ul>
				</li>
				<!--<li><a href="?mc=lock&site=index"><i class="fa fa-lock"></i> Khóa sổ </a></li>-->
			</ul>
		</div>
		<div class="menu_section">
			<h3>Cấu hình</h3>
			<ul class="nav side-menu">
				<li><a><i class="fa fa-cog"></i> Thiết lập <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu" style="display: none">
						<li><a href="?mc=user&site=index">Quản lý người dùng</a></li>
						<li><a href="?mc=staff&site=index">Quản lý nhân viên kinh doanh</a></li>
						<li><a href="?mc=setting&site=info">Thiết lập thông tin</a></li>
						<li><a href="?mc=setting&site=others">Thiết lập bán hàng</a></li>
					</ul>
				</li>
				<li><a><i class="fa fa-cogs"></i> Phân quyền hệ thống<span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu" style="display: none">
						<li><a href="?mc=user&site=groups">Nhóm phân quyền</a></li>
						<li><a href="?mc=user&site=permissions">Quản lý phân quyền</a></li>
					</ul>
				</li>
			</ul>
		</div>

	</div>
	<!-- /sidebar menu -->

	<!-- /menu footer buttons -->
	<div class="sidebar-footer hidden-small">
		<a data-toggle="tooltip" data-placement="top" title="Settings"> <span
			class="glyphicon glyphicon-cog"></span>
		</a> <a data-toggle="tooltip" data-placement="top" title="FullScreen">
			<span class="glyphicon glyphicon-fullscreen"></span>
		</a> <a data-toggle="tooltip" data-placement="top" title="Lock"> <span
			class="glyphicon glyphicon-eye-close"></span>
		</a> <a data-toggle="tooltip" data-placement="top" title="Logout"> <span
			class="glyphicon glyphicon-off"></span>
		</a>
	</div>
	<!-- /menu footer buttons -->
</div>
<script>
if($("body.nav-sm").length){
	$(".sidebar-footer.hidden-small").hide();
}
</script>
