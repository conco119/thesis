<link href="{$arg.stylesheet}css/print.css" rel="stylesheet">

<div class="container" id="printA5">
    <div class="row">
        {if $arg.setting.use_logo eq 1}
            <div class="col-md-2 col-sm-2 col-xs-2"><img src="{$output.logo}" class="avatar"/></div>
        {/if}
        <div class="col-md-5 col-sm-5 col-xs-5">
            <h2 class="name-cty">{$out.setting.name}</h2>
            <p class="address">ĐC: {$out.setting.address} </p>
            <p class="">TEL: {$out.setting.phone}  </p>
            <p>Email: {$out.setting.email} </p>
            <h1 class="h1-payment">PHIẾU NHẬP KHO</h1>
        </div>
        <div class="col-md-5 col-sm-5 col-xs-5">
            <p>Nhân viên nhập: {$value.creator} </p>
            <p>Mã phiếu: [{$out.code}]</p>
            <p>Nhà cung cấp: {$out.supplier}</p>
            <p>Ngày Tháng: {$out.date}</p>
        </div>

    </div>
    <p></p>
    <p></p>


    <table class="table table-bordered mar-top">
        <thead>
        <tr>
            <th>TT</th>
            <th>Mã SP</th>
            <th>Sản phẩm</th>
            <th class="align-right">Đơn vị</th>
            {if $arg.setting.percent eq 1}
                <th class="">Nguyên giá</th>
                <th class="">Chiết khấu</th>
            {/if}
            <th class="">Giá nhập</th>
            <th class="align-cen">SL</th>
            <th class="align-right">Giá trị</th>
        </tr>
        </thead>
        <tbody>
        {$i=1}
        {foreach from=$products key=k item=list}
            <tr>
                <td>{$i}</td>
                <td>{$list.code}</td>
                <td>{$list.name}</td>
                <td class="align-right">{$list.unit_name}</td>
                <td class="">{$list.price}</td>
                {if $arg.setting.percent eq 1}
                    <td class="">{$list.percent} %</td>
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


    <div class="row">

        <div class="col-md-3 col-sm-3 col-xs-3 text-center">
            <p>Người giao hàng</p>
            <p>(Ký và ghi rõ họ tên)</p>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-3 text-center">
            <p>Người nhận hàng</p>
            <p>(Ký và ghi rõ họ tên)</p>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-3 text-center">
            <p>Thủ kho</p>
            <p>(Ký và ghi rõ họ tên)</p>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-3 text-center">
            <p>Người lập phiếu</p>
            <p>(Ký và ghi rõ họ tên)</p>
        </div>
    </div>
</div>

<!-- /widget -->
<script type="text/javascript">
</script>
