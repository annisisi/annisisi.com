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
                <td>id</td>
                <td>标题</td>
                <td>图片</td>
                <td>状态</td>
                <td>首页展示</td>
                <td>更新时间</td>
                <td>创建时间</td>
                <td>修改</td>
                <td>删除</td>
            </tr>


            <?php
            foreach ($data['data']['lists'] as $value)
            {
                ?>
                <tr>
                    <td><?= $value['id'];?></td>
                    <td><?= $value['title'];?></td>
                    <td><img src="<?= $value['img'];?>"></td>
                    <td><?= $value['state'];?></td>
                    <td><?= $value['index_state'];?></td>
                    <td><?= $value['updated_at'];?></td>
                    <td><?= $value['created_at'];?></td>
                    <td><a href="/edit?id=<?= $value['id'];?>">修改</a></td>
                    <td>
                        <form method="post" action="delete" name="<?= $value['id'] ?>" id="<?= $value['id'] ?>" >
                            <input type="text" name="id" value="<?= $value['id'] ?>" style="display: none" />
                            <input type="submit" onclick="return confirmd()" value="删除">
                        </form>
                    </td>
                </tr>
                <?php
            }
            ?>
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
    <?php include("page.php"); ?>
    </body>
</html>