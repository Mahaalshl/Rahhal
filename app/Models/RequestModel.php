<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestModel extends Model
{
    protected $table = 'requests';
    public $timestamps = false;

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }


    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
