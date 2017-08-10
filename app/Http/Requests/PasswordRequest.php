<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Validator;
use Hash;
use Auth;

class PasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     *
     * 如果自己出来验证是否授权 ,修改为 true
     * 验证是否登陆
     * false 进行验证
     * 因为在中间件中进行了登陆验证 所有这里就不用验证了
     *
     * false 修改为 true
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // 使用自定义密码验证器
        $this->passwordValidator();

        return [
            // 验证原密码
            // 验证原密码是否登陆 需要自定义验证规则
            'old_password' => 'sometimes|required|check_password',
            // 验证新密码
            'password' => 'sometimes|required|confirmed',
            // 验证 确认密码
            'password_confirmation' => 'sometimes|required'
        ];
    }

    public function messages()
    {
        return [
            'old_password.required'          => '原密码不能为空',
            'old_password.check_password'    => '原密码错误',
            'password.required'              => '新密码不能为空',
            'password.confirmed'             => '两次密码不一致',
            'password_confirmation.required' => '确认密码不能为空',
        ];
    }

    /**
     *  自定义密码验证器
     */
    public function passwordValidator(){
        // 扩展验证规则
        Validator::extend('check_password',function ($attribute, $value, $parameters, $validator){
            // 密码比对 ,如果正确返回true 失败返回false
            // $value 用户输入的原密码
            return Hash::check($value,Auth::guard('admin')->user()->password);
        });
    }
}
