<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegisterRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
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
            'password' => 'required|confirmed|min:8',
            'phone' => 'required|digits_between:10,11',
            'email' => 'required|email|unique:users,email',
            'captcha' => 'required|captcha'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập họ tên',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.confirmed' => 'Mật khẩu chưa khớp',
            'password.min' => 'Mật khẩu phải từ 8 ký tự trở lên',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.digits_between' => 'Số điện thoại phải từ 10 đến 11 số',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email sai định dạng',
            'email.unique' => 'Email đã tồn tại',
            'captcha.required' => 'Vui lòng nhập Captcha',
            'captcha.captcha' => 'Vui lòng nhập đúng Captcha',
        ];
    }

}
