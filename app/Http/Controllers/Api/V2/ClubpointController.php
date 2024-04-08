<?php

namespace App\Http\Controllers\Api\V2;

use App\Models\ClubPoint;
use App\Http\Resources\V2\ClubpointCollection;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;

class ClubpointController extends Controller
{

    public function get_list()
    {
        $club_points = ClubPoint::where('user_id', auth()->user()->id)->latest()->paginate(10);

        return new ClubpointCollection($club_points);
    }

    public function convert_into_wallet(Request $request)
    {
        $club_point = ClubPoint::find($request->id);
        if($club_point->convert_status == 0) {
            $amount = 0;

            foreach ($club_point->club_point_details as $club_point_detail) {
                if($club_point_detail->refunded == 0){
                    $club_point_detail->converted_amount = floatval($club_point_detail->point / get_setting('club_point_convert_rate'));
                    $club_point_detail->save();
                    $amount += $club_point_detail->converted_amount;
                } 
            }



            $wallet = new Wallet;
            $wallet->user_id = auth()->user()->id;
            $wallet->amount = $amount;
            $wallet->payment_method = 'Club Point Convert';
            $wallet->payment_details = 'Club Point Convert';
            $wallet->save();
            $user = User::find(auth()->user()->id);
            $user->balance = $user->balance + $amount;
            $user->save();
            $club_point->convert_status = 1;
            $club_point->save();

            return response()->json([
                'success' => true,
                'message' => translate('Successfully converted')
            ]);
    }
}

}
