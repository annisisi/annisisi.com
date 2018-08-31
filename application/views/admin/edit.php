<html>
    <head>
    </head>
    <body>
        <div align="center">
            <form method="post" enctype="multipart/form-data">
                <input type="text" name="title" placeholder="标题" />
                </br>
                <input type="text" name="label" placeholder="标签" />
                </br>
                <input type="file" name="img" placeholder="图片地址" />
                </br>
                <select name="state">
                    <option value="0">草稿</option>
                    <option value="1">展示</option>
                    <option value="2">隐藏</option>
                    <option value="3">删除</option>
                </select>
                <select name="index_state">
                    <option value="0">不展示</option>
                    <option value="1">展示</option>
                </select>
                </br>
                <textarea name="text" placeholder="内容" clos=",100" rows="30" warp="virtual"></textarea>
                </br>
                <button type="submit" >提交</button>
            </form>
        </div>
    </body>

</html>

