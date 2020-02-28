<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FormCreateProduct extends FormRequest
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
            'name_product' => 'required',
            'category'=>'required',
            'brand'=>'required',
            'price'=>'required',
            'color'=>'required',
            'ram'=>'required',
            'hard'=>'required',
            'screen'=>'required',
            'cpu'=>'required',
            'cruise_gallery'=>'required',
            'price_product'=>'required|numeric',
            'sale_product'=>'required|numeric',
            'qty_product'=>'required|numeric',
            'description'=>'required',
            'thumbnail'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'name_product.required' => 'Tên sản phẩm không được để trống!',
            'category.required' => 'Vui lòng lựa chọn danh mục!',
            'brand.required' => 'Vui lòng lựa chọn nhãn hiệu!',
            'price.required' => 'Vui lòng lựa chọn mức giá!',
            'color.required' => 'Vui lòng lựa chọn màu sắc!',
            'ram.required' => 'Vui lòng lựa chọn loại ram!',
            'hard.required' => 'Vui lòng lựa chọn bộ nhớ!',
            'screen.required' => 'Vui lòng lựa chọn màn hình!',
            'cpu.required' => 'Vui lòng lựa chọn cpu!',
            'cruise_gallery.required' => 'Ảnh sản phẩm không được để trống!',
            'price_product.required' => 'Giá sản phẩm không được để trống!',
            'sale_product.required' => 'Sale sản phẩm không được để trống!',
            'qty_product.required' => 'Số lượng sản phẩm không được để trống!',
            'description.required' => 'Vui lòng mô tả sản phẩm!',
            'thumbnail.required' => 'Avatar sản phẩm không được để trống!',
            'price_product.numeric' => 'Vui lòng nhập đúng định dạng!',
            'sale_product.numeric' => 'Vui lòng nhập đúng định dạng!',
            'qty_product.numeric' => 'Vui lòng nhập đúng định dạng!',
         
        ];
    }
}
