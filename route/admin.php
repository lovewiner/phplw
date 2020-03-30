<?php
use think\facade\Route;


//后台登录
Route::get('admin/login$','admin/Account/login')->name('admin_login');
Route::post('admin/check','admin/Account/check_login')->name('admin_check_login');
//后台注销
Route::get('admin/logout','admin/Account/logout')->name('admin_logout');
//后台首页
Route::get('admin$','admin/Home/index');
Route::get('admin/$','admin/Home/index');
Route::get('admin/index$','admin/Home/index')->name('home_index');

//会员列表
Route::get('admin/admin$','admin/Admin/lst')->name('admin_list');
//会员添加
Route::get('admin/add$','admin/Admin/add')->name('admin_add');
//会员搜索
Route::post('admin/search$','admin/Admin/search')->name('admin_search');
//会员编辑
Route::get('admin/edit$','admin/Admin/edit')->name('admin_edit');
//会员保存
Route::post('admin/save$','admin/Admin/save')->name('admin_save');
//会员删除
Route::post('admin/delete$','admin/Admin/delete')->name('admin_del');

//管理员列表
Route::get('manager$','admin/Manager/lst')->name('manager_list');
//管理员添加
Route::get('manager/add$','admin/Manager/add')->name('manager_add');
//管理员保存
Route::post('manager/save$','admin/Manager/save')->name('manager_save');
//管理员编辑
Route::get('manager/edit$','admin/Manager/edit')->name('manager_edit');
//管理员删除
Route::post('manager/delete$','admin/Manager/delete')->name('manager_del');
//管理员头像上传
//Route::post('manager/upload$','admin/Manager/upload_img')->name('manager_img');

//角色列表
Route::get('admin/role$','admin/Role/lst')->name('role_list');
//角色添加
Route::get('admin/role/add$','admin/Role/add')->name('role_add');
//角色保存
Route::get('admin/role/save$','admin/Role/save')->name('role_save');
//角色删除
Route::post('admin/role/delete$','admin/Role/delete')->name('role_del');

//等级列表
Route::get('admin/grade$','admin/Grade/lst')->name('grade_list');
//等级添加
Route::get('admin/grade/add$','admin/Grade/add')->name('grade_add');
//等级保存
Route::get('admin/grade/save$','admin/Grade/save')->name('grade_save');
//等级删除
Route::post('admin/grade/delete$','admin/Grade/delete')->name('grade_del');

//菜单列表
Route::get('admin/menu$','admin/Menu/index')->name('menu_index');
//菜单保存
Route::post('admin/menu$','admin/Menu/save')->name('menu_save');


//网站设置显示
Route::get('site/list$','admin/Site/index')->name('site_index');
//网站设置保存
Route::post('site/save$','admin/Site/save')->name('site_save');

//其他-积分管理列表
Route::get('points/list$','admin/Points/lst')->name('points_list');
Route::get('points/add$','admin/Points/add')->name('points_add');
Route::get('points/save$','admin/Points/save')->name('points_save');
Route::get('points/delete$','admin/Points/delete')->name('points_del');