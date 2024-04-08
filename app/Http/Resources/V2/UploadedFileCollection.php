<?php

namespace App\Http\Resources\V2;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UploadedFileCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    'id' => $data->id,
                    'file_original_name' =>$data->file_original_name,
                    'file_name' => $data->file_name,
                    'url' => uploaded_asset($data->id),
                    'file_size' => $data->file_size,
                    'extension' => $data->extension,
                    'type' => $data->type
                ];
            })
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
