<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\InvoiceMail;
use App\Models\Address;
use App\Models\Cart;
use App\Models\HomeSetting;
use App\Models\ProductInventory;
use App\Models\WishList;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function createOrder($address_id, $order_no)
    {
        DB::beginTransaction();
        try {
            $customer = auth('customer')->user();
            $cart = Cart::where('customer_id', $customer->id)->first();
            $grand_total = $cart->grand_total;
            if ($cart->price) {
                $grand_total += $cart->price;
            }
            $addess = Address::find($address_id);
            //create an order
            $order = $customer->orders()->create([
                'address_id' => $address_id,
                'first_name' => $addess->first_name,
                'last_name' => $addess->last_name,
                'email' => $addess->email,
                'phone' => $addess->phone,
                'shipping_method' => 'COD',
                'items_count' => count($cart->items),
                'items_qty' => $cart->items_qty,
                'total_amount' => $cart->total_amount,
                'tax_total' => $cart->tax_total,
                'tax' => $cart->tax,
                'discount_amount' => $cart->discount_amount,
                'grand_total' => $grand_total,
                'note' => $addess->note,
                'delivery_type' => $cart->type,
                'date' => $cart->date,
                'time' => $cart->time,
                'delivery_charge' => $cart->price ?? 0,
                'min_price' => $cart->min_price,
                'city' => $cart->city,
                'payment_id' => $order_no,
            ]);

            //create an order items 
            foreach ($cart->items as $key => $item) {
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'name' => $item->name,
                    'quantity' => $item->quantity,
                    'sku' => $item->sku,
                    'coupon_code' => $item->coupon_code,
                    'price' => $item->price,
                    'total_amount' => $item->total_amount,
                    'tax_percent' => $item->tax_percent,
                    'tax_amount' => $item->tax_amount
                ]);
                $inventory = ProductInventory::where('product_id', $item->product_id)->first();
                $remaining = $inventory->inventory - $item->quantity;
                $inventory->update(['inventory', $remaining]);
                $item->delete();
            }
            $cart->delete();
            DB::commit();
            $this->sendInvoice($order);
            return redirect()->route('booking.success', $order->id)->with('message', 'Your Order Successful');
        } catch (Exception $ex) {
            DB::rollBack();
            dd($ex);
        }

        //send order confirmation mail
        // event(new OrderCreatedEvent($order));
    }
    public function success($id)
    {
        return view('frontend.pages.thankyou', compact('id'));
    }
    public function addToWishlist(Request $request, $id)
    {
        $customer = Auth::guard('customer')->user();
        $exist = WishList::where('customer_id', $customer->id)->where('product_id', $id)->first();
        if ($exist) {
            $exist->delete();
            return back()->with('message', 'Item removed successfully');
        } else {
            $wishlist = WishList::create([
                'customer_id' => $customer->id,
                'product_id' => $id,
            ]);
            return back()->with('message', 'Item added successfully');
        }
    }
    public function wishlist()
    {
        $customer = Auth::guard('customer')->user();
        $wishlists = WishList::where('customer_id', $customer->id)->get();
        return view('frontend.customer.wish-list', compact('wishlists'));
    }
    public function removeFromWishlist($id)
    {
        wishlist::destroy($id);
        return back()->with('message', 'Item removed from wishlist successfully');
    }
    public function sendInvoice($order)
    {
        $email = $order->email;
        if ($email) {
            Mail::to($email)->send(new InvoiceMail($order));
        }
        $setting = HomeSetting::first();
        $emails = explode(",", $setting->admin_mails);
        if ($emails) {
            Mail::to($emails)->send(new InvoiceMail($order));
        }
    }
}
