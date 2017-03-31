<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UsersCreateFormRequest extends Request
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
            'name' => 'required|min:1|max:30|unique:users',
            'email' => 'required|min:1|max:30|unique:users|email',
            'password' => 'required|confirmed|min:6',
            'role' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'name' => '用户名',
            'email' => '邮箱',
            'role' => '角色'
        ];
    }

    public function messages()
    {
        return [
            'name1.required' => 'Please provide a brief link description',
            'url.required' => 'Please provide a URL',
            'url.url' => 'A valid URL is required',
            'category.required' => 'Please associate this link with a category',
            'category.min' => 'Please associate this link with a category'
        ];
    }
}
