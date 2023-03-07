<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    function delete(Request $request)
    {
        Comment::destroy($request->id);
        return 1;
    }

    function negative(){
        if (auth()->guest() || auth()->user()->role != 'admin') {
            return back();
        }
        return view('comments')->with('comments',Comment::where('positive',0)->simplePaginate(10));

    }

}
