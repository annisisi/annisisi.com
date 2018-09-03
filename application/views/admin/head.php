<style type="text/css">
    .menu{
        margin:0px;
        padding::0px;}
    .menu ul{
        margin:0px;
        padding:0px;
        height:30px;
        background-color:#000099;
        color:#FFFFFF;
        text-align:center;
        list-style:none;
        font-family:"宋体";}
    .menu ul li{
        position:relative;
        margin-left:0px;
        padding-top:10px;
        padding-left:0px;
        height:20px;
        width:25%;
        border:none;
        float:left}
    .menu ul li ul{
        visibility:hidden;
        width:80%;
        position:absolute;
        top:30px;
        left:10%;}
    .menu ul li ul li{
        width:100%;
        float:none;
        height:25px;
        padding-top:3px;
        padding-bottom::3px;
        position:relative;
    }
    .menu ul li ul li ul{
        visibility:hidden;
        position:absolute;
        left:100%;
        top:0px;
        width:80%;
    }
    .menu ul li:hover ul li ul{
        visibility:hidden;}
    .menu ul li ul li:hover ul{
        visibility:visible;
        background-color:#CC3399;
        color:#000000;
    }
    .menu ul li ul li:hover ul li{
        background-color:#CC3399;
        color:#000000;
    }
    .menu ul li:hover{
        background-color:#999999;}
    .menu ul li:hover ul{
        visibility:visible;}
    .menu ul li:hover ul li{
        background-color:#CCFF99;
        color:#000000;}
</style>
<?php $head_arr = config('data', 'headconfig');?>

<div class="menu">
    <ul>
        <?php foreach ($head_arr as $key => $value) { ?>
            <li><?= $key;?>
                <ul>
            <?php foreach ($value as $k => $val) { ?>
                <li><a href="<?= $val['href']?>"><?= $k ?></a></li>
            <?php } ?>
                </ul>
            </li>
        <?php } ?>
    </ul>
</div>