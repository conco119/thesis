<div class="">
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Lịch sử thu chi của nhân viên</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <div class="h_content">
                        <div class="form-group form-inline">
                            <select class="form-control left" id="filter" onchange="filter();">
                                {$out.filter}
                            </select>

                            {if $out.value.filter eq '2'}
                                <select class="form-control left" id="year" onchange="filter();">
                                    {$out.year}
                                </select>
                                <select class="form-control left" id="month" onchange="filter();">
                                    {$out.month}
                                </select>
                            {/if}

                            {if $out.value.filter eq '1'}
                                <input type="text" class="form-control left" id="date_from" placeholder="Từ ngày" onchange="filter();" value="{$out.date_from}">
                                <input type="text" class="form-control left" id="date_to" placeholder="Đến ngày" onchange="filter();" value="{$out.date_to}">
                            {/if}
                            <select class="form-control left" id="date_ex" onchange="filter();">
                                <option>Tất cả hóa đơn</option>
                                {$out.select_export}
                            </select>
                        </div>
                        <form method="post" style="display: inline;">
                            <button type="submit" class="btn btn-success" name="export_request">
                                <i class="fa fa-share-square-o"></i> Xuất file
                            </button>
                        </form>

                        <div class="clearfix"></div>
                    </div>

                    <div id="money_stats">
                        <ul>
                            <li><a>Tổng thu: <span>{$money.import|number_format} đ</span></a></li>
                            <li><a>Tổng chi: <span>-{$money.export|number_format} đ</span></a></li>
                            <li><a>Ngân quỹ: <span>{$money.total|number_format} đ</span></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>

                    <!-- start project list -->
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                        <tr>
                            <th >Ngày tháng</th>
                            <th>Thể loại</th>
                            <th>Nội dung</th>
                            <th class="text-right">Thu</th>
                            <th class="text-right">Chi</th>
                            <th>Người nộp / nhận</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                        {foreach from=$result item=list}
                            <tr id="field{$list.id}">
                                <td>{$list.date|date_format:"%d-%m-%Y"}<br><small>{$list.updated}</small></td>
                                <td>{$list.money_type}<br><small>{$list.category}</small></td>
                                <td>{$list.description}</td>
                                <td class="text-right">{if $list.is_import neq 0}{$list.money|number_format} đ{/if}  </td>
                                <td class="text-right">{if $list.is_import eq 0} - {$list.money|number_format} đ {/if}</td>
                                <td>{$list.object_name}{if $list.object neq NULL}<br><small>[{$list.object}]</small>{/if}</td>
                                <td class="text-right">
                                    {$list.btn}
                                </td>
                            </tr>
                        {/foreach}

                        </tbody>
                    </table>
                    <!-- end project list -->

                    <div class="paging">{$paging.paging}</div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Order Detail -->
<div class="modal fade" id="orderDetail">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body form-horizontal"></div>
            <div class="modal-footer">
                <form action="" method="post">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal UpdateFrom -->
<div class="modal fade" tabindex="-1" id="UpdateForm">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                <h4 class="modal-title" id="title_fees"></h4>
            </div>
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <input type="hidden" name="id">
                            <input type="hidden" name="is_import">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-2 col-xs-12">Ngày lập phiếu</label>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <input type="text" id="datefees" class="form-control" name="date">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-2 col-xs-12">Đối tượng</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select name="object" class="form-control" onchange="LoadObject(this.value);"></select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-2 col-xs-12">Người nộp / nhận</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select name="object_id" class="form-control"></select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-2 col-xs-12">Thể loại</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select name="category_id" class="form-control" onchange="AddIdMoneyType(this.value);"></select>
                        </div>
                        <div class="col-md-2 col-sm-6 col-xs-12">
                            <button type="button" id="BtnUpdateMoneyType" data-toggle="modal" class="btn btn-primary" data-target="#UpdateMoneyType" onclick="UpdateMoneyType(0);"><i class="fa fa-pencil"></i></button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-2 col-xs-12">Số tiền</label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <input type="text" name="money" required="required" class="form-control text-right" oninput="SetMoney(this);">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-2 col-xs-12">Mô tả thêm</label>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                            <textarea class="form-control" rows="4" name="description"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-2 col-xs-12">&nbsp;</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <div class="checkbox">
                                <label> <input type="checkbox" name="type" value="1">Cập nhật tới báo cáo lợi nhuận</label>
                                <p class="help-block">Khi tích chọn, số tiền này sẽ được tổng hợp vào chi phí hoặc doanh thu thêm trong báo cáo lợi nhuận.
                                    Trong trường hợp tạo phiếu thu tiền khách nợ hoặc chi phí khác làm phát sinh tài khoản của khách hàng hoặc nhà cung cấp
                                    thì nên bỏ chọn để tránh sai số lợi nhuận.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="submit">Lưu lại</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Bỏ qua</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- Modal Update Item -->
<div class="modal fade" id="UpdateMoneyType">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Cập nhật thể loại</h4>
            </div>
            <div class="modal-body form-horizontal form">
                <br>
                <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="hidden" name="id">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-2 col-xs-12">Thể loại</label>
                    <div class="col-md-7 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" name="name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-2 col-xs-12">Mô tả thêm</label>
                    <div class="col-md-8 col-sm-6 col-xs-12">
                        <textarea class="form-control" name="description" rows="4"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-2 col-xs-12">Sắp xếp</label>
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <input type="number" class="form-control" name="sort">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-2 col-xs-12">Trạng thái</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <div class="checkbox">
                            <label> <input type="checkbox" name="status" value="1"> Active / Inactive this item</label>
                        </div>
                    </div>
                </div>

                <br />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="AjaxSaveType();">Lưu lại</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Bỏ qua</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="DeleteForm">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Xóa mục này</h4>
            </div>
            <div class="modal-body">Bạn chắc chắn muốn xóa mục này chứ?</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="DeleteItem();" id="DeleteItem">Đồng ý</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Hủy bỏ</button>
            </div>
        </div>
    </div>
</div>

<script>
    var id = {$out.id};
</script>
<script src="{$arg.stylesheet}js/moment/moment.min.js"></script>
<script type="text/javascript" src="{$arg.stylesheet}js/datepicker/daterangepicker.js"></script>
{literal}
    <script>
        $(document).ready(function() {
            $('#datefees').daterangepicker({singleDatePicker : true, calender_style : "picker_4", format : 'DD-MM-YYYY'});
            $('#date_from').daterangepicker({singleDatePicker : true, calender_style : "picker_4", format : 'DD-MM-YYYY'}, function() {
                $('#date_from').change();
            });
            $('#date_to').daterangepicker({singleDatePicker : true, calender_style : "picker_4", format : 'DD-MM-YYYY'}, function() {
                $('#date_to').change();
            });
        });


        function LoadObject(type){
            $.post("?mod=money&site=ajax_load_select_object", {'type' : type}).done(function(data) {
                $("#UpdateForm select[name=object_id]").html(data);
            });
        }

        var set_is_import = 0;
        function AddIdMoneyType(id){
            $("#BtnUpdateMoneyType").attr('onclick', 'UpdateMoneyType('+id+');')
        }

        function SetExportInfo(id, type) {
            if(type=='exp' || type=='srv')
                $("#orderDetail .modal-body").load("?mod=exportAjax&site=ajax_get_export_info", {"id": id});
            else
                $("#orderDetail .modal-body").load("?mod=import&site=ajax_get_import_info", {"id": id});
        }

        function UpdateMoneyType(id) {
            //$('#UpdateForm').modal('hide');
            $("#UpdateMoneyType input[type=text]").val('');
            $.post("?mod=money&site=ajax_load_money_category_item", {'id':id}).done(function(data) {
                var data = JSON.parse(data);
                if (data.id == undefined) {
                    $("#UpdateMoneyType input[name=id]").val(0);
                    $("#UpdateMoneyType input[name=sort]").val(1);
                    $("#UpdateMoneyType input[name=status]").attr("checked", "checked");
                    $("#UpdateMoneyType input[name=status]").prop('checked', true);
                } else {
                    $("#UpdateMoneyType input[name=id]").val(data.id);
                    $("#UpdateMoneyType input[name=name]").val(data.name);
                    $("#UpdateMoneyType input[name=description]").val(data.description);
                    $("#UpdateMoneyType input[name=sort]").val(data.sort);
                    if (data.status == '1') {
                        $("#UpdateMoneyType input[name=status]").attr("checked", "checked");
                        $("#UpdateMoneyType input[name=status]").prop('checked', true);
                    } else {
                        $("#UpdateMoneyType input[name=status]").removeAttr("checked");
                        $("#UpdateMoneyType input[name=status]").prop('checked', false);
                    }
                }
            });
        }

        function LoadDataForEdit(id, is_import) {
            set_is_import = is_import;
            $("#UpdateForm input[type=text]").val('');
            $("#UpdateForm input[type=checkbox]").removeAttr("checked");
            $("#UpdateForm select[name=object]").removeAttr('disabled');
            $("#UpdateForm select[name=object_id]").removeAttr('disabled');
            var msg = '';
            $.post("?mod=money&site=ajax_load_item", {'id':id, 'is_import':is_import}).done(function(data) {
                var data = JSON.parse(data);
                if (data.id == undefined) {
                    //$("#UpdateForm input[name=type]").attr("checked", "checked");
                    //$("#UpdateForm input[name=type]").prop('checked', true);
                    $("#UpdateForm input[name=id]").val(0);
                    msg = 'Lập phiếu thu';
                    if(is_import=='0')
                        msg = 'Lập phiếu chi';
                    $("#title_fees").html(msg);
                } else {
                    $("#UpdateForm input[name=id]").val(data.id);
                    $("#UpdateForm input[name=title]").val(data.title);
                    $("#UpdateForm input[name=money]").val(data.money);
                    $("#UpdateForm input[name=money]").val(data.money);
                    $("#UpdateForm textarea[name=description]").val(data.description);

                    $("#UpdateForm select[name=object]").attr('disabled','disabled');
                    $("#UpdateForm select[name=object_id]").attr('disabled','disabled');
                    if (data.type == '1') {
                        $("#UpdateForm input[name=type]").attr("checked", "checked");
                        $("#UpdateForm input[name=type]").prop('checked', true);
                    } else {
                        $("#UpdateForm input[name=type]").removeAttr("checked");
                        $("#UpdateForm input[name=type]").prop('checked', false);
                    }

                    msg = 'Chỉnh sửa phiếu thu';
                    if(is_import=='0')
                        msg = 'Chỉnh sửa phiếu chi';
                    $("#title_fees").html(msg);
                }
                $("#UpdateForm input[name=is_import]").val(is_import);
                $("#UpdateForm input[name=date]").val(data.date);
                $("#UpdateForm select[name=category_id]").html(data.category);
                $("#UpdateForm select[name=object]").html(data.object);
                $("#UpdateForm select[name=object_id]").html(data.object_id);
                AddIdMoneyType(data.category_id);
            });
        }

        function AjaxSaveType(){
            var data = {};
            data['id'] = $("#UpdateMoneyType input[name=id]").val();
            data['name'] = $("#UpdateMoneyType input[name=name]").val();
            data['description'] = $("#UpdateMoneyType textarea[name=description]").val();
            data['sort'] = $("#UpdateMoneyType input[name=sort]").val();
            data['status'] = $("#UpdateMoneyType input[name=status]").val();
            data['is_import'] = set_is_import;
            if(data['name'] == ''){
                $("#UpdateMoneyType input[name=name]").val('Vui lòng nhập thể loại');
                setTimeout(function(){
                    $("#UpdateMoneyType input[name=name]").val('');
                    $("#UpdateMoneyType input[name=name]").focus();
                }, 1000);
                return false;
            }

            $.post("?mod=money&site=ajax_save_money_type", data).done(function(rt) {
                var rt = JSON.parse(rt);
                $('#UpdateMoneyType').modal('hide');
                //$('#UpdateForm').modal('show');
                $("#UpdateForm select[name=category_id]").html(rt.select);
                AddIdMoneyType(rt.id);
                return false;
            });
        }

        function filter() {
            var filter = $("#filter").val();
            var supp = $("#supp").val();
            var date = $("#date_ex").val();
            var url = "./?mod=report&site=detail_account&id="+id;
            url += "&filter=" + filter;
            url += "&supp=" + supp;
            url += "&date=" + date;

            if (filter == "1") {
                var date_from = $("#date_from").val();
                var date_to = $("#date_to").val();
                url += "&date_from=" + date_from;
                url += "&date_to=" + date_to;
            } else if (filter == "2") {
                var year = $("#year").val();
                var month = $("#month").val();
                url += "&year=" + year;
                url += "&month=" + month;
            }

            window.location.href = url;
        }
    </script>
{/literal}
