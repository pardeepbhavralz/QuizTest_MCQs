<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterMail;

class MailController extends Controller
{
    // Mail sender
    static function sendMail($email , $otp)
    {
        $to = $email;
        $msg = $otp;
        $subject = "Mail";

        Mail::to($to)->send(new RegisterMail($msg , $subject));
        
    }
    
}
