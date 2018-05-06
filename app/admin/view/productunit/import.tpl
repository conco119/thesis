<div class="">
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Nhập sản phẩm từ file Excel</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="?mod=product&site=categories">Quản lý danh mục</a></li>
                                <li><a href="?mod=product&site=units">Quản lý đơn vị</a></li>
                            </ul>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <form method="post" class="form-horizontal form-label-left" data-parsley-validate enctype="multipart/form-data">
                        <br><br>
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12"></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="radio">
                                    <label> <input type="radio" name="type" checked value="0">Cập nhật dữ liệu sản phẩm từ file</label>
                                </div>
                                <div class="radio">
                                    <label> <input type="radio" name="type" value="1">Khởi tạo giá trị kho ban đầu</label> 
                                </div>
                            </div>
                        </div>
                        <!-- /control-group -->
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">File import</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="file" name="file">
                            </div>
                        </div>
                        <br><br>
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12"></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <p>Lưu ý: file upload dữ liệu phải có dạng giống file mẫu.</p>
                                <p><i>Nếu bạn chưa có file mẫu, xin vui lòng <a href="{$out.download}" class="bold">download</a> tại đây</i></p>
                            </div>
                        </div>
                        <br />

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2">
                                <button type="submit" class="btn btn-primary">Hủy</button>
                                <button type="submit" class="btn btn-success" name="submit">Nhập</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
