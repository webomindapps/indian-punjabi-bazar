<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class CustomerEmailIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $customer = auth('customer')->user();
        if ($customer->email_verified_at) {
            return $next($request);
        } else {
            return redirect()->route('customer.verify')->with('message', "Verify your email account first");
            // return Redirect::guest(URL::route('verification.notice'));
            // Auth::guard('customer')->logout();
            // return redirect()->route('customer.login')->with('message', "Verify your email account first");
        }
    }
}
