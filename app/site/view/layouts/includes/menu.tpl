<div class="container mar-btm">
	<div class="menu">
		<div class="col-md-12 col-sm-12 col-xs-12 col-df left">
			<ul>
				<div class="col-md-2 col-sm-2 col-xs-12 col-df">
					<li class="" style="background:green;"><i class="fa fa-home"></i>
						<a href="{$arg.domain}" title="Trang chủ">Trang chủ
							<p>{$list.description}</p>
					</a></li>
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12 col-df">
					<li class="" style="background: rgb(129, 142, 181);"><i class="fa fa-cc-paypal"></i>
						<a href="./?site=intro" title="Giới thiệu">Giới thiệu
							<p></p>
					</a></li>
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12 col-df">
					<li class="" style="background: rgb(245, 121, 31);"><i class="fa fa-camera-retro"></i>
						<a href="./?mc=product" title="Sản phẩm">Sản phẩm
							<p>Phân phối linh kiện</p>
					</a></li>
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12 col-df">
					<li class="" style="background:rgb(31, 57, 245);"><i class="fa fa-camera-retro"></i>
						<a href="./?mc=servicee" title="Sản phẩm">Dịch vụ
					</a></li>
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12 col-df">
					<li class="" style="background: rgb(53, 152, 219);"><i class="fa fa-cc-paypal"></i>
						<a href="./?site=payment" title="Giới thiệu">Thanh Toán
							<p>Hướng dẫn thanh toán</p>
					</a></li>
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12 col-df">
					<li class="" style="background: rgb(154, 89, 181);"><i class="fa fa-cc-paypal"></i>
						<a href="./?site=contact" title="Liên hệ">Liên hệ
							<p> Liên hệ </p>
					</a></li>
				</div>
			</ul>
		</div>

	</div>
</div>
{* <nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">MÁY TÍNH ĐÔNG TÂY</a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menubar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div id="menubar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">

                {foreach from=$output.menu_main item=list}
                    <li><a href="{$list.url}" title="{$list.name}">{$list.name}</a></li>
                {/foreach}
            </ul>
        </div>
    </div>
</nav> *}