<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BrandFormRequest extends FormRequest
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
            //
            'title' => 'required|max:255|unique:brand,name',
            'content' =>'required',

        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Vui lòng nhập thương hieu',
            'title.unique' => ' Thương hiệu đã tồn tai ',
            'title.max' => 'Thương hiệu tối da 255 ký tự',
            'content.required' => 'Vui lòng nhập mô ta',
        ];
    }
}
