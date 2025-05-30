<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'comment',
        'user_id',
        'post_id',
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function post()
    {
        return $this->hasMany(Post::class);
    }
}