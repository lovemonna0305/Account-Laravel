<?php

namespace App\Http\Controllers\Api\V2;

use App\Models\CustomerPackage;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerPackageController;
use App\Http\Controllers\WalletController;
use App\Models\CombinedOrder;
use App\Models\Currency;
use Illuminate\Http\Request;
use Stripe\Exception\CardException;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class StripeController extends Controller
{
    public function stripe(Request $request)
    {
        $data['payment_type'] = $request->payment_type;
        $data['combined_order_id'] = $request->combined_order_id;
        $data['amount'] = $request->amount;
        $data['user_id'] = $request->user_id;
        $data['package_id'] = 0;


        if(isset($request->package_id)) {
            $data['package_id'] = $request->package_id;
        }
        
        return view('frontend.payment.stripe_app', $data);
    }

    public function create_checkout_session(Request $request)
    {
        $amount = 0;

        if ($request->payment_type == 'cart_payment') {
            $combined_order = CombinedOrder::find($request->combined_order_id);
            $amount = round($combined_order->grand_total * 100);
        } elseif ($request->payment_type == 'wallet_payment') {
            $amount = round($request->amount * 100);
        } elseif ($request->payment_type == 'customer_package_payment') {
            $amount = round($request->amount * 100);
        } elseif ($request->payment_type == 'seller_package_payment') {
            $amount = round($request->amount * 100);
        }

        $data = array();
        $data['payment_type'] = $request->payment_type;
        $data['combined_order_id'] = $request->combined_order_id;
        $data['amount'] = $request->amount;
        $data['user_id'] = $request->user_id;
        $data['package_id'] = $request->package_id;

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => Currency::findOrFail(get_setting('system_default_currency'))->code,
                        'product_data' => [
                            'name' => "Payment"
                        ],
                        'unit_amount' => $amount,
                    ],
                    'quantity' => 1,
                ]
            ],
            'mode' => 'payment',
            'client_reference_id' => json_encode($data),
            // 'success_url' => route('api.stripe.success', $data),
            'success_url' => env('APP_URL') . "/api/v2/stripe/success?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url' => route('api.stripe.cancel'),
        ]);

        return response()->json(['id' => $session->id, 'status' => 200]);
    }

    public function payment_success(Request $request)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        
        try {
            $session = $stripe->checkout->sessions->retrieve($request->session_id);
            
            $decoded_reference_data = json_decode($session->client_reference_id);
            
            $payment = ["status" => "Success"];

            $payment_type = $decoded_reference_data->payment_type;

            if ($payment_type == 'cart_payment') {
                checkout_done($decoded_reference_data->combined_order_id, json_encode($payment));
            }

            if ($payment_type == 'wallet_payment') {
                wallet_payment_done($decoded_reference_data->user_id, $decoded_reference_data->amount, 'Stripe', json_encode($payment));
            }

            if ($payment_type == 'seller_package_payment') {
                seller_purchase_payment_done($decoded_reference_data->user_id, $decoded_reference_data->package_id, $decoded_reference_data->amount, 'Stripe', json_encode($payment));
            }
            if ($payment_type == 'customer_package_payment') {
                customer_purchase_payment_done($decoded_reference_data->user_id, $decoded_reference_data->package_id);
            }

            return response()->json(['result' => true, 'message' => translate("Payment is successful")]);


        } catch (\Exception $e) {
            return response()->json(['result' => false, 'message' => translate("Payment is failed")]);
        }
    }

    public function cancel(Request $request)
    {
        return response()->json(['result' => false, 'message' => translate("Payment is cancelled")]);
    }
}
