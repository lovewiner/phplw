<?php
namespace app\admin\controller;
use think\Db;
/**
 * 角色管理
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
        $role && $role['rights'] && $role['rights'] = json_decode($role['rights']);
        $this->assign('role',$role);
        $data = Db::name('manager_menus')->where('status',0)->select();
        $results = array();
        foreach ($data as $value) {
            $results[$value['mid']] = $value;
        }
        $menus = $this->gettreeitems($results);
        $menus_list = array();
        foreach ($menus as $value) {
            $value['children'] = isset($value['children'])? $this->formatMeuns($value['children']) : false;
            $menus_list[] = $value;
        }
        $this->assign('menus_list',$menus_list);
        return $this->fetch();
    }
    public function save(){
        $gid = (int)input('post.gid');
        $result['title'] = trim(input('post.title'));
        $menus = input('post.menu/a');
        if($result['title'] == ""){
            exit(json_encode(array('code'=>1,'msg'=>'角色名称不能为空')));
        }
        $menus && $result['rights']=json_encode(array_keys($menus));
        if($gid>0){
            $res=Db::name('vip_manager_groups')->where('gid',$gid)->update($result);
        }else{
            //检查角色是否已存在
            $_title= Db::name('vip_manager_groups')->where('title',$result['title'])->find();
            if($_title){
                exit(json_encode(array('code'=>1,'msg'=>'角色已存在')));
            }
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