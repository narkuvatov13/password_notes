<?php

namespace App\Http\Controllers;

use App\Mail\PasswordForgetEmail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class PasswordForgetController extends Controller
{
    //

    public function index()
    {
        return view('auth.forgot-password');
    }


    public function update(Request $request)
    {

        $user = User::where('email', $request->email)->first();
        // dd($request->email);

        // Random Password and hashing
        $newPassword = Str::password();
        $hashPassword = Hash::make($newPassword);


        $toEmail = $request->email;
        $message = "Your New Password:   " . $newPassword;
        $subject = 'Reset Password';

        $user->password = $hashPassword;
        $user->save();

        Mail::to($toEmail)->send(new PasswordForgetEmail($message, $subject));

        session()->flash('passwordForgot', __('Reset Password Successfull Check in Mail'));

        return redirect()->route('login');
    }
}
