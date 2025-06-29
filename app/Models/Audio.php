<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
    public function comments()
    {
        return $this->morphMany(\App\Models\Comment::class, 'commentable');
    }
}