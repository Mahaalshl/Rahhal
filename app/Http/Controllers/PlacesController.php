<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Place;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class PlacesController extends Controller
{
    function createPage()
    {
        if (auth()->guest() || auth()->user()->role != 'admin') {
            return back();
        }
        return view('places.create')->with("regions", Region::all());
    }

    function editPage(Request $request)
    {
        $place = Place::find($request->id);
        if (auth()->guest() || auth()->user()->id != $place->created_by) {
            return back();
        }
        return view('places.edit')->with("place", $place)->with("regions", Region::all());
    }

    function create(Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
        $place = new Place();
        $place->title = $request->title;
        $place->created_by = auth()->id();
        $place->description = $request->description;
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('img'), $imageName);
        $place->picture = '/img/' . $imageName;
        $place->region_id = $request->region;
        $place->save();
        Alert::success('Place Added Successfully');
        return redirect('places');
    }

    function edit(Request $request)
    {
        $request->validate([
            'title' => ['required'],
        ]);
        $place = Place::find($request->id);
        $place->title = $request->title;
        $place->created_by = auth()->id();
        $place->description = $request->description;
        if ($request->has('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('img'), $imageName);
            $place->picture = '/img/' . $imageName;
        }
        $place->region_id = $request->region;

        $place->save();
        Alert::success('Place updated Successfully');
        return redirect('places');
    }


    function all(Request $request)
    {
        $places = Place::orderBy('id', 'desc');
        if ($request->has('s') and $request->s != '') {
            $places = $places->where(function ($query) use ($request) {
                $query->where('title', 'like', "%$request->s%")->orWhere('description', 'like', "%$request->s%");
            });
        }
        if ($request->has('region') and $request->region != -1) {
            $places = $places->where('region_id', "$request->region");
        }
        $places = $places->simplePaginate(5);
        $recentPlaces = Place::orderBy('id', 'desc')->limit(5)->get();
        return view('places.all')->with("places", $places)->with('recentPlaces', $recentPlaces)->with("regions", Region::all());

    }

    function single(Request $request)
    {
        $place = Place::find($request->id);
        $recentPlaces = Place::orderBy('id', 'desc')->limit(5)->get();
        $checkLike = 0;
        if (!Auth::guest()) {
            $checkLike = Like::where("user_id", Auth::id())->where("likable_id", $place->id)->where("likable_type", "App\Models\Place")->count();
        }
        return view('places.single')->with("place", $place)->with('recentPlaces', $recentPlaces)->with("checkLike", $checkLike)->with("regions", Region::all());

    }

    function like(Request $request)
    {
        $checkLike = Like::where("user_id", Auth::id())->where("likable_id", $request->id)->where("likable_type", "App\Models\Place")->count();
        if ($checkLike == 0) {
            $like = new Like();
            $like->user_id = Auth::id();
            $like->likable_id = $request->id;
            $like->likable_type = "App\Models\Place";
            $like->save();
            return 1;
        } else {
            Like::where("user_id", Auth::id())->where("likable_id", $request->id)->where("likable_type", "App\Models\Place")->delete();
            return 0;
        }


    }

    function comment(Request $request)
    {
        $request->validate([
            'comment' => ['required'],
            'place_id' => ['required'],
        ]);
        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->commentable_id = $request->place_id;
        $comment->commentable_type = "App\Models\Place";
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
        Place::destroy($request->id);
        Comment::where('commentable_type','App\Models\Place')->where('commentable_id',$request->id)->delete();
        Like::where('likable_type','App\Models\Place')->where('likable_id',$request->id)->delete();
        return 1;
    }
}
