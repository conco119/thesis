
<div class="sidebar_title bg_34495e">
        <h3> ĐỔI MẬT KHẨU </h3>
    </div>
<div class="row col-default">

    <div class="col-md-12 col-sm-12 col-default ">
        <div class="account_info full bg_white pad-15" >
            <form class="form-inline"  method="post">
                    {foreach from=$error item=er}
                        <p style='padding-left: 20px; color:red;'>{$er}</p>
                    {/foreach}
                    <div class="form-group">
                        <label for="email">Nhập mật khẩu cũ:</label>
                        <input type="password" class="form-control form-inline" name="old_password"   width="100px" placeholder='Nhập mật khẩu cũ'>
                    </div>
                    <div class="form-group">
                        <label for="email">Mật khẩu mới:</label>
                        <input type="password" class="form-control form-inline" name="password"   width="100px" placeholder='Nhập mật khẩu mới'>
                    </div>
                    <div class="form-group">
                        <label for="email">Nhập lại mật khẩu mới:</label>
                        <input  type="password" class="form-control" name="repassword" placeholder='Nhập lại mật khẩu mới'>
                    </div>
                        <a href='./?mc=customer&site=detail' class='btn btn-primary'  style='margin-left:20px' >
                            <i class="fa fa-arrow-left"></i>
                        </a>
                        <button class='btn btn-default' type='submit' style='margin-left:20px' name='submit'>
                            <i class="fa fa-save"></i>
                            Lưu
                        </button>
                    </div>
            </form>
        </div>
    </div>
</div>