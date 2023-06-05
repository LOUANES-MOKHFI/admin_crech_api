<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentBlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'blog_id'  => $this->blog_id,
            'user_id'  => $this->user_id,
            'parent_id'  => $this->parent_id,
            'comment'  => $this->comment
        ];
    }
}