<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CheckoutRequest extends Request
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
            'name' => 'required',
            'phone' => 'required|digits_between:10,11',
            'email' => 'required|email|unique:users,email',
            'address' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập họ tên',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.digits_between' => 'Số điện thoại phải từ 10 đến 11 chữ số',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email sai định dạng',
            'email.unique' => 'Email đã tồn tại',
            'address.required' => 'Vui lòng nhập địa chỉ nhận hàng'
        ];
    }

}
