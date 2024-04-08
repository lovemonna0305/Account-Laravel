<?php

namespace App\Http\Resources\V2;

use App\Models\Review;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AuctionProductDetailCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function ($data) {

                //photos
                $photo_paths = get_images_path($data->photos);
                $photos = [];
                if (!empty($photo_paths)) {
                    for ($i = 0; $i < count($photo_paths); $i++) {
                        if ($photo_paths[$i] != "") {
                            $item = array();
                            $item['variant'] = "";
                            $item['path'] = $photo_paths[$i];
                            $photos[] = $item;
                        }
                    }
                }

                //branc

                $brand = [
                    'id' => 0,
                    'name' => "",
                    'logo' => "",
                ];

                if ($data->brand != null) {
                    $brand = [
                        'id' => $data->brand->id,
                        'name' => $data->brand->getTranslation('name'),
                        'logo' => uploaded_asset($data->brand->logo),
                    ];
                }
                $unit = '';
                if ($data->unit != null) {
                    $unit = $data->getTranslation('unit');
                }
                // highest bids
                $highest_bid = $data->bids->max('amount');


                return [
                    'id' => (int)$data->id,
                    'name' => $data->getTranslation('name'),
                    'added_by' => $data->added_by,
                    'seller_id' => $data->user->id,
                    'shop_id' => $data->added_by == 'admin' ? 0 : $data->user->shop->id,
                    'shop_name' => $data->added_by == 'admin' ? translate('In House Product') : $data->user->shop->name,
                    'shop_logo' => $data->added_by == 'admin' ? uploaded_asset(get_setting('header_logo')) : uploaded_asset($data->user->shop->logo) ?? "",
                    'photos' => $photos,
                    'thumbnail_image' => uploaded_asset($data->thumbnail_img),
                    'tags' => explode(',', $data->tags),
                    'rating' => (float)$data->rating,
                    'rating_count' => (int)Review::where(['product_id' => $data->id])->count(),
                    'brand' => $brand,
                    // "auction_end_date" => $data->auction_end_date > strtotime('now') ? date('Y/m/d H:i:s', $data->auction_end_date) : 'Ended',
                    "auction_end_date" => $data->auction_end_date > strtotime('now') ?  $data->auction_end_date  : 'Ended',
                    "starting_bid" =>  single_price($data->starting_bid),
                    'unit' => $unit,
                    'min_bid_price' => $highest_bid != null? ($highest_bid +1): $data->starting_bid,
                    'highest_bid' => $highest_bid != null ?  single_price($highest_bid) : '',
                    'description' => str_replace('&nbsp;', ' ', strip_tags($data->getTranslation('description'))),
                    'video_link' => $data->video_link != null ?  $data->video_link : "",
                    'link' => route('product', $data->slug)
                    // 'data' => $data


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
