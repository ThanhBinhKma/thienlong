<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PriceFormRequest extends FormRequest
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
            'title' => 'required|max:255|unique:price,name',
            'status' =>'required',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Vui lòng nhập khoảng  giá',
            'title.unique' => ' khoảng giá đã tồn tại',
            'title.max' => 'khoảng giá tối da 255 ký tự',
            'status.required' => 'Vui lòng chọn trạng thái khoảng g',
            ];
    }
}
