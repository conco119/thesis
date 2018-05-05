<style>
    p{
        margin:0px; font-size: 10px;}
    h1{
        font-size: 16px;}

    .print-logo{
        position: absolute; top: 5px; left:0px; width: 40px; height: 40px;
    }
    .align-cen{
        text-align: center;
    }
    h2{
        padding: 0px 35px;
        font-size: 16px;
    }
    .byebye{
        text-align: center;
    }
    .byebye p{
        font-size: 18px;
    }
    .table{
    margin-bottom: 8px;
        width: 100%;
    }
    .table th, .table td{
        padding: 5px 2px;
        font-size: 11px;
        line-height: 13px;
    }
    .mar-top{
        margin-top: 8px;
    }
    .align-cen
    {
        text-align: center;
    }
    .align-right
    {
        text-align: right;
    }
</style>
<div class="widget">
    {if $arg.setting.use_logo eq 1}
        <img src="{$output.logo}" class="print-logo">
    {/if}
    <div class="align-cen">
        <h2>{$out.setting.name}</h2>
        <p>Địa chỉ: {$out.setting.address}</p>
        <p>Email liên hệ: {$out.setting.email}</p>
        <p>Số điện thoại: {$out.setting.phone}</p>
        <h1>PHIẾU TRẢ HÀNG</h1>
        <h4>[{$value.code} - {$value.date}]</h4>
    </div>

    <div class="mar-top">
        <p>Nhân viên nhập: {$value.creator}</p>
        <p>Khách hàng: {$value.supplier}</p>
    </div>

    <table class="table mar-top">
        <thead>
            <tr>
                <th class="align-cen">TT</th>
                <th class="align-cen">Mã SP</th>
                <th class="align-cen">Sản phẩm</th>
                <th class="align-cen">Đơn vị</th>
                <th class="align-cen">Giá nhập</th>
                <th class="align-cen">SL</th>
                <th class="align-cen">Giá trị</th>
            </tr>
        </thead>
        <tbody>

            {foreach from=$products key=k item=list}
                <tr>
                    <td class="align-cen">{$k+1}</td>
                    <td class="align-cen">{$list.code}</td>
                    <td class="align-cen">{$list.name}</td>
                    <td class="align-cen">{$list.unit_name}</td>
                    <td class="align-right">{$list.price}</td>
                    <td class="align-cen">{$list.number}</td>
                    <td class="align-right">{$list.total}</td>
                </tr>
            {/foreach}

        </tbody>
    </table>

    <hr class="line-big">
    <h2 style="text-align: right;">TỔNG CỘNG: {$value.money}</h2>
</div>
<!-- /widget -->
<script type="text/javascript">
</script>
