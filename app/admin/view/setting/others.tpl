<div class="">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Thiết lập thông tin sử dụng</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Settings 1</a></li>
                                <li><a href="#">Settings 2</a></li>
                            </ul>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form method="post" data-parsley-validate class="form-horizontal form-label-left">
                        <br>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                            	<h3>Thiết lập sử dụng</h3>
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Doanh số tháng</label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <input type="text" required="required" class="form-control" name="export_plan" oninput="setPrice(this);" value="{$out.export_plan}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Phương thức</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="radio">
                                    <label><input type="radio" value="1" name="method" {if $out.method eq '1'}checked{/if}> Nhập sản phẩm bằng tay</label>
                                </div>
                                <div class="radio">
                                    <label><input type="radio" value="2" name="method" {if $out.method eq '1'}checked{/if}> Quét mã vạch sản phẩm</label>
                                </div>
                            </div>
                        </div> -->
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Thương hiệu</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="checkbox">
                                    <label><input type="checkbox" value="1" name="use_trademark" {if $out.use_trademark eq '1'}checked{/if}> Sử dụng thương hiệu cho sản phẩm</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Bảo hành</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="checkbox">
                                    <label><input type="checkbox" value="1" name="use_warranty" {if $out.use_warranty eq '1'}checked{/if}> Sử dụng bảo hành cho sản phẩm</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Xuất xứ</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="checkbox">
                                    <label><input type="checkbox" value="1" name="use_origin" {if $out.use_origin eq '1'}checked{/if}> Sử dụng xuất xứ cho sản phẩm</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Dịch vụ</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="checkbox">
                                    <label><input type="checkbox" value="1" name="use_service" {if $out.use_service eq '1'}checked{/if}> Sử dụng dịch vụ</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Hạn sử dụng</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="checkbox">
                                    <label><input type="checkbox" value="1" name="use_expiry" {if $out.use_expiry eq '1'}checked{/if}> Sử dụng hạn sử dụng sản phẩm</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Sử dụng logo</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="checkbox">
                                    <label><input type="checkbox" value="1" name="use_logo" {if $out.use_logo eq '1'}checked{/if}> Hiển thị logo</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Sử dụng bán buôn</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="checkbox">
                                    <label><input type="checkbox" value="1" name="use_sale" {if $out.use_sale eq '1'}checked{/if}>Có sử dụng bán buôn</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                            	<h3>Thiết lập nhập / bán hàng</h3>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="checkbox">
                                    <label><input type="checkbox" value="1" name="export_alway" {if $out.export_alway eq '1'}checked{/if}> Cho phép xuất âm sản phẩm khi hết hàng</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="checkbox">
                                    <label><input type="checkbox" value="1" name="use_description" {if $out.use_description eq '1'}checked{/if}> Sử dụng mô tả cho từng sản phẩm của hóa đơn bán hàng</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="checkbox">
                                    <label><input type="checkbox" value="1" {if $out.use_description_import eq '1'}checked{/if} name="use_description_import"> Sử dụng mô tả cho từng sản phẩm của hóa đơn nhập hàng</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="checkbox">
                                    <label><input type="checkbox" value="1" {if $out.percent eq '1'}checked{/if} name="percent"> Sử dụng chiết khấu cho từng sản phẩm</label>
                                </div>
                            </div>
                        </div>


                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <label class="control-label col-md-5 col-sm-3 col-xs-12"></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                            	<h3>Thiết lập khổ in cho máy in</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <table class="table table-striped table-bordered">
                                    <tr>
                                        <th>
                                            Hóa đơn bán hàng
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="radio">
                                             <label><input type="radio"  onchange="Export_print(this.value,1);" name="print" {if $out.print eq '1'}checked{/if} value="1"> Khổ in A4</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="radio">
                                                <label><input type="radio"  onchange="Export_print(this.value,1);" name="print" {if $out.print eq '2'}checked{/if} value="2"> Khổ in A5</label>
                                            </div>
                                        </td>
                                    </tr>
                                   <tr>
                                       <td>
                                           <div class="radio">
                                               <label><input type="radio"  onchange="Export_print(this.value,1);" name="print" {if $out.print eq '3'}checked{/if} value="3"> Khổ in XP-58</label>
                                           </div>
                                       </td>
                                   </tr>
                                    <tr>
                                        <td>
                                            <div class="radio">
                                                <label><input type="radio"  onchange="Export_print(this.value,1);" name="print" {if $out.print eq '4'}checked{/if} value="4"> Khổ in XP-80</label>
                                            </div>
                                        </td>
                                    </tr>

                                </table>



                            </div>

                            <div class="col-md-9">
                                <table class="table table-striped table-bordered">
                                    <tr>
                                        <th class="text-center">
                                           Ảnh hóa đơn bán hàng
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img width="100%" {if $out.print eq '1'}style="display: block" {else} style="display: none"{/if} id="export1" src="http://localhost/app/qlbh/site/upload/../upload/logo/export_a4.png">
                                            <img width="100%" {if $out.print eq '3'}style="display: block" {else} style="display: none"{/if} id="export3" src="http://localhost/app/qlbh/site/upload/../upload/logo/export_58.png">
                                            <img width="100%" {if $out.print eq '4'}style="display: block" {else} style="display: none"{/if} id="export4" src="http://localhost/app/qlbh/site/upload/../upload/logo/export_80.png">
                                            <img width="100%" {if $out.print eq '2'}style="display: block" {else} style="display: none"{/if} id="export2" src="http://localhost/app/qlbh/site/upload/../upload/logo/export_a5.png">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3">
                                <table class="table table-striped table-bordered">
                                    <tr>
                                        <th>
                                            Hóa đơn nhập hàng
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="radio">
                                                <label><input type="radio"  onchange="Export_print(this.value,2);"  name="imprint" {if $out.imprint eq '1'}checked{/if} value="1"> Khổ in A4</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="radio">
                                                <label><input type="radio" onchange="Export_print(this.value,2);" name="imprint" {if $out.imprint eq '2'}checked{/if} value="2"> Khổ in A5</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="radio">
                                                <label><input type="radio" onchange="Export_print(this.value,2);" name="imprint" {if $out.imprint eq '3'}checked{/if} value="3"> Khổ in XP-58</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="radio">
                                                <label><input type="radio" onchange="Export_print(this.value,2); "name="imprint" {if $out.imprint eq '4'}checked{/if} value="4"> Khổ in XP-80</label>
                                            </div>
                                        </td>
                                    </tr>
                                </table>

                            </div>
                            <div class="col-md-9">
                                    <table class="table table-striped table-bordered">
                                        <tr>
                                            <th class="text-center">
                                                Ảnh hóa đơn nhập hàng
                                            </th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img width="100%" {if $out.imprint eq '1'}style="display: block" {else} style="display: none"{/if} id="import1" src="http://localhost/app/qlbh/site/upload/../upload/logo/export_a4.png">
                                                <img width="100%" {if $out.imprint eq '3'}style="display: block" {else} style="display: none"{/if} id="import3" src="http://localhost/app/qlbh/site/upload/../upload/logo/export_58.png">
                                                <img width="100%" {if $out.imprint eq '4'}style="display: block" {else} style="display: none"{/if} id="import4" src="http://localhost/app/qlbh/site/upload/../upload/logo/export_80.png">
                                                <img width="100%" {if $out.imprint eq '2'}style="display: block" {else} style="display: none"{/if} id="import2" src="http://localhost/app/qlbh/site/upload/../upload/logo/export_a5.png">
                                            </td>
                                        </tr>
                                    </table>
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button type="submit" class="btn btn-success" name="submit">Lưu lại</button>
                                <button type="reset" class="btn btn-default">Hủy bỏ</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
{literal}
    function Export_print(value, check){
        var list= [1,2,3,4];
        for(var i = 0; i < list.length; i++) {
            if (list[i] == value  ) {
                if(check==1) {
                    $("#export" + value).show();
                }
                else {
                            $("#import" + value).show();
                }
            }
            else
            {
                if(check==1) {
                    $("#export" + list[i]).hide();
                }
                else {
                    $("#import" + list[i]).hide();
                }
            }
        }
    }
</script>
{/literal}
