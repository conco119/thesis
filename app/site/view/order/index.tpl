<div class="detail_title">
    Đơn hàng mới
</div>
<div class="full-content cart-cont-page" style="margin-top: 15px;">
    <table>
        <tr class="th">
            <td>TT</td>
            <td>Đơn hàng</td>  
            <td>Email</td>
            <td>Địa chỉ</td>
            <td>Giá trị</td>
            <td>Xử lý</td>
        </tr>
        {if $result neq NULL}
            {foreach from=$result key=k item=list}
            <tr>
                <td>{$k+1}</td>
                 <td class="name">
                     <b>HD{$list.id}</b>
                     <p>{$list.created}</p>
                 </td>
              
                <td class="prices">{$list.cus_email}</td>
                <td class="prices">{$list.cus_address}</td>
                <td><b>{$list.total}</b></td>
                <td>
                    <a href="javascript:void(0);" class="btn"  onclick="delateOrder({$list.id});"><i class="fa fa-trash-o fa-2x"></i></a>
                    <a href="?mod=order&site=detail&id={$list.id}" class="btn"><i class="fa fa-eye"></i></a>
                </td>
            </tr>
            {/foreach}

            {else}
            <tr>
                <td colspan="8">Không có dữ liệu!</td>
            </tr>
        {/if}

    </table>
    
</div>

<!--end .content-->




<script src="{$arg.stylesheet}js/cart.js"></script>