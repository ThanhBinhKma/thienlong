<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEventRequest extends FormRequest
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
            'status'=>'required',
            'content'=>'required',
        ];
    }
    public function messages() {
        return [
            'title.required'=>'Tiêu đề được để trống ',
            'status.required'=>"trạng thái không được để trống ",
            'content.required'=>"nội dung không được để trống ",
        ];
    }
}
