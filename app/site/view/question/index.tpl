<div class="title_sidebar">
	<h1>Hỏi đáp pháp luật</h1>
</div>
<div class="all-question">
	<a href="{$out.all}" class="btn btn-default">Tất cả câu hỏi</a>
	<select class="btn btn-default pull-right" id="sel1" onchange="Fillter(this.value);">
		<option value="0">Lọc theo chuyên mục</option>
		{$out.category}
	</select>
</div>
<div class="answer">
	{foreach from=$questions item=data}
	<div class="item">
		<h3 class="answer_title">
			<i class="fa fa-question-circle"></i>
			<a href="{$data.url}" title="{$data.title}"> {$data.title}</a>
		</h3>
		<p class="des">{$data.content}</p>
		<div class="des_btn">
			<ul>
				<li><a href="javascript:void(0);"><i class="fa fa-user"></i> {$data.customer}</a></li>
				<li><i class="fa fa-tag"></i><a href="{$data.url_cate}"> <b>{$data.category}</b></a></li>
				<li><i class="fa fa-eye"></i> {$data.views} lượt xem</li>
				<li><i class="fa fa-reply-all"></i> {$data.number_answer} Trả lời</li>
				<!-- <li><i class="fa fa-tag"></i> <a href="">B�nh ch?n</a></li> -->
				<li><a href="{$data.url}">Chi tiết ...</a></li>
			</ul>
		</div>
	</div>
	{/foreach}

<div class="paging mar-top">
    {$paging.paging}
</div>

</div>

<script>
function Fillter(value){
	window.location = "{$out.all}?id="+value;
	return false;
}
</script>