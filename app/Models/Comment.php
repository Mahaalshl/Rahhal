<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $table = 'comments';
    public $timestamps = false;

    public function commentable()
    {
        return $this->morphTo();
    }
    public function writer()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
