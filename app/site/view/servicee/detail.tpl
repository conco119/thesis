<div class="service-detail">
	<div class="banner">
		<img src="{$value.image}" width="100%">
	</div>

	<div class="bg_f3f2f2">
		<div class="container">
			<h1 class="title text-center text-uppercase">{$value.name}</h1>
			<p class="title-cont">{$value.description}</p>
		</div>
	</div>

	<div class="container">
	
	    <div id="list-prd-box">
	        <div class="container">
	            {foreach from=$products item=list}
	            <div class="col-md-3 col-sm-3 col-xs-12 prd-item">
	                <div class="bg_white">
	                    <a href="{$list.link}"><img src="{$list.img}"></a>
	                    <div class="name">
	                        <a href="{$list.link}">{$list.name}</a>
	                    </div>
	                    <div class="num_star" id="Star{$list.id}">
	                        {$list.stars}
	                         <button type="button" class="btn_prd like_btl pull-right" title="Yêu thích sản phẩm" onclick="likeProduct({$list.id});"><i class="fa fa-heart-o"></i></button>
	                        <span>{$list.number_point} đánh giá - {$list.avg_point} điểm</span>
	                    </div>
	                    <div class="clear"></div>
	                </div>
	            </div>
	            {/foreach}
	
	        </div>
	
	        {$paging.paging}        
	            
	    </div>

		<div class="box temp-demo">
			<h3 class="box-name text-center">Các mẫu giao diện tham khảo</h3>
			<div class="box-content">
				<div class="row">
					{foreach from=$templates item=list}
					<div class="col-md-3 col-sm-4 col-xs-6">
						<div class="docs-galley">
							<ul class="docs-pictures clearfix">
								<li><img data-original="{$list.img}" src="{$list.img}">
									<div class="name">
										<a href="javascript:void(0)">{$list.name}</a>
									</div>
								</li> 
								{if $list.img_child neq NULL} 
								{foreach from=$list.img_child item=sub_temp}
									<li class="hidden"><img data-original="{$sub_temp.bimg}" src="{$sub_temp.bimg}"></li> 
								{/foreach} 
								{/if}
							</ul>
						</div>
					</div>
					{/foreach}
				</div>
			</div>
		</div>
	
		<div class="row">
		<div class="col-md-8 col-sm-8 col-xs-12 content-detail">
			<!-- Nav tabs -->
			<ul class="nav nav-tabs" role="tablist">
				<li class="active"><a href="#home" role="tab" data-toggle="tab">
						<icon class="fa fa-home"></icon> Phân tích chức năng
				</a></li>
				<li><a href="#profile" role="tab" data-toggle="tab"> <i
						class="fa fa-user"></i> Báo giá
				</a></li>
				<li><a href="#settings" role="tab" data-toggle="tab"> <i
						class="fa fa-cog"></i> Settings
				</a></li>
			</ul>
			<!-- Tab panes -->
			<div class="tab-content">
				<div class="tab-pane fade active in" id="home">
					{$value.feature}
				</div>
				<div class="tab-pane fade" id="profile">
					{$value.price_info}
				</div>
				<div class="tab-pane fade" id="settings">
					<h2>Settings Content Goes Here</h2>

				</div>
			</div>


		</div>

		<div class="col-md-4 col-sm-4 col-xs-12" id="detail-sidebar">
			<div class="box">
				<h3 class="name">Shaeng - Fashion</h3>
				<div class="like-evaluate">
					<div class="head">
						<i class="fa fa-heart"></i> 0 Like
						<div class="num_star text-center pull-right">
							<p>(0 Đánh giá)</p>
						</div>
					</div>
					<div class="body text-center">

						<div class="row">
							<div class="col-md-6 col-sm-6 col-xs-6">
								<a href="" class="btn_body"><i class="fa fa-heart"></i> Thêm
									vào yêu thích</a>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-6">
								<a href="" class="btn_body"><i class="fa fa-folder-open"></i>
									Thêm vào bộ sưu tập</a>
							</div>
						</div>

						<div class="clear"></div>
					</div>

				</div>
			</div>

			<div class="box box-sale-info">
				<h3 class="box-name">Khuyến mại đi kèm</h3>
				<div class="box-content">{$value.promo_info}</div>
			</div>

			<div class="box box-sale-info">
				<h3 class="box-name">Các website đang chạy</h3>
				<div class="box-content">{$value.promo_info}</div>
			</div>

		</div>
		</div>
		
	</div>

</div>