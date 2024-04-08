<?php

namespace App\Http\Controllers\Payment;

use Auth;
use Session;
use Paystack;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\CombinedOrder;
use App\Models\SellerPackage;
use App\Models\CustomerPackage;
use App\Http\Controllers\Controller;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\SellerPackageController;
use App\Http\Controllers\CustomerPackageController;

class PaystackController extends Controller
{
    public function pay(Request $request)
    {
        $post_data = array();
        $post_data['payment_type'] = Session::get('payment_type');

        if (Session::get('payment_type') == 'cart_payment') {
            $post_data['combined_order_id'] = Session::get('combined_order_id');
            $array = ['custom_fields' => $post_data];

            $combined_order = CombinedOrder::findOrFail(Session::get('combined_order_id'));
            $user = Auth::user();
            $request->email = $user->email;
            $request->amount = round($combined_order->grand_total * 100);
            $request->currency = env('PAYSTACK_CURRENCY_CODE', 'NGN');
            $request->metadata = json_encode($array);
            $request->reference = Paystack::genTranxRef();
            return Paystack::getAuthorizationUrl()->redirectNow();
        } elseif (Session::get('payment_type') == 'wallet_payment') {
            $post_data['payment_method'] = Session::get('payment_data')['payment_method'];
            $array = ['custom_fields' => $post_data];

            $user = Auth::user();
            $request->email = $user->email;
            $request->amount = round(Session::get('payment_data')['amount'] * 100);
            $request->currency = env('PAYSTACK_CURRENCY_CODE', 'NGN');
            $request->metadata = json_encode($array);
            $request->reference = Paystack::genTranxRef();
            return Paystack::getAuthorizationUrl()->redirectNow();
        } elseif (Session::get('payment_type') == 'customer_package_payment') {
            $post_data['customer_package_id'] = Session::get('payment_data')['customer_package_id'];
            $array = ['custom_fields' => $post_data];

            $customer_package = CustomerPackage::findOrFail(Session::get('payment_data')['customer_package_id']);
            $user = Auth::user();
            $request->email = $user->email;
            $request->amount = round($customer_package->amount * 100);
            $request->currency = env('PAYSTACK_CURRENCY_CODE', 'NGN');
            $request->metadata = json_encode($array);
            $request->reference = Paystack::genTranxRef();
            return Paystack::getAuthorizationUrl()->redirectNow();
        } elseif (Session::get('payment_type') == 'seller_package_payment') {
            $post_data['seller_package_id'] = Session::get('payment_data')['seller_package_id'];
            $post_data['payment_method'] = Session::get('payment_data')['payment_method'];
            $array = ['custom_fields' => $post_data];

            $seller_package = SellerPackage::findOrFail(Session::get('payment_data')['seller_package_id']);
            $user = Auth::user();
            $request->email = $user->email;
            $request->amount = round($seller_package->amount * 100);
            $request->currency = env('PAYSTACK_CURRENCY_CODE', 'NGN');
            $request->metadata = json_encode($array);
            $request->reference = Paystack::genTranxRef();
            return Paystack::getAuthorizationUrl()->redirectNow();
        }
    }

    public function paystackNewCallback()
    {
        Paystack::getCallbackData();
    }


    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
        $payment = Paystack::getPaymentData();

        if ($payment['data']['metadata'] && $payment['data']['metadata']['custom_fields']) {
            $payment_type = $payment['data']['metadata']['custom_fields']['payment_type'];
            if ($payment_type == 'cart_payment') {
                $payment_detalis = json_encode($payment);
                if (!empty($payment['data']) && $payment['data']['status'] == 'success') {
                    Auth::login(User::where('email', $payment['data']['customer']['email'])->first());
                    return (new CheckoutController)->checkout_done($payment['data']['metadata']['custom_fields']['combined_order_id'], $payment_detalis);
                }
                Session::forget('combined_order_id');
                flash(translate('Payment cancelled'))->success();
                return redirect()->route('home');
            } elseif ($payment_type == 'wallet_payment') {
                $payment_detalis = json_encode($payment);
                if (!empty($payment['data']) && $payment['data']['status'] == 'success') {
                    $payment_data['amount'] = $payment['data']['amount']/100;
                    $payment_data['payment_method'] = $payment['data']['metadata']['custom_fields']['payment_method'];
                    Auth::login(User::where('email', $payment['data']['customer']['email'])->first());
                    return (new WalletController)->wallet_payment_done($payment_data, $payment_detalis);
                }
                Session::forget('payment_data');
                flash(translate('Payment cancelled'))->success();
                return redirect()->route('home');
            } elseif ($payment_type == 'customer_package_payment') {
                $payment_detalis = json_encode($payment);
                if (!empty($payment['data']) && $payment['data']['status'] == 'success') {
                    $payment_data['customer_package_id'] = $payment['data']['metadata']['custom_fields']['customer_package_id'];
                    Auth::login(User::where('email', $payment['data']['customer']['email'])->first());
                    return (new CustomerPackageController)->purchase_payment_done($payment_data, $payment);
                }
                Session::forget('payment_data');
                flash(translate('Payment cancelled'))->success();
                return redirect()->route('home');
            } elseif ($payment_type == 'seller_package_payment') {
                $payment_detalis = json_encode($payment);
                if (!empty($payment['data']) && $payment['data']['status'] == 'success') {
                    $payment_data['seller_package_id'] = $payment['data']['metadata']['custom_fields']['seller_package_id'];
                    $payment_data['payment_method'] = $payment['data']['metadata']['custom_fields']['payment_method'];
                    Auth::login(User::where('email', $payment['data']['customer']['email'])->first());
                    return (new SellerPackageController)->purchase_payment_done($payment_data, $payment);
                }
                Session::forget('payment_data');
                flash(translate('Payment cancelled'))->success();
                return redirect()->route('home');
            }
        }
        // for mobile app
        else {
            if (!empty($payment['data']) && $payment['data']['status'] == 'success') {
                return response()->json(['result' => true, 'message' => "Payment is successful", 'payment_details' => $payment]);
            } else {
                return response()->json(['result' => false, 'message' => "Payment unsuccessful", 'payment_details' => $payment]);
            }

        }
    }
}
