<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Resources\V2\CustomerCollection;
use App\Models\User;

class CustomerController extends Controller
{
    public function show()
    {
        $user = User::where("id",auth()->user()->id)->where("user_type","customer")->get();

        return new CustomerCollection($user);
    }
}
