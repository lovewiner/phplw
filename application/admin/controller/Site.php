<?php

namespace app\admin\controller;

use think\Db;

class Site extends Base
{
    public function index(){
        $sites = Db::name('sites')->where('names','site')->find();
        $sites && $sites['values']=json_decode($sites['values']);
        $this->assign('sites',$sites);
        return $this->fetch();
    }
    public function save(){
        $title = trim(input('post.title'));
        $sites = Db::name('sites')->where('names','site')->find();
        if(!$sites){
            Db::name('sites')->insert(['names'=>'site','values'=>json_encode($title)]);
        }else{
            $value['values'] = json_encode($title);
            Db::name('sites')->where('names','site')->update($value);
        }
        exit(json_encode(array('code'=>0,'msg'=>'保存成功')));
    }
}
