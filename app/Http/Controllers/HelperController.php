<?php
/**
 * Created by IntelliJ IDEA.
 * User: Phuc Anh Hoang
 * Date: 7/8/2016
 * Time: 10:34 AM
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Customer;
use Illuminate\Support\Facades\Validator;
use App\Mailers\AppMailer;

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
        $count = User::where('email', '=', $email)->where('deleted', '=', 0)->count();
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


}