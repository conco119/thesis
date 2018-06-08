
<div class="sidebar_title bg_34495e">
        <h3> THÔNG TIN TÀI KHOẢN </h3>
    </div>
<div class="row col-default">
   
    <div class="col-md-12 col-sm-12 col-default ">
        <div class="account_info full bg_white pad-15" >
            <form class="form-inline" action="?mod=customer&site=update" method="post">
               
                    <div class="form-group">
                        <label for="email">Họ Tên:</label>
                        <input type="text" class="form-control form-inline" name="name" value="{$user_info.name}"  width="100px">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" value="{$user_info.email}" disabled="">
                    </div>
                   
                    <div class="form-group">
                        <label for="email">Số điện thoại:</label>
                        <input type="text" class="form-control" name="phone" value="{$user_info.phone}" >
                    </div>
                    <div class="form-group">
                        <label for="email">Địa chỉ:</label>
                        <input type="text" class="form-control" name="address" value="{$user_info.address}">
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

                    <div class="form-full">
                        <input type="submit" class="btn btn-danger pull-left" name="submit" value="Lưu thông tin">
                    </div>
               
            </form>
        </div>
    </div>
</div>