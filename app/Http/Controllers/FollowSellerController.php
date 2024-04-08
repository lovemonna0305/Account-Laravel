<?php

namespace App\Http\Controllers;

use App\Models\FollowSeller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowSellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $followed_sellers = FollowSeller::where('user_id', Auth::user()->id)->orderBy('shop_id', 'asc')->paginate(10);
        return view('frontend.user.customer.followed_sellers', compact('followed_sellers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(isCustomer()){
            $followed_seller = FollowSeller::where('user_id', Auth::user()->id)->where('shop_id', $request->id)->first();
            if($followed_seller == null){
                FollowSeller::insert([
                    'user_id' => Auth::user()->id,
                    'shop_id' => $request->id
                ]);
            }
            flash(translate('Seller is followed Successfully'))->success();
            return back();
        }
        flash(translate('You need to login as a customer to follow this seller'))->success();
        return back();
    }

    public function remove(Request $request)
    {
        $followed_seller = FollowSeller::where('user_id', Auth::user()->id)->where('shop_id', $request->id)->first();
        if($followed_seller!=null){
            FollowSeller::where('user_id', Auth::user()->id)->where('shop_id', $request->id)->delete();
            flash(translate('Seller is unfollowed Successfully'))->success();
            return back();
        }
    }
}
