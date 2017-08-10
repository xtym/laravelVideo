<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordRequest;
use Request;

/**
 * 后台控制器
 * Class Entry
 * @package App\Http\Controllers\Admin
 */
class Entry extends Controller
{
    //后台首页
    public function index(){
        return view('admin.entry.index');
    }

    // 后台登录
    public function login(){
        if(IS_POST){
            // 将登陆操作 较高admin的guard守卫操作验证
            // 因为默认是 web ,所有要指定guard
            $status = \Auth::guard('admin')->attempt([
                'name' => Request::input('name'),
                'password' => Request::input('password'),
            ]);

            // $status 为真 登陆成功 跳转到后台首页
            if ($status){
                return redirect('/admin/index');
            }
            // $status为假 提示消息 登陆失败 闪存
            return redirect('/admin/login')->with('error','用户名或密码错误');
        }
       return view('admin.entry.login');
    }

    /**
     * 后台退出 注销
     */
    public function logout(){
        \Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }

    /**
     * 载入修改管理员密码的用户界面
     */
    public function changePassword(){
        return view('admin.entry.changepassword');
    }

    /**
     * 修改用户密码
     */
    public function password(PasswordRequest $request){
        // 获取用户信息
        $model = \Auth::guard('admin')->user();
        $model->password = bcrypt($request->input('password'));
        // 保存密码
        $model->save();
        // 调用页面中的bootstrap的模态框
        //调用页面的bootstrap的模块的框
        flash()->overlay('修改成功', '友情提示');
        return redirect('admin/changepassword');
    }

}
