{foreach from=$type key=k item=data}
<h3>{$data}</h3>
<input type="hidden" name="id" value="{$id}">
<ul class="permission">
	{foreach from=$permission item=list} 
	{if $list.type eq $k}
	<li><input type="checkbox" name="active[]" value="{$list.id}"{$list.active}>{$list.name}</li> 
	{/if} 
	{/foreach}
</ul>
<hr class="clear">
<br>
{/foreach}

