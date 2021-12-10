<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    const PENDING = 1;
    const APPROVED = 2;
    const REJECTED = 3;

    protected $casts = [
        'time' => 'datetime', // is needed?
        'is_approved' => 'integer'
    ];

    public function scopeContent($query)
    {
        $query->select('id','user_id','author_name','author_email','content','created_at','parent_id','is_approved');
    }

    public function scopeApproved($query)
    {
        $query->where('is_approved', $this->APPROVED);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }
}
