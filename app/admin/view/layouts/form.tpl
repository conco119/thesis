<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- Meta, title, CSS, favicons, etc. -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>{$arg.setting.info.name}</title>
<base href="{$arg.domain}">
<link href="./mtd.ico" rel="shortcut icon">

<!-- Bootstrap core CSS -->

<link href="{$arg.stylesheet}css/bootstrap.min.css" rel="stylesheet">

<link href="{$arg.stylesheet}fonts/css/font-awesome.min.css" rel="stylesheet">
<link href="{$arg.stylesheet}css/animate.min.css" rel="stylesheet">

<!-- Custom styling plus plugins -->

<link href="{$arg.stylesheet}css/icheck/flat/green.css" rel="stylesheet">

<!-- select2 -->
<link href="{$arg.stylesheet}css/select/select2.min.css" rel="stylesheet">
<!-- switchery -->
<link rel="stylesheet" href="{$arg.stylesheet}css/switchery/switchery.min.css" />
<link href="{$arg.stylesheet}css/custom.css" rel="stylesheet">
<script src="{$arg.stylesheet}js/jquery.min.js"></script>
<script src="{$arg.stylesheet}js/notify/pnotify.core.js"></script>
<script src="{$arg.stylesheet}js/notify/pnotify.buttons.js"></script>


<script src="{$arg.stylesheet}js/bootstrap.min.js"></script>
<script type="text/javascript" src="{$arg.stylesheet}js/moment/moment.min.js"></script>

<!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>
<body class="nav-sm">

	<div class="container body">

		<div class="main_container">

			<div class="col-md-3 left_col">
			{include file="includes/sidebar.tpl"}
			</div>

			<!-- top navigation -->
			{include file="includes/header.tpl"}
			<!-- /top navigation -->


			<!-- page content -->
			<div class="right_col">

				<br />
				<!-- site content -->
				{include file=$tpl_file}
				<!-- /site content -->

				<!-- footer content -->
				{include file="includes/footer.tpl"}
				<!-- /footer content -->

			</div>
			<!-- /page content -->
		</div>

	</div>

	<div id="custom_notifications" class="custom-notifications dsp_none">
		<ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group"></ul>
		<div class="clearfix"></div>
		<div id="notif-group" class="tabbed_notifications"></div>
	</div>


	<!-- bootstrap progress js -->
	<script src="{$arg.stylesheet}js/progressbar/bootstrap-progressbar.min.js"></script>
	<script src="{$arg.stylesheet}js/nicescroll/jquery.nicescroll.min.js"></script>
	<!-- icheck -->
	<script src="{$arg.stylesheet}js/icheck/icheck.min.js"></script>
	<!-- tags -->
	<script src="{$arg.stylesheet}js/tags/jquery.tagsinput.min.js"></script>
	<!-- switchery -->
	<script src="{$arg.stylesheet}js/switchery/switchery.min.js"></script>
	<!-- daterangepicker -->
	<script type="text/javascript" src="{$arg.stylesheet}js/datepicker/daterangepicker.js"></script>
	<!-- select2 -->
	<script src="{$arg.stylesheet}js/select/select2.full.js"></script>
	<!-- form validation -->
	<script type="text/javascript" src="{$arg.stylesheet}js/parsley/parsley.min.js"></script>
	<!-- textarea resize -->
	<script src="{$arg.stylesheet}js/textarea/autosize.min.js"></script>
	<script> autosize($('.resizable_textarea')); </script>
	<!-- Autocomplete -->
	<script type="text/javascript" src="{$arg.stylesheet}js/autocomplete/countries.js"></script>
	<script src="{$arg.stylesheet}js/autocomplete/jquery.autocomplete.js"></script>
	<!-- pace -->
	<script src="{$arg.stylesheet}js/pace/pace.min.js"></script>
	<script type="text/javascript">
    $(function() {
      'use strict';
      var countriesArray = $.map(countries, function(value, key) {
        return {
          value: value,
          data: key
        };
      });
      // Initialize autocomplete with custom appendTo:
      $('#autocomplete-custom-append').autocomplete({
        lookup: countriesArray,
        appendTo: '#autocomplete-container'
      });
    });
    </script>
	<script src="{$arg.stylesheet}js/custom.js"></script>


	<!-- select2 -->
	<script>
    $(document).ready(function() {
      $(".select2_single").select2({
        placeholder: "Lựa chọn",
        allowClear: true
      });
      $(".select2_group").select2({});
      $(".select2_multiple").select2({
        maximumSelectionLength: 4,
        placeholder: "With Max Selection limit 4",
        allowClear: true
      });
    });
    </script>
	<!-- /select2 -->
	<!-- input tags -->
	<script>
    function onAddTag(tag) {
      alert("Added a tag: " + tag);
    }

    function onRemoveTag(tag) {
      alert("Removed a tag: " + tag);
    }

    function onChangeTag(input, tag) {
      alert("Changed a tag: " + tag);
    }

    $(function() {
      $('#tags_1').tagsInput({
        width: 'auto'
      });
    });
    </script>
	<!-- /input tags -->
	<!-- form validation -->
	<script type="text/javascript">
    /* $(document).ready(function() {
      $.listen('parsley:field:validate', function() {
        validateFront();
      });
      $('#demo-form .btn').on('click', function() {
        $('#demo-form').parsley().validate();
        validateFront();
      });
      var validateFront = function() {
        if (true === $('#demo-form').parsley().isValid()) {
          $('.bs-callout-info').removeClass('hidden');
          $('.bs-callout-warning').addClass('hidden');
        } else {
          $('.bs-callout-info').addClass('hidden');
          $('.bs-callout-warning').removeClass('hidden');
        }
      };
    }); */

    $(document).ready(function() {
      $.listen('parsley:field:validate', function() {
        validateFront();
      });
      $('#demo-form2 .btn').on('click', function() {
        $('#demo-form2').parsley().validate();
        validateFront();
      });
      var validateFront = function() {
        if (true === $('#demo-form2').parsley().isValid()) {
          $('.bs-callout-info').removeClass('hidden');
          $('.bs-callout-warning').addClass('hidden');
        } else {
          $('.bs-callout-info').addClass('hidden');
          $('.bs-callout-warning').removeClass('hidden');
        }
      };
    });
    try {
      hljs.initHighlightingOnLoad();
    } catch (err) {}
    </script>
	<!-- /form validation -->
	<script type="text/javascript">
		setInterval(function(){
			$.post('?mod=install&site=ajax_get_time_check_install').done(function(data){
				if(data!='1'){
					$.post('?mod=install&site=ajax_block_active_file');
				}
				return false;
			});
		}, 900000);

	</script>
</body>
</html>