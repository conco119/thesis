<div class="detail_title">
    THÔNG TIN TÀI KHOẢN
</div>

<div class="row col-default">
    <div class="col-md-2 col-sm-2"></div>
    <div class="col-md-10 col-sm-10 col-default">
        <div class="account_info">
            <form class="form-inline">
               
                    <div class="form-group">
                        <label for="email">Họ Tên:</label>
                        <input type="text" class="form-control form-inline" value="{$user_info.name}"  width="100px">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" value="{$user_info.email}" disabled="">
                    </div>
                    <div class="form-group">
                        <label for="email">Mật Khẩu:</label>
                        <input type="password" class="form-control" value="{$user_info.password}" >
                    </div>
                    <div class="form-group">
                        <label for="email">Số điện thoại:</label>
                        <input type="text" class="form-control" value="{$user_info.phone}" >
                    </div>
                    <div class="form-group">
                        <label for="email">Địa chỉ:</label>
                        <input type="text" class="form-control" value="{$user_info.address}">
                    </div>
                    <div class="form-group">
                        <label for="email">Ngày sinh:</label>
                        <select class="form-control">
                            <option>1</option>
                        </select>
                        <select class="form-control">
                            <option>4</option>
                        </select>
                        <select class="form-control">
                            <option>1993</option>
                        </select>
                    </div>

                    <div class="form-full">
                        <button type="button" class="btn btn-danger">Lưu thông tin</button>
                    </div>
               
            </form>
        </div>
    </div>
</div>