<?php /*a:1:{s:50:"E:\WWW\phplw\application\admin\view\grade\lst.html";i:1585301700;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="/static/admin/layui/css/layui.css">
    <script type="text/javascript" src="/static/admin/layui/layui.js"></script>
    <link rel="stylesheet" href="/static/admin/common/common.css">
</head>
<body style="padding-top: 20px;margin: 0 4px;">
<div class="header">
    <span>会员等级列表</span>
    <button class="layui-btn layui-btn-sm" onclick="add()">添加</button>
    <div></div>
</div>
<table class="layui-table">
    <thead>
    <tr>
        <th>ID</th>
        <th>会员等级</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
    <tr>
        <td><?php echo htmlentities($vo['gid']); ?></td>
        <td><?php echo htmlentities($vo['title']); ?></td>
        <td>
            <button class="layui-btn layui-btn-xs layui-btn-warm" onclick="add(<?php echo htmlentities($vo['gid']); ?>)">编辑</button>
            <button class="layui-btn layui-btn-xs layui-btn-danger" onclick="del(<?php echo htmlentities($vo['gid']); ?>)">删除</button>
        </td>
    </tr>
    <?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
</table>
<script type="text/javascript">
    layui.use(['layer'],function(){
        layer = layui.layer;
        $ = layui.jquery;
    });
    function add(id){
        //iframe层
        layer.open({
            type: 2,
            title: id>0?'编辑等级':'添加等级',
            shadeClose: false,//点击背景关闭
            shade: 0.8,//阴影
            area: ['480px', '400px'],//宽度、高度
            content: "<?php echo url('grade_add'); ?>?id="+id //iframe的url
        });
    }
    function del(id){
        layer.confirm('确定删除该会员等级？',{btn:['确定','取消']},function(){
            $.post("<?php echo url('grade_del'); ?>",{'id':id},function(res){
                if(res.code>0){
                    layer.alert(res.msg,{icon:2});
                }else{
                    layer.msg(res.msg,{icon:1});
                    setTimeout(function(){
                        window.location.reload();
                    },1000);
                }
            },'json');
        });
    }
</script>
</body>
</html>