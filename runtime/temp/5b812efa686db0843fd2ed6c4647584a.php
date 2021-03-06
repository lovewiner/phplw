<?php /*a:1:{s:51:"E:\WWW\phplw\application\admin\view\home\index.html";i:1585479576;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>后台管理系统</title>
    <link rel="stylesheet" href="/static/admin/layui/css/layui.css">
    <link rel="stylesheet" href="/static/admin/home/index.css">
    <script type="text/javascript" src="/static/admin/layui/layui.js"></script>
</head>
<body>
<!-- header -->
<div class="header">
    <span class="title"><?php echo htmlentities($sites['values']); ?>后台管理系统</span>
    <span class="userinfo"><?php echo htmlentities($data['username']); ?>【<?php echo htmlentities($roles['title']); ?>】<span><a href="javascript:;" onclick="logout()">退出</a></span></span>
</div>
<!-- 左侧菜单 -->
<div class="menu" id="menu">
    <div class="layui-collapse" lay-accordion>
        <!-- lay-accordion开启手风琴效果 -->
        <div class="layui-colla-item">
        <h2 class="layui-colla-title">管理员管理</h2>
        <!-- layui-show默认初始打开一个内容页 -->
        <!-- <div class="layui-colla-content layui-show"> -->
        <div class="layui-colla-content">
            <ul class="layui-nav layui-nav-tree" lay-filter="test">
                <li class="layui-nav-item"><a href="javascript:;" onclick="menuFire(this)" src="<?php echo url('manager_list'); ?>" >管理员列表</a></li>
            </ul>
        </div>
    </div>
        <div class="layui-colla-item">
            <h2 class="layui-colla-title">用户管理</h2>
            <!-- layui-show默认初始打开一个内容页 -->
            <!-- <div class="layui-colla-content layui-show"> -->
            <div class="layui-colla-content">
                <ul class="layui-nav layui-nav-tree" lay-filter="test">
                    <li class="layui-nav-item"><a href="javascript:;" onclick="menuFire(this)" src="<?php echo url('admin_list'); ?>" >会员列表</a></li>
                </ul>
            </div>
        </div>
        <div class="layui-colla-item">
            <h2 class="layui-colla-title">权限管理</h2>
            <!-- layui-show默认初始打开一个内容页 -->
            <!-- <div class="layui-colla-content layui-show"> -->
            <div class="layui-colla-content">
                <ul class="layui-nav layui-nav-tree" lay-filter="test">
                    <li class="layui-nav-item"><a href="javascript:;" onclick="menuFire(this)" src="<?php echo url('menu_index'); ?>" >菜单管理</a></li>
                    <li class="layui-nav-item"><a href="javascript:;" onclick="menuFire(this)" src="<?php echo url('role_list'); ?>" >角色管理</a></li>
                    <li class="layui-nav-item"><a href="javascript:;" onclick="menuFire(this)" src="<?php echo url('grade_list'); ?>" >等级管理</a></li>
                </ul>
            </div>
        </div>
        <div class="layui-colla-item">
            <h2 class="layui-colla-title">系统设置</h2>
            <div class="layui-colla-content">
                <ul class="layui-nav layui-nav-tree" lay-filter="test">
                    <li class="layui-nav-item">
                        <a href="javascript:;" onclick="menuFire(this)" src="<?php echo url('site_index'); ?>" >网站设置</a>
                    </li>
                </ul>
            </div>
        </div>
         <div class="layui-colla-item">
          <h2 class="layui-colla-title">其他</h2>
          <div class="layui-colla-content">
              <ul class="layui-nav layui-nav-tree" lay-filter="test">
                    <li class="layui-nav-item">
                        <a href="javascript:;" onclick="menuFire(this)" src="<?php echo url('points_list'); ?>" >积分管理</a>
                    </li>
                  <li class="layui-nav-item">
                      <a href="javascript:;" onclick="menuFire(this)" src="" >折扣管理</a>
                  </li>
              </ul>
          </div>
        </div>
        <!--<div class="layui-colla-item">
          <h2 class="layui-colla-title">系统设置</h2>
          <div class="layui-colla-content">内容区域</div>
        </div> -->
    </div>
</div>
<!-- 主操作页面 -->
<div class="main">
    <iframe src="/admin/Home/welcome" onload="resetMainHeight(this)" style="width: 100%;height: 100%;" frameborder="0" scrolling="0"></iframe>
</div>
<script>
    layui.use(['element','layer'], function(){
        var element = layui.element;
        $ = layui.jquery;
        layer = layui.layer;
        resetMenuHight();
    });

    //重新设置菜单容器的高度
    function resetMenuHight(){
        var height = document.documentElement.clientHeight-50;
        $('#menu').height(height);
    }

    //设置主操作页面高度
    function resetMainHeight(obj){
        var height = document.documentElement.clientHeight-53;
        $(obj).parent('div').height(height);
    }

    //菜单点击
    function menuFire(obj){
        //获取src
        var src=$(obj).attr('src');
        //设置iframe的src
        $('iframe').attr('src',src);
    }
    //退出
    function logout(){
        layer.confirm('确定退出吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.get("<?php echo url('admin_logout'); ?>",function(res){
                if(res.code>0){
                    layer.msg(res.msg,{icon:2});
                }else{
                    layer.msg(res.msg,{icon:1});
                    setTimeout(function(){
                        window.location.href="<?php echo url('admin_login'); ?>";
                    },1000);
                }
            },'json');
        });
    }
</script>
</body>
</html>