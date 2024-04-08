<?php

namespace App\Http\Resources\V2;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CustomerCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    'name' => $data->name,
                    'email' => $data->email,
                    'avatar' => uploaded_asset($data->avatar),
                    'address' => $data->address??"",
                    'country' => $data->country??"",
                    'state' => $data->state??"",
                    'city' => $data->city??"",
                    'postal_code' => $data->postal_code??"",
                    'phone' =>$data->phone??"",
                    'balance' =>single_price($data->balance),
                    'remaining_uploads' => $data->remaining_uploads,
                    'package_id' => $data->customer_package_id??"",
                    'package_name' => $data->customer_package->name??"",
                ];
            })
        ];
    }

    public function with($request)
    {
        return [
            'success' => true,
            'status' => 200
        ];
    }
}
