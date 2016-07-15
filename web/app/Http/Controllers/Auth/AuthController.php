<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use App\User;
use App\SocialAccount;
use App\Customer;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use App\Mailers\AppMailer;
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

    use AuthenticatesAndRegistersUsers;

    /**
     * Create a new authentication controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\Guard $auth
     * @param  \Illuminate\Contracts\Auth\Registrar $registrar
     * @return void
     */
    public function __construct(Guard $auth, Registrar $registrar)
    {
        $this->auth = $auth;
        $this->registrar = $registrar;

        $this->middleware('guest', ['except' => 'getLogout']);
    }

    public function getLogin()
    {
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

        if ($this->auth->attempt($userdata, $r)) {
            if ($this->auth->user()->userable_type == 'customer') {
                if ($this->auth->user()->banned == 0 && $this->auth->user()->deleted == 0) {
                    return redirect()->away($request->rtn_url);
                } else {
                    $this->auth->logout();
                    return redirect()->away($request->rtn_url)
                        ->with('message', 'Xin lỗi! Tài khoản của bạn đang bị khóa.')
                        ->with('alert-class', 'alert-warning')
                        ->with('fa-class', 'fa-warning');
                }
            } else if ($this->auth->user()->userable_type == 'admin')
                return redirect('/adpage');
            else {
                if ($this->auth->user()->banned == 0 && $this->auth->user()->deleted == 0) {
                    return redirect('/adpage');
                } else {
                    $this->auth->logout();
                    return redirect()->away($request->rtn_url)
                        ->with('message', 'Xin lỗi! Tài khoản của bạn đang bị khóa.')
                        ->with('alert-class', 'alert-warning')
                        ->with('fa-class', 'fa-warning');
                }
            }
        } else {
            $data['autoOpenModal'] = true;
            return redirect()->away($request->rtn_url)
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
            $social_acc = SocialAccount::where('provider', '=', 'facebook')
                ->where('provider_user_id', '=', $userfb->id)->get();
            if ($social_acc->count() > 0) {
                $this->auth->loginUsingId($social_acc[0]->user_id);
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
                    $social_acc = new SocialAccount();
                    $social_acc->user_id = $user->id;
                    $social_acc->provider_user_id = $userfb->id;
                    $social_acc->provider = 'facebook';
                    $check = $social_acc->save();
                }
                if ($check) {
                    $this->auth->loginUsingId($user->id);
                    return redirect('home');
                }
            }

        } catch (Exception $e) {
            return redirect('auth/facebook');
        }
    }

    public function logout()
    {
        $this->auth->logout();
        return redirect('/');
    }

    public function getRegister()
    {
        return view('auth.register');
    }

    public function postRegister(RegisterRequest $request, AppMailer $mailer)
    {
        $customer = new Customer;
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $check = $customer->save();

        if ($check) {
            $user = new User;
            $user->password = Hash::make($request->password);
            $user->email = $request->email;
            $user->remember_token = $request->_token;
            $user->userable_id = $customer->id;
            $user->userable_type = 'customer';
            $check = $user->save();
        }

        if ($check) {
            $mailer->sendEmailConfirmationTo();
            return redirect()->away($request->rtn_url)
                ->with('message', 'Đăng ký thành công!')
                ->with('alert-class', 'alert-success')
                ->with('fa-class', 'fa-check');
        } else {
            return redirect('auth/register')
                ->with('alert-class', 'alert-danger')
                ->with('message', 'Đăng ký không thành công, vui lòng thử lại!')
                ->with('fa-class', 'fa-ban');
        }
    }
}
