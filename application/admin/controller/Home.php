<?php

namespace app\admin\controller;

use think\Db;
class Home extends Base
{
   public function index(){
       $data = session('admin');
       $roles = Db::name('manager_groups')->where('gid',$data['gid'])->find();
       $sites = Db::name('sites')->where('names','site')->find();
       $sites && $sites['values']=json_decode($sites['values']);
       $img = Db::name('manager')->where('gid',$data['gid'])->find();
       $this->assign('data',$data);
       $this->assign('roles',$roles);
       $this->assign('sites',$sites);
       $this->assign('img',$img);
       return $this->fetch();
   }
   public function welcome(){
       //服务器IP
       $server_ip=GetHostByName($_SERVER['SERVER_NAME']);
       //服务器域名
       $server_name=$_SERVER['HTTP_HOST'];
       //服务器操作系统
       $php_os=PHP_OS;
       //运行环境
       $software=$_SERVER['SERVER_SOFTWARE'];
       //服务器端口
       $port=$_SERVER['SERVER_PORT'];
       //php版本
       $version=PHP_VERSION;
       $this->assign([
           'server_ip'=>$server_ip,
           'server_name'=>$server_name,
           'php_os'=>$php_os,
           'software'=>$software,
           'port'=>$port,
           'version'=>$version
       ]);
       return $this->fetch();
   }
}
