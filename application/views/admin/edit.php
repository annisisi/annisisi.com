<html>
    <head>
        <style>
            table{background:#ffffee;}

            #linkurl,#linkname,#savelink{width:100px;}
            img {
                width: 50px; //控制图片的宽度
            heigth: 50px; //控制图片的高度
            }
        </style>
    </head>
    <body>
     <?php include("head.php"); ?>
        <div align="center">
            <form method="post" onSubmit="return beforeSubmit(this)">
                <?php if (isset($data['data']['id'])) {?>
                    <input type="text" name="id" placeholder="id" value="<?= $data['data']['id']?>" style="display: none" />
                <?php } ?>
                <input type="text" name="title" placeholder="标题" value="<?= isset($data['data']['title']) ? $data['data']['title'] : ''?>" />
                </br>
                <input type="text" name="label" placeholder="标签" value="<?= isset($data['data']['label']) ? $data['data']['label'] : ''?>"/>
                </br>
                <input type="text" name="img" placeholder="图片地址" value="<?= isset($data['data']['img']) ? $data['data']['img'] : ''?>" /> <button id="img_button" onclick="return addimg();" > 设置图片</button>
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
                <textarea name="text" placeholder="内容" rows="12" cols="100" warp="virtual" ><?= htmlspecialchars(isset($data['data']['text']) ? $data['data']['text'] : '') ?></textarea>
                <button id="text_button"  onclick="return addimg('text_button');" > 添加图片</button>
                </br>
                <button type="submit" >提交</button>
            </form>
        </div>

     <!-- 显示窗口的地方 -->
     <div id="here"></div>
     <div id="login" style="display:none;">
         <table border="1" align="center">
             <tr>
                 <td>图片</td>
                 <td>地址</td>
                 <td>删除</td>
             </tr>
             <tr>
                 <td><img src="http://<?= HTTP_HOST ?>/uploads/DSC_6911.jpg"></td>
                 <td>http://www.annisisi.com/uploads/DSC_6911.jpg</td>
                 <td><button name="addimglist" id="DSC_6911.jpg" onclick="return addtype(this.id);">添加</button></td>
             </tr>

             <tr>
                 <td><img src="http://<?= HTTP_HOST ?>/uploads/DSC_6931.jpg"></td>
                 <td>http://www.annisisi.com/uploads/DSC_6931.jpg</td>
                 <td><button name="addimglist" id="DSC_6931.jpg" onclick="return addtype(this.id);">添加</button></td>
             </tr>
         </table>
     </div>
    </body>

    <script type="text/javascript">
        window.onload=function(){
            document.getElementById('state').value="<?= isset($data['data']['state']) ? $data['data']['state'] : 1 ?>";
            document.getElementById('index_state').value="<?= isset($data['data']['index_state']) ? $data['data']['index_state'] : 1 ?>";
        }

        function beforeSubmit(form) {
            if (form.title.value == '') {
                alert('标题不能为空！');
                form.title.focus();
                return false;
            }
            if (form.label.value == '') {
                alert('标签不能为空！');
                form.label.focus();
                return false;
            }
            if (form.img.value == '') {
                alert('图片不能为空！');
                form.img.focus();
                return false;
            }
            if (form.text.value == '') {
                alert('内容不能为空！');
                form.text.focus();
                return false;
            }
            return true;
        }

        function addtype(txt){
            document.getElementsByName('img')[0].value = txt;
            return false;
        }

        function addtext(){
            document.getElementsByName('text')[0].value += txt;
            return false;
        }
    </script>
    <script src="js/addimg.js"></script>
</html>

