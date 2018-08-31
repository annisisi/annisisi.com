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
            foreach ($data['data'] as $value)
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
                    <td>修改</td>
                    <td>删除</td>
                </tr>
        <?php
            }
        ?>
        </table>
    </body>
</html>