<html>
<head><title>多个文件上传表单</title></head>
<body>
<?php include("head.php"); ?>
<style>
    form{
        margin: 20px;
        padding: 10px;
    }

    #picInput>input{
        display: block;
        margin: 10px;
    }


</style>
<form method="post" enctype="multipart/form-data">
    <div id="picInput">
        上传图片：<input type="file" name='myfile[]'>
    </div>
    <input id="addBtn" type="button" onclick="addPic1()" value="继续添加图片"><br/><br/>
    <input type="submit" value="上传文件">
</form>

<script>
    function addPic1(){
        var addBtn =  document.getElementById('addBtn');
        var input = document.createElement("input");
        input.type = 'file';
        input.name = 'myfile[]';
        var picInut = document.getElementById('picInput');
        picInut.appendChild(input);
        if(picInut.children.length == 3){
            addBtn.disabled = 'disabled';
        }
    }
</script>
</body>
</html>