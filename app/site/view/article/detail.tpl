<style rel="stylesheet">
    .desc img{
        display: block;
        margin: 0 auto;
        max-width: 100%;
    }
</style>


<div class="news_list">
    <div class="sidebar_title bg_34495e">
        <h3>{$result.title}</h3>
    </div>

   
    <div class="col-md-12 col-sm-12 col-xs-12 col-df bg_white relative">

        <br />
        <div class="date-info">
            <ul>
                <li><i class="fa fa-clock-o"></i> {$result.time} </li>
                <li><i class="fa fa-tags"></i> {$result.cate}</li>
                <li><i class="fa fa-eye"></i> {$result.views} lượt</li>
                
            </ul>
        </div>
        <div class="name"><a href="javascript:void(0)"><b>{$result.title}</b></a></div>
        <div class="description">
            
            <div class="desc">
                {$result.content}
            </div>

           

        </div>
    </div>
    
   

    

</div>