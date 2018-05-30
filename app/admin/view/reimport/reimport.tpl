<div class="row">
    <div class="col-md-9 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <a href="?mod=import&site=reimport_list" style="margin-right: 20px;"
                   class="btn btn-default pull-left"><i class="fa fa-arrow-left"></i>&ensp;Hóa đơn lưu trữ</a>
                <h2>Chi tiết hóa đơn trả hàng</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <div class="h_content">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#GetProduct"
                            onclick="LoadProduct();">
                        <i class="fa fa-pencil"></i> Thêm sản phẩm
                    </button>
                    <div class="clearfix"></div>
                </div>


                <div id="">
                    <table class="table table-striped table-bordered" id="Products">
                        <thead>
                        <tr>
                            <th>Mã</th>
                            <th>Sản phẩm</th>
                            <th class="text-right">Giá</th>
                            <th class="text-center">S.lượng</th>
                            <th>Đơn vị</th>
                            <th class="text-right">Thành tiền</th>
                            <th class="td-actions"></th>
                        </tr>
                        </thead>
                        <tbody>
                        {foreach from=$products item=list}
                            <tr id="proNo{$list.product_id}">
                                <td>{$list.product_code}</td>
                                <td>{$list.product_name}</td>
                                <td class="text-right"><input type="text"
                                                              class="prod-price"
                                                              value="{$list.price|number_format}"></td>
                                <td class="text-center"><input type="number"
                                                               class="prod-number" id="proNumber{$list.product_id}"
                                                               onchange="UpdateNumberProduct({$list.product_id}, this.value, {$list.max_number});"
                                                               value="{$list.number_count}"></td>
                                <td>{$list.unit_name}</td>
                                <td class="text-right"
                                    id="proTotal{$list.product_id}">{($list.price*$list.number_count)|number_format} đ
                                </td>
                                <td class="text-right">
                                    <button class="btn btn-danger"
                                            onclick="RemoveProduct({$list.product_id})">
                                        <i class="fa fa-times-circle"></i>
                                    </button>
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
        <form class="form-horizontal text-right" action="" method="post">
            <div class="x_panel">
                <div class="">
                    <div class="tabbable">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_1" data-toggle="tab">Thông tin trả hàng</a></li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Ngày</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input class="date-picker form-control col-md-7 col-xs-12"
                                               onchange="SetExportValue('date', this.value);"
                                               required="required" type="text" id="exportday"
                                               value="{$import.date}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">KH</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input class="form-control col-md-7 col-xs-12" value="{$import.customer_name}"
                                               id="customer" readonly placeholder="Tên khách hàng">
                                    </div>
                                </div>
                                <input type="radio" value="0" name="check_money" checked> Lấy lại tiền trả
                                <input type="radio" value="1" name="check_money"> Nạp vào tài khoản
                                <br>
                                <br>
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
									<textarea class="form-control" rows="5"
                                              placeholder='Ghi chú thông tin'
                                              onchange="SetExportValue('description', this.value);">{$import.description}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>

            <div class="x_panel">
                <div class="x_content">
                    <div class="form-group">
                        <label class="control-label col-md-5 col-sm-6 col-xs-12">Tổng
                            tiền</label>
                        <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" class="form-control text-right" name="m_total"
                                   readonly/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-5 col-sm-6 col-xs-12">Phải
                            trả</label>
                        <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" class="form-control text-right"
                                   name="m_total_must_pay" readonly/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-5 col-sm-6 col-xs-12">Đã
                            trả</label>
                        <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" name="payment" class="form-control text-right"
                                   onchange="SetExportValue('payment', this.value);"
                                   value="{$import.payment|number_format}"/>
                            <button type="button" id="GetAllPay" onclick="GetAllPayment();"
                                    title="Trả toàn bộ">
                                <i class="fa fa-calculator"></i>
                            </button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-5 col-sm-6 col-xs-12">Ghi
                            nợ</label>
                        <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" class="form-control text-right" name="debt"
                                   readonly/>
                        </div>
                    </div>
                    <hr>

                    <button type="submit" class="btn btn-success" name="submit">
                        <i class="fa fa-check-square-o"></i> Lưu phiếu trả hàng
                    </button>
                </div>
            </div>
        </form>
    </div>

</div>


<!-- GetProduct -->
<div class="modal fade" id="GetProduct">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                <h4 class="modal-title">Nhập sản phẩm vào hóa đơn</h4>
            </div>
            <div class="modal-body">
                <div class="row form-group" id="prodFillter">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" name="FilterCode" onchange="UpdateIdExport(this.value);" class="form-control"
                               placeholder="Mã hóa đơn">
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <button type="button" class="btn btn-info" onclick="LoadProduct();"><i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
                <div>
                    <table class="table table-striped" id="ProductList"></table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- Print -->
<div class="modal fade" id="Print">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body modal-print">
                <iframe src="#" style="zoom: 0.60" width="99.6%" height="450" id="PrintContent"></iframe>
            </div>
        </div>
    </div>
</div>


<!-- Update export price -->
<div class="modal fade" id="UpdateExportPrice">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body form-horizontal">
                <h3 id="uxp_name">PID08 ami 6 cuon</h3>
                <p>Sản phẩm đã thay đổi giá nhập, bạn có muốn nhập lại giá bán của nó không ?</p>
                <div class="form-group">
                    <label class="control-label col-md-6 col-sm-6 col-xs-12">Giá nhập hàng</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input class="form-control text-right" type="text" name="price_import" readonly="readonly">
                        <input class="form-control" type="hidden" name="id">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-6 col-sm-6 col-xs-12">Giá bán</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input class="form-control text-right" type="text" name="price" oninput="SetMoney(this);">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" onclick="SaveExportPrice();">Lưu lại</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Bỏ qua</button>
            </div>
        </div>
    </div>
</div>

<script src="{$arg.stylesheet}js/wh.reimport.js"></script>
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
            GetTotalSession();
        });

        function GetAllPayment() {
            var must_pay = $("input[name=m_total_must_pay]").val();
            $("input[name=payment]").val(must_pay);
            $('input[name=payment]').change();
        }

    </script>
{/literal}

