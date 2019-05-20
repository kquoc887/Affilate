<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Models\PasswordReset;
use App\Notifications\ResetPasswordRequest;

class ResetPasswordController extends Controller
{
    public function sendEmail(Request $request){
        $user = User::where('email',$request->email)->firstOrFail();
        $passwordReset = PassWordReset::updateOrCreate([
            'email' => $user->email,
        ],[
            'token' => Str::random(60),
        ]);
        if($passwordReset){
            $user->notify(new ResetPasswordRequest($passwordReset->token));
        }
        return response()->json([
            'message' => 'We have emailed your password reset link!'
        ]);
    }

}
