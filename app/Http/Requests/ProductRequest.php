<?php 
namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProductRequest extends Request
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
            'pro_name' => 'required',
            'pro_code' => 'required|unique:products',
            'cat_id' => 'required',
            'price' => 'required|numeric',
            'discount' => 'required|numeric',
            'image' => 'required|mimes:jpeg,jpg,png',
            'full_des' => 'required|min:100',
            'sizes' => 'required',
            // 'colors' => 'required'
        ];
    }

    public function messages(){
        return [
            'pro_name.required' => 'Please enter the product name',
            'pro_code.required' => 'Please enter the product code',
            'pro_code.unique' => 'This product code has been existed!',
            'cat_id.required' => 'Please choose the category',
            'price.required' => 'Please enter the price',
            'price.numeric' => 'The price must be a number',
            'discount.required' => 'Please enter the discount',
            'discount.numeric' => 'The discount must be a number',
            'image.required' => 'Please choose the image',
            'image.image' => 'The images must be a file of type: jpeg, jpg, png.',
            'full_des.required' => 'Please enter the description',
            'full_des.min' => 'The description must be at least 100 letters',
            'size.required' => 'Please choose the size',
            'color.required' => 'Please choose the color',
        ];
    }


}
