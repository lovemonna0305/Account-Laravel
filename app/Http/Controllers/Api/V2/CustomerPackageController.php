<?php
namespace App\Http\Controllers\Api\V2;
use App\Http\Resources\V2\CustomerPackageResource;
use App\Models\CustomerPackage;
use App\Models\CustomerPackagePayment;
use App\Models\User;
use Illuminate\Http\Request;


class CustomerPackageController extends Controller
{
    public function customer_packages_list()
    {
            $customer_packages = CustomerPackage::all();
            return CustomerPackageResource::collection($customer_packages);
    }

public function purchase_package_free(Request $request)
    {
        $data['customer_package_id'] = $request->package_id;
        

        $customer_package = CustomerPackage::findOrFail($data['customer_package_id']);

        if ($customer_package->amount == 0) {
            $user = User::findOrFail(auth()->user()->id);
            if ($user->customer_package_id != $customer_package->id) {

                $user->customer_package_id = $data['customer_package_id'];
                $customer_package = CustomerPackage::findOrFail($data['customer_package_id']);
                $user->remaining_uploads += $customer_package->product_upload;
                $user->save();
                return $this->success(translate('Package purchasing successful'));
            } else {
               return $this->failed(translate('You can not purchase this package anymore.'));
                
            }
        }
        return $this->failed(translate('Invalid input'));

    }





    public function purchase_package_offline(Request $request)
    {
        $customer_package = new CustomerPackagePayment();
        $customer_package->user_id = auth()->user()->id;
        $customer_package->customer_package_id = $request->package_id;
        $customer_package->payment_method = $request->payment_option;
        $customer_package->payment_details = $request->trx_id;
        $customer_package->approval = 0;
        $customer_package->offline_payment = 1;
        $customer_package->reciept = ($request->photo == null) ? '' : $request->photo;
        $customer_package->save();
        
        return $this->success(translate("Submitted Successfully"));
    }
}
