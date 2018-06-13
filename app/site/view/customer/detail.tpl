
<div class="sidebar_title bg_34495e">
        <h3> THÔNG TIN TÀI KHOẢN </h3>
    </div>
<div class="row col-default">

    <div class="col-md-12 col-sm-12 col-default ">
        <div class="account_info full bg_white pad-15" >
            <form class="form-inline"  method="post">

                    <div class="form-group">
                        <label for="email">Họ Tên:</label>
                        <input type="text" class="form-control form-inline" name="name" value="{$user.name}"  width="100px">
                    </div>
                    <div class="form-group">
                        <label for="email">Tài khoản:</label>
                        <input type="email" class="form-control" value="{$user.username}" disabled="">
                    </div>

                    <div class="form-group">
                        <label for="email">Số điện thoại:</label>
                        <input type="text" class="form-control" name="phone" value="{$user.phone}" >
                    </div>
                    <div class="form-group">
                        <label for="email">Địa chỉ:</label>
                        <input type="text" class="form-control" name="address" value="{$user.address}" style='width:70%'>
                    </div>
                    <!-- <div class="form-group">
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
                    </div> -->

                    <div class="form-full" >
                        <button class='btn btn-default' name='submit' type='submit' style='margin-right:20px'>
                            <i class="fa fa-save"></i>
                            {* <input type="submit" class="btn btn-default pull-left" name="submit" value="Lưu thông tin" style='margin-right:20px'> *}
                            Lưu thông tin
                        </button>
                        <a class='btn btn-primary' href='./?mc=customer&site=pass'>
                            <i class="fa fa-exchange"></i>
                                Đổi mật khẩu
                        </a>
                    </div>
            </form>
        </div>
    </div>
</div>