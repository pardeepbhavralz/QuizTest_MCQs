<?php

namespace App\Http\Controllers;

use App\Models\Register;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function register()
    {
        return view('register-form');
    }
    function adminlogin()
    {
        return view('admin-login');
    }

    function otp()
    {
        return view('otp-check');
    }

    function otpSubmit(Request $request)
    {
        $matchOTP = Register::where('otp', $request->otp)
            ->first();

        if ($matchOTP) {
            return redirect('user-dashboard')->with([
                'success' => 'Register Successful! OTP Matched.'
            ]);
        } else {
            return back()->with('error', 'OTP is not correct');
        }
    }


    function registersubmit(Request $request)
    {

        $randomInt = rand(1, 10000);
        $randomAlphabet = chr(rand(65, 90));
        $otp = $randomInt . $randomAlphabet;

        // dd($request->all()); 
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'confirmPassword' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'country' => 'required',
            'city' => 'required'
        ]);

        $register = new Register();
        $register->name = $request->name;
        $register->email = $request->email;
        $register->password = $request->password;
        $register->confirmPassword = $request->confirmPassword;
        $register->phone = $request->phone;
        $register->address = $request->address;
        $register->country = $request->country;
        $register->city = $request->city;
        $register->otp = $otp;
        $register->save();

        return redirect('otp-check')->with([
            'success' => 'Register Request sent to Admin!!',
            'email' => $request->email
        ]);

    }

    function adminSubmit(Request $request)
    {
        //  dd($request->all());   
        $email = $request->email;
        $password = $request->password;

        $check = Register::where('email', $email)->where('password', $password)->first();

        if ($check) {
            if ($check->role == 1) {
                return redirect('user-dashboard')->with([
                    'success' => 'Login successfull!',
                    'email' => $email
                ]);
            } else {
                return redirect('admin-dashboard')->with([
                    'success' => 'Login successfull!',
                    'email' => $email
                ]);
            }

        }

    }



}
