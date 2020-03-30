<?php /*a:1:{s:50:"E:\WWW\phplw\application\admin\view\admin\lst.html";i:1585469522;}*/ ?>
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
    <span>会员列表</span>
    <button class="layui-btn layui-btn-sm" onclick="add()">添加</button>
    <div></div>
</div>
<div style="padding-top: 10px;"></div>
<form class="layui-form" method="post" action="<?php echo url('admin_search'); ?>"> <!-- 提示：如果你不想用form，你可以换成div等任何一个普通元素 -->
    <div class="layui-form-item">
        <div class="layui-input-inline">
            <input type="text" name="card" placeholder="会员卡号" autocomplete="off" class="layui-input" value="<?php echo htmlentities($card); ?>">
        </div>
        <div class="layui-input-inline" style="z-index:99;">
            <select name="gid">
                <option value="">请选择会员等级</option>
                <?php foreach($groups as $value): ?>
                <option value="<?php echo htmlentities($value['gid']); ?>" <?php if($gid == $value['gid']): ?>selected<?php endif; ?>><?php echo htmlentities($value['title']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit lay-filter="*">搜索</button>
            <a href="<?php echo url('admin_list'); ?>">
                <button type="button" class="layui-btn">
                    <i class="layui-icon layui-icon-refresh"></i>
                </button>
            </a>
        </div>
    </div>
</form>

<table class="layui-table">
    <thead>
    <tr>
        <th>ID</th>
        <th>会员卡号</th>
<!--        <th>真实姓名</th>-->
        <th>会员等级</th>
        <th>状态</th>
        <th>添加时间</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $k = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?>
    <tr>
        <td><?php echo htmlentities($k); ?></td>
        <td><?php echo htmlentities($v['card']); ?></td>
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
    layui.use(['layer','form'],function(){
        layer=layui.layer;
        $=layui.jquery;
        form = layui.form;
    });
    //添加管理员
    function edit(id){
        //iframe层
        layer.open({
            type: 2,
            title: '编辑会员',
            shadeClose: false,//点击背景关闭
            shade: 0.8,//阴影
            area: ['480px', '400px'],//宽度、高度
            content: "<?php echo url('admin_edit'); ?>?id=" +id  //iframe的url
        });
    }
    function add(){
        //iframe层
        layer.open({
            type: 2,
            title: '添加会员',
            shadeClose: false,//点击背景关闭
            shade: 0.8,//阴影
            area: ['480px', '400px'],//宽度、高度
            content: "<?php echo url('admin_add'); ?>" //iframe的url
        });
    }
    //删除
    function del(id) {
        layer.confirm('确定要删除该会员吗?', {icon: 3, title: '温馨提示'}, function (index) {
            $.post("<?php echo url('admin_del'); ?>", {'id': id}, function (res) {
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