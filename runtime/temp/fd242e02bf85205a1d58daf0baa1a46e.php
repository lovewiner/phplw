<?php /*a:1:{s:54:"E:\WWW\phplw\application\admin\view\account\login.html";i:1585298260;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>登录</title>
    <link rel="stylesheet" href="/static/admin/layui/css/layui.css">
    <script type="text/javascript" src="/static/admin/layui/layui.js"></script>
</head>
<body style="background-color: #1E9FFF">
<div style="position: absolute;left: 50%;top: 50%;width: 500px;margin-left: -250px;margin-top: -200px;">
    <div style="background-color: #ffffff;padding: 20px;border-radius: 4px;box-shadow: 5px 5px 20px #444444;">
        <div class="layui-form">
            <div class="layui-form-item" style="color: gray;">
                <h2>后台登录系统</h2>
            </div>
            <hr>
            <div class="layui-form-item">
                <label class="layui-form-label">用户名</label>
                <div class="layui-input-block">
                    <input type="text" id="username" class="layui-input" autocomplete="off">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">密&nbsp;&nbsp;&nbsp;&nbsp;码</label>
                <div class="layui-input-block">
                    <input type="password" id="password" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">验证码</label>
                <div class="layui-input-inline">
                    <input type="text" id="verifycode" class="layui-input">
                </div>
                <!-- 第一种二维码点击刷新 -->
                <!-- <img src="<?php echo captcha_src(); ?>" onclick="this.src='<?php echo captcha_src(); ?>?'+Math.random()" alt=""> -->
                <!-- 第二种二维码点击刷新 -->
                <img src="<?php echo captcha_src(); ?>" id="img" onclick="reloadImg()" alt="">
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" onclick="dologin()">登录</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    layui.use(['layer'],function(){
        $ = layui.jquery;
        layer = layui.layer;

        //用户名获取焦点
        $('#username').focus();

        //回车键提交
        $('input').keydown(function(e){
            if(e.keyCode==13){
                dologin();
            }
        })
    });

    //二维码点击刷新
    function reloadImg(){
        $('#img').attr('src','<?php echo captcha_src(); ?>?rand=' + Math.random());
    }


    //登录
    function dologin(){
        //过滤用户名、密码、验证码
        var username=$.trim($('#username').val());
        var password=$.trim($('#password').val());
        var verifycode=$.trim($('#verifycode').val());
        if(username==''){
            layer.alert("请输入用户名",{icon:2})
            return;
        }
        if(password==''){
            layer.alert("请输入密码",{icon:2})
            return;
        }
        if(verifycode==''){
            layer.alert("请输入验证码",{icon:2})
            return;
        }
        $.post("<?php echo url('admin_check_login'); ?>",{'username':username,'pwd':password,'verifycode':verifycode},function(res){
            if(res.code>0){
                // 出现错误后验证码刷新
                reloadImg();
                layer.alert(res.msg,{icon:2});
            }else{
                layer.msg(res.msg,{icon:1});
                setTimeout(function(){
                    window.location.href="<?php echo url('home_index'); ?>"
                },1000);//一秒后跳转
            }
        },'json');
    }
</script>
</body>
</html>