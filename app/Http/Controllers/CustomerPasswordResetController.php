<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPasswordMail;
use App\Models\Customer;
use App\Models\CustomerPasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CustomerPasswordResetController extends Controller
{
    public function forgetView()
    {
        return view('frontend.auth.forgot-password');
    }
    public function forgetMail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:customers',
        ]);
        $email = $request->email;
        $token = Str::random(64);
        CustomerPasswordReset::create([
            'email' => $email,
            'token' => $token,
        ]);
        $customer = Customer::where('email', $email)->first();
        Mail::to($email)->send(new ForgotPasswordMail($customer, $token));
        return back()->with('message', 'Password reset mail sent to your email address');
    }
    public function resetView($token)
    {
        return view('frontend.auth.reset-password', compact('token'));
    }
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:customers',
            'password' => 'required',
            'password_conf' => 'required|same:password'
        ], [
            'password_conf.same' => 'Password and confirm password should be same',
            'password_conf.required' => 'Confirm password field is required',
        ]);
        $token = CustomerPasswordReset::where('token', $request->reset_token)->first();

        if (is_null($token)) {
            return back()->with('error', 'Token mismatch');
        } else {
            $customer = Customer::where('email', $request->email)->first();
            $customer->update([
                'password' => Hash::make($request->password)
            ]);
        }
        return redirect()->route('customer.login')->with('message', 'Password reseted successfully');
    }
}
