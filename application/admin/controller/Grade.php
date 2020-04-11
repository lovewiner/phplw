<?php
namespace app\admin\controller;
use think\Db;
/**
 * 等级管理
 */
class Grade extends Base
{
    public function lst(){
        $data=Db::name('vip_manager_groups')->select();
        $this->assign('data',$data);
        return $this->fetch();
    }
    public function add(){
        $gid = (int)input('get.id');
        $role = Db::name('vip_manager_groups')->where('gid',$gid)->find();
        $role && $role['discount'];
        $this->assign('role',$role);
        return $this->fetch();
    }
    public function save(){
        $gid = (int)input('post.gid');
        $result['title'] = trim(input('post.title'));
        $result['discount'] = trim(input('post.discount'));
        if($result['title'] == ""){
            exit(json_encode(array('code'=>1,'msg'=>'角色名称不能为空')));
        }
        if($result['discount'] == ""){
            exit(json_encode(array('code'=>1,'msg'=>'折扣不能为空')));
        }
        if($gid>0){
            $res=Db::name('vip_manager_groups')->where('gid',$gid)->update($result);
        }else{
            $res = Db::name('vip_manager_groups')->insert($result);
        }
        if(!$res){
            exit(json_encode(array('code'=>1,'msg'=>'保存失败')));
        }else{
            exit(json_encode(array('code'=>0,'msg'=>'保存成功')));
        }
    }
    public function delete(){
        $gid = input('post.id');
        $res = Db::name('vip_manager_groups')->where('gid',$gid)->delete();
        if(!$res){
            exit(json_encode(array('code'=>1,'msg'=>'删除失败')));
        }else{
            exit(json_encode(array('code'=>0,'msg'=>'删除成功')));
        }
    }
    private function gettreeitems($items){
        $tree = array();
        foreach ($items as $item) {
            if(isset($items[$item['pid']])){
                $items[$item['pid']]['children'][] = &$items[$item['mid']];
            }else{
                $tree[] = &$items[$item['mid']];
            }
        }
        return $tree;
    }
    private function formatMeuns($items,&$res = array()){
        foreach ($items as $value){
            if(!isset($value['children'])){
                $res[] = $value;
            }else{
                $tem = $value['children'];
                unset($value['children']);
                $res[]=$value;
                $this->formatMeuns($tem,$res);
            }
        }
        return $res;
    }
}