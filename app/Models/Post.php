<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    protected $table = 'posts';
    public $timestamps = false;
    public function creator()
    {
        return $this->belongsTo(User::class,'created_by');
    }
    public function likes()
    {
        return $this->morphMany(Like::class, 'likable');
    }
//    public function isLiked($query)
//    {
//        if(Auth::guest()){
//            return 0;
//        }else{
//            return Like::where("user_id",Auth::id())->where("likable_id",$this->id)->where("likable_type","App\Models\Post")->count();
//        }
//    }
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
