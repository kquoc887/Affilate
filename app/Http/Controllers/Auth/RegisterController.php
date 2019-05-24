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
use Dirape\Token\Token;

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

    // regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/'
    private $rules = [     
        'email'     => ['required', 'string','email', 'max:255', 'unique:tbl_users'],
        'password'  => ['required', 'string', 'min:8'],
        'repass'    => ['required', 'string', 'min:8','same:password'],
        'firstname' => ['required', 'string', 'max:255'],
        'lastname'  => ['required', 'string', 'max:255'],
        'address'   => ['required', 'string', 'max:255'],
        'uri'       => ['required', 'string', 'max:255'],
        'phone'     => ['required', 'min:10'],
    ];

    private $message = [
        'email.required'        => 'Vui lòng nhập email',
        'password.required'     => 'Vui lòng nhập mật khẩu',
        'password.min'          => 'Mật khẩu phải có tối thiểu 8 ký tự',
        'repass.required'       => 'vui lòng nhập lại mật khẩu',
        'repass.same'           => 'Mật khẩu nhập lại chưa khớp',
        'firstname.required'    => 'Vui lòng nhập tên',
        'lastname.required'     => 'Vui lòng nhập họ và tên đệm',
        'address.required'      => 'Vui lòng nhập địa chỉ',
        'uri.required'          => 'Vui lòng nhập vào đường dẫn web',
        'phone.required'        => 'Vui lòng nhập vào điện thoại'
        


    ];
    /**
     * Where to redirect users after registration.
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
        // $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, $this->rules, $this->message);
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
            $this->message = array_merge(array('company_name.required' => 'Vui lòng nhập tên công ty'), $this->message);
            $validator = $this->validator($data->all());
        
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }

            tbl_org::create([
                'org_name'    => $data['company_name'],
                'org_email'   => $data['email'],
                'org_uri'     => $data['uri'],
                'org_address' => $data['address'],
                'org_phone'   => $data['phone'],
                'org_token'   => (new Token())->Unique('tbl_org', 'org_token', 60),
                'created_at'  => new DateTime(),
                'updated_at'  => new DateTime(),

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
                'remember_token' => $data['_token'],
                'role' => $role,
                'created_at'=> new DateTime(),
                'updated_at'=> new DateTime(),
            ]);

        // Bắt sự kiện gửi mail
        event(new NewUser($user));
    
        return response()->json(['success' => 'success'], 200);
    }
}
