<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PostTag extends Pivot
{
    public static function boot()
    {
        parent::boot();

        static::saved(function($item) {
            Tag::find($item->tag_id)->increment('posts_count', 1);
        });
    }
}