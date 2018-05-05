<div class="widget widget-table action-table">
	<div class="widget-header">
		<i class="icon-th-list"></i>
		<h3>Thống kê kết quả kế hoạch kinh doanh từng năm</h3>
	</div>
	<!-- /widget-header -->
	<div class="widget-content">
		
		<div class="padding">
			<select class="span2" id="year" onchange="filter();">
				{$out.year}
			</select>
		</div>

		{foreach from=$plans item=data}
		<div class="padding">
			<h2>Kế hoạch kinh doanh tháng {$data.month}/{$data.year}</h2>
			<p><i class="btn-icon-only icon-hand-right"></i> Kế hoạch: <b>{$data.money|number_format} đ</b></p>
			<p><i class="btn-icon-only icon-bar-chart"></i> Đạt được: <b>{$data.plan_money|number_format} đ</b></p>
			<div class="progress progress-success">
				<div class="bar" style="width: {if $data.performance > 100}100%{else}{$data.performance}%{/if}">{$data.performance}%</div>
			</div>
		</div>
		{/foreach}

	</div>
	<!-- /widget-content -->
</div>
<!-- /widget -->



<script>
function filter(){
	var url = "./?mod=report&site=plans";
	var year = $("#year").val();
	url += "&year=" + year;
	window.location.href = url;
}
</script>