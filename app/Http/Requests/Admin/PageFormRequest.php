<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PageFormRequest extends FormRequest
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
      'content' =>'required',
      'status' =>'required',
      'thumbnail' => 'nullable'
    ];
  }

  public function messages()
  {
    return [
      'title.required' => 'Vui lòng nhập tiêu đề bài viết',
      'title.max' => 'Tiêu đề tối da 255 ký tự',
      'content.required' => 'Vui lòng nhập nội dung',
      'status.required' => 'Vui lòng chọn trạng thái',
    ];
  }
}
