<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterPost extends FormRequest
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
        return [
            'username' => 'bail|required|unique:admin_users,username',
            'nickname' => 'required|unique:admin_users,nickname',
            'email' => 'required|email',
            'password' => 'required|regex:/^(\w){6,16}$/',
            'repassword' => 'required|same:password'
        ];
    }

    public function messages()
    {
        return [
            'username.required' => '用户名不能为空！',
            'username.unique' => '用户已经存在！',
            'nickname.required' => '昵称不能为空！',
            'nickname.unique' => '昵称已经存在',
            'email.required' => '邮箱不能为空！',
            'email.email' => '邮箱格式不正确！',
            'password.required' => '密码不能为空！',
            'password.regex' => '密码需要6至16位',
            'repassword.required' => '确认密码不能为空！',
            'repassword.same' => '确认密码与密码不一致！'
        ];
    }

}
