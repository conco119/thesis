<div class="detail_title">
    Đơn hàng đã hủy bỏ
</div>
<div class="full-content cart-cont-page" style="margin-top: 15px;">
    <table>
        <tr class="th">
            <td>TT</td>
            <td>Đơn hàng</td>  
            <td>Email</td>
            <td>Địa chỉ</td>
            <td>Giá trị</td>
          
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