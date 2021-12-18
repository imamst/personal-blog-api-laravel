<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CategoryPost extends Pivot
{
    public static function boot()
    {
        parent::boot();

        static::saved(function($item) {
            Category::find($item->category_id)->increment('posts_count', 1);
        });
    }
}