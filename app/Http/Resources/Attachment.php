<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Attachment extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'asset_url' => asset($this->asset_path . '/'.$this->file_name),
            'asset_type' => $this->file_type,
            'name' => $this->name
        ];
    }
}
