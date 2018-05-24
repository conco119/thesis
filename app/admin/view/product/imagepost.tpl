<div class="">
    <div class="row">
        <div class="x_panel">
            <div class="x_title">
                <h2>Quản lý hình ảnh sản phẩm: {$product_info.name} [{$product_info.code}]</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="h_content">
                    <a href="./admin?mc=product&site=index" class="btn btn-primary left"><i
                                class="fa fa-bars"></i> Quản lý sản phẩm</a>
                    <div class="clearfix"></div>
                </div>
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="avatar-modal">
    <div class="">
        <div id="avatar_change" class="modal-content">
            <form class="avatar-form" enctype="multipart/form-data" method="post">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal" type="button">&times;</button>
                    <h4 class="modal-title" id="avatar-modal-label">Thay đổi avatar</h4>
                </div>
                <div class="modal-body" style="background-color: #F7F7F7;">
                    <div class="avatar-body">
                        <!-- Upload image and data -->
                        <!-- Crop and preview -->
                        <div class="row">
                            <div style="padding-left: 0;" id="avatar_wrap" class="col-md-7 col-sm-7 col-xs-12">
                                <div style="position: relative; width: 100%; margin-top: 0;" id="avatar_wrap_child" class="avatar-wrapper">
                                    <img id="avatar_image" style="max-width: 100%" src="{$result.avatar}">
                                </div>
                            </div>
                            <div style="padding-right: 0;" class="col-md-5 col-sm-5 col-xs-12">
                                <div class="form-group">
                                    <label for="avatarInput" class="col-md-3 col-sm-12 col-xs-12 control-label" style="padding-left: 0; margin-top: 3px;">Tải lên</label>
                                    <div class="col-md-9 col-sm-12 col-xs-12" style="padding: 0; margin-bottom: 10px;">
                                        <input class="avatar-input" id="avatarInput" name="avatar_file" type="file" onchange="readURL(this);" style="width: 100%;">
                                    </div>
                                </div>
                                <div style="display: block;">
                                    <label style="padding-top: 25px; margin-bottom: 0; display: block;" class="control-label">Xem trước</label>
                                    <div style="display: inline-block; width: 214px; height: 214px; border: 1px solid #aaa; margin-top: 10px;" class="avatar-preview preview-lg"></div>
                                    <div style="display: inline-block; width: 56px; height: 56px; border: 1px solid #aaa; border-radius: 28px;" class="avatar-preview preview-sm"></div>
                                </div>
                                <br>
                                <input name="avatar_x" type="hidden">
                                <input name="avatar_y" type="hidden">
                                <input name="avatar_width" type="hidden">
                                <input name="avatar_height" type="hidden">
                                <div class="text-right" style="margin-top: 10px; display: block;">
                                    <button id="del_avt_btn" class="btn btn-danger" name="delete_avatar">Xóa avatar hiện tại</button>
                                    <button class="btn btn-default" data-dismiss="modal" type="button">Hủy bỏ</button>
                                    <button class="btn btn-primary avatar-save" name="avatar_change" type="submit">Lưu lại</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="modal-footer">
                                            </div> -->
            </form>
        </div>
    </div>
</div>

<script src="{$arg.stylesheet}js/image.product.js"></script>