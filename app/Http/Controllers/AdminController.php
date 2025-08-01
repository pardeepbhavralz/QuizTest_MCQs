<?php

namespace App\Http\Controllers;

use App\Models\Register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
                'success' => 'Register Successful! OTP Matched.',
                Session::put('email', $matchOTP->email)
            ]);
        } else {
            return back()->with('error', 'OTP is not correct');
        }
    }


    function registersubmit(Request $request)
    {
        $fileName = $request->file('image')->store('profile_images', 'public');

        // Save the relative path to the database

        // $path = $request->file('image')->store('public');

        // $fileNameArray = explode("/" , $path);
        // $fileName = $fileNameArray[1];
        // dd( $fileName);
        // Create a timestamped filename
        // $timestamp = now()->format('Ymd_His');
        // $filename = 'image_' . $timestamp . '.' . $image->getClientOriginalExtension();


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
            'image' => 'required',
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
        $register->profileImage = $fileName;
        $register->address = $request->address;
        $register->country = $request->country;
        $register->city = $request->city;
        $register->otp = $otp;
        $register->save();

        MailController::sendMail($request->email, $otp);

        return redirect('otp-check')->with([
            'success' => 'Register Request sent to Admin!!',
            'email' => Session::put('email', $request->email)
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
                Session::put('email', $check->email);
                return redirect('user-dashboard')->with([
                    'success' => 'Login successfull!',

                ]);
            } else {
                Session::put('email', $check->email);
                return redirect('admin-dashboard')->with([
                    'success' => 'Login successfull!',
                ]);
            }
        }
    }

    function logout()
    {
        Session::flush();
        return redirect('admin-login');
    }



}
