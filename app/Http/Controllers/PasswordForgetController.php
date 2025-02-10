<?php

namespace App\Http\Controllers;

use App\Mail\PasswordForgetEmail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

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
        $toEmail = 'diyorbek.yusup@gmail.com';
        $message = "TEst Message";
        $subject = 'Password Reset';

        $req = Mail::to('diyorbek.yusup@gmail.com')->send(new PasswordForgetEmail($message, $subject));
        dd($req);
    }
}
