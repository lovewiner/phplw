<?php /*a:1:{s:52:"E:\WWW\phplw\application\admin\view\manager\add.html";i:1585476409;}*/ ?>
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
    <div class="layui-form-item">
        <label class="layui-form-label">用户名</label>
        <div class="layui-input-inline">
            <input type="text"  autocomplete="off" class="layui-input" name="username" value="">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">角&nbsp;&nbsp;&nbsp;&nbsp;色</label>
        <div class="layui-input-inline">
            <select name="gid">
                <option value="0"></option>
                <?php if(is_array($groups) || $groups instanceof \think\Collection || $groups instanceof \think\Paginator): $i = 0; $__LIST__ = $groups;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <option value="<?php echo htmlentities($vo['gid']); ?>"><?php echo htmlentities($vo['title']); ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">密&nbsp;&nbsp;&nbsp;&nbsp;码</label>
        <div class="layui-input-inline">
            <input type="text" autocomplete="off" class="layui-input" name="pwd">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">姓&nbsp;&nbsp;&nbsp;&nbsp;名</label>
        <div class="layui-input-inline">
            <input type="text" autocomplete="off" class="layui-input" name="truename" value="" placeholder="*保存后不可更改">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">上传图片</label>
        <div class="layui-input-inline">
            <button class="layui-btn layui-btn-sm" onclick="return false;" id="upload_img">
                <i class="layui-icon">&#xe67c;</i>上传
            </button>
            <img src="" id="pre_img" style="height: 30px;" />
            <input type="hidden" name="img">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">状&nbsp;&nbsp;&nbsp;&nbsp;态</label>
        <div class="layui-input-inline">
            <input type="checkbox" lay-skin="primary" title="禁用" name="status" value="1">
        </div>
    </div>
</form>
<div class="layui-form-item">
    <div class="layui-input-block">
        <button class="layui-btn" onclick="save()">保存</button>
    </div>
</div>
<script type="text/javascript">
    layui.use(['layer','form','upload'],function(){
        layer=layui.layer;
        $ = layui.jquery;
        var form=layui.form;
        var upload = layui.upload;

        var uploadInst = upload.render({
            elem: '#upload_img' //绑定元素
            ,url: '/admin/manager/upload_img' //上传接口
            ,accept: 'images' //校验上传文件类型
            ,done: function(res){
                //上传完毕回调
                $('#pre_img').attr('src',res.msg);
                $('input[name="img"]').val(res.msg);
            }
            ,error: function(){
                //请求异常回调
            }
        });
    });

    //保存管理员
    function save(){
        var username=$.trim($('input[name="username"]').val());
        var pwd = $.trim($('input[name="pwd"]').val());
        var gid =$('select[name="gid"]').val();
        var truename = $.trim($('input[name="truename"]').val());
        var img = $.trim($('input[name="img"]').val());
        if(username==""){
            layer.msg("请输入用户名",{icon:2});
            return;
        }
        if(gid==0){
            layer.msg("请选择角色",{icon:2});
            return;
        }
        if(pwd==""){
            layer.msg("请输入密码",{icon:2});
            return;
        }
        if(truename==""){
            layer.msg("请输入姓名",{icon:2});
            return;
        }
        if(img==""){
            layer.msg('请上传图片',{icon:2,anim:6});
            return;
        }
        $.post("<?php echo url('manager_save'); ?>",$('form').serialize(),function(res){
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