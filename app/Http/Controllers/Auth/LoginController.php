<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Cookie;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    private $rules = [     
        'email'     => ['required', 'string', 'email', 'max:255'],
        'password'  => ['required', 'string', 'min:8'],
    ];

    private $messages = [
        'email.required'    => 'Vui lòng nhập email',
        'email.email'       => 'Email nhập vào chưa đúng định dạng',
        'password.required' => 'Vui lòng nhập mật khẩu',
        'password.min' => 'Mật khẩu phải có thiểu 8 ký tự',

    ];

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, $this->rules, $this->messages);
    }


    public function checkLogin(Request $request) {

        if ($request->ajax()) {
            $data = [
                'email' => $request->post('email'),
                'password' => $request->post('password'),
            ];

            $validator = $this->validator($data);
           
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }
            
            return response()->json(['success' => 'ok']);
        }
      
    }

    public function postLogin(Request $request)
    {
        $remember   = (!empty($request->chkRemember)) ? true : false;
       
        if (Auth::attempt(['email'=>$request->email,'password'=>$request->password], $remember)) {
            $user = Auth::user();
            switch ($user->role) {
                case 0:
                    return redirect()->route('publisher.dashboard');
                    break;
                case 1:
                    return redirect()->route('home');
                    break;
            }   
        } 
        return redirect()->route('getLogin')->with(['message' => 'Email hoặc password bị sai', 'text-alert' => 'alert-danger']);
    }
    
    public function getLogout() {
        Auth::logout();
        return redirect()->route('getLogin');
    }
}
