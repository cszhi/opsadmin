<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PersonUpdateFormRequest extends Request
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
            'email' => 'required|min:1|max:30|email|unique:users,email,' . $this->get('email') . ',email',
            'password' => 'confirmed|min:6',
        ];
    }

    // public function attributes()
    // {
    //     return [
            
    //     ];
    // }

    // public function messages()
    // {
    //     return [
            
    //     ];
    // }
}
