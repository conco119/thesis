<div class="">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Thiết lập thông tin công ty / cửa hàng {$content}</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Settings 1</a></li>
                                <li><a href="#">Settings 2</a></li>
                            </ul>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form method="post" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                        <br>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Cửa hàng/ doanh nghiệp</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" required="required" class="form-control" name="name" value="{$out.name}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Hotline</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" required="required" class="form-control" name="phone" value="{$out.phone}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Email liên hệ</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input class="form-control" type="text" name="email" value="{$out.email}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Địa chỉ</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea class="form-control" required="required" name="address">{$out.address}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Thông tin mô tả</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea class="form-control"  name="description">{$out.description}</textarea>
                            </div>
                        </div>

                       {* <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Logo</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="file" name="logo" class="mar-top-10" />
                                <img class="logo" src="{$out.logo}" />
                            </div>
                        </div> *}

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button type="submit" class="btn btn-success" name="submit">Lưu lại</button>
                                <button type="reset" class="btn btn-default">Hủy bỏ</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>