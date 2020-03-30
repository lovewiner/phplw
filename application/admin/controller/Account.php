<?php

namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\facade\Session;
use think\facade\Cookie;
class Account extends Controller
{
    //登录页面
    public function login(){
        return $this->fetch();
    }
    //验证登录
    public function check_login(){
        $username=trim(input('post.username'));
        $password=trim(input('post.pwd'));
        $verifycode=trim(input('post.verifycode'));
        if($username==""){
            exit(json_encode(array('code'=>'1','msg'=>'用户名不能为空')));
        }
        if($password==""){
            exit(json_encode(array('code'=>'1','msg'=>'密码不能为空')));
        }
        if($verifycode==""){
            exit(json_encode(array('code'=>'1','msg'=>'验证码不能为空')));
        }
        if(!captcha_check($verifycode)){
            exit(json_encode(array('code'=>'1','msg'=>'验证码错误')));
        }
        $res = Db::name('manager')->where('username',$username)->find();
        if(!$res){
            exit(json_encode(array('code'=>'1','msg'=>'用户名不存在')));
        }
        if (!password_verify($password,$res['password'])){
            exit(json_encode(array('code'=>'1','msg'=>'密码错误')));
        }
        session('admin',$res);
        exit(json_encode(array('code'=>0,'msg'=>'登录成功')));
    }
    public function logout(){
//        session('admin',null);
        Session::clear();
        Cookie::clear();
        exit(json_encode(array('code'=>0,'msg'=>'退出成功')));
    }
}
