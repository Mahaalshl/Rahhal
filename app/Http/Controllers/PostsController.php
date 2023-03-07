<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use function PHPUnit\Framework\isNull;
use RealRashid\SweetAlert\Facades\Alert;

class PostsController extends Controller
{
    function createPage()
    {
        if (auth()->guest() || auth()->user()->role == 'admin')  {
            return back();
        }
        return view('posts.create');
    }

    function editPage(Request $request)
    {
        $post = Post::find($request->id);
        if (auth()->guest() || auth()->user()->id != $post->created_by) {
            return back();
        }
        return view('posts.edit')->with("post", $post);
    }

    function create(Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
        $post = new Post();
        $post->title = $request->title;
        $post->created_by = auth()->id();
        $post->description = $request->description;
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('img'), $imageName);
        $post->picture = '/img/' . $imageName;

        $post->created_at = today();
        $post->save();
        Alert::success('Post Added Successfully');
        return redirect('posts');
    }

    function edit(Request $request)
    {
        $request->validate([
            'title' => ['required'],
        ]);
        $post = Post::find($request->id);
        $post->title = $request->title;
        $post->created_by = auth()->id();
        $post->description = $request->description;
        if ($request->has('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('img'), $imageName);
            $post->picture = '/img/' . $imageName;
        }
        $post->save();
        Alert::success('Place updated Successfully');
        return redirect('posts');
    }


    function all(Request $request)
    {
        if ($request->has('s')) {
            $posts = Post::where('title', 'like', "%$request->s%")->orWhere('description', 'like', "%$request->s%")->orderBy('id', 'desc')->simplePaginate(5);;
        } else {
            $posts = Post::orderBy('id', 'desc')->simplePaginate(5);
        }
        $recentPosts = Post::orderBy('id', 'desc')->limit(5)->get();
        return view('posts.all')->with("posts", $posts)->with('recentPosts', $recentPosts);

    }

    function single(Request $request)
    {
        $post = Post::find($request->id);
        $recentPosts = Post::orderBy('id', 'desc')->limit(5)->get();
        $checkLike = 0;
        if (!Auth::guest()) {
            $checkLike = Like::where("user_id", Auth::id())->where("likable_id", $post->id)->where("likable_type", "App\Models\Post")->count();
        }
        return view('posts.single')->with("post", $post)->with('recentPosts', $recentPosts)->with("checkLike", $checkLike);

    }

    function like(Request $request)
    {
        $checkLike = Like::where("user_id", Auth::id())->where("likable_id", $request->id)->where("likable_type", "App\Models\Post")->count();
        if ($checkLike == 0) {
            $like = new Like();
            $like->user_id = Auth::id();
            $like->likable_id = $request->id;
            $like->likable_type = "App\Models\Post";
            $like->save();
            return 1;
        } else {
            Like::where("user_id", Auth::id())->where("likable_id", $request->id)->where("likable_type", "App\Models\Post")->delete();
            return 0;
        }


    }

    function comment(Request $request)
    {
        $request->validate([
            'comment' => ['required'],
            'post_id' => ['required'],
        ]);
        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->commentable_id = $request->post_id;
        $comment->commentable_type = "App\Models\Post";
        $comment->body = $request->comment;
        try {
            $response = Http::post('http://127.0.0.1:5000/predict/comment', ['comment' => $request->comment])->json();
            $comment->positive = $response['result'];
        }
        catch (\Exception $exception){
        }

        $comment->save();
        Alert::success('Comment Added Successfully');
        return back();

    }

    function delete(Request $request)
    {
        Post::destroy($request->id);
        Comment::where('commentable_type','App\Models\Post')->where('commentable_id',$request->id)->delete();
        Like::where('likable_type','App\Models\Post')->where('likable_id',$request->id)->delete();
        return 1;
    }

}
