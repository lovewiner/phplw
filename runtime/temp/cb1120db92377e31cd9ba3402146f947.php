<?php /*a:1:{s:52:"E:\WWW\phplw\application\admin\view\manager\lst.html";i:1585476777;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="/static/admin/layui/css/layui.css">
    <link rel="stylesheet" href="/static/admin/common/common.css">
    <link rel="stylesheet" href="/static/admin/bootstrap/css/bootstrap.css">
    <script type="text/javascript" src="/static/admin/layui/layui.js"></script>
</head>
<body style="padding-top: 20px; margin: 0 4px;">
<div class="header">
    <span>管理员列表</span>
    <button class="layui-btn layui-btn-sm" onclick="add()">添加</button>
    <div></div>
</div>
<table class="layui-table">
    <thead>
    <tr>
        <th>ID</th>
        <th>用户名</th>
        <th>真实姓名</th>
        <th>头像</th>
        <th>角色</th>
        <th>状态</th>
        <th>添加时间</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $k = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?>
    <tr>
        <td><?php echo htmlentities($k); ?></td>
        <td><?php echo htmlentities($v['username']); ?></td>
        <td><?php echo htmlentities($v['truename']); ?></td>
        <td><img src="<?php echo htmlentities($v['img']); ?>" style="height: 40px;" alt=""></td>
<!--         <td><?php if($v['gid'] == '1'): ?>普通会员<?php else: ?>尊贵会员<?php endif; ?></td>-->
        <td>
            <?php if(is_array($groups) || $groups instanceof \think\Collection || $groups instanceof \think\Paginator): $i = 0; $__LIST__ = $groups;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($v['gid']==$vo['gid']): ?>
            <?php echo htmlentities($vo['title']); ?>
            <?php endif; ?>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </td>
        <!-- <td><?php if($v['status'] == '0'): ?>正常<?php else: ?>禁用<?php endif; ?></td> -->
        <td><?php echo $v['status']==0 ? "正常" : '<span style="color: red;">禁用</span>'; ?></td>
        <!-- 加粗 -->
        <!-- <td><?php echo $v['status']==0 ? "正常" : '<span style="color: red;font-weight:bold;">禁用</span>'; ?></td> -->
        <td><?php echo date('Y-m-d H:i:s',$v['add_time']); ?></td>
        <td>
            <a href="javascript:;" onclick="edit(<?php echo htmlentities($v['id']); ?>)" class="layui-btn layui-btn-sm">编辑</a>
            <a href="javascript:;" onclick="del(<?php echo htmlentities($v['id']); ?>)" class="layui-btn layui-btn-sm layui-btn-danger del">删除</a>
        </td>
    </tr>
    <?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
</table>
<div style="text-align: center">
    <?php echo $data; ?>
</div>
<script type="text/javascript">
    layui.use(['layer'],function(){
        layer=layui.layer;
        $=layui.jquery;
    });
    //添加管理员
    function edit(id){
        //iframe层
        layer.open({
            type: 2,
            title: '编辑管理员',
            shadeClose: false,//点击背景关闭
            shade: 0.8,//阴影
            area: ['480px', '500px'],//宽度、高度
            content: "<?php echo url('manager_edit'); ?>?id=" +id  //iframe的url
        });
    }
    function add(){
        //iframe层
        layer.open({
            type: 2,
            title: '添加管理员',
            shadeClose: false,//点击背景关闭
            shade: 0.8,//阴影
            area: ['480px', '500px'],//宽度、高度
            content: "<?php echo url('manager_add'); ?>" //iframe的url
        });
    }
    //删除
    function del(id) {
        layer.confirm('确定要删除该管理员吗?', {icon: 3, title: '温馨提示'}, function (index) {
            $.post("<?php echo url('manager_del'); ?>", {'id': id}, function (res) {
                if (res.code > 0) {
                    layer.alert(res.msg, {icon: 2});
                } else {
                    layer.msg(res.msg, {icon: 1});
                    setTimeout(function () {
                        window.location.reload();
                    }, 1000);
                }
            }, 'json');
        });
    }
</script>
</body>
</html>