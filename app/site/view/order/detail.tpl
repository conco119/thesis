<div class="detail_title">
    Thông tin hóa đơn
</div>
<div class="full-content detail_order" style="margin-top: 15px;">
   
   	<div class="row col-default">
   		<div class="col-md-5 col-sm-5">
	   		<div class="form-group">
		    	<label class="info">Hóa đơn:</label>
		    	<label for="info">HD{$detail_order.id}</label>
		  	</div>
		  	<div class="form-group">
		    	<label class="info">Khách hàng:</label>
		    	<label for="info">{$detail_order.cus_name}</label>
		  	</div>
		  	<div class="form-group">
		    	<label class="info">Email:</label>
		    	<label for="info">{$detail_order.cus_address}</label>
		  	</div>
		  	<div class="form-group">
		    	<label class="info">Tổng tiền:</label>
		    	<label for="info">{$detail_order.total}</label>
		  	</div>
	   	</div>
	   	<div class="col-md-5col-sm-5">
	   		<div class="form-group">
		    	<label class="info">Ngày tạo:</label>
		    	<label for="info">{$detail_order.created}</label>
		  	</div>
		  	<div class="form-group">
		    	<label class="info">Điện thoại:</label>
		    	<label for="info">{$detail_order.cus_phone}</label>
		  	</div>
		  	<div class="form-group">
		    	<label class="info">Địa chỉ:</label>
		    	<label for="info">{$detail_order.cus_address}</label>
		  	</div>
		  	
	   	</div>
   	</div>

   	<div class="row col-default">
   		<div class="full-content cart-cont-page" style="margin-top: 15px;">
    <table>
        <tr class="th">
            <td>TT</td>
            <td>Sản phẩm</td>  
            <td>Size</td>
            <td>Giá bán</td>
            <td>Số lượng</td>
            <td>Thành tiền</td>
        </tr>
        {if $result neq NULL}
            {foreach from=$result key=k item=list}
            <tr>
                <td>{$k+1}</td>
                 <td class="name">
                     <b>HD{$list.product}</b>
                 </td>
              
                <td class="prices">{$list.size}</td>
                <td class="prices">{$list.price}</td>
                <td><b>{$list.total}</b></td>
                <td>
                    <a href="javascript:void(0);" class="btn"  onclick="delateItemCart({$list.id});"><i class="fa fa-trash-o fa-2x"></i></a>
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
   	</div>
    
</div>

<!--end .content-->




<script src="{$arg.stylesheet}js/cart.js"></script>