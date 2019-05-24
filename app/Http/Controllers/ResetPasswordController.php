<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\PasswordReset;
use App\Notifications\ResetPasswordRequest;
use Hash;

class ResetPasswordController extends Controller
{
    public function checkEmail(Request $request) {
        $email = $_POST['postMail'];
        $user = User::where('email',$email)->get();
        if (count($user) == 0) {
            return response()->json(['error' => 'Email không tồn tài']);
        } 
        return response()->json(['message' => 'success']);
    
    }
    
    

    public function sendMail(Request $request){
        $user = User::where('email',$request->email)->firstOrFail();
        $passwordReset = PassWordReset::updateOrCreate([
            'email' => $user->email,
        ],[
            'token' => Str::random(60),
        ]);
        if($passwordReset){
            $user->notify(new ResetPasswordRequest($passwordReset->token));
        }
        return redirect('login')->with([
            'message' => 'Chúng tôi đã gửi mail thay đổi mật khẩu, vui lòng kiểm tra mail', 
            'text-alert' => 'alert-success'
        ]);
    }

        public function reset(Request $request, $token)
        {
            $validator = $request->validate([
                'password'        => 'bail|required|min:8',
                'repeat-password' => 'bail|required|same:password',
            ]);
           
            $passwordReset = PasswordReset::where('token', $token)->firstOrFail();
           
            if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
                $passwordReset->delete();

                return redirect('login')->with([
                    'message' => 'This password reset token is invalid.',
                ], 422);
            }
            $user = User::where('email', $passwordReset->email)->firstOrFail();
            $user->password = Hash::make($request->password);
            $user->save();
           
            $passwordReset->delete();

            return redirect('login')->with([
                'message' => 'Change Password complete',
                'text-alert' => 'alert-success'
            ]);
            

            
        }
        public function getFormReset(Request $request){
            if ($request->has('token')) {
                 return view('affilate.forgetpass',['token'=>$request->token]);
            }
           
        }
}
