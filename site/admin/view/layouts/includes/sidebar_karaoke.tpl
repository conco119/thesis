<div class="left_col scroll-view">

	<div class="navbar nav_title" style="border: 0;">
		<a href="./" class="site_title"><i class="fa fa-paw"></i><span> HLSelling</span></a>
	</div>
	<div class="clearfix"></div>

	<!-- menu prile quick info -->
	<div class="profile">
		<div class="profile_pic">
			<img src="{$arg.stylesheet}images/img.jpg" alt="..." class="img-circle profile_img">
		</div>
		<div class="profile_info">
			<span>Xin chào,</span>
			<h2>{$arg.user.short_name}</h2>
		</div>
	</div>
	<!-- /menu prile quick info -->

	<br />

	<!-- sidebar menu -->
	<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

		<div class="menu_section">
			<h3>General</h3>
			<ul class="nav side-menu">
				<li><a><i class="fa fa-dashboard"></i> Bàn làm việc <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu" style="display: none">
						<li id="home_li"><a href="./">Điều khiển</a></li>
						<li><a href="?mod=room&site=manager">Quản lý phòng</a></li>
						<li><a href="?mod=import&site=create">Nhập hàng</a></li>
						<li><a href="?mod=import&site=reimport">Trả hàng</a></li>
						<li><a href="?mod=export&site=distroy">Hủy hàng</a></li>
					</ul>
				</li>
				<li><a href="?mod=money&site=index"><i class="fa fa-dollar"></i> Sổ thu chi</a></li>
				<li><a><i class="fa fa-recycle"></i> Sản phẩm<span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu" style="display: none">
						<li id="product_index_li"><a href="?mod=product&site=index">Quản lý sản phẩm</a></li>
						<!-- <li><a href="?mod=product&site=combo">Quản lý bộ sản phẩm</a></li> -->
						{if $arg.setting.use_service eq 1}<li><a href="?mod=service&site=index">Quản lý dịch vụ</a></li>{/if}
						<li><a href="?mod=product&site=categories">Danh mục sản phẩm</a></li>
						<li><a href="?mod=product&site=units">Đơn vị sản phẩm</a></li>
					</ul>
				</li>
				<li><a><i class="fa fa-table"></i> Đối tác <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu" style="display: none">
						<li><a href="?mod=customer&site=index">Khách hàng</a></li>
						<li><a href="?mod=supplier&site=index">Nhà cung cấp</a></li>
					</ul>
				</li>
				<li><a><i class="fa fa-desktop"></i> Lưu trữ <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu" style="display: none">
						<!-- <li><a href="?mod=product&site=warehouse">Kho hàng</a></li> -->
						<li><a href="?mod=export&site=statistics">Hóa đơn bán hàng</a></li>
						<li><a href="?mod=import&site=statistics">Hóa đơn nhập hàng</a></li>
						<li><a href="?mod=import&site=reimport_list">Phiếu trả hàng</a></li>
						<li><a href="?mod=export&site=distroy_list">Phiếu hủy hàng</a></li>
					</ul>
				</li>
				<li><a><i class="fa fa-bar-chart-o"></i> Báo cáo <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu" style="display: none">
						<li><a href="?mod=report&site=daily">Ghi sổ ngày</a></li>
						<!--<li><a href="?mod=room&site=statistics">Phòng hát</a></li>-->
						<li><a href="?mod=product&site=statistics">Sản phẩm</a></li>
						<li><a href="?mod=service&site=statistics">Dịch vụ</a></li>
						<li><a href="?mod=report&site=performance">Lợi nhuận</a></li>
					</ul>
				</li>
			</ul>
		</div>
		<div class="menu_section">
			<h3>Cấu hình</h3>
			<ul class="nav side-menu">
				<li><a><i class="fa fa-bug"></i> Thiết lập <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu" style="display: none">
						<li><a href="?mod=user&site=index">Quản lý người dùng</a></li>
						<li><a href="?mod=setting&site=info">Thiết lập thông tin</a></li>
						<li><a href="?mod=setting&site=others">Thiết lập bán hàng</a></li>
					</ul>
				</li>
				<li><a><i class="fa fa-windows"></i> Phân quyền hệ thống<span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu" style="display: none">
						<li><a href="?mod=user&site=groups">Nhóm phân quyền</a></li>
						<li><a href="?mod=user&site=permissions">Quản lý phân quyền</a></li>
					</ul>
				</li>
				<li><a><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a></li>
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