<?php

namespace App\Http\Resources\V2\Seller;

use App\Http\Resources\V2\UploadedFileCollection;
use App\Models\Upload;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailsCollection extends JsonResource
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
            "id" => $this->id,
            'lang'          => $this->lang,
            'product_name'  => $this->getTranslation('name', $this->lang),
            'product_unit'  => $this->getTranslation('unit', $this->lang),
            'description'   => $this->getTranslation('description', $this->lang),
            "category_id" => $this->category_id,
            "brand_id" => $this->brand_id,
            "photos" =>new UploadedFileCollection(Upload::whereIn("id",explode(",",$this->photos))->get()),
            "thumbnail_img" =>new UploadedFileCollection(Upload::whereIn("id",explode(",",$this->thumbnail_img))->get()),
            "video_provider" => $this->video_provider,
            "video_link" => $this->video_link,
            "tags" => $this->tags,
            "unit_price" => $this->unit_price,
            "purchase_price" => $this->purchase_price,
            "variant_product" => $this->variant_product,
            "attributes" => json_decode($this->attributes),
            "choice_options" => json_decode($this->choice_options),
            "colors" => json_decode($this->colors),
            "variations" => $this->variations,
            "stocks" =>  new StockCollection($this->stocks),
            "todays_deal" => $this->todays_deal,
            "published" => $this->published,
            "approved" => $this->approved,
            "stock_visibility_state" => $this->stock_visibility_state,
            "cash_on_delivery" => $this->cash_on_delivery,
            "featured" => $this->featured,
            "seller_featured" => $this->seller_featured,
            "current_stock" => $this->current_stock,
            "weight" => $this->weight,
            "min_qty" => $this->min_qty,
            "low_stock_quantity" => $this->low_stock_quantity,
            "discount" => $this->discount,
            "discount_type" => $this->discount_type,
            "discount_start_date" => date("Y-m-d", $this->discount_start_date),
            "discount_end_date" => date("Y-m-d", $this->discount_end_date),
            "tax" => $this->taxes,
            "tax_type" => $this->tax_type,
            "shipping_type" => $this->shipping_type,
            "shipping_cost" => $this->shipping_cost,
            "is_quantity_multiplied" => $this->is_quantity_multiplied,
            "est_shipping_days" => $this->est_shipping_days,
            "num_of_sale" => $this->num_of_sale,
            "meta_title" => $this->meta_title,
            "meta_description" => $this->meta_description,
            "meta_img" =>new UploadedFileCollection(Upload::where("id",$this->meta_img)->get()), 
            "pdf" =>new UploadedFileCollection(Upload::whereIn("id",explode(",",$this->pdf))->get()),
            "slug" => $this->slug,
            "rating" => $this->rating,
            "barcode" => $this->barcode,
            "digital" => $this->digital,
            "auction_product" => $this->auction_product,
            "file_name" => $this->file_name,
            "file_path" => $this->file_path,
            "external_link" => $this->external_link,
            "external_link_btn" => $this->external_link_btn,
            "wholesale_product" => $this->wholesale_product,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }


    public function with($request)
    {
        return [
            'result' => true,
            'status' => 200
        ];
    }
}
