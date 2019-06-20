<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class paymentOrdersPost extends FormRequest
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
            'username'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'address'=>'required'
        ];
    }

    public function messages()
    {
        // thông báo lỗi ra ngoài form
        return[
            'username.required'=>':attribute không được để trống',
            'email.required'=>':attribute không được để trống',
            'email.email'=>':attribute không hợp lệ',
            'phone.required'=>':attribute không được để trống',
            'address.required'=>':attribute không được để trống',
        ];
    }
}
