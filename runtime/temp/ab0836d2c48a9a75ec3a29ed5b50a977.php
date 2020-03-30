<?php /*a:1:{s:51:"E:\WWW\phplw\application\admin\view\site\index.html";i:1585216466;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>网站设置</title>
    <link rel="stylesheet" href="/static/admin/layui/css/layui.css">
    <script type="text/javascript" src="/static/admin/layui/layui.js"></script>
    <link rel="stylesheet" href="/static/admin/common/common.css">
</head>
<body style="padding-top: 20px;margin: 0 4px;">
    <div class="header">
        <span>网站设置</span>
        <div></div>
    </div>
    <form class="layui-form" style="padding-top: 10px;">
        <div class="layui-form-item">
            <label class="layui-form-label">网站设置</label>
            <div class="layui-input-inline">
                <input type="text" class="layui-input" name="title" value="<?php echo htmlentities($sites['values']); ?>" autocomplete="off">
            </div>
        </div>
    </form>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" onclick="save()">提交</button>
        </div>
    </div>
</body>
<script style="text/javascript">
    layui.use(['layer'],function(){
        $ = layui.jquery;
        layer = layui.layer;
    });
    function save(){
        var title = $.trim($('input[name="title"]').val());
        if(title == ''){
            layer.msg('网站名称不能为空',{'icon':2});
            return;
        }
        $.post("<?php echo url('site_save'); ?>",{'title':title},function(res){
            if(res.code>0){
                layer.alert(res.msg,{icon:2});
            }else{
                layer.msg(res.msg,{icon:1});
                setTimeout(function(){
                    window.location.reload();
                },1000);
            }
        },'json');
    }
</script>
</html>