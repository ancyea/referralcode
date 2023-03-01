<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;


class MailController extends Controller
{
   
    public function index(Request $request)
    {
        $request->validate([
            'email' => 'required|email:rfc,dns'
         ]);
        $name =  Auth::user()->name;
        $referralcode = Auth::user()->newreferralcode;

        $details = [
            'title' => 'Mail from Referralcode.com',
            'body' => 'The referral code is '.$referralcode.' from '.$name.' for registration',
        ];
       
        \Mail::to($request->email)->send(new \App\Mail\MyMail($details));
    }

    public function mail()
    {
        return view('emails.sendmail');
    }
}
