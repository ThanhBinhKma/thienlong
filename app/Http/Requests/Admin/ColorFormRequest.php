<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ColorFormRequest extends FormRequest
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
            'title' => 'required|max:255|unique:color,name',
            'status' =>'required',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Vui lòng nhập mầu sắc',
            'title.unique' => ' mầu sắc đã tồn tại',
            'title.max' => 'mầu sắc tối da 255 ký tự',
            'status.required' => 'Vui lòng chọn trạng thái mầu sắc',
    }
}
