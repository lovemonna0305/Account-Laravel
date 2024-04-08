<?php

namespace App\Http\Resources\V2\Seller;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoriesCollection extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'                =>(int) $this->id,
            'parent_id'         => $this->parent_id,
            'level'             => $this->level,
            'name'              =>$this->name,
            'banner'            =>uploaded_asset($this->banner),
            'icon'              => uploaded_asset($this->icon),
            'featured'          =>$this->featured==0?false:true,
            'digital'           =>$this->digital==0?false:true,
            'slug'              =>$this->slug,
            'meta_title'        =>$this->meta_title
        ];
    }
}
