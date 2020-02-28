<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ScreenFormRequest extends FormRequest
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
            'title' => 'required|max:255|unique:screen,name',
            'status' =>'required',

        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Vui lòng nhập tên màn hình',
            'title.unique' => ' màn hình đã tồn tại',
            'title.max' => 'tên mành hình da 255 ký tự',
            'status.required' => 'Vui lòng chọn trạng thái màn hinh',
            ];
    }
}
