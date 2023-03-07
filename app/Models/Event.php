<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';
    public $timestamps = false;

    public function creator()
    {
        return $this->belongsTo(User::class,'created_by');
    }
    public function likes()
    {
        return $this->morphMany(Like::class, 'likable');
    }
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
