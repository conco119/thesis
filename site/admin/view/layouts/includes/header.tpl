
<div class="top_nav">

	<div class="nav_menu">
		<nav class="">
			<div class="nav toggle">
				<a id="menu_toggle"><i class="fa fa-bars"></i></a>
			</div>

			<ul class="nav navbar-nav navbar-right">
				<li class="">
					<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown">
						<img src="{$arg.stylesheet}images/img.jpg" alt="">{$arg.user.username} <span class=" fa fa-angle-down"></span>
					</a>
					<ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
						<li><a href="?mod=account&site=profile"> Tài khoản</a></li>
						<li><a href="?mod=install&site=index"> Thông tin sử dụng</a></li>
            <li><a href="?mod=upgrade&site=index"> Phiên bản</a></li>
						<li><a href="admin?mc=user&site=logout"><i class="fa fa-sign-out pull-right"></i> Đăng xuất</a></li>
					</ul>
				</li>
			</ul>
		</nav>
	</div>

</div>
