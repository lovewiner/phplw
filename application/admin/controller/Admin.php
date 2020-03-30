<?php

namespace app\admin\controller;

use think\Db;

class Admin extends Base
{
    public function lst()
    {
        $data = Db::name('vip_manager')->paginate(8);
        $groups = Db::name('vip_manager_groups')->select();
        $this->assign([
            'groups'=>$groups,
            'data'  =>$data,
            'card'  =>'',
            'gid'   =>''
        ]);
        return $this->fetch();
    }

    public function search(){
        //获取会员等级
        $groups = Db::name('vip_manager_groups')->select();
        //会员卡号
        $card = input('card','','trim');
        //会员等级gid
        $gid  = input('gid');

        //卡号等级都不存在
        if($card=="" && $gid==""){
            $this->redirect('admin_list');die();
        }
        //卡号等级都存在
        if($card!="" && $gid!=""){
            $data = Db::name('vip_manager')
                ->where('card','like','%'.$card.'%')
                ->where('gid',$gid)
                ->paginate(8);
            $this->assign([
                'card' =>$card,
                'gid'  =>$gid,
                'groups'=>$groups,
                'data'  =>$data
            ]);
        }
        //卡号存在，等级不存在
        if($card!='' && $gid==''){
            $data = Db::name('vip_manager')
                ->where('card','like','%'.$card.'%')
                ->paginate(8);
            $this->assign([
                'card' =>$card,
                'gid'  =>'',
                'groups'=>$groups,
                'data'  =>$data
            ]);
        }
        //卡号不存在，等级存在
        if($card=='' && $gid!=''){
            $data = Db::name('vip_manager')
                ->where('gid',$gid)
                ->paginate(8);
            $this->assign([
                'card' =>'',
                'gid'  =>$gid,
                'groups'=>$groups,
                'data'  =>$data
            ]);
        }
        return $this->fetch('admin/lst');
    }
    /**
     * 会员添加.
     */
    public function add()
    {
        $groups = Db::name('vip_manager_groups')->select();
        $this->assign('groups',$groups);
        return $this->fetch();
    }

    /**
     * 保存新建的资源
     */
    public function save()
    {
        $id = trim(input('post.id'));
        $data['card']=(int)input('post.card');
        $data['gid'] = (int)input('post.gid');
        $data['status'] = (int)input('post.status');
        if(!$data['card']){
            exit(json_encode(array('code'=>1,'msg'=>'卡号不能为空')));
        }
        if(!$data['gid']){
            exit(json_encode(array('code'=>1,'msg'=>'未选择角色')));
        }
        if($id==0){
            //检查用户名是否重复
            $item=Db::name('vip_manager')->where('card',$data['card'])->find();
            if($item){
                exit(json_encode(array('code'=>1,'msg'=>'卡号已存在')));
            }
            //保存数据
            $data['add_time']=time();
            $res=Db::name('vip_manager')->insert($data);
        }else{
            $res=Db::name('vip_manager')->where('id',$id)->update($data);
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
        $item = Db::name('vip_manager')->where('id',$id)->find();
        $groups = Db::name('vip_manager_groups')->select();
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
        $res=Db::name('vip_manager')->where('id',$id)->delete();
        if($res){
            exit(json_encode(array('code'=>0,'msg'=>'删除成功')));
        }else{
            exit(json_encode(array('code'=>1,'msg'=>'删除失败')));
        }
    }
}
