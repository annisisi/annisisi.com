<style>
    .pagination{ text-align: center;font-size: 12px;padding: 10px 0;}
    .pagination a,.pagination span{display: inline-block;padding: 0 10px;height: 28px;line-height: 28px;border: 1px solid #ddd;border-radius: 4px;text-decoration: none;color: #999;cursor: pointer;  margin-right:5px;}
    .pagination a:hover:not(.disabled):not(.current),.pagination span:hover:not(.disabled):not(.current){color:#f04848}
    .pagination a.disabled,.pagination span.disabled{color: #bfbfbf;background: #f5f5f5;cursor: no-drop;border: 1px solid #ddd;}
    .pagination a.current,.pagination span.current{color: #fff;background: #f04848;border: 1px solid #f04848;}

</style>
<div class="pagination">
    <?php
    $page_count = 7;
    if ($data['data']['other']['count_page'] <= 7) {
        $page_count = $data['data']['other']['count_page'];
        $star = 1;
    } else {
        if ($data['data']['other']['page'] < 4) {
            $star = 1;
        } elseif ($data['data']['other']['page'] > ($data['data']['other']['count_page']-3)) {
            $star = $data['data']['other']['count_page'] - 7;
        } else {
            $star = $data['data']['other']['page'] - 7;
        }
    }

    ?>


    <span <?php if($data['data']['other']['page'] == 1) { ?> class="disabled" <?php } else { ?> href="/?page=1" <?php } ?> title="首页">首页</span>
    <span <?php if($data['data']['other']['page'] == 1) { ?> class="disabled" <?php } else { ?> href="/?page=1" <?php } ?> title="上一页" >上一页</span>
    <?php
        for ($i = 1; $i <= $page_count; $i++)
        {
            if ($data['data']['other']['page'] == $i) {
                ?> <span class="current"><?= $star; ?></span> <?php
            } else {
                ?> <span href="/?page=<?= $star; ?>"><?= $star; ?></span> <?php
            }
        }
    ?>




    <span <?php if($data['data']['other']['count_page'] == $data['data']['other']['page']) { ?> class="disabled" <?php } else { ?> href="/?page=<?= $data['data']['other']['count_page'];?>" <?php } ?> title="下一页" >下一页</span>
    <span <?php if($data['data']['other']['count_page'] == $data['data']['other']['page']) { ?> class="disabled" <?php } else { ?> href="/?page=<?= $data['data']['other']['count_page'];?>" <?php } ?> title="尾页" >尾页</span>
</div>

