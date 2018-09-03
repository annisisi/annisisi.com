<html>
    <head>
    </head>
    <body>
     <?php include("head.php"); ?>
        <div align="center">
            <form method="post" >
                <?php if (isset($data['data']['id'])) {?>
                    <input type="text" name="title" placeholder="标题" value="<?= $data['data']['id']?>" style="display: none" />
                <?php } ?>
                <input type="text" name="title" placeholder="标题" value="<?= isset($data['data']['title']) ? $data['data']['title'] : ''?>" />
                </br>
                <input type="text" name="label" placeholder="标签" value="<?= isset($data['data']['label']) ? $data['data']['label'] : ''?>"/>
                </br>
                <input type="text" name="img" placeholder="图片地址" value="<?= isset($data['data']['img']) ? $data['data']['img'] : ''?>" />
                </br>
                <select name="state" id="state">
                    <option value="0">草稿</option>
                    <option value="1">展示</option>
                    <option value="2">隐藏</option>
                    <option value="3">删除</option>
                </select>
                <select name="index_state" id="index_state">
                    <option value="0">不展示</option>
                    <option value="1">展示</option>
                </select>
                </br>
                <textarea name="text" placeholder="内容" rows="12" cols="100" warp="virtual" value="<?= isset($data['data']['text']) ? $data['data']['text'] : ''?>" ></textarea>
                </br>
                <button type="submit" >提交</button>
            </form>
        </div>
    </body>

    <script type="text/javascript">
        window.onload=function(){
            document.getElementById('state').value="<?= isset($data['data']['state']) ? $data['data']['state'] : 1 ?>";
            document.getElementById('index_state').value="<?= isset($data['data']['index_state']) ? $data['data']['index_state'] : 1 ?>";
        };
    </script>

</html>

