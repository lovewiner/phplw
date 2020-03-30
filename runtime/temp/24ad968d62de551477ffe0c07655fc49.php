<?php /*a:1:{s:51:"E:\WWW\phplw\application\admin\view\menu\index.html";i:1585218054;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="/static/admin/layui/css/layui.css">
    <link rel="stylesheet" href="/static/admin/common/common.css">
    <script type="text/javascript" src="/static/admin/layui/layui.js"></script>
    <style type="text/css">
        .header span {background: #009688;margin-left: 30px;padding: 10px;color: #ffffff;}
        .header div{border-bottom: solid 2px #009688;margin-top: 8px;}
    </style>
</head>
<body style="padding-top: 20px;margin: 0 4px;">
<div class="header">
    <span>菜单列表</span>
    <div></div>
</div>
<form class="layui-form">
    <?php if($mid>0): ?>
    <button class="layui-btn layui-btn-sm layui-btn-primary" style="float: right; margin: 5px 0;" onclick="back(<?php echo htmlentities($backid); ?>);return false;">返回上一级</button>
    <?php endif; ?>
    <input type="hidden" name="mid" value="<?php echo htmlentities($mid); ?>">
    <table class="layui-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>排序</th>
            <th>菜单名称</th>
            <th>controller</th>
            <th>method</th>
            <th>是否隐藏</th>
            <th>是否禁用</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <tr>
            <td><?php echo htmlentities($vo['mid']); ?></td>
            <td><input type="text" class="layui-input" name="ord[<?php echo htmlentities($vo['mid']); ?>]" value="<?php echo htmlentities($vo['ord']); ?>"></td>
            <td><input type="text" class="layui-input" name="title[<?php echo htmlentities($vo['mid']); ?>]" value="<?php echo htmlentities($vo['title']); ?>"></td>
            <td><input type="text" class="layui-input" name="controller[<?php echo htmlentities($vo['mid']); ?>]" value="<?php echo htmlentities($vo['controller']); ?>"></td>
            <td><input type="text" class="layui-input" name="method[<?php echo htmlentities($vo['mid']); ?>]" value="<?php echo htmlentities($vo['method']); ?>"></td>
            <td><input type="checkbox" lay-skin="primary" name="ishidden[<?php echo htmlentities($vo['mid']); ?>]" title="隐藏" value="1" <?php echo !empty($vo['ishidden']) ? 'checked' : ''; ?>></td>
            <td><input type="checkbox" lay-skin="primary" name="status[<?php echo htmlentities($vo['mid']); ?>]" title="禁用" value="1" <?php echo !empty($vo['status']) ? 'checked' : ''; ?>></td>
            <td><button class="layui-btn layui-btn-xs" onclick="child(<?php echo htmlentities($vo['mid']); ?>);return false;">子菜单</button></td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        <tr>
            <td></td>
            <td><input type="text" class="layui-input" name="ord[0]"></td>
            <td><input type="text" autocomplete="off" class="layui-input" name="title[0]"></td>
            <td><input type="text" class="layui-input" name="controller[0]"></td>
            <td><input type="text" class="layui-input" name="method[0]"></td>
            <td><input type="checkbox" lay-skin="primary" name="ishidden[0]" title="隐藏" value="1"></td>
            <td><input type="checkbox" lay-skin="primary" name="status[0]" title="禁用" value="1"></td>
            <td></td>
        </tr>
        </tbody>
    </table>
</form>
<button class="layui-btn" onclick="save()">保存</button>
<script type="text/javascript">
    layui.use(['layer','form'],function(){
        $ = layui.jquery;
        layer=layui.layer;
    });
    function child(mid){

        window.location.href="<?php echo url('menu_index'); ?>?mid="+mid;
    }
    function back(backid){
        window.location.href="<?php echo url('menu_index'); ?>?mid="+backid;
    }
    function save(){
        $.post("<?php echo url('menu_save'); ?>",$('form').serialize(),function(res){
            if(res.code>0){
                layer.alert(res.msg,{'icon':2});
            }else{
                layer.msg(res.msg,{'icon':1});
                setTimeout(function(){window.location.reload();},1000);
            }
        },'json');
    }
</script>
</body>
</html>