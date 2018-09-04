<html>
<head>
</head>
<body>
<?php include("head.php"); ?>
<div align="center">
    <form method="post" onSubmit="return beforeSubmit(this)">

        <input type="text" name="id" placeholder="id" value="<?= $data['data']['id']?>" style="display: none" />
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
        </br>
        <textarea name="text" placeholder="内容" rows="12" cols="100" warp="virtual" ><?= htmlspecialchars(isset($data['data']['text']) ? $data['data']['text'] : '')?></textarea>
        </br>
        <button type="submit" >提交</button>
    </form>
</div>
</body>

<script type="text/javascript">
    window.onload=function(){
        document.getElementById('state').value="<?= isset($data['data']['state']) ? $data['data']['state'] : 1 ?>";
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
</script>

</html>

