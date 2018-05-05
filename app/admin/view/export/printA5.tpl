<link href="{$arg.stylesheet}css/print.css" rel="stylesheet">

<div class="container" id="printA5">
    <div class="row">
	    {if $arg.setting.use_logo eq 1}
    	<div class="col-md-2 col-sm-2 col-xs-2"><img src="{$output.logo}" class="avatar" /></div>
    	{/if}
    	<div class="col-md-5 col-sm-5 col-xs-5">
	        <h2>{$out.setting.name}</h2>
	        <p>ĐC: {$out.setting.address}</p>
	        <p>Email: {$out.setting.email}</p>
	        <p>TEL: {$out.setting.phone}</p>
    	</div>
    	<div class="col-md-5 col-sm-5 col-xs-5">
	        <h1>PHIẾU THANH TOÁN</h1>
	        <p>[{$value.code} - {$value.date}]</p>
	        <p>NVKD: {$value.name}</p>
	        {if $value.customer ne NULL}<p>KH: {$value.customer}-{$value.code_cus}</p>{/if}
            {if $value.description ne NULL}<p>Mô tả: {$value.description}</p>{/if}
            {if isset($value.room)}<p>Phòng hát: {$value.room}</p>{/if}
    	</div>
    </div>
    
    <h3>Danh sách sản phẩm</h3>
    <table class="table table-bordered mar-top">
        <thead>
            <tr>
                {if $out.setting.print ne '3'}<th class="text-center">TT</th>{/if}
                <th class="text-center">S.phẩm</th>
                {if $out.setting.print ne '3'}<th class="text-center" style=""> Giá</th>{/if}
                {if $arg.setting.percent eq 1} <th class="text-center">CK</th>{/if}
                <th class="text-center">ĐV</th>
                <th class="text-center" style="">SL</th>
                {if $arg.setting.use_warranty eq 1}<th class="text-center" style="">BH</th>{/if}
                {if $arg.setting.use_description eq 1}<th class="text-center" style="">Mô tả</th>{/if}
                <th class="text-center" style="">Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            {$total = 0}
            {$i = 1}
            {foreach from=$value.products key=k item=data}
                <tr>
                    {if $out.setting.print ne '3'}<td class="text-center">{$i}</td>{/if}
                    <td class="text-left">{$data.name}</td>
                    {if $out.setting.print ne '3'}<td class="text-right">{($data.price-$data.price*$data.percent/100)|number_format} đ</td>{/if}
                    {if $arg.setting.percent eq 1}  <td class="text-center">{$data.percent}%</td>{/if}
                    <td class="text-center">{$data.unit_name}</td>
                    <td class="text-center">{$data.number}</td>
                    {if $arg.setting.use_warranty eq 1}	<td class="text-center">{$data.warranty}</td>{/if}
                     {if $arg.setting.use_description eq 1}    <td class="text-center">{$data.description}</td>{/if}
                    <td class="text-right">{($data.number*$data.price-$data.number*$data.price*$data.percent/100)|number_format} đ</td>
                </tr>
                {$total = $total + $data.number*$data.price}
                {$i = $i+1}
            {/foreach}
        </tbody>
    </table>

    {if $value.services neq NULL}
        <h3>Danh sách dịch vụ</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    {if $out.setting.print ne '3'}<th class="text-center">TT</th>{/if}
                    <th class="text-center">Tên</th>
                    {if $out.setting.print ne '3'}<th class="text-center">Chi phí</th>{/if}
                    <th class="text-center">SL</th>
                    <th class="text-center">Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                {$total = 0}
                {$j=1}
                {foreach from=$value.services key=k item=data}
                    <tr>
                        {if $out.setting.print ne '3'}<td class="text-center">{$j}</td>{/if}
                        <td>{$data.name} {if $data.id_room neq 0}: {$data.room_name}{/if}</td>
                        {if $out.setting.print ne '3'}<td class="text-right">{$data.price|number_format} đ</td>{/if}
                        <td class="text-center">
                        	{if $data.type eq '0'}
                        	{$data.number}
                        	{else if $data.type eq '1'}
                        	{$data.number}/{$data.time}
                        	{else}
                        	{$data.number}
                        	{/if}
                            {if $data.type eq 2} phút<br>
                                Từ:{$data.time_start} => {$data.time_finish}{/if}
                        </td>
                        <td class="text-right">
                        	{if $data.type eq '0'}
                        	{($data.price*$data.number)|number_format}
                        	{else if $data.type eq '1'}
                        	{($data.price*$data.number*$data.int_time)|number_format}
                        	{else}
                        	{($data.price*$data.number/60)|number_format}
                        	{/if} đ
                        </td>
                    </tr>
                    {$total = $total + $data.number*$data.price}
                    {$j=$j+1}
                {/foreach}
                
            </tbody>
        </table>
    {/if}

    
    <h4 class="text-right"><b>Thành tiền:&emsp;</b> {$value.total|number_format} đ</h4>
    {if $value.total > $value.must_pay}<p class="text-right"><b>Chiết khấu:&emsp;</b> {($value.total-$value.must_pay)|number_format} đ<p>{/if}
    {if $value.debt > 0}<p class="text-right"><b>Ghi nợ:&emsp;</b> {$value.debt|number_format} đ<p>{/if}
    <h4 class="text-right"><b>Thanh toán:&emsp;</b> {($value.must_pay-$value.debt)|number_format} đ</h4>
    <hr class="line-dott">

    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-6 text-center">
            <p class="bold">Phụ trách cửa hàng</p>
            <p>(Ký và ghi rõ họ tên)</p>
        </div> 
        <div class="col-md-6 col-sm-6 col-xs-6 text-center">
            <p class="bold">Người nhận hàng</p>
            <p>(Ký và ghi rõ họ tên)</p>
        </div> 
    </div> 

</div>
