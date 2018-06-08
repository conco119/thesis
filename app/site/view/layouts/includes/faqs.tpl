<div class="row col-df faq_slide">
    <div class="container">
        <h3 class="title"></h3>
       
        <ul class="slider_faqs text-center">
            {foreach from=$output.faqs item=list}
            <li> 
                <p>{$list.title}</p>
                <span class="author">{$list.description}</span>
            </li>
            {/foreach}
        </ul>
    </div>
</div>