<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
        'email' => ['required', 'string', 'email', 'max:255'],
        'password' => ['required', 'string', 'min:8'],
    ];

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, $this->rules);
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

        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
        {
            switch(Auth::user()->role){
                case 0:
                    return view('affilate.publisher.dashboard');
                    break;
                case 1:
                    return view('affilate.web.home');
                    break;
            }   

        }
    }
}
