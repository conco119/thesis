<link href="{$arg.stylesheet}css/expenprint.css" rel="stylesheet">

<div class="container" id="expenprint">
    <div class="row">
                
        <div class="col-md-6 col-sm-6 col-xs-6">
            <!--<img src="" class="avatar" />-->
            <p>Công Ty TNHH Công Nghệ Đông Tây</p>
            <p>Nhà phân phối chính thức sữa</p>
            <p><i>In vào lúc: <small>{$out.time}</small></i></p>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6">            
            <h1> PHIẾU THU TIỀN </h1>
            <p><i>Ngày.......tháng........năm.......</i></p>           
        </div>
    </div>
    <br/>
    <br/>
    
    <div class="row">
        <div class="col-md-2 col-sm-2 col-xs-2"></div>
        <div class="col-md-10 col-sm-10 col-xs-10">
            <p>Họ và tên: {$value.name}</p>            
            <p>Địa chỉ:   {$value.address}</p>
            <p>Lý do nộp: {$value.description}</p>
            <p>Số tiền:   {$value.money}</p>
            <br/>
            <p>Bằng chữ:.............................................................
            </p>
            <p style="text-align: right;"><i>Ngày......tháng......năm.......</i></p>            
        </div>
    </div>
 
    <hr class="line-dott" />
    <div class="row">
        <div class="col-md-3 col-sm-3 col-xs-3 text-center">
            <p class="bold">Người nộp tiền</p>
            <p>(Ký và ghi rõ họ tên)</p>
               
        </div> 
        <div class="col-md-3 col-sm-3 col-xs-3 text-center">
            <p class="bold">Thủ quỹ</p>
            <p>(Ký và ghi rõ họ tên)</p>
             
        </div> 
        <div class="col-md-3 col-sm-3 col-xs-3 text-center">
            <p class="bold">Giám đốc</p>
            <p>(Ký và ghi rõ họ tên)</p>
             
        </div> 
        <div class="col-md-3 col-sm-3 col-xs-3 text-center">
            <p class="bold">Người Lập phiếu</p>
            <p>(Ký và ghi rõ họ tên)</p>
             <p>{$value.nguoilap}</p>
        </div> 
    </div> 

</div>
