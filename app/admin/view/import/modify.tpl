<script type="text/javascript"> var mid = {$value.id}; </script>
<div class="">

    <div class="" id="AllId">
        <div class="col-md-6 col-xs-12">
            <h2>Chỉnh sửa hóa đơn nhập hàng</h2>
        </div>
        <div class="col-md-6 col-xs-12">
            <form action="" method="post" class="text-right">
                <button type="button" class="btn btn-primary" onclick="Refresh({$value.id});"><i
                            class="fa fa-refresh"></i> Làm mới
                </button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-9 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <a href="?mod=import&site=statistics" style="margin-right: 20px;" class="btn btn-default pull-left"><i
                                class="fa fa-arrow-left"></i>&ensp;Hóa đơn lưu trữ</a>
                    <h2>Chi tiết đơn hàng</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <div class="h_content">
                        <div class="form-group form-inline">
                            <input class="left form-control" id="UseBarcode" placeholder="Mã vạch"
                                   onchange="GetProductFromBarcode({$value.id}, this.value);">
                        </div>

                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#GetProduct"
                                onclick="LoadProduct({$value.id});"><i class="fa fa-pencil"></i> Chọn sản phẩm
                        </button>
                        <div class="clearfix"></div>
                    </div>


                    <div id="">
                        <table class="table table-striped table-bordered" id="Products">
                            <thead>
                            <tr>
                                <th>Mã</th>
                                <th>Sản phẩm</th>
                                <th class="text-right">{if $arg.setting.percent eq 1}Nguyên giá{else}Giá nhập{/if}</th>
                                {if $arg.setting.percent eq 1}<th class="text-center">Chiết khấu</th>
                                    <th class="text-right">Giá nhập</th>{/if}
                                <th class="text-center">Số lượng</th>
                                <th>Đơn vị</th>
                                {if $arg.setting.use_expiry eq 1}
                                    <th>Hạn sử dụng</th>
                                {/if}
                                {if $arg.setting.use_description_import eq 1}
                                    <th class="text-center" width="70">Mô tả</th>
                                {/if}
                                <th class="text-right">Thành tiền</th>
                                <th class="td-actions"></th>
                            </tr>
                            </thead>
                            <tbody>
                            {foreach from=$value.products item=list}
                                <tr id="proNo{$list.id}">
                                    <td>{$list.code}</td>
                                    <td>{$list.name}</td>
                                    <td class="text-right"><input type="text" class="prod-price" id="proPrice{$list.id}"
                                                                  onchange="UpdateProductPrice({$value.id}, {$list.id}, this.value);"
                                                                  value="{$list.price|number_format}"></td>
                                    {if $arg.setting.percent eq 1}  <td class="text-center">
                                        <div class="input-group" style="width: 50px;">
                                            <input id="propercent{$list.id}" type="text"
                                                   class="form-control prod-price input-sm" value="{$list.percent}"
                                                   onchange="UpdatePercent({$value.id},{$list.id},this.value);"
                                                   aria-describedby="basic-addon2">
                                            <span class="input-group-addon" id="basic-addon2"
                                                  style="padding: 2px;">%</span>
                                        </div>
                                    </td>
                                    <td class="text-right" id="price_sell{$list.id}">
                                        {($list.price-$list.price*$list.percent/100)|number_format} đ
                                    </td>{/if}
                                    <td class="text-center"><input type="number" class="prod-number"
                                                                   id="proNumber{$list.id}"
                                                                   onchange="UpdateNumberProduct({$value.id}, {$list.id}, 'update', this.value);"
                                                                   value="{$list.number}"></td>
                                    <td>{$list.select_units}</td>
                                    {if $arg.setting.use_expiry eq 1}
                                        <td><input type="text" class="expiry" id="proExpiry{$list.id}"
                                                   onchange="UpdateExpiry({$value.id}, {$list.id}, this.value);"
                                                   value="{$list.expiry}"></td>{/if}
                                    {if $arg.setting.use_description_import eq 1}
                                        <td class="text-center edit_desciption">
                                            <button type="button" id="test" class="btn btn-lg btn-info" data-html="true"
                                                    data-toggle="popover" data-placement="left"
                                                    onclick="SetValueDescripton({$value.id},{$list.id});"
                                                    data-content="<input type='text' class='form-control' id='proDescription{$list.id}' onchange='UpdateDescriptionProduct({$value.id},{$list.id}, this.value);' value='{$list.description}'>">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                        </td>
                                    {/if}
                                    <td class="text-right"
                                        id="proTotal{$list.id}">{(($list.price-$list.price*$list.percent/100)*$list.number)|number_format}
                                        đ
                                    </td>
                                    <td class="text-right">
                                        <button class="btn btn-danger"
                                                onclick="UpdateNumberProduct({$value.id}, {$list.id}, 'delete')"><i
                                                    class="fa fa-times-circle"></i></button>
                                    </td>
                                </tr>
                            {/foreach}
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-3 col-xs-12">
            <div class="x_panel">
                <div class="">
                    <div class="tabbable">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_1" data-toggle="tab">Cơ bản</a></li>
                            <li><a href="#tab_2" data-toggle="tab">Chiết khấu</a></li>
                            <li><a href="#tab_3" data-toggle="tab">Mô tả</a></li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
                    <form class="form-horizontal form-label-left input_mask">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">HD</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" name="country" class="form-control col-md-10" readonly
                                               value="{$value.code}"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Ngày</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input class="date-picker form-control col-md-7 col-xs-12"
                                               onchange="SetExportValue({$value.id}, 'date', this.value);"
                                               required="required" type="text" id="exportday" value="{$value.date}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <button type="button" class="btn btn-primary" onclick="LoadDataForForm(0);"
                                                data-toggle="modal" data-target="#UpdateFrom">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select name="suppliers_id" class="select2_single form-control" tabindex="-1"
                                                onchange="SetExportValue({$value.id}, 'supplier_id', this.value);">
                                            <option>Chọn nhà cung cấp</option>{$out.suppliers}</select>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_2">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                    <div class="col-md-9 col-sm-12 col-xs-12">
                                        <select class="form-control" name="discount_type"
                                                onchange="UpdateDiscount(); SetExportValue({$value.id}, 'discount_type', this.value); GetTotalSession({$value.id});">{$out.discount}</select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Giá trị</label>
                                    <div class="col-md-9 col-sm-12 col-xs-12">
                                        <input type="text" name="discount" class="form-control text-right"
                                               onchange="UpdateDiscount(); SetExportValue({$value.id}, 'discount', this.value); GetTotalSession({$value.id});"
                                               value="{$value.discount}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_3">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <textarea class="form-control" rows="5" placeholder='Mô tả hóa đơn...'
                                                  onchange="SetExportValue({$value.id}, 'description', this.value);">{$value.description}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="x_panel">
                <div class="x_content">
                    <form class="form-horizontal form-label-left">
                        <div class="form-group">
                            <label class="control-label col-md-5 col-sm-6 col-xs-12">Tổng tiền</label>
                            <div class="col-md-7 col-sm-6 col-xs-12">
                                <input type="text" class="form-control text-right" name="m_total" readonly/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-5 col-sm-6 col-xs-12">Tiền phải thanh toán</label>
                            <div class="col-md-7 col-sm-6 col-xs-12">
                                <input type="text" class="form-control text-right" name="m_total_must_pay" readonly/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-5 col-sm-6 col-xs-12">Tiền thanh toán</label>
                            <div class="col-md-7 col-sm-6 col-xs-12">
                                <input type="text" name="payment" class="form-control text-right"
                                       onchange="SetExportValue({$value.id}, 'payment', this.value); GetTotalSession({$value.id});"
                                       value="{$value.payment|number_format}"/>
                                <button type="button" id="GetAllPay" onclick="GetAllPayment();" title="Trả toàn bộ"><i
                                            class="fa fa-calculator"></i></button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-5 col-sm-6 col-xs-12">Tiền ghi nợ</label>
                            <div class="col-md-7 col-sm-6 col-xs-12">
                                <input type="text" class="form-control text-right" name="debt" readonly/>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <form action="" method="post" class="text-center">
                        <button type="submit" class="btn btn-lg btn-success" name="submit"><i class="fa fa-save"></i>
                            Lưu HD
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" tabindex="-1" id="UpdateFrom">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                <h4 class="modal-title" id="title"> Thêm nhà cung cấp mới </h4>
            </div>
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <input type="hidden" name="id">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Mã</label>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <input class="form-control" type="text" name="code">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Tên NCC</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="text" name="name" required class="form-control" placeholder="Tên NCC...">
                        </div>
                        <div id="name_eror" class="text-center" style="color: red; margin-bottom: 10px;"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Người liên hệ</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="text" name="manager" required="required" class="form-control"
                                   placeholder="Người liên hệ...">
                        </div>
                        <div id="manager_eror" class="text-center" style="color: red; margin-bottom: 10px;"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Điện thoại</label>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <input type="tel" class="form-control" name="phone" pattern="[0-9]\d*"
                                   title="Số điện thoại">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Địa chỉ</label>
                        <div class="col-md-9 col-sm-6 col-xs-12">
                            <input type="text" class="form-control" name="address">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="AddSupplier();">Lưu lại</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Bỏ qua</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- GetProduct -->
<div class="modal fade" tabindex="-1" id="GetProduct">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                <h4 class="modal-title">Nhập sản phẩm vào hóa đơn</h4>
            </div>
            <div class="modal-body">
                <div class="row form-group" id="prodFillter">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="FilterKey" class="form-control" oninput="LoadProduct({$value.id});">
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" id="FilterCate"
                                onchange="LoadProduct({$value.id});">{$out.categories}</select>
                    </div>
                    {if $arg.setting.use_trademark  eq 1}
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" id="FilterTrademark"
                                onchange="LoadProduct({$value.id});">{$out.trademarks}</select>
                        </div>{/if}
                    {if $arg.setting.use_origin  eq 1}
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" id="FilterOrigin"
                                onchange="LoadProduct({$value.id});">{$out.origins}</select>
                        </div>{/if}
                </div>
                <div style="max-height: 400px; overflow-y: auto">
                    <table class="table table-striped" id="ProductList"></table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- Order Detail -->
<div class="modal fade" id="orderDetail">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body form-horizontal"></div>
            <div class="modal-footer">
                <form action="" method="post">
                    <button type="button" data-toggle="modal" class="btn btn-default" onclick="SetPrint();"
                            data-dismiss="modal"><i class="icon-print"></i> In
                    </button>
                    <button type="submit" class="btn btn-default" name="submit"><i class="icon-save"></i> Lưu</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="{$arg.stylesheet}js/wh.import_modify.js"></script>
{literal}
    <script>
        $(document).ready(function () {
            $('#exportday').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_4",
                format: 'DD-MM-YYYY'
            }, function (start, end, label) {
                $('#exportday').change();
            });

            $('.expiry').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_4",
                format: 'DD-MM-YYYY'
            }, function () {
                $('.expiry').change();
            });

            GetTotalSession(mid);
        });

        function GetAllPayment() {
            var must_pay = $("input[name=m_total_must_pay]").val();
            $("input[name=payment]").val(must_pay);
            $('input[name=payment]').change();
        }


        function GetOrderDetail() {
            //console.log(data);
            $("#orderDetail .modal-body").load("?mod=exportAjax&site=ajax_get_export_session_detail");
        }
        $(function () {
            $('[data-toggle="popover"]').popover();
        });


        function LoadDataForForm(id) {
            $("#UpdateFrom input[type=text]").val('');
            $("#UpdateFrom input[type=number]").val('');
            $.post("?mod=supplier&site=ajax_load_item", {'id': id}).done(function (data) {
                var data = JSON.parse(data);
                $("#UpdateFrom input[name=code]").val(data.code);
            });
        }

        function AddSupplier() {
            var data = {};
            data['code'] = $("#UpdateFrom input[name=code]").val();
            data['name'] = $("#UpdateFrom input[name=name]").val();
            data['manager'] = $("#UpdateFrom input[name=manager]").val();
            data['phone'] = $("#UpdateFrom input[name=phone]").val();
            data['address'] = $("#UpdateFrom input[name=address]").val();
            if (data['name'] == "") {
                $('#name_eror').html("Tên không được bỏ trống!");
                return false;

            }
            if (data['manager'] == "") {
                $('#manager_eror').html("Người liên hệ không được bỏ trống!");
                return false;

            }
            $.post("?mod=supplier&site=ajax_insert_item", data).done(function (rt) {
                var rt = JSON.parse(rt);
                $('#UpdateFrom').modal('hide');
                $(".select2_single").select2({placeholder: "Select a state", allowClear: true});
                $("select[name=suppliers_id]").html(rt.categories).change();
            });
        }


    </script>
{/literal}

