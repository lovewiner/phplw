<?php /*a:1:{s:50:"E:\WWW\phplw\application\admin\view\grade\add.html";i:1585301789;}*/ ?>
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
    <input type="hidden" name="gid" value="<?php echo htmlentities($role['gid']); ?>">
    <div class="layui-form-item">
        <label class="layui-form-label">会员等级</label>
        <div class="layui-input-block">
            <input type="text"  autocomplete="off" class="layui-input" name="title" value="<?php echo htmlentities($role['title']); ?>">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">等级权限</label>
        <?php if(is_array($menus_list) || $menus_list instanceof \think\Collection || $menus_list instanceof \think\Paginator): $i = 0; $__LIST__ = $menus_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <hr>
        <div class="layui-input-block">
            <input type="checkbox" name="menu[<?php echo htmlentities($vo['mid']); ?>]" lay-skin="primary" title="<?php echo htmlentities($vo['title']); ?>" <?php echo isset($role['rights']) && $role['rights'] && in_array($vo['mid'],$role['rights'])?'checked':''; ?>>
            <hr>
            <?php if(is_array($vo['children']) || $vo['children'] instanceof \think\Collection || $vo['children'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['children'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cvo): $mod = ($i % 2 );++$i;?>
            <input type="checkbox" name="menu[<?php echo htmlentities($cvo['mid']); ?>]" lay-skin="primary" title="<?php echo htmlentities($cvo['title']); ?>" <?php echo isset($role['rights']) && $role['rights'] && in_array($cvo['mid'],$role['rights'])?'checked':''; ?>>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</form>
<div class="layui-form-item">
    <div class="layui-input-block">
        <button class="layui-btn" onclick="save()">保存</button>
    </div>
</div>
</body>
<script style="text/javascript">
    layui.use(['layer','form'],function(){
        layer = layui.layer;
        $ = layui.jquery;
        form = layui.form;
    });
    //保存角色
    function save(){
        var title = $.trim($('input[name="title"]').val());
        if(title == ""){
            layer.msg('角色名称不能为空',{icon:2});
            return;
        }
        $.post("<?php echo url('grade_save'); ?>",$('form').serialize(),function(res){
            if(res.code>0){
                layer.msg(res.msg,{icon:2});
            }else{
                layer.msg(res.msg,{icon:1});
                setTimeout(function(){
                    parent.window.location.reload();
                },1000);
            }
        },'json');
    }
</script>
</html>