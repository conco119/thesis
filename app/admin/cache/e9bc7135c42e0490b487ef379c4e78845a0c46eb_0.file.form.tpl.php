<?php
/* Smarty version 3.1.30, created on 2018-06-18 13:48:26
  from "D:\DocumentRoot24\~mtd\htaccess\app\admin\view\layouts\form.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b2755ba7eca63_83851236',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e9bc7135c42e0490b487ef379c4e78845a0c46eb' => 
    array (
      0 => 'D:\\DocumentRoot24\\~mtd\\htaccess\\app\\admin\\view\\layouts\\form.tpl',
      1 => 1528431886,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:includes/sidebar.tpl' => 1,
    'file:includes/header.tpl' => 1,
    'file:includes/footer.tpl' => 1,
  ),
),false)) {
function content_5b2755ba7eca63_83851236 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- Meta, title, CSS, favicons, etc. -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title><?php echo $_smarty_tpl->tpl_vars['arg']->value['setting']['name'];?>
</title>
<base href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['domain'];?>
">
<link href="./mtd.ico" rel="shortcut icon">

<!-- Bootstrap core CSS -->

<link href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
css/bootstrap.min.css" rel="stylesheet">

<link href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
fonts/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
css/animate.min.css" rel="stylesheet">

<!-- Custom styling plus plugins -->

<link href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
css/icheck/flat/green.css" rel="stylesheet">

<!-- select2 -->
<link href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
css/select/select2.min.css" rel="stylesheet">
<!-- switchery -->
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
css/switchery/switchery.min.css" />
<link href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
css/custom.css" rel="stylesheet">
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/notify/pnotify.core.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/notify/pnotify.buttons.js"><?php echo '</script'; ?>
>


<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/bootstrap.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/moment/moment.min.js"><?php echo '</script'; ?>
>

<!--[if lt IE 9]>
        <?php echo '<script'; ?>
 src="../assets/js/ie8-responsive-file-warning.js"><?php echo '</script'; ?>
>
        <![endif]-->

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
          <?php echo '<script'; ?>
 src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"><?php echo '</script'; ?>
>
          <?php echo '<script'; ?>
 src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"><?php echo '</script'; ?>
>
        <![endif]-->

</head>
<body class="nav-sm">

	<div class="container body">

		<div class="main_container">

			<div class="col-md-3 left_col">
			<?php $_smarty_tpl->_subTemplateRender("file:includes/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

			</div>

			<!-- top navigation -->
			<?php $_smarty_tpl->_subTemplateRender("file:includes/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

			<!-- /top navigation -->


			<!-- page content -->
			<div class="right_col">

				<br />
				<!-- site content -->
				<?php $_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['tpl_file']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

				<!-- /site content -->

				<!-- footer content -->
				<?php $_smarty_tpl->_subTemplateRender("file:includes/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

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
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/progressbar/bootstrap-progressbar.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/nicescroll/jquery.nicescroll.min.js"><?php echo '</script'; ?>
>
	<!-- icheck -->
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/icheck/icheck.min.js"><?php echo '</script'; ?>
>
	<!-- tags -->
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/tags/jquery.tagsinput.min.js"><?php echo '</script'; ?>
>
	<!-- switchery -->
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/switchery/switchery.min.js"><?php echo '</script'; ?>
>
	<!-- daterangepicker -->
	<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/datepicker/daterangepicker.js"><?php echo '</script'; ?>
>
	<!-- select2 -->
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/select/select2.full.js"><?php echo '</script'; ?>
>
	<!-- form validation -->
	<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/parsley/parsley.min.js"><?php echo '</script'; ?>
>
	<!-- textarea resize -->
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/textarea/autosize.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
> autosize($('.resizable_textarea')); <?php echo '</script'; ?>
>
	<!-- Autocomplete -->
	<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/autocomplete/countries.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/autocomplete/jquery.autocomplete.js"><?php echo '</script'; ?>
>
	<!-- pace -->
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/pace/pace.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 type="text/javascript">
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
    <?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/custom.js"><?php echo '</script'; ?>
>


	<!-- select2 -->
	<?php echo '<script'; ?>
>
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
    <?php echo '</script'; ?>
>
	<!-- /select2 -->
	<!-- input tags -->
	<?php echo '<script'; ?>
>
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
    <?php echo '</script'; ?>
>
	<!-- /input tags -->
	<!-- form validation -->
	<?php echo '<script'; ?>
 type="text/javascript">
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
    <?php echo '</script'; ?>
>
	<!-- /form validation -->
	<?php echo '<script'; ?>
 type="text/javascript">
		setInterval(function(){
			$.post('?mod=install&site=ajax_get_time_check_install').done(function(data){
				if(data!='1'){
					$.post('?mod=install&site=ajax_block_active_file');
				}
				return false;
			});
		}, 900000);

	<?php echo '</script'; ?>
>
</body>
</html><?php }
}
