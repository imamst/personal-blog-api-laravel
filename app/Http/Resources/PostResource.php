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
            'id' => $this->id,
            'author_id' => $this->user_id,
            'author_name' => $this->author_name,
            'title' => $this->title,
            'published_date' => $this->published_date,
            'slug' => $this->slug,
            'featured_img' => $this->featured_img,
            'excerpt' => $this->excerpt,
            'content' => $this->content,
            'status' => $this->status,
            'comment_status' => $this->comment_status,
            'comment_count' => $this->comment_count,
            'comments' => CommentResource::collection($this->comments()->content()->approved()->latest())
        ];
    }
}
