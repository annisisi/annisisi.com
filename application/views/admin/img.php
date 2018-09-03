<html>
<head>
    <style type="text/css">
        img {
            width: 50px; //控制图片的宽度
        heigth: 50px; //控制图片的高度
        }
    </style>
</head>
<body>
<?php include("head.php"); ?>
<div>
    <table border="1" align="center">
        <tr>
            <td>图片</td>
            <td>地址</td>
            <td>删除</td>
        </tr

        <?php foreach ($data['data'] as $value) { ?>
            <tr>
                <td><img src="http://<?= HTTP_HOST ?>/uploads/<?= $value ?>"></td>
                <td>http://www.annisisi.com/uploads/<?= $value ?></td>
                <td>
                    <form method="post" action="img/delete" name="<?= $value ?>" id="<?= $value ?>" >
                        <input type="text" name="name" value="<?= $value ?>" style="display: none" />
                        <input type="submit" onclick="return confirmd()" value="删除">
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>
<script type="text/javascript">
    function confirmd() {
        var msg = "确定删除该条数据？";
        if (confirm(msg)==true){
            return true;
        }else{
            return false;
        }
    }
</script>
</body>
</html>