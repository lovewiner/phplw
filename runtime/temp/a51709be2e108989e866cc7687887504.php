<?php /*a:1:{s:51:"E:\WWW\phplw\application\admin\view\admin\edit.html";i:1585208446;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="/static/admin/layui/css/layui.css">
    <script type="text/javascript" src="/static/admin/layui/layui.js"></script>
</head>
<body style="padding: 10px;">
<form class="layui-form">
    <input type="hidden" name="id" value="<?php echo htmlentities($item['id']); ?>">
    <div class="layui-form-item">
        <label class="layui-form-label">用户名</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input" name="card" value="<?php echo htmlentities($item['card']); ?>">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">角&nbsp;&nbsp;&nbsp;&nbsp;色</label>
        <div class="layui-input-inline">
            <select name="gid">
                <?php if(is_array($groups) || $groups instanceof \think\Collection || $groups instanceof \think\Paginator): $i = 0; $__LIST__ = $groups;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <option value="<?php echo htmlentities($vo['gid']); ?>" <?php echo $vo['gid']==$item['gid'] ? 'selected' : ''; ?>><?php echo htmlentities($vo['title']); ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">状&nbsp;&nbsp;&nbsp;&nbsp;态</label>
        <div class="layui-input-inline">
            <input type="checkbox" lay-skin="primary" title="禁用" name="status" value="1" <?php echo !empty($item['status']) ? 'checked' : ''; ?>>
        </div>
    </div>
</form>
<div class="layui-form-item">
    <div class="layui-input-block">
        <button class="layui-btn" onclick="save()">保存</button>
    </div>
</div>
<script type="text/javascript">
    layui.use(['layer','form'],function(){
        form=layui.form;
        layer=layui.layer;
        $=layui.jquery;
    });
    //保存会员
    function save(){
        var id=parseInt($('input[name="id"]').val());
        var card=$.trim($('input[name="card"]').val());
        var gid =$('select[name="gid"]').val();
        if(card==""){
            layer.msg("请输入卡号",{icon:2});
            return;
        }
        if(gid==0){
            layer.msg("请选择角色",{icon:2});
            return;
        }
        $.post("<?php echo url('admin_save'); ?>",$('form').serialize(),function(res){
            if(res.code>0){
                layer.alert(res.msg,{icon:2});
            }else{
                layer.msg(res.msg,{icon:1});
                setTimeout(function(){
                    parent.window.location.reload();
                },1000);//一秒后跳转
            }
        },'json');
    }
</script>
</body>
</html>