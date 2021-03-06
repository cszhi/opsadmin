<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class MenuCreateFormRequest extends Request
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
            'slug' => 'required|string',
            'icon' => 'required|string',
            'url' => 'required|string',
            'sort' => 'required|integer',
            'description' => 'max:60'
        ];
    }

    public function attributes()
    {
        return [
            'name' => '名称',
            'slug' => '权限',
            'description' => '描述',
            'url' => '地址',
            'icon' => '图标',
            'sort' => '排序',
        ];
    }

    public function messages()
    {
        return [
            'name1.required' => 'Please provide a brief link description',
            //'url.required' => 'Please provide a URL',
            'url.url' => 'A valid URL is required',
            'category.required' => 'Please associate this link with a category',
            'category.min' => 'Please associate this link with a category'
        ];
    }
}
