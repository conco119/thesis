<div class="">
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Danh sách sản phẩm được báo giá</h2>
                    <button type="button" class="btn btn-primary pull-right" onclick="Refresh();"><i
                                class="fa fa-refresh"></i> Làm mới
                    </button>
                    <button type="button" class="btn btn-primary pull-right " data-toggle="modal"
                            data-target="#GetProduct" onclick="LoadProduct4Setup();"><i class="fa fa-plus"></i> Thêm
                    </button>
                    <form method="post">
                        <button type="submit" class="btn btn-success pull-right" name="export_request">
                            <i class="fa fa-share-square-o"></i> Xuất file
                        </button>
                    </form>

                    <div class="form-inline">
                        <select class="form-control pull-left" id="type_percent">
                            <option value="0"> Bán lẻ</option>
                            <option value="1"> Bán buôn</option>
                        </select>

                        <div class="input-group" style="width: 150px;margin-left: 10px">
                            <input id="value_percent" type="text"
                                   class="form-control prod-price" placeholder="Nhập chiết khấu"
                                   aria-describedby="basic-addon2">
                            <span class="input-group-addon" id="basic-addon2">%</span>
                        </div>
                        <button class="btn  btn-primary" style="margin-bottom: 10px;" onclick="Update_all_percent();">Áp
                            dụng
                        </button>
                    </div>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <!-- start project list -->
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="Products">
                            <thead>
                            <tr>
                                <th class="text-center"><input type="checkbox" id="SelectAllRows"></th>
                                <th>Mã</th>
                                <th>Sản phẩm</th>
                                <th class="text-right">Nguyên giá lẻ</th>
                                <th class="text-center">Chiết khấu bán lẻ</th>
                                <th class="text-right">Giá bán lẻ</th>
                                <th class="text-right">Nguyên giá buôn</th>
                                <th class="text-center">Chiết khấu bán buôn</th>
                                <th class="text-right">Giá bán buôn</th>
                                <th width="60"></th>
                            </tr>
                            </thead>
                            <tbody>
                            {foreach from=$result item=list}
                                <tr id="prodNo{$list.id}">
                                    <td class="text-center"><input type="checkbox" class="item_checked"
                                                                   value="{$list.id}"></td>
                                    <td>{$list.code}</td>
                                    <td>{$list.name}</td>
                                    <td class="text-right">{$list.price|number_format} đ</td>
                                    <td class="text-center">
                                        <div class="input-group" style="width: 50px;">
                                            <input id="propercent{$list.id}" type="text"
                                                   class="form-control prod-price input-sm" value="{$list.percent}"
                                                   onchange="UpdatePercent(this.value,{$list.id},0);"
                                                   aria-describedby="basic-addon2">
                                            <span class="input-group-addon" id="basic-addon2"
                                                  style="padding: 2px;">%</span>
                                        </div>
                                    </td>
                                    <td class="text-right"
                                        id="price{$list.id}">{($list.price-$list.price*$list.percent/100)|number_format}
                                        đ
                                    </td>
                                    <td class="text-right">{$list.price_sale|number_format} đ</td>
                                    <td class="text-right">
                                        <div class="input-group" style="width: 50px;">
                                            <input id="propercent{$list.id}" type="text"
                                                   class="form-control prod-price input-sm" value="{$list.percent_sale}"
                                                   onchange="UpdatePercent(this.value,{$list.id},1);"
                                                   aria-describedby="basic-addon2">
                                            <span class="input-group-addon" id="basic-addon2"
                                                  style="padding: 2px;">%</span>
                                        </div>
                                    </td>
                                    <td class="text-right"
                                        id="price_sale{$list.id}">{($list.price_sale-$list.price_sale*$list.percent_sale/100)|number_format}
                                        đ
                                    </td>
                                    <td class="text-right">
                                        <button type="button" class="btn btn-danger"
                                                onclick="RemoveProd({$list.id});"><i
                                                    class="fa fa-times-circle"></i></button>
                                    </td>
                                </tr>
                            {/foreach}
                            </tbody>
                        </table>
                    </div>
                    <!-- end project list -->

                </div>
            </div>
        </div>
    </div>
</div>

<!-- GetProduct -->
<div class="modal fade" tabindex="-1" id="GetProduct">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                <h4 class="modal-title">Chọn sản phẩm làm báo giá</h4>
            </div>
            <div class="modal-body">
                <div class="row form-group" id="prodFillter">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="FilterKey" class="form-control" oninput="LoadProduct4Setup();"
                               placeholder="Mã / Tên sản phẩm">
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" id="FilterCate"
                                onchange="LoadProduct4Setup();">{$out.categories}</select>
                    </div>
                    {if $arg.setting.use_trademark  eq 1}
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" id="FilterTrademark"
                                onchange="LoadProduct4Setup();">{$out.trademarks}</select>
                        </div>{/if}
                    {if $arg.setting.use_origin  eq 1}
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" id="FilterOrigin"
                                    onchange="LoadProduct4Setup();">{$out.origins}</select>
                        </div>
                    {/if}
                </div>
                <div style="max-height: 400px; overflow-y: auto">
                    <table class="table table-striped" id="ProductList">

                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="AddAllproduct();">Chọn</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script src="{$arg.stylesheet}js/room.js"></script>

{literal}
    <script>
        $('#GetProduct').on('shown.bs.modal', function () {
            $("#SelectAllmodal").click(function () {
                $(".item_checked_modal").prop('checked', $(this).prop('checked'));
            });
        });
        function LoadProduct4Setup() {
            var post = {};
            post['cate'] = $("#FilterCate").val();
            post['trade'] = $("#FilterTrademark").val();
            post['orig'] = $("#FilterOrigin").val();
            post['key'] = $("#FilterKey").val();

            $.post('?mod=product&site=ajax_load_prod4setup', post).done(function (data) {
                $("#ProductList").html(data);
                $("#SelectAllmodal").click(function () {
                    $(".item_checked_modal").prop('checked', $(this).prop('checked'));
                });
            });
        }
        function AddProd4Setup(id) {
            id = parseInt(id);
            if (id == 0 || id < 0) {
                return false;
            }
            $.post('?mod=product&site=ajax_add_prod4setup', {'id': id})
                    .done(function (data) {

                        if (data == '0') {
                            return false;
                        }
                        $("#prd" + id).remove();
                        $("#Products tbody").prepend(data);
                        LoadProduct4Setup();

                    });

        }

        function UpdatePercent(value, id, type) {
            $.post("?mod=product&site=ajax_update_percent", {
                'id': id,
                'value': value,
                'type': type
            }).done(function (data) {
                if (data == 0) {
                    alert('error');
                }
                else {
                    if (type == 0) {
                        $('#price' + id).html(data);
                        $('propercent' + id).val(value);
                    }
                    else {
                        $('#price_sale' + id).html(data);
                    }
                    alert('Thay doi thanh cong!');
                }
            });
        }
        function RemoveProd(id) {
            id = parseInt(id);
            $.post('?mod=product&site=ajax_remove_prod', {'id': id})
                    .done(function () {
                        console.log(id);
                        $('#prodNo' + id).css('background', '#F7CDCE');
                        $('#prodNo' + id).fadeOut(800);
                    });
        }
        function Update_all_percent() {
            var type = $('#type_percent').val();
            var value = $('#value_percent').val();
            var arr = [];
            $(".item_checked").each(function () {
                if ($(this).is(':checked')) {
                    var value = $(this).val();
                    arr.push(value);
                }
            });
            if (arr.length < 1) {
                var notice = new PNotify({
                    title: 'Chọn mục xử lí',
                    text: 'Vui lòng chọn các mục cần xử lí',
                    type: 'info',
                    mouse_reset: false,
                    buttons: {
                        sticker: false
                    },
                    animate: {
                        animate: true,
                        in_class: 'fadeInDown',
                        out_class: 'fadeOutRight'
                    }
                });
                notice.get().click(function () {
                    notice.remove();
                });
                return false;
            }
            var str = arr.toString();
            $.post('?mod=product&site=ajax_set_all_percent', {
                'id': str,
                'type': type,
                'value': value
            }).done(function () {
                window.location.href = '?mod=product&site=setup';
            });

        }
        function AddAllproduct() {
            var arr = [];
            $(".item_checked_modal").each(function () {
                if ($(this).is(':checked')) {
                    var value = $(this).val();
                    arr.push(value);
                }
            });
            if (arr.length < 1) {
                var notice = new PNotify({
                    title: 'Chọn mục xử lí',
                    text: 'Vui lòng chọn các mục cần xử lí',
                    type: 'info',
                    mouse_reset: false,
                    buttons: {
                        sticker: false
                    },
                    animate: {
                        animate: true,
                        in_class: 'fadeInDown',
                        out_class: 'fadeOutRight'
                    }
                });
                notice.get().click(function () {
                    notice.remove();
                });
                return false;
            }
            var str = arr.toString();
            $.post('?mod=product&site=ajax_add_all_pro', {
                'id': str
            }).done(function (data) {
                $("#Products tbody").prepend(data);
                LoadProduct4Setup();
            });
        }
        function Refresh() {
            window.location.href = '?mod=product&site=refresh';

        }

    </script>
{/literal}
