<?php
/**
 * Created by IntelliJ IDEA.
 * User: Phuc Anh Hoang
 * Date: 7/8/2016
 * Time: 10:34 AM
 */

namespace App\Http\Controllers;


use App\Helper\HelperFunction;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Customer;
use Illuminate\Support\Facades\Validator;
use App\Product;
use DB;

class HelperController extends Controller
{
    public function refereshCapcha()
    {
        return captcha_img();
    }

    public function checkPhone(Request $request){
        $count = Customer::where('phone', '=', $request->phone)->count();
        if ($count > 0) {
            echo 'false';
        } else
            echo 'true';
    }

    public function checkEmail(Request $request){
        $email = $request->email;
        $count = Customer::where('email', '=', $email)->count();
        if ($count > 0) {
            echo 'false';
        } else
            echo 'true';
    }

    public function checkCaptcha(Request $request){
        $rules = ['captcha' => 'required|captcha'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
        {
            echo 'false';
        }
        else
        {
            echo 'true';
        }
    }

    public function getTags(){
        $prods = Product::select('pro_name')->get();

        $data = array();
        foreach ($prods as $prod) {
            array_push($data, $prod->pro_name);
        }

        return $data;
    }

    public function search(Request $request, HelperFunction $helper)
    {
        $keyword = $request->keyword;
        $pros = Product::where('pro_name', 'like', '%'. $keyword .'%')->get();

        return view('pages.result-search', compact('keyword', 'pros'));
    }

    public function getDistrict(Request $request){
        $districts = DB::table('districts')->where('province_id', $request->province_id)->get();

        return $districts;
    }
}