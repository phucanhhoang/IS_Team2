<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mailers\AppMailer;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Validator;
use Illuminate\Http\Request;
use DB;
use App\Customer;
use Hash;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function getEmail(){
        return view('auth.passwords.email');
    }

    public function postEmail(Request $request, AppMailer $mailer){
        $rules = [
            'email' => 'required|email',
        ];
        $messages = [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email sai định dạng',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()){
            return redirect()->route('getEmail')->withErrors($validator);
        }
        else{
            $count = Customer::where('email', $request->email)->count();
            if(!$count > 0){
                return redirect()->route('getEmail')->withErrors('email', 'E-mail không chính xác');
            }
            else{
                $token = str_random(50);
                $date = new \DateTime();
                $email_reset = DB::table('password_resets')->where('email', $request->email);
                if($email_reset->count() > 0){
                    $check = $email_reset->update(
                        ['token' => $token, 'created_at' => $date]
                    );
                }
                else{
                    $check = DB::table('password_resets')->insert(
                        ['email' => $request->email, 'token' => $token, 'created_at' => $date]
                    );
                }
                if($check) {
                    $data = array(
                        'token' => $token,
                        'email' => $request->email
                    );
//                    $mailer->sendEmailConfirmationTo($request->email, 'Reset your password Stylitics Account', 'auth.emails.password', $data);
                    $announce = array(
                        'tit' => 'Quên mật khẩu',
                        'msg' => 'Vui lòng kiểm tra email và làm theo hướng dẫn.'
                    );
                    return view('pages.announce', compact('announce'));
                }
                else{
                    $announce = array(
                        'tit' => 'Quên mật khẩu',
                        'msg' => 'Có lỗi xảy ra. Vui lòng thử lại sau!'
                    );
                    return view('pages.announce', compact('announce'));
                }
            }
        }
    }

    public function getResetForm($token){
        $email = $_GET['email'];
        $count = DB::table('password_resets')->where('email', $email)->where('token', $token)->count();
        if($count > 0){
            return view('auth.passwords.reset', compact('email', 'token'));
        }
        else
            return view('errors.404');
    }

    public function postResetForm(Request $request){
        $rules = [
            'password' => 'required|confirmed|min:8',
        ];
        $messages = [
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.confirmed' => 'Mật khẩu chưa khớp',
            'password.min' => 'Mật khẩu phải từ 8 ký tự trở lên',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()){
            return redirect()->away($request->rtn_url)->withErrors($validator);
        }
        else{
            $cus = Customer::where('email', $request->email)->first();
            if($cus != null){
                $cus->password = Hash::make($request->password);
                $check = $cus->save();
                if($check){
                    $data['openLoginModal'] = true;
                    return redirect('/')
                        ->with('message', 'Đổi mật khẩu thành công.')
                        ->withInput($data);
                }
            }

            return redirect()->away($request->rtn_url)->withErrors("Có lỗi xảy ra. Vui lòng thử lại sau!");
        }
    }
}
