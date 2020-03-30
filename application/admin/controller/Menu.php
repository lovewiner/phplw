<?php
namespace app\admin\controller;
use think\Db;

class Menu extends Base
{
    public function index(){
        $mid=(int)input('get.mid');
        $data=Db::name('manager_menus')->where('pid',$mid)->select();
        $backid=0;
        if($mid>0){
            $parent_id=Db::name('manager_menus')->field('pid')->where('mid',$mid)->find();
            $backid=$parent_id['pid'];
        }
        $this->assign([
            'backid'=>$backid,
            'mid'  =>$mid,
            'data' => $data
        ]);
        return $this->fetch();
    }
    //保存菜单
    public function save(){
        $mid=(int)input('post.mid');
        //post.ord是数组，所以需要表明，在后面加/a(array)
        $ord = input('post.ord/a');
        $title = input('post.title/a');
        $controller = input('post.controller/a');
        $method = input('post.method/a');
        $ishidden = input('post.ishidden/a');
        $status = input('post.status/a');
        foreach($ord as $key => $value){
            $data['pid'] = $mid;
            $data['ord'] = $value;
            $data['title'] = $title[$key];
            $data['controller'] = $controller[$key];
            $data['method'] = $method[$key];
            $data['ishidden'] = isset($ishidden[$key]) ? 1 : 0;
            $data['status'] = isset($status[$key]) ? 1 : 0;
            if($key==0 && $data['title']){
                $res=Db::name('manager_menus')->insert($data);
            }
            if($key>0){
                if($data['title'] == '' && $data['controller'] == '' && $data['method'] == ''){
                    //删除
                    DB::name('manager_menus')->where('mid',$key)->delete();
                }else{
                    //编辑(更改)
                    DB::name('manager_menus')->where('mid',$key)->update($data);
                }
            }
        }
        exit(json_encode(array('code'=>0,'msg'=>'保存成功')));
    }
}