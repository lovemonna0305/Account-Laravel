<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Mail\AuctionBidMailManager;
use App\Models\AuctionProductBid;
use App\Models\Product;
use Auth;
use Illuminate\Http\Request;
use Mail;

class AuctionProductBidController extends Controller
{
    public function store(Request $request)
    {
        $bid = AuctionProductBid::where('product_id', $request->product_id)->where('user_id', Auth::user()->id)->first();
        if ($bid == null) {
            $bid =  new AuctionProductBid;
            $bid->user_id = Auth::user()->id;
        }
        $bid->product_id = $request->product_id;
        $bid->amount = $request->amount;
        if ($bid->save()) {
            $secound_max_bid = AuctionProductBid::where('product_id', $request->product_id)->orderBy('amount', 'desc')->skip(1)->first();
            if ($secound_max_bid != null) {
                if ($secound_max_bid->user->email != null) {
                    $product = Product::where('id', $request->product_id)->first();
                    $array['view'] = 'emails.auction_bid';
                    $array['subject'] = translate('Auction Bid');
                    $array['from'] = env('MAIL_FROM_ADDRESS');
                    $array['content'] = 'Hi! A new user bidded more then you for the product, ' . $product->name . '. ' . 'Highest bid amount: ' . $bid->amount;
                    $array['link'] = route('auction-product', $product->slug);
                    try {
                        Mail::to($secound_max_bid->user->email)->queue(new AuctionBidMailManager($array));
                    } catch (\Exception $e) {
                        //dd($e->getMessage());
                    }
                }
            }

            return response()->json([
                'result' => true,
                'message' => translate('Bid Placed Successfully.'),

            ], 200);
        } else {
            return response()->json([
                'result' => false,
                'message' => translate('Something Went Wrong'),
            ], 201);
        }
        return back();
    }
}
