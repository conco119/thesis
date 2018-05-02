<link href="{$arg.stylesheet}css/print.css" rel="stylesheet">

<div class="container" id="print">
    <div class="row">
	    {if $arg.setting.use_logo eq 1}
    	<div class="col-md-3 col-sm-3 col-xs-3"><img src="{$output.logo}" class="avatar" /></div>
    	{/if}
    	<div class="col-md-9 col-sm-9 col-xs-9 ">
	        <h2>{$out.setting.name}</h2>
	        <p>{$out.setting.address}</p>
	        <h1>PHIẾU THANH TOÁN</h1>
	        <p>[{$value.code} - {$value.date}]</p>
	        <p>NV: {$value.creator}</p>
	        {if $value.customer ne NULL}<p>KH: {$value.customer}</p>{/if}
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
                {if $arg.setting.percent eq 1}<th class="text-center" style="">CK</th>{/if}
                <th class="text-center" style="">SL</th>
                <th class="text-center" style="">T.Tiền</th>
            </tr>
        </thead>
        <tbody>
            {$i = 1}
            {foreach from=$value.products key=k item=data}
                <tr>
                    {if $out.setting.print ne '3'}<td class="text-center">{$i}</td>{/if}
                    <td class="text-left">{$data.name}</td>
                    {if $out.setting.print ne '3'}<td class="text-right">{($data.price-$data.price*$data.percent/100)|number_format} đ</td>{/if}
                    {if $arg.setting.percent eq 1} <td class="text-center">{$data.percent}%</td>{/if}
                    <td class="text-center">{$data.number}</td>
                    <td class="text-right">{($data.number*$data.price-$data.number*$data.price*$data.percent/100)|number_format} đ</td>
                </tr>
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
                    <th>Tên</th>
                    {if $out.setting.print ne '3'}<th class="text-right">Chi phí</th>{/if}
                    <th class="text-center">SL</th>
                    <th class="text-right">T.Tiền</th>
                </tr>
            </thead>
            <tbody>
            	{$i = 1}
                {foreach from=$value.services key=k item=data}
                    <tr>
                        {if $out.setting.print ne '3'}<td class="text-center">{$i}</td>{/if}
                        <td>{$data.name} {if $data.id_room neq 0}: {$data.room_name}{/if}</td>
                        {if $out.setting.print ne '3'}<td class="text-right">{$data.price|number_format}</td>{/if}
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
                	{$i = $i+1}
                {/foreach}
                
            </tbody>
        </table>
    {/if}

    
    <p class="text-right"><b>Thành tiền : &emsp; </b> {$value.total|number_format} đ</p>
    {if $value.total > $value.must_pay}<p class="text-right"><b>Chiết khấu:&emsp;</b> {($value.total-$value.must_pay)|number_format} đ<p>{/if}
    {if $value.debt > 0}<p class="text-right">Ghi nợ: &emsp;  {$value.debt|number_format} đ<p>{/if}
    <p class="text-right"><b>Thanh toán: &emsp; </b> {($value.must_pay-$value.debt)|number_format} đ</p>
    <hr class="line-dott">

    <div class="text-center">
        <p>TEL: {$out.setting.phone}</p>
        <p class="bold">Cảm ơn quý khách !</p>
        <p>Hẹn gặp lại !</p>
    </div> 

</div>
