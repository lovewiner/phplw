<?php

namespace app\admin\controller;
use think\App;
use think\Controller;

class Base extends Controller
{
    public function __construct()
    {
        parent::__construct();
        if(!session('admin')){
           $this->redirect('admin_login');
           exit();
        }
    }
}
