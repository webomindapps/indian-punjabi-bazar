<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ProductInventory;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use function Termwind\render;

class CartController extends Controller
{
    public function model()
    {
        return new Cart;
    }
    public function cartItems()
    {
        $customer = Auth::guard('customer')->user();
        if ($customer) {
            $cart = Cart::where('customer_id', $customer->id)->latest()->first();
        } else {
            $cart_id = Session::get('cart_id');
            if ($cart_id) {
                $cart = $this->findBy('id', $cart_id);
            } else {
                $cart = null;
            }
        }
        $count = 0;
        if ($cart) {
            $count = count($cart?->items);
        }
        return [
            'html' => view('frontend.pages.cart.mini-cart', compact('cart'))->render(),
            'count' => $count
        ];
    }
    public function cartView()
    {
        $customer = Auth::guard('customer')->user();
        if ($customer) {
            $cart = Cart::where('customer_id', $customer->id)->latest()->first();
        } else {
            $cart_id = Session::get('cart_id');
            if ($cart_id) {
                $cart = $this->findBy('id', $cart_id);
            } else {
                $cart = null;
            }
        }
        return view('frontend.pages.cart', compact('cart'));
    }
    public function findBy($type, $value)
    {
        return $this->model()->where($type, $value)->first();
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            //check if customer is sign in
            $customer = Auth::guard('customer')->user();
            $product_id = $request->product_id;
            $qty = $request->qty;

            if ($customer) {
                //check if cart exist already
                if ($customer->cart) {
                    $cart = $customer->cart;
                } else {
                    $cart = $customer->cart()->create([
                        'customer_id' => $customer->id,
                        'name' => $customer->name,
                        'email' => $customer->email,
                    ]);
                }
            } else {
                //check if session has cart
                $cart_id = Session::get('cart_id');
                if ($cart_id) {
                    $cart = $this->findBy('id', $cart_id);
                } else {
                    $cart = $this->model()->create(['items_count' => 0]);
                    Session::put('cart_id',  $cart->id);
                }
            }
            $inventory = ProductInventory::where('product_id', $product_id)->first();
            if ($inventory->inventory < $qty) {
                return response()->json([
                    'success' => false,
                ], 200);
            }
            //insert cart items
            $cart_item = $this->cartItemCreate($cart, $product_id, $qty);
            DB::commit();
            $this->calculateTotal($cart->id);
            // return $cart;
            return response()->json([
                'success' => true,
                'data' => $cart,
            ], 201);
        } catch (Exception $e) {
            DB::rollBack();
            session()->forget('cart_id');
            return response()->json([
                'error' => true,
                'data' => $e,
            ], 200);
        }
    }
    public function cartItemCreate($cart, $product_id, $qty)
    {
        $product = Product::find($product_id);
        $today = date('Y-m-d');
        $price = $product->price;
        if ($product->special_price_from) {
            if ($product->special_price_from <= $today && $product->special_price_to >= $today) {
                $price = $product->special_price;
            }
        }

        $cart_item = CartItem::where('product_id', $product_id)->where('cart_id', $cart->id)->first();
        if ($cart_item) {
            $data['quantity'] = $cart_item->quantity + $qty;
            $new_total_amount = $price * $qty;
            $total_amount = $cart_item->total_amount +  $new_total_amount;
            if ($cart_item->tax_percent) {
                $data['tax_percent'] = $cart_item->tax_percent;
                $new_tax_amount = $total_amount * ($cart_item->tax_percent / 100);
                $data['tax_amount'] = $new_tax_amount;
            }
            $data['total_amount'] = $total_amount;
            $cart_item->update($data);
            return $cart_item;
        } else {
            $data['product_id'] = $product->id;
            $data['sku'] = $product->sku;
            $data['name'] = $product->name;
            $data['price'] = $price;
            $data['quantity'] = $qty;
            $total_amount = $price * $qty;
            if ($product->tax) {
                $data['tax_percent'] = $product->tax?->percent;
                $new_tax_amount = $total_amount * ($product->tax?->percent / 100);
                $data['tax_amount'] = $new_tax_amount;
            }
            $data['total_amount'] = $total_amount;
            return $cart->items()->create($data);
        }
    }

    public function calculateTotal($cart_id)
    {
        $cart = $this->findBy('id', $cart_id);
        $item_qty = 0;
        $total_amount = 0;
        $tax_total = 0;
        $tax = 0;
        $discount = 0;
        $grand_total = 0;

        if (!is_null($cart)) {
            foreach ($cart->items as $item) {
                if ($item->tax_amount) {
                    $tax_total += $item->total_amount;
                }
                $item_qty += $item->quantity;
                $total_amount += $item->total_amount;
                $tax += $item->tax_amount;
                $grand_total += $item->total_amount + $item->tax_amount;
            }
            if ($cart->coupon_code) {
                $coupon = Coupon::where('name', $cart->coupon_code)->first();
                $valid = $this->checkCoupon($coupon, $cart);
                if ($valid) {
                    if ($coupon->is_condition_coupon == 1) {
                        if ($total_amount >= $coupon->min_amount_for_discount) {
                            if ($coupon->discount_type == 1) {
                                $discount = $total_amount * ($coupon->discount_type_value / 100);
                                if ($discount > $coupon->max_discount_amount) {
                                    $discount = $coupon->max_discount_amount;
                                }
                            } else {
                                $discount = $coupon->discount_type_value;
                            }
                        } else {
                            $cart->coupon_code = null;
                            $cart->save();
                            $discount = 0;
                        }
                    }
                    $grand_total = $grand_total - $discount;
                }
            }
            $cart->update([
                'items_qty'       => $item_qty,
                'total_amount'    => $total_amount,
                'discount_amount' => $discount,
                'tax_total'       => $tax_total,
                'tax'             => $tax,
                'grand_total'     => $grand_total
            ]);
        }
    }

    public function update(Request $request)
    {
        $item_id = $request->item_id;
        $qty = $request->qty;
        $cart_item = CartItem::find($item_id);
        $cart = Cart::find($cart_item->cart_id);
        $product = Product::find($cart_item->product_id);
        $today = date('Y-m-d');
        $price = $product->price;
        if ($product->special_price_from) {
            if ($product->special_price_from <= $today && $product->special_price_to >= $today) {
                $price = $product->special_price;
            }
        }
        DB::beginTransaction();
        try {
            $cart_item->quantity = $qty;
            $total_amount = $price * $qty;
            if ($cart_item->tax_percent) {
                $new_tax_amount = $total_amount * ($cart_item->tax_percent / 100);
                $cart_item->tax_amount = $new_tax_amount;
            }
            $cart_item->total_amount = $total_amount;
            $cart_item->save();
            $this->calculateTotal($cart->id);
            $cart = Cart::find($cart_item->cart_id);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            session()->forget('cart_id');
            dd($e);
        }
        return response()->json([
            'success' => true,
            'data' => $cart_item,
            'cart' => $cart,
        ], 200);
    }
    public function destroy($item_id)
    {
        $cart_item = CartItem::find($item_id);
        $cart_item->delete();
        $cart = Cart::find($cart_item->cart_id);
        $this->calculateTotal($cart->id);
        return back()->with('error', 'item was removed successfully from the cart');
    }
    public function applyCoupon(Request $request)
    {
        $coupon = Coupon::where('name', $request->coupon)->first();
        if (is_null($coupon)) {
            return response()->json([
                'success' => true,
                'error' => 'Coupon not found'
            ], 200);
        }
        $customer = Auth::guard('customer')->user();
        if ($customer) {
            $cart = Cart::where('customer_id', $customer->id)->latest()->first();
        } else {
            $cart_id = Session::get('cart_id');
            if ($cart_id) {
                $cart = $this->findBy('id', $cart_id);
            } else {
                $cart = null;
            }
        }
        $valid = $this->checkCoupon($coupon);
        if ($valid) {
            if ($coupon->is_condition_coupon == 1) {
                if ($cart->total_amount >= $coupon->min_amount_for_discount) {
                    $cart->coupon_code = $request->coupon;
                    $cart->save();
                    $this->calculateTotal($cart->id);
                    return response()->json([
                        'success' => true,
                        'data' => $coupon,
                        'cart' => $cart,
                    ], 200);
                } else {
                    return response()->json([
                        'success' => true,
                        'error' => 'Not eligible for this coupon',
                    ], 200);
                }
            } else {
                $cart->coupon_code = $request->coupon;
                $cart->save();
                $this->calculateTotal($cart->id);
                return response()->json([
                    'success' => true,
                    'data' => $coupon,
                    'cart' => $cart,
                ], 200);
            }
        } else {
            return response()->json([
                'success' => true,
                'error' => 'Invalid Coupon'
            ], 200);
        }
    }
    public function removeCoupon($id)
    {
        $cart = Cart::find($id);
        $cart->coupon_code = null;
        $cart->discount_amount = 0;
        $cart->save();
        $this->calculateTotal($cart->id);
        return back()->with('message', 'Coupon removed successfully');
    }
    public function checkCoupon(Coupon $coupon)
    {
        if ($coupon) {
            $today = Carbon::today();
            $fromDate = Carbon::parse($coupon->from);
            $toDate = Carbon::parse($coupon->to);
            if ($fromDate->lessThanOrEqualTo($today) && $toDate->greaterThanOrEqualTo($today)) {
                return true;
            }
        }
        return false;
    }

    public function deliveryLocation(Request $request)
    {
        $customer = Auth::guard('customer')->user();
        $cart = Cart::where('customer_id', $customer->id)->first();
        $cart->update([
            'type' => $request->type,
            'city' => $request->city,
            'date' => $request->date,
            'time' => $request->time,
            'price' => $request->price,
            'min_price' => $request->min_price,
        ]);
        return response()->json([
            'success' => true,
        ], 200);
    }
}
