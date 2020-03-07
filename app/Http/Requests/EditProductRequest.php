<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProductRequest extends FormRequest
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
            'title'=>'required',
            'date'=>'required',
            'link'=>'required',
            'thumbnail'=>'required',
        ];
    }
    public function messages() {
        return [
            'title.required'=>'Tiêu đề  không được để trống ',
            'date.required'=>'Ngày không được để trống ',
            'link.required'=>"Đường dẫn không được để trống ",
            'link.thumbnail'=>"Hình ảnh  không được để trống ",

        ];
    }
}
