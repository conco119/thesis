<div class="">
    <div class="x_panel">
        <div class="x_title">
            <h2>Thông tin sử dụng</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">


            <!-- start project list -->
            <div class="form-horizontal">
            	<form action="" method="post">
	            	<br><br>
	                <div class="form-group">
	                    <label class="control-label col-md-3 col-sm-2 col-xs-12">Phần mềm</label>
	                    <div class="col-md-4 col-sm-4 col-xs-12">
	                        <input type="text" class="form-control" value="Phần mềm quản lý bán hàng" readonly="readonly">
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label class="control-label col-md-3 col-sm-2 col-xs-12">Tên</label>
	                    <div class="col-md-4 col-sm-4 col-xs-12">
	                        <input type="text" class="form-control" value="{$value.name}" readonly="readonly">
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label class="control-label col-md-3 col-sm-2 col-xs-12">Email</label>
	                    <div class="col-md-4 col-sm-4 col-xs-12">
	                        <input type="text" class="form-control" value="{$value.email}" readonly="readonly">
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label class="control-label col-md-3 col-sm-2 col-xs-12">Điện thoại</label>
	                    <div class="col-md-4 col-sm-4 col-xs-12">
	                        <input type="text" class="form-control" value="{$value.phone}" readonly="readonly">
	                    </div>
	                </div>
	                <br>
	                <div class="form-group">
	                    <label class="control-label col-md-3 col-sm-2 col-xs-12">Ngày bắt đầu</label>
	                    <div class="col-md-4 col-sm-4 col-xs-12">
	                        <input type="text" class="form-control" value="{$value.starttime|date_format:'%d-%m-%Y'}" readonly="readonly">
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label class="control-label col-md-3 col-sm-2 col-xs-12">Ngày hết hạn</label>
	                    <div class="col-md-4 col-sm-4 col-xs-12">
	                        <input type="text" class="form-control" value="{$value.dua_date|date_format:'%d-%m-%Y'}" readonly="readonly">
	                    </div>
	                </div>
	                <br>
	
	                <div class="form-group">
	                    <label class="control-label col-md-3 col-sm-2 col-xs-12">&nbsp;</label>
	                    <div class="col-md-4 col-sm-4 col-xs-12">
	                        <input type="submit" class="btn btn-success submit" name="submit" value="Cập nhật thông tin">
	                    </div>
	                </div>
                </form>
            </div>
            <!-- end project list -->

        </div>
    </div>
</div>

