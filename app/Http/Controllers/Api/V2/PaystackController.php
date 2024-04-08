<?php


namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerPackageController;
use App\Http\Controllers\WalletController;
use App\Models\CombinedOrder;
use App\Models\User;
use Illuminate\Http\Request;
use Paystack;

class PaystackController extends Controller
{

    public function init(Request $request)
    {
        $amount = $request->amount;
        if ($request->combined_order_id) {
            $combined_order = CombinedOrder::find($request->combined_order_id);
            $amount = $combined_order->grand_total;
        }
        $user_id = $request->user_id;

        $user = User::find($user_id);
        $request->email = $user->email;
        $request->amount = round($amount * 100);
        $request->currency = env('PAYSTACK_CURRENCY_CODE', 'NGN');
        $request->reference = Paystack::genTranxRef();
        return Paystack::getAuthorizationUrl()->redirectNow();
    }


    // the callback function is in the main controller of web | paystackcontroller

    public function payment_success(Request $request)
    {
        try {

            $payment_type = $request->payment_type;

            if ($payment_type == 'cart_payment') {
                checkout_done($request->combined_order_id, $request->payment_details);
            }

            if ($payment_type == 'wallet_payment') {
                wallet_payment_done($request->user_id, $request->amount, 'Paystack', $request->payment_details);
            }

            if ($payment_type == 'seller_package_payment') {
                seller_purchase_payment_done($request->user_id, $request->package_id, $request->amount, 'Paystack', $request->payment_details);
            }

            if ($payment_type == 'customer_package_payment') {
                customer_purchase_payment_done($request->user_id, $request->package_id);
            }

            return response()->json(['result' => true, 'message' => translate("Payment is successful")]);
        } catch (\Exception $e) {
            return response()->json(['result' => false, 'message' => $e->getMessage()]);
        }
    }
}
