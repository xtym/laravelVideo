<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Admin extends User
{
    // 不需要记住登录
    // 因为remember_token没有设置TOkenName字段
    protected $rememberTokenName = '';
}
