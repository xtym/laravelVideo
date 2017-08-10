<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
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
        // TODO:: 添加标签不能重复验证规则
        return [
            'name' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required'          => '内容不能为空',

        ];
    }
}
