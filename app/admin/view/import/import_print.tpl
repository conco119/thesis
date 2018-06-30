<link href="{$arg.stylesheet}css/print.css" rel="stylesheet">

<div class="container" id="print">
    <div class="row">
    	{* <div class="col-md-3 col-sm-3 col-xs-3"><img src="{$arg.logo_folder_link}/{$arg.setting.logo.image}" class="avatar" /></div> *}
    	<div class="col-md-9 col-sm-9 col-xs-9 ">
	        <h2>{$arg.setting.infoname}</h2>
	        <p>{$arg.setting.info.address}</p>
	        <h1>PHIẾU THANH TOÁN</h1>
	        <p>[{$import.code} - {$import.date}]</p>
	        <p>Người lập phiếu: {$import.creator.name}</p>
	        <p>Nhà cung cấp: {$import.supplier_id.name}</p>
    	</div>
    </div>
    {if !empty($products)}
        <h3>Danh sách sản phẩm</h3>
        <table class="table table-bordered mar-top">
            <thead>
                <tr>
                    <th class="text-center">TT</th>
                    <th class="text-center">Sản phẩm</th>
                    <th class="text-center">Đơn vị</th>
                    <th class="text-center" style=""> Giá</th>
                    <th class="text-center" style="">SL</th>
                    <th class="text-center" style="">T.Tiền</th>
                </tr>
            </thead>
            <tbody>
                {$i = 1}
                {foreach from=$products key=k item=data}
                    <tr>
                        <td class="text-center">{$i}</td>
                        <td class="text-left">{$data.name}</td>
                        <td class="text-center">{$data.unit_name}</td>
                        <td class="text-right">{($data.price_import)|number_format} đ</td>
                        <td class="text-center">{$data.number_count}</td>
                        <td class="text-right">{($data.number_count*$data.price_import)|number_format} đ</td>
                    </tr>
                    {$i = $i+1}
                {/foreach}
            </tbody>
        </table>
    {/if}

    <p class="text-right"><b>Thành tiền : &emsp; </b> {$out.total_money|number_format} đ</p>
    {if $out.total_money > $out.must_pay}<p class="text-right"><b>Chiết khấu:&emsp;</b> {($out.total_money-$out.must_pay)|number_format} đ<p>{/if}
    {if $out.must_pay neq $out.payment}<p class="text-right"> <b>Ghi nợ&emsp;</b> {($out.must_pay - $out.payment)|number_format} đ</p>{/if}
    <p class="text-right"><b>Thanh toán: &emsp; </b> {($out.payment)|number_format} đ</p>
    <hr class="line-dott">

    <div class="text-center">
        <p>TEL: {$arg.setting.info.phone}</p>
        <p class="bold">Cảm ơn quý khách !</p>
        <p>Hẹn gặp lại !</p>
    </div>

</div>
