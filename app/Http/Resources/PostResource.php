<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CommentResource;

class PostResource extends JsonResource
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
            $this->merge(parent::toArray($request)),

            'comments' => CommentResource::collection($this->whenLoaded('comments', 
                fn() => object_get($this->comments->where('is_approved', 2)->sortByDesc('created_at')->all(), 'value')
            ))
            
        ];
    }
}
