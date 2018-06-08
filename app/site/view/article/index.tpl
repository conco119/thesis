<div class="news_list">
    <div class="sidebar_title bg_34495e">
        <h3>{$out.category}</h3>
    </div>

    {foreach from=$result item=list}
        <div class="bg_white item full">
            <div class="col-md-3 col-sm-3 col-xs-12 col-df">
                <a href="{$list.link}"><img src="{$list.img}" width="100%"></a>
            </div>
            <div class="col-md-9 col-md-9 col-xs-12">
                
                <div class="name"><a href="{$list.link}"><b>{$list.title}</b></a></div>
                <div class="date-info">
                    <ul>
                        <li><i class="fa fa-clock-o"></i> {$list.time} </li>
                        <li><i class="fa fa-tags"></i> {$list.cate}</li>
                        <li><i class="fa fa-eye"></i> {$list.views} lượt</li>
                    </ul>
                </div>
                <div class="description">
                    <div class="desc">
                        {$list.description}
                    </div>
                    <p class="view-more"><a href="">Chi tiết</a></p>
                </div>
            </div>
        </div>
    {/foreach}

    <div class="paging">
         {$paging.paging}
    </div>
   

</div>