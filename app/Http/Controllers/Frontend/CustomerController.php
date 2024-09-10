<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\CustomerVerifyMail;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Order;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Validation\ValidationException;

class CustomerController extends Controller
{
    public function login()
    {
        return view('frontend.auth.login');
    }
    public function register()
    {
        return view('frontend.auth.register');
    }
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:customers',
            'password' => 'required',
            'conf_password' => 'required|same:password',
        ], [
            'conf_password.same' => 'Password and Confirm password should be same',
            'conf_password.required' => 'The Confirm password field is required'
        ]);
        $customer = Customer::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'password'   => Hash::make($request->password)
        ]);
        Mail::to($customer->email)->send(new CustomerVerifyMail($customer));
        return redirect()->route('customer.login')->with('verify', 'An account created successfully , We have sent you a verification mail');
    }
    public function authenticate(Request $request)
    {
        $request->validate([
            'email'    => 'required',
            'password' => 'required'
        ]);
        $cust = Customer::where('email', $request->email)->first();
        if (is_null($cust) || $cust->password == '') {
            return back()->with('danger', 'Account Not found');
        }
        $attempt = Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password]);
        if ($attempt) {
            $customer = Auth::guard('customer')->user();

            $this->updateCart();

            $intendedUrl = Session::get('url.intended');
            $profile = route('customer.profile');
            return redirect()->intended($intendedUrl ?? $profile);
        }

        throw ValidationException::withMessages([
            'email' => trans('auth.failed'),
        ]);
    }
    public function profile()
    {
        $customer = auth('customer')->user();
        return view('frontend.customer.profile', compact('customer'));
    }

    public function address()
    {
        $customer = auth('customer')->user();
        return view('frontend.customer.addresses', compact('customer'));
    }
    public function addAddress()
    {
        return view('frontend.customer.add-address');
    }
    public function orders()
    {
        $customer = auth('customer')->user();
        return view('frontend.customer.orders', compact('customer'));
    }
    public function storeAddress(Request $request)
    {
        $customer = auth('customer')->user();
        $request->validate([
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required',
            'phone'      => 'required',
            'address'    => 'required',
            'state'      => 'required',
            'city'       => 'required',
            'pincode'    => 'required',
        ]);
        Address::create([
            'customer_id' => $customer->id,
            'first_name'  => $request->first_name,
            'last_name'   => $request->last_name,
            'email'       => $request->email,
            'phone'       => $request->phone,
            'address'     => $request->address,
            'state'       => $request->state,
            'city'        => $request->city,
            'pincode'     => $request->pincode,
        ]);
        return redirect()->route('customer.address');
    }

    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect('/');
    }
    public function reset(Request $request)
    {
        $request->validate([
            'new_password' => 'required',
            'conf_password' => 'required|same:new_password',
        ], ['conf_password.same' => 'Password and confirm password should same']);
        $customer = auth('customer')->user();
        $customer->update([
            'password' => Hash::make($request->new_password)
        ]);
        return back()->with('message', 'Password reseted successfully');
    }
    public function update(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
        ]);
        $customer = auth('customer')->user();
        $customer->update($request->all());
        return back()->with('message', 'Profile updated successfully');
    }
    public function verify()
    {
        return view('frontend.auth.email-verify');
    }
    public function sendVerifyMail()
    {
        $customer = auth('customer')->user();
        Mail::to($customer->email)->send(new CustomerVerifyMail($customer));
        return back()->with('message', 'Verification mail sent successfully');
    }
    public function verifyEmail(Request $request)
    {
        $customer = Customer::where('email', $request->email)->first();
        $customer->email_verified_at = Carbon::now();
        $customer->save();
        return redirect()->route('customer.login');
    }
    public function orderDetails($id)
    {
        $order = Order::find($id);
        return view('frontend.customer.order-details', compact('order'));
    }



    public function updateCart()
    {
        $customer = auth('customer')->user();
        $cart_id = session('cart_id');

        if (!is_null($cart_id)) {

            $cart = Cart::find($cart_id);
            // dd($cart,$customer->cart);
            //check if customer has already cart
            if ($customer->cart) {
                //load session cart and add it to customer cart id
                foreach ($cart->items as $item) {

                    app(CartController::class)->cartItemCreate($customer->cart, $item->product_id, $item->quantity);

                    //delete cart item of session
                    app(CartController::class)->destroy($item->id);
                }
                //update cart total 
                $customer->cart()->update([
                    'items_qty'       => $customer->cart->items_qty + $cart->items_qty,
                    'total_amount'    => $customer->cart->total_amount + $cart->total_amount,
                    'tax_total'       => $customer->cart->tax_total + $cart->tax_total,
                    'discount_amount' => $customer->cart->discount_amount + $cart->discount_amount,
                    'grand_total'     => $customer->cart->grand_total + $cart->grand_total,
                    'coupon_code'     => $cart->coupon_code,
                ]);

                //delete session cart
                $cart->delete();
            } else {
                $cart->update([
                    'customer_id' => $customer->id,
                    'first_name' => $customer->name,
                    'last_name' => $customer->name,
                    'email' => $customer->email,
                    'phone' => $customer->phone,
                ]);
            }

            app(CartController::class)->calculateTotal($cart_id);

            //clear the session
            session()->forget('cart_id');
        }
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $customer = Customer::where('email', $user->email)->first();

            if ($customer) {
                $customer->update(['email_verified_at' => Carbon::now()]);
                Auth::guard('customer')->login($customer);
                $this->updateCart();

                $intendedUrl = Session::get('url.intended');
                $profile = route('customer.profile');
                return redirect()->intended($intendedUrl ?? $profile);
            } else {
                Customer::create([
                    'first_name' => $user->user['given_name'],
                    'last_name' => $user->user['family_name'],
                    'email' => $user->email,
                    'email_verified_at' => Carbon::now()
                ]);
                $customer = Customer::where('email', $user->email)->first();
                Auth::guard('customer')->login($customer);
                $this->updateCart();
                return redirect()->route('customer.profile');
            }
        } catch (Exception $e) {
            // dd($e);
            return redirect('auth/google');
        }
    }
}
