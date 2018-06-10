<div id="web-service">
	<div class="row" style='padding:20px'>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Dịch vụ</th>
                <th>Giá</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            {foreach from=$services item=service}
                <tr>
                    <td>{$service.name}</td>
                    <td style='color:red'>{$service.price|number_format}đ</td>
                    <td>
                        <div class='btn_function' style='width:70%'>
                        <button type="button" class="btn_prd cart" title="Thêm vào giỏ hàng" onclick="addService({$service.id});"><i class="fa fa-opencart"></i> Thêm vào
                            giỏ hàng
                        </button>
                        </div>
                    </td>
                </tr>
            {/foreach}
            </tbody>
        </table>
	</div>
</div>
<script src="{$arg.stylesheet}js/cart.js"></script>