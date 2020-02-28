<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAccountRequest extends FormRequest
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
            'account_name' => 'required',
            'password' => 'required',
            'social' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'account_name.required'=>'Tên đăng nhập không được để trống!',
            'password.required'=>'Mật khẩu không được để trống!',
            'social.required'=>'Vui lòng chọn mạng xã hội!',
        ];
    }
}
