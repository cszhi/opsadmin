<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RoleEditFormRequest extends Request
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
            'name' => 'required|min:1|max:30',
            'slug' => 'required|min:1|max:30|unique:roles,slug,'. $this->get('slug') . ',slug',
            'permission' => 'required',
            'description' => 'max:60'
        ];
    }

    public function attributes()
    {
        return [
            'name' => '角色名称',
            'slug' => '角色',
            'permission' => '权限',
            'description' => '描述'
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
