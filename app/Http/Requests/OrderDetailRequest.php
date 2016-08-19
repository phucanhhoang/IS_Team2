<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class OrderDetailRequest extends Request
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
            'product_id'    =>      'required',
            'color_id'  =>      'required',
            'size_id'   =>      'required',
            'quantity'       =>      'required|numeric'
        ];
    }

    /*public function message()
    {
        return [
            'pro_id.required'    =>      'Please choose product',
            'color_id.required'  =>      'Please choose color for the product',
            'size_id.required'   =>      'Please choose size for the product',
            'qty.required'       =>      'Please choose the quantity for the product',
            'qty.numeric'        =>      'The quantity must be a number'
        ];
    }*/
}
