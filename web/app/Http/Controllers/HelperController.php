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
use Illuminate\Support\Facades\Validator;

class HelperController extends Controller
{
    public function refereshCapcha()
    {
        return captcha_img();
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
        $rules = ['captcha' => 'captcha'];
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