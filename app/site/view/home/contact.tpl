        <div class="sidebar_title bg_34495e">
            <h3>Thông tin liên lạc</h3>
        </div>
<div class="bg_white full pad-bottm-15 mar-btm">
    <div class="col-md-7 col-sm-7 col-xs-12">
    <div class="">

        <div class="map_site">
            <div id="map_canvas" style="width: 100%; height: 300px;" class=""></div>
            <br />
            <div style="display: none;">
                <label>latitude: </label><input id="txtPositionY" type="text" /><br />
                <label>longitude: </label><input id="txtPositionX" type="text" />
            </div>
        </div>

        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="cont_localtion">
                <div class="icon bg_1bbc9b"><i class="fa fa-map-marker"></i></div>
                <p>{$info.info.address}</p>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="cont_localtion">
                <div class="icon bg_3598db"><i class="fa fa-envelope-o"></i></div>
                <p>{$info.info.email}</p>

            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="cont_localtion">
                <div class="icon bg_f5791f"><i class="fa fa-phone"></i></div>
                <p>{$info.info.phone}</p>

            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="cont_localtion">
                <div class="icon bg_9a59b5"><i class="fa fa-clock-o"></i></div>
                <p>Thứ 2 - Thứ 7: 8h đến 18h</p>
            </div>
        </div>

    </div>
</div>

<div class="col-md-5 col-sm-5 col-xs-12 form_contact">
    <form class="form-horizontal" role="form" id="FrmValidate" action="" method="post">
        <div class="form-group">
            <label class="control-label" for="email">Tên:</label>
            <div class="">
                <input type="text" class="form-control required" name="name" placeholder="">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label" for="pwd">Email:</label>
            <div class="">
                <input type="text" class="form-control required email" name="email" placeholder="">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label" for="pwd">Điện thoại:</label>
            <div class="">
                <input type="text" class="form-control" name="phone" placeholder="">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label" for="pwd">Lời Nhắn:</label>
            <div class="">
                <textarea class="form-control required" rows="5" name="description"></textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="">
                <input type="submit" class="btn btn-default" name="submit" value="Gửi" />
            </div>
        </div>
    </form>
</div>
</div>


<script>
    $("#FrmValidate").validate({
          messages: {
                name: "Mời bạn nhập vào tên",
                address: "Mời bạn nhập vào địa chỉ",
                phone: "Số điện thoại không đúng",
                email: "Bạn vui lòng nhập email để có thể nhận báo giá mới nhất"

            }

    });
</script>