<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ChangePassRequest extends FormRequest
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
            'password' => 'required',
            'passconf' => 'required|same:password'
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'Mật khẩu không được để trống!',
            'passconf.required' => 'Mật khẩu không được để trống!',
            'passconf.same' => 'Mật khẩu không khớp!',
        ];
    }
}
