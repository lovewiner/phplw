<?php

namespace app\admin\controller;
use think\Controller;
use think\Db;
class Manager extends Controller
{
    /**
     * 显示会员列表
     */
    public function lst()
    {
        $data = Db::name('manager')->paginate(5);
        $this->assign('data',$data);
        $groups = Db::name('manager_groups')->select();
        $this->assign('groups',$groups);
        return $this->fetch();
    }

    /**
     * 会员添加.
     */
    public function add()
    {
        $groups = Db::name('manager_groups')->select();
        $this->assign('groups',$groups);
        return $this->fetch();
    }

    /**
     * 保存新建的资源
     */
    public function save()
    {
        $id = trim(input('post.id'));
        $data['username']=trim(input('post.username'));
        $pwd = trim(input('post.pwd'));
        $data['gid'] = (int)input('post.gid');
        $data['truename'] = trim(input('post.truename'));
        $data['status'] = (int)input('post.status');
        $data['img'] = trim(input('post.img'));
        if(!$data['username']){
            exit(json_encode(array('code'=>1,'msg'=>'用户名不能为空')));
        }
        if(!$pwd){
            exit(json_encode(array('code'=>1,'msg'=>'密码不能为空')));
        }else{
            //密码加密
            $data['password']=password_hash($pwd,PASSWORD_DEFAULT);
        }
        if(!$data['gid']){
            exit(json_encode(array('code'=>1,'msg'=>'未选择角色')));
        }
        if(!$data['truename']){
            exit(json_encode(array('code'=>1,'msg'=>'名字不能为空')));
        }
        if($id==0){
            //检查用户名是否重复
            $item=Db::name('manager')->where('username',$data['username'])->find();
            if($item){
                exit(json_encode(array('code'=>1,'msg'=>'用户名已存在')));
            }
            //保存数据
            $data['add_time']=time();
            $res=Db::name('manager')->insert($data);
        }else{
            $res=Db::name('manager')->where('id',$id)->update($data);
        }
        if(!$res){
            exit(json_encode(array('code'=>1,'msg'=>'保存失败')));
        }else{
            exit(json_encode(array('code'=>0,'msg'=>'保存成功')));
        }
    }

    /**
     * 显示编辑资源表单页.
     */
    public function edit($id)
    {
        $item = Db::name('manager')->where('id',$id)->find();
        $groups = Db::name('manager_groups')->select();
        $this->assign('item',$item);
        $this->assign('groups',$groups);
        return $this->fetch();
    }

    /**
     * 删除指定资源
     */
    public function delete()
    {
        $id=input('post.id');
        $res=Db::name('manager')->where('id',$id)->delete();
        if($res){
            exit(json_encode(array('code'=>0,'msg'=>'删除成功')));
        }else{
            exit(json_encode(array('code'=>1,'msg'=>'删除失败')));
        }
    }
    public function upload_img(){
        $file = request()->file('file');
        if($file==null){
            exit(json_encode(array('code'=>1,'msg'=>'未上传文件')));
        }
        $info = $file->move('./uploads');
        $ext = $info->getExtension();
        //dump($ext);die();输出：jpg
        if(!in_array($ext,array('jpg','jpeg','gif','png'))){
            exit(json_encode(array('code'=>1,'msg'=>'上传格式不支持')));
        }
        //保存路径
        $img='/uploads/'.$info->getSaveName();
        exit(json_encode(array('code'=>0,'msg'=>$img)));
    }

}
