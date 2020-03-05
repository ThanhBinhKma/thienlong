<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
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
            'name_member'=>'required',
            'position'=>'required',
            'thumbnail'=>'required',
        ];
    }
    public function messages() {
        return [
            'name_member.required'=>'Tên không được để trống ',
            'position.required'=>' Vị trí không được để trống ',
            'thumbnail.required'=>"Avatar không được để trống ",
        ];
    }
}
