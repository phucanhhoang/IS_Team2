<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use App\SocialAccount;
use App\Customer;
use App\Http\Requests\LoginRequest;
use App\Mailers\AppMailer;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Mail;
use Socialite;
use Hash;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function getLogin(){
        return view('auth.login');
    }

    public function postLogin(LoginRequest $request)
    {
        // create our user data for the authentication
        $userdata = array(
            'email' => $request->email,
            'password' => $request->password,
        );
        $chkRemember = $request->chkRemember;
        if ($chkRemember == 'on')
            $r = true;
        else
            $r = false;

        if (\Auth::attempt($userdata, $r)) {
            if (\Auth::user()->userable_type == 'customer') {
                if($request->rtn_url) {
                    if (\Auth::user()->activated == 1) {
                        return redirect()->away($request->rtn_url);
                    } else {
                        \Auth::logout();
                        $data['openLoginModal'] = true;
                        return redirect()->away($request->rtn_url)
                            ->with('message', 'Tài khoản của bạn chưa được kích hoạt!')
                            ->withInput($data);
                    }
                } else {
                    return redirect('/');
                }
            } else if (\Auth::user()->userable_type == 'admin'){
                if (\Auth::user()->banned == 0 && \Auth::user()->deleted == 0) {
                    return redirect('/admin/home');
                } else {
                    \Auth::logout();
                    return redirect()->away($request->rtn_url)
                        ->with('message', 'Xin lỗi! Tài khoản của bạn đang bị khóa.')
                        ->with('alert-class', 'alert-warning')
                        ->with('fa-class', 'fa-warning');
                }
            }
        } else {
            $data['openLoginModal'] = true;
            return redirect()->away($request->rtn_url)
                ->with('message', 'E-mail hoặc mật khẩu không chính xác.')
                ->withInput($data);
        }
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
            $userfb = Socialite::driver('facebook')->user();
            $user = User::where('email', $userfb->email)->first();
            if ($user) {
                \Auth::loginUsingId($user->id);
                return redirect('home');
            } else {
                $customer = new Customer;
                $customer->name = $userfb->name;
                $check = $customer->save();

                if ($check) {
                    $user = new User;
                    $user->email = $userfb->email;
                    $user->userable_id = $customer->id;
                    $user->userable_type = 'customer';
                    $user->remember_token = csrf_token();
                    $check = $user->save();
                }
                if ($check) {
                    \Auth::loginUsingId($user->id);
                    return redirect('home');
                }
            }

        } catch (\Exception $e) {
            return redirect('auth/facebook');
        }
    }

    public function logout()
    {
        if(\Auth::user()->userable_type == 'admin'){
            $re_path = '/admin/auth/login';
        }
        else{
            $re_path = '/';
        }
        \Auth::logout();
        return redirect($re_path);
    }
    public function logoutAdmin()
    {
        \Auth::logout();
        return redirect()->route('getLoginAdmin');
    }

    public function getRegister()
    {
        return view('auth.register');
    }

    public function postRegister(Request $request, AppMailer $mailer)
    {
        $rules = [
            'name' => 'required',
            'password' => 'required|confirmed|min:8',
            'phone' => 'required|digits_between:10,11',
            'email' => 'required|email|unique:users,email',
            'captcha' => 'required|captcha'
        ];
        $messages = [
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
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails())
        {
            $data['openRegisterModal'] = true;
            return redirect()->away($request->rtn_url)
                ->withInput($data)->withErrors($validator);
        }
        else
        {
            try {
                $customer = new Customer;
                $customer->name = $request->name;
                $customer->phone = $request->phone;
                $check = $customer->save();

                if ($check) {
                    $confirmation_code = str_random(50);
                    $user = new User;
                    $user->password = Hash::make($request->password);
                    $user->email = $request->email;
                    $user->remember_token = $request->_token;
                    $user->userable_id = $customer->id;
                    $user->userable_type = 'customer';
                    $user->confirmation_code = $confirmation_code;
                    $check = $user->save();
                }

                if ($check) {
                    $data = array(
                        'confirmation_code' => $confirmation_code
                    );
                    $mailer->sendEmailConfirmationTo($user->email, 'Verify your Stylitics Account', 'emails.verify', $data);
                    $email = $user->email;
                    return view('pages.verify', compact('email'));
                } else {
                    return redirect()->away($request->rtn_url)
                        ->with('alert-class', 'alert-danger')
                        ->with('message', 'Đăng ký không thành công, vui lòng thử lại!')
                        ->with('fa-class', 'fa-ban');
                }
            } catch(\Exception $e){
                dd($e->getMessage());
            }
        }
    }

    public function sendMailVerify ($email, AppMailer $mailer) {
        $confirmation_code = str_random(50);
        $user = User::where('email', $email)->first();
        if($user) {
            $user->confirmation_code = $confirmation_code;
            $user->save();
            $data = array(
                'confirmation_code' => $confirmation_code
            );
            $mailer->sendEmailConfirmationTo($user->email, 'Verify your Stylitics Account', 'emails.verify', $data);

            return "Your email has been sent successfully";
        }
        else
            return 'false';
    }

    public function confirm($confirmation_code){
        $user = User::where('confirmation_code', $confirmation_code)->first();
        if( $user ){
            $user->activated = 1;
            $user->save();
            $data['openLoginModal'] = true;
            return redirect('/')->withInput($data);
        }
        else
            return view('errors.404');
    }
}
