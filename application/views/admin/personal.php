<html>
<head>
    <style>
        table{background:#ffffee;}

        #linkurl,#linkname,#savelink{width:100px;}
        #login table{width:100%;}#login table td{width:50%;text-align:center;}#login table td img{width: 50px; heigth: 50px;}
    </style>
</head>
<body>
<?php include("head.php"); ?>
<div align="center">
    <form method="post" onSubmit="return beforeSubmit(this)">

        <input type="text" name="id" placeholder="id" value="<?= $data['data']['lists']['id']?>" style="display: none" />
        <input type="text" name="title" placeholder="标题" value="<?= isset($data['data']['lists']['title']) ? $data['data']['lists']['title'] : ''?>" />
        </br>
        <input type="text" name="label" placeholder="标签" value="<?= isset($data['data']['lists']['label']) ? $data['data']['lists']['label'] : ''?>"/>
        </br>
        <input type="text" name="img" placeholder="图片地址" value="<?= isset($data['data']['lists']['img']) ? $data['data']['lists']['img'] : ''?>" /> <button id="img_button" onclick="return addimg('img');" > 设置图片</button>
        </br>
        <select name="state" id="state">
            <option value="0">草稿</option>
            <option value="1">展示</option>
            <option value="2">隐藏</option>
            <option value="3">删除</option>
        </select>
        </br>
        <textarea name="text" placeholder="内容" rows="12" cols="100" warp="virtual" ><?= htmlspecialchars(isset($data['data']['lists']['text']) ? $data['data']['lists']['text'] : '')?></textarea>
        </br><button id="text_button"  onclick="return addimg('text');" > 添加图片</button>
        </br>
        <button type="submit" >提交</button>
    </form>
</div>



<!-- 显示窗口的地方 -->
<div id="here" value = "1"></div>
<div id="login" style="display:none;">
    <table border="1" align="center">
        <tr>
            <td>图片</td>
            <td>删除</td>
        </tr>
        <?php foreach ($data['data']['img_lists'] as $value) { ?>
            <tr>
                <td><img src="http://www.annisisi.com/uploads/<?= $value ?>"></td>
                <td>
                    <button name="addimglist" id="<?= $value ?>" onclick="return addtype(this.id);">添加</button>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>
<!-- 显示窗口的地方 -->


</body>

<script type="text/javascript">
    window.onload=function(){
        document.getElementById('state').value="<?= isset($data['data']['lists']['state']) ? $data['data']['state'] : 1 ?>";
    };

    function beforeSubmit(form) {
        if (form.title.value == '') {
            alert('标题不能为空！');
            form.title.focus();
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
        var value = document.getElementById("here").getAttribute('value');

        if (value == 'img') {
            document.getElementsByName('img')[0].value = 'http://www.annisisi.com/uploads/' + txt;
        } else {
            var str = "<p><img src=\"uploads/" + txt + "\" alt=\"无法显示\"></p>";
            AddContent(str);
        }
        return false;
    }

    function AddContent(str) {
        var lastInput = document.getElementsByName('text')[0];
        if (lastInput) {
            lastInput.focus();
        }
        if (typeof document.selection != "undefined") {
            document.selection.createRange().text = str;
        }
        else {
            lastInput.value = lastInput.value.substr(0, lastInput.selectionStart) + str + lastInput.value.substring(lastInput.selectionStart, lastInput.value.length);
        }
    }


</script>
<script src="js/addimg.js"></script>
</html>

