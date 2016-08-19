<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CusRequest extends Request
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
            'phone' => 'required|digits_between:10,11|unique:customers',
            'province' => 'required',
            'district' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:customers',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập họ tên',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.digits_between' => 'Số điện thoại phải từ 10 đến 11 chữ số',
            'phone.unique' => 'Số điện thoại đã tồn tại',
            'province.required' => 'Vui lòng chọn tỉnh thành',
            'district.required' => 'Vui lòng chọn quận huyện',
            'address.required' => 'Vui lòng nhập địa chỉ nhận hàng',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'E-mail sai định dạng',
            'email.unique' => 'E-mail đã tồn tại'
        ];
    }

}
