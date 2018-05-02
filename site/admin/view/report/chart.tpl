<div class="widget widget-table action-table">
	<div class="widget-header">
		<i class="icon-th-list"></i>
		<h3>Biểu đồ tăng trưởng kinh doanh</h3>
	</div>
	<!-- /widget-header -->
	<div class="widget-content">
		
		<div class="padding">
			<select class="span2" id="year" onchange="filter();">
				{$out.year}
			</select>
		</div>

		<div class="padding"><canvas id="bar-chart" class="chart-holder" width="838" height="460"></canvas></div>
	</div>
	<!-- /widget-content -->
</div>
<!-- /widget -->



<script>
var chart1_label = [{$chart1.label}];
var chart1_import = [{$chart1.imported}];
var chart1_export = [{$chart1.exported}];

function filter(){
	var url = "./?mod=report&site=chart";
	var year = $("#year").val();
	url += "&year=" + year;
	window.location.href = url;
}

var barChartData = {
        labels: chart1_label,
        datasets: [
			{
			    fillColor: "rgba(220,220,220,0.5)",
			    strokeColor: "rgba(220,220,220,1)",
			    data: chart1_import
			},
			{
			    fillColor: "rgba(151,187,205,0.5)",
			    strokeColor: "rgba(151,187,205,1)",
			    data: chart1_export
			}
		]

    }

var myLine = new Chart(document.getElementById("bar-chart").getContext("2d")).Bar(barChartData);

</script>