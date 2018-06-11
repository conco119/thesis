<div class="">
    <div class="top_tiles">
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon">
                    <i class="fa fa-file blue"></i>
                </div>
                <div class="count">{$statis_1.exports}</div>
                <h3>Hóa đơn bán</h3>
                <p>Tổng số hóa đơn bán hàng trong tháng.</p>
            </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon">
                    <i class="fa fa-users green"></i>
                </div>
                <div class="count">{$statis_1.customers}</div>
                <h3>Khách hàng</h3>
                <p>Tổng số khách hàng được quản lý.</p>
            </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon">
                    <i class="fa fa-user-md green"></i>
                </div>
                <div class="count">{$statis_1.suppliers}</div>
                <h3>Nhà cung cấp</h3>
                <p>Tổng số nhà cung cấp.</p>
            </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon">
                    <i class="fa fa-warning red"></i>
                </div>
                <div class="count">{$statis_1.products}</div>
                <h3>Sản phẩm đã hết và sắp hết</h3>
                <p>Số sản phẩm cảnh báo hết cần nhập thêm.</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                {* <div class="x_title">
                    <h2>Biểu đồ theo dõi bán hàng <small>Trong 20 ngày gần nhất</small></h2>
                    <div class="clearfix"></div>
                </div> *}
                <div class="x_content">
                    <div class="col-md-9 col-sm-12 col-xs-12" style='display:none'>
                        <div class="demo-container" style="height: 360px">
                            <div id="placeholder33x" class="demo-placeholder"></div>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div>
                            <div class="x_title">
                                <h2>Hóa đơn bán hàng mới</h2>
                                <div class="clearfix"></div>
                            </div>
                            <ul class="list-unstyled top_profiles scroll-view">
                            	{foreach from=$statis_2 item=data}
                                <li class="media event">
                                	<a class="pull-left border-aero profile_thumb"> <i class="fa fa-user aero"></i></a>
                                    <div class="media-body">
                                        <a class="title">{$data.code}</a>
                                        <p ><strong style='color:red'>{$data.must_pay|number_format}đ </strong> <small>{$data.created_at|date_format:"%d-%m-%Y"}</small></p>
                                        <p><small>{$data.customer_name}</small></p>
                                    </div>
                                </li>
                                {/foreach}
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div>
                            <div class="x_title">
                                <h2>Hóa đơn nhập hàng mới</h2>
                                <div class="clearfix"></div>
                            </div>
                            <ul class="list-unstyled top_profiles scroll-view">
                            	{foreach from=$statis_3 item=data}
                                <li class="media event">
                                	<a class="pull-left border-aero profile_thumb"> <i class="fa fa-user aero"></i></a>
                                    <div class="media-body">
                                        <a class="title">{$data.code}</a>
                                        <p><strong  style='color:red'>{$data.must_pay|number_format}đ </strong> <small>{$data.created_at|date_format:"%d-%m-%Y"}</small></p>
                                        <p><small>{$data.supplier_name}</small></p>
                                    </div>
                                </li>
                                {/foreach}
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- flot js -->
<!--[if lte IE 8]><script type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
<script type="text/javascript" src="{$arg.stylesheet}js/flot/jquery.flot.js"></script>
<script type="text/javascript" src="{$arg.stylesheet}js/flot/jquery.flot.pie.js"></script>
<script type="text/javascript" src="{$arg.stylesheet}js/flot/jquery.flot.orderBars.js"></script>
<script type="text/javascript" src="{$arg.stylesheet}js/flot/jquery.flot.time.min.js"></script>
<script type="text/javascript" src="{$arg.stylesheet}js/flot/date.js"></script>
<script type="text/javascript" src="{$arg.stylesheet}js/flot/jquery.flot.spline.js"></script>
<script type="text/javascript" src="{$arg.stylesheet}js/flot/jquery.flot.stack.js"></script>
<script type="text/javascript" src="{$arg.stylesheet}js/flot/curvedLines.js"></script>
<script type="text/javascript" src="{$arg.stylesheet}js/flot/jquery.flot.resize.js"></script>
<!-- pace -->
<script src="{$arg.stylesheet}js/pace/pace.min.js"></script>
<!-- flot -->
<script type="text/javascript">
	//define chart clolors ( you maybe add more colors if you want or flot will add it automatic )
	var chartColours = [ '#96CA59', '#3F97EB', '#72c380', '#6f7a8a', '#f7cb38', '#5a8022', '#2c7282' ];

	//generate random number for charts
	randNum = function() {
		return (Math.floor(Math.random() * (1 + 40 - 20))) + 20;
	}

	$(function() {
		/* var d1 = [];
		for (var i = 0; i < 30; i++) {
			d1.push([ new Date(Date.today().add(i).days()).getTime(), randNum() + i + i + 10 ]);
		}
		var chartMinDate = d1[0][0]; //first day
		var chartMaxDate = d1[20][0]; //last day
		console.log(d1); */

		var chartMinDate = '{$statis2.minday}';
		var chartMaxDate = '{$statis2.maxday}';
		var d1 = [];
		{foreach from=$statis2.data key=k item=data}
		d1.push([{$k}, {$data}]);
		{/foreach}

		var tickSize = [ 1, "day" ];
		var tformat = "%d/%m/%y";

		//graph options
		var options = {
			grid : {
				show : true,
				aboveData : true,
				color : "#3f3f3f",
				labelMargin : 10,
				axisMargin : 0,
				borderWidth : 0,
				borderColor : null,
				minBorderMargin : 5,
				clickable : true,
				hoverable : true,
				autoHighlight : true,
				mouseActiveRadius : 100
			},
			series : {
				lines : {
					show : true,
					fill : true,
					lineWidth : 2,
					steps : false
				},
				points : {
					show : true,
					radius : 4.5,
					symbol : "circle",
					lineWidth : 3.0
				}
			},
			legend : {
				position : "ne",
				margin : [ 0, -25 ],
				noColumns : 0,
				labelBoxBorderColor : null,
				labelFormatter : function(label, series) {
					// just add some space to labes
					return label + '&nbsp;&nbsp;';
				},
				width : 40,
				height : 1
			},
			colors : chartColours,
			shadowSize : 0,
			tooltip : true, //activate tooltip
			tooltipOpts : {
				content : "%s: %y.0",
				xDateFormat : "%d/%m",
				shifts : {
					x : -30,
					y : -50
				},
				defaultTheme : false
			},
			yaxis : {
				min : 0
			},
			xaxis : {
				mode : "time",
				minTickSize : tickSize,
				timeformat : tformat,
				min : chartMinDate,
				max : chartMaxDate
			}
		};
		var plot = $.plot($("#placeholder33x"), [ {
			label : " Doanh thu",
			data : d1,
			lines : {
				fillColor : "rgba(150, 202, 89, 0.12)"
			}, //#96CA59 rgba(150, 202, 89, 0.42)
			points : {
				fillColor : "#fff"
			}
		} ], options);
	});
</script>
<!-- /flot -->
