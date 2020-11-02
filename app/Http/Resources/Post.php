<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class Post extends JsonResource
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
            'topic' => $this->topic,
            'content' => $this->content,
            'user' => [
                'name' => $this->user->name,
                'email' => $this->user->email
            ],
            'view_count' => $this->view_count,
            'is_popular' => $this->view_count > 1000,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'attachments' => new AttachmentCollection($this->attachments),
        ];

    }
}
