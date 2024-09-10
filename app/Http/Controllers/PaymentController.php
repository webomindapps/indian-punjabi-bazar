<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function showPaymentForm(Request $request)
    {
        $request->validate([
            'first_name'  => 'required',
            'last_name'   => 'required',
            'last_name'   => 'required',
            'phone'       => 'required',
            'address'     => 'required',
            'state'       => 'required',
            'city'        => 'required',
            'pincode'     => 'required',
        ]);
        DB::beginTransaction();
        try {
            $customer = auth('customer')->user();
            $cart = Cart::where('customer_id', $customer->id)->first();
            $address = $customer->addresses()->create($request->all());
            if ($customer->phone == '') {
                $customer->update(['phone' => $request->phone]);
            }
            $grand_total = $cart->grand_total;
            if ($cart->price) {
                $grand_total += $cart->price;
            }
            // foreach ($cart->items as $key => $item) {
            //     $inventory = ProductInventory::where('product_id', $item->product_id)->first();
            //     if ($inventory->inventory < $item->quantity) {
            //         return back()->with('error', 'Stock not Available');
            //     }
            // }

            // Data to be sent to Moneris
            $data = [
                "store_id" => env('MONERIS_STORE_ID'),
                "api_token" => env('MONERIS_API_TOKEN'),
                "checkout_id" => env('MONERIS_CHECKOUT_ID'),
                "environment" => "qa",
                // "txn_total" => "10.00",
                "txn_total" => number_format($grand_total,2),
                "action" => "preload",
                "contact_details" => [
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'phone' => $request->phone,
                    'email' => $request->email,
                ]
            ];

            // Convert data array to JSON
            $payload = json_encode($data);

            // Initialize cURL session
            $ch = curl_init(env('MONERIS_API_URL'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLINFO_HEADER_OUT, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'Content-Length: ' . strlen($payload)]);

            // Execute the cURL request
            $result = curl_exec($ch);

            // Close the cURL session
            curl_close($ch);

            // Decode the response
            $result_data = json_decode($result, true);

            // dd(isset($result_data['response']['error']),$result_data['response']['success']);

            // Check for cURL errors
            if (isset($result_data['response']['error']) && $result_data['response']['success'] == "false") {
                return redirect()->back()->with('error', 'Moneris Payment error');
            } else {
                DB::commit();
                $token = $result_data['response']['ticket'];
                $address_id = $address->id;
                // Return the view with the token
                return view('payment.form', compact('token', 'address_id'));
            }
        } catch (Exception $ex) {
            DB::rollBack();
            dd($ex);
        }
    }

    public function paymentResponse(Request $request)
    {
        $payload = json_encode([
            "store_id" => env('MONERIS_STORE_ID'),
            "api_token" => env('MONERIS_API_TOKEN'),
            "checkout_id" => env('MONERIS_CHECKOUT_ID'),
            "ticket" => $request->ticket,
            "environment" => "qa",
            "action" => "receipt"
        ]);

        $ch = curl_init(env('MONERIS_API_URL'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($payload)
        ]);

        $result = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);
        if ($error) {
            Log::error('cURL Error: ' . $error);
            return redirect('/payment-failure')->with('error', 'cURL Error: ' . $error);
        }

        $response_data = json_decode($result, true);
        if (isset($response_data['response']['receipt']['result']) && $response_data['response']['receipt']['result'] === 'a') {
            $address_id = $request->address_id;
            $order_no = $response_data['response']['request']['order_no'];
            return redirect()->route('order', ['address_id' => $address_id, 'order_no' => $order_no]);
        } else {
            return redirect()->route('cart')->with('error', 'Payment was not successful');
        }
    }
}
