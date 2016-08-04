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
            'pro_name' => 'required|unique:products',
            'pro_code' => 'required|unique:products',
            'cat_id' => 'required',
            'price' => 'required|numeric',
            'discount' => 'required|numeric',
            'image' => 'required|image',
            'full_des' => 'required|min:100',
            'size_id' => 'required|unique:prosizes',
            'color_id' => 'required|unique:images'
        ];
    }


}
