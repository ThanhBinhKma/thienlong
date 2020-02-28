<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryFormRequest extends FormRequest
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
      'title' => 'required|max:255',
      'status' =>'required',
    ];
  }

  public function messages()
  {
    return [
      'title.required' => 'Vui lòng nhập tiêu đề bài viết',
      'title.max' => 'Tiêu đề tối da 255 ký tự',
      'status.required' => 'Vui lòng chọn trạng thái',
    ];
  }
}
