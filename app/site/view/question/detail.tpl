<div class="title_sidebar">
	<h2>Hỏi đáp pháp luật</h2>
</div>
<div class="answer">
	<div class="item">
		<h1 class="answer_title">{$value.title}</h1>
		<div class="des_btn">
			<ul>
				<li><a href="javascript:void(0);"><i class="fa fa-user"></i> {$value.customer}</a></li>
				<li><i class="fa fa-tag"></i><a href="{$value.url_cate}"> <b>{$value.category}</b></a></li>
				<li><i class="fa fa-eye"></i> <span class="num">{$value.views} lượt xem</span></li>
				<li><i class="fa fa-reply-all"></i> <span id="numberAnswer">{$value.number_answer}</span> Trả lời</li>
				<!-- <li><i class="fa fa-tag"></i> 4 Bình chọn</li> -->
				<li></li>
			</ul>
		</div>
		<p class="des">{$value.content}</p>
		
		{if $value.answer neq NULL}
		<h3 class="title_sub">Trả lời cho câu hỏi</h3>
		<p class="des">{$value.answer}</p>
		{/if}
		
		<h3 class="title_sub">Các câu trả lời khác</h3>
		<div id="answers">
			{foreach from=$answers item=list}
			<div class="items">
				<div class="row col-df">
					<div class="col-md-2 ">
						<i class="avatar"></i>
					</div>
					<div class="col-md-10 ">
						<p class="name"><a href="javascript:void(0);">{$list.customer}</a> <i>{$list.created}</i></p>
						<p class="content">{$list.content}</p>
					</div>
				</div>
			</div>
			{/foreach}
		</div>
		
		<div class="answer-form">
			<form class="form">
				<div class="form-group">
					<textarea class="form-control" rows="5" id="AnswerContent" required="required"></textarea>
				</div>
				<button type="button" onclick="AddAnswer({$value.id});" class="btn btn-default pull-right">Gửi câu trả lời</button>
				<div class="clear"></div>
			</form>
		</div>
	</div>

</div>

<script>
function AddAnswer(id){
	var content = $("#AnswerContent").val();
	if(content.length < 10){
		alert("Vui lòng nhập câu trả lời nhiều hơn 20 ký tự !");
		$("#AnswerContent").focus();
		return false;
	}
	$.post('?mod=question&site=ajax_add_answer',{
		'id': id, 'content':content
	}).done(function(data){
		$("#answers").prepend(data);
		$("#AnswerContent").val('');
		var numberAnswer = parseInt($("#numberAnswer").html());
		$("#numberAnswer").html(numberAnswer+1);
		return false;
	});

}
</script>
