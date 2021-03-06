<?php /*a:1:{s:53:"E:\WWW\phplw\application\admin\view\home\welcome.html";i:1585039892;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>后台管理系统</title>
    <link rel="stylesheet" href="/static/admin/layui/css/layui.css">
</head>
<body class="layui-layout-body">
    <div class="layui-body" style="left: 30px;right: 30px;top: 30px;">
        <div class="layui-collapse" lay-accordion="" lay-filter="collapse">
            <div class="layui-colla-item">
                <h2 class="layui-colla-title">软件信息</h2>
                <div class="layui-colla-content layui-show">
                    <table class="layui-table">
                        <tr>
                            <td width="40%">软件名称</td>
                            <td width="40%">会员卡管理系统</td>
                        </tr>
                        <tr>
                            <td>系统版本</td>
                            <td>V8.0</td>
                        </tr>
                        <tr>
                            <td>QQ</td>
                            <td>1336741418</td>
                        </tr>
                        <tr>
                            <td>网络支持</td>
                            <td><a href="#';">无网络</a></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="layui-colla-item">
                <h2 class="layui-colla-title">服务器信息</h2>
                <div class="layui-colla-content">
                    <table class="layui-table">
                        <tr>
                            <td>服务器IP</td>
                            <td><?php echo htmlentities($server_ip); ?></td>
                        </tr>
                        <tr>
                            <td width="40%">服务器域名</td>
                            <td width="60%"><?php echo htmlentities($server_name); ?></td>
                        </tr>
                        <tr>
                            <td>服务器操作系统</td>
                            <td><?php echo htmlentities($php_os); ?></td>
                        </tr>
                        <tr>
                            <td>运行环境</td>
                            <td><?php echo htmlentities($software); ?></td>
                        </tr>
                        <tr>
                            <td>服务器端口</td>
                            <td><?php echo htmlentities($port); ?></td>
                        </tr>
                        <tr>
                            <td width="40%">PHP版本</td>
                            <td width="60%"><?php echo htmlentities($version); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript" src="/static/admin/layui/layui.all.js"></script>
<script type="text/javascript" src="/static/admin/common/jquery-3.4.1/jquery-3.4.1.js"></script>
<script>
    //注意：折叠面板 依赖 element 模块，否则无法进行功能性操作
    layui.use('element', function(){
        var element = layui.element;
    });
</script>
</html>