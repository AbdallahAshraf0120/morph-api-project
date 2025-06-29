<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
    protected $fillable = ['external_id', 'title', 'url'];

    public function comments()
    {
        return $this->morphMany(\App\Models\Comment::class, 'commentable');
    }
}