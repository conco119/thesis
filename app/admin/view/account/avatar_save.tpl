
<script src="{$dir_style}js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="{$dir_style}js/jquery-pack.js"></script>
<script type="text/javascript" src="{$dir_style}js/jquery.imgareaselect.min.js"></script>
{literal}
<script type="text/javascript">


function preview(img, selection) { 
	var scaleX = 120 / selection.width; 
	var scaleY = 120 / selection.height; 

	var img_w = $('#thumbnail').width();
	var img_h = $('#thumbnail').height();
	
	$('div#get_thumb > img').css({ 
		width: Math.round(scaleX * img_w) + 'px', 
		height: Math.round(scaleY * img_h) + 'px',
		marginLeft: '-' + Math.round(scaleX * selection.x1) + 'px', 
		marginTop: '-' + Math.round(scaleY * selection.y1) + 'px' 
	});
	$('#x1').val(selection.x1);
	$('#y1').val(selection.y1);
	$('#x2').val(selection.x2);
	$('#y2').val(selection.y2);
	$('#w').val(selection.width);
	$('#h').val(selection.height);
} 

$(document).ready(function () { 
	$('#save_thumb').click(function() {
		var x1 = $('#x1').val();
		var y1 = $('#y1').val();
		var x2 = $('#x2').val();
		var y2 = $('#y2').val();
		var w = $('#w').val();
		var h = $('#h').val();
		if(x1=="" || y1=="" || x2=="" || y2=="" || w=="" || h==""){
			alert("You must make a selection first");
			return false;
		}else{
			return true;
		}
	});
}); 

$(window).load(function () { 
	$('#thumbnail').imgAreaSelect({ aspectRatio: '1:1', onSelectChange: preview }); 
});

</script>
{/literal}

<div class="use">
	<h2 class="bor-btm">Tạo ảnh logo</h2>
	<div>
		<div class="wap-x70 bg gray pad bor" align="center">
			<img src="{$avatar}" id="thumbnail" alt="Create Thumbnail" />
		</div>
		<div id="get_thumb" class="mar-lft" style="border:1px #e5e5e5 solid; float:left; position:relative; overflow:hidden; width:120px; height:120px;">
			<img src="{$avatar}" style="position: relative;" alt="Thumbnail Preview" />
		</div>
		<br style="clear:both;"/>
		<form name="thumbnail" action="" method="post" class="mar-2top">
			<input type="hidden" name="x1" value="" id="x1" />
			<input type="hidden" name="y1" value="" id="y1" />
			<input type="hidden" name="x2" value="" id="x2" />
			<input type="hidden" name="y2" value="" id="y2" />
			<input type="hidden" name="w" value="" id="w" />
			<input type="hidden" name="h" value="" id="h" />
			<input type="submit" name="upload_thumbnail" value="Save Thumbnail" id="save_thumb" />
		</form>
	</div>
</div>

