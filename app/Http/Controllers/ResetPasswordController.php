<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\PasswordReset;
use App\Notifications\ResetPasswordRequest;


class ResetPasswordController extends Controller
{
    
    
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
                'message' => 'We have emailed your password reset link please check your email'
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
            $user->password = $request->password;
            $user->save();
           
            $passwordReset->delete();

            return redirect('login')->with([
                'success' => 'Change Password complete'
            ]);
            

            
        }
        public function getFormReset($token){
            return view('affilate.forgetpass',['token'=>$token]);
        }
}
