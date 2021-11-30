<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Databse\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    const STATUS_DRAFT = 1;
    const STATUS_PUBLISHED = 2;

    const TYPE_POST = 1;
    const TYPE_PAGE = 2;

    const COMMENT_CLOSED = 1;
    const COMMENT_OPENED = 2;

    protected $casts = [
        'date' => 'date',
        'status' => 'integer',
        'post_type' => 'integer',
        'comment_status' => 'integer',
        'comment_count' => 'integer'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
