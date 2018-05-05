<link href="{$arg.stylesheet}css/print.css" rel="stylesheet">
<div class="container" id="print">
	<div class="row">
	    {if $arg.setting.use_logo eq 1}
	        <div class="col-md-3 col-sm-3 col-xs-3"><img src="{$output.logo}" class="avatar" ></div>
	    {/if}
	    <div class="col-md-9 col-sm-9 col-xs-9">
	        <h2>{$out.setting.name}</h2>
	        <p>Địa chỉ: {$out.setting.address}</p>
	        <p>Email liên hệ: {$out.setting.email}</p>
	        <p>Số điện thoại: {$out.setting.phone}</p>
	        <h1>PHIẾU NHẬP KHO</h1>
	        <h4>[{$out.code} - {$out.date}]</h4>
	        <p>Nhà cung cấp: {$out.supplier}</p>
	    </div>
	</div>
		<h3>Danh sách sản phẩm</h3>
	    <table class="table table-bordered mar-top">
	        <thead>
	            <tr>
	                <th class="text-center">TT</th>
	                <th>Mã SP</th>
	                <th class="text-left">Sản phẩm</th>
	                <th class="align-right">Đơn vị</th>


					{if $arg.setting.percent eq 1}
						<th class="">Nguyên giá</th>
						<th class="">Chiết khấu</th>
					<th class="">Giá nhập</th>{else}
						<th class="">Giá nhập</th>
					{/if}
	                <th class="align-cen">SL</th>
	                <th class="align-right">Giá trị</th>
	            </tr>
	        </thead>
	        <tbody>
				{$i=1}
	            {foreach from=$products key=k item=list}
	                <tr>
	                    <td class="text-left">{$i}</td>
	                    <td>{$list.code}</td>
	                    <td class="text-left">{$list.name}</td>
	                    <td class="align-right">{$list.unit_name}</td>
						<td class="">{$list.price}</td>
						{if $arg.setting.percent eq 1}<td class="">{$list.percent} %</td>
						<td class="">{$list.price_im}</td>{/if}
	                    <td class="align-cen">{$list.number}</td>
	                    <td class="align-right">{$list.total}</td>
	                </tr>
					{$i=$i+1}
	            {/foreach}
	
	        </tbody>
	    </table>
	    <h2 style="text-align: right;">TỔNG CỘNG: {$out.money}</h2>
	{if $out.discount != 0}<h2 style="text-align: right;">Chiết khấu: {$out.discount}</h2>{/if}
	<h2 style="text-align: right;">Tiền trả: {$out.payment}</h2>
	{if $out.owe != 0}<h2 style="text-align: right;">Công nợ: {$out.owe} </h2>{/if}
	<h2 style="text-align: right;">Tiền bằng chữ: {$out.money_custom}</h2>
</div>
<!-- /widget -->
<script type="text/javascript">
</script>
