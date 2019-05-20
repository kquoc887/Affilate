<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use DateTime;
use App\tbl_org;
use App\Events\NewUser;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    private $rules = [     
        'email' => ['required', 'string', 'email', 'max:255', 'unique:tbl_users'],
        'password' => ['required', 'string', 'min:8'],
        'repass' => ['required', 'string', 'min:8','same:password'],
        'firstname' => ['required', 'string', 'max:255'],
        'lastname' => ['required', 'string', 'max:255'],
        'address' => ['required', 'string', 'max:255'],
        'uri' => ['required', 'string', 'max:255'],
        'phone' => ['required', 'min:10'],
    ];
    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, $this->rules);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(Request $data)
    {

        $role = 0;
        if(isset($data['company_name']))


        if(isset($data['company_name'])) {
            
            $this->rules = array_merge(array('company_name' => 'required'), $this->rules);
            $validator = $this->validator($data->all());
        
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }

            tbl_org::create([
                'org_name'    => $data['company_name'],
                'org_email'   => $data['email'],
                'org_address' => $data['address'],
                'org_phone'   => $data['phone'],
                'created_at'=> new DateTime(),
                'updated_at'=> new DateTime(),
            ]);

             $role = 1;
        }
        

        $validator = $this->validator($data->all());
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }


        $user = User::create([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname'],
                'gender' => $data['gender'],
                'address' => $data['address'],
                'phone'=>$data['phone'],
                'uri' => $data['uri'],
                'token' => $data['_token'],
                'role' => $role,
                'created_at'=> new DateTime(),
                'updated_at'=> new DateTime(),
            ]);

        // Bắt sự kiện gửi mail
        event(new NewUser($user));

        return response()->json(['success' => 'Đăng ký thành công vui lòng kiểm mail để kích hoạt']);
    }
}
