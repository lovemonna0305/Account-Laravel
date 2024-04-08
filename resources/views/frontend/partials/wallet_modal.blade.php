<div class="modal fade" id="wallet_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ translate('Recharge Wallet') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body gry-bg px-3 pt-3" style="overflow-y: inherit;">
                <form class="" action="{{ route('wallet.recharge') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <label>{{ translate('Payment Method') }} <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-md-8">
                            <div class="mb-3">
                                <select class="form-control selectpicker rounded-0" data-minimum-results-for-search="Infinity"
                                    name="payment_option" data-live-search="true">
                                    @if (get_setting('paypal_payment') == 1)
                                        <option value="paypal">{{ translate('Paypal') }}</option>
                                    @endif
                                    @if (get_setting('stripe_payment') == 1)
                                        <option value="stripe">{{ translate('Stripe') }}</option>
                                    @endif
                                    @if (get_setting('mercadopago_payment') == 1)
                                        <option value="mercadopago">{{ translate('Mercadopago') }}</option>
                                    @endif
                                    @if (get_setting('toyyibpay_payment') == 1)
                                        <option value="toyyibpay">{{ translate('ToyyibPay') }}</option>
                                    @endif
                                    @if (get_setting('sslcommerz_payment') == 1)
                                        <option value="sslcommerz">{{ translate('SSLCommerz') }}</option>
                                    @endif
                                    @if (get_setting('instamojo_payment') == 1)
                                        <option value="instamojo">{{ translate('Instamojo') }}</option>
                                    @endif
                                    @if (get_setting('paystack') == 1)
                                        <option value="paystack">{{ translate('Paystack') }}</option>
                                    @endif
                                    @if (get_setting('voguepay') == 1)
                                        <option value="voguepay">{{ translate('VoguePay') }}</option>
                                    @endif
                                    @if (get_setting('payhere') == 1)
                                        <option value="payhere">{{ translate('Payhere') }}</option>
                                    @endif
                                    @if (get_setting('ngenius') == 1)
                                        <option value="ngenius">{{ translate('Ngenius') }}</option>
                                    @endif
                                    @if (get_setting('razorpay') == 1)
                                        <option value="razorpay">{{ translate('Razorpay') }}</option>
                                    @endif
                                    @if (get_setting('iyzico') == 1)
                                        <option value="iyzico">{{ translate('Iyzico') }}</option>
                                    @endif
                                    @if (get_setting('bkash') == 1)
                                        <option value="bkash">{{ translate('Bkash') }}</option>
                                    @endif
                                    @if (get_setting('nagad') == 1)
                                        <option value="nagad">{{ translate('Nagad') }}</option>
                                    @endif
                                    @if (get_setting('payku') == 1)
                                        <option value="payku">{{ translate('Payku') }}</option>
                                    @endif
                                    @if (addon_is_activated('african_pg'))
                                        @if (get_setting('mpesa') == 1)
                                            <option value="mpesa">{{ translate('Mpesa') }}</option>
                                        @endif
                                        @if (get_setting('flutterwave') == 1)
                                            <option value="flutterwave">{{ translate('Flutterwave') }}</option>
                                        @endif
                                        @if (get_setting('payfast') == 1)
                                            <option value="payfast">{{ translate('PayFast') }}</option>
                                        @endif
                                    @endif
                                    @if (addon_is_activated('paytm') && get_setting('paytm_payment'))
                                        <option value="paytm">{{ translate('Paytm') }}</option>
                                    @endif
                                    @if (get_setting('authorizenet') == 1)
                                        <option value="authorizenet">{{ translate('Authorize Net') }}</option>
                                    @endif
                                    @if (addon_is_activated('paytm') && get_setting('myfatoorah') == 1)
                                        <option value="myfatoorah">{{ translate('MyFatoorah') }}</option>
                                    @endif
                                    @if (addon_is_activated('paytm') && get_setting('khalti_payment') == 1)
                                        <option value="khalti">{{ translate('Khalti') }}</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>{{ translate('Amount') }} <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-md-8">
                            <input type="number" lang="en" class="form-control mb-3 rounded-0" name="amount"
                                placeholder="{{ translate('Amount') }}" required>
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <button type="submit"
                            class="btn btn-sm btn-primary rounded-0 transition-3d-hover mr-1">{{ translate('Confirm') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>