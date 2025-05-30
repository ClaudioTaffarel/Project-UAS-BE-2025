<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Like extends Model
{
    protected $fillable = [
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
