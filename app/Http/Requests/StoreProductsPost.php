<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductsPost extends FormRequest
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
            'nameProduct'=>'required|unique:products,name_product|min:3',
            'cat'=>'required',
            'color'=>'required',
            'size'=>'required',
            'brands'=>'required|numeric',
            'price'=>'required|numeric',
            'qty'=>'required|numeric',
            'images'=>'required',
            'description'=>'required',
        ];
    }
    public function messages()
    {
        return[
            'nameProduct.required'=>':attribute không được để trống',
            'nameProduct.unique'=>':attribute đã tồn tại',
            'nameProduct.min'=>':attribute phải lớn hơn :min ký tự',
            'cat.required'=>':attribute không được để trống',
            'color.required'=>':attribute không được để trống',
            'size.required'=>':attribute không được để trống',
            'brands.required'=>':attribute không được để trống',
            'brands.numeric'=>':attribute phải là dữ liệu số',
            'price.required'=>':attribute không được để trống',
            'price.required'=>':attribute phải là dữ liệu số',
            'qty.required'=>':attribute không được để trống',
            'qty.numeric'=>':attribute phải là dữ liệu số',
            'images'=>':attribute không được để trống',
            'description'=>':attribute không được để trống',

        ];
    }
}
