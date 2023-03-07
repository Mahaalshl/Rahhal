<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class EventsController extends Controller
{
    function createPage()
    {
        if (auth()->guest() || auth()->user()->role != 'admin') {
            return back();
        }
        return view('events.create');
    }

    function editPage(Request $request)
    {
        $event = Event::find($request->id);
        if (auth()->guest() || auth()->user()->id != $event->created_by) {
            return back();
        }
        return view('events.edit')->with("event", $event);
    }

    function create(Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => ['required'],

        ]);
        $event = new Event();
        $event->title = $request->title;
        $event->created_by = auth()->id();
        $event->description = $request->description;
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('img'), $imageName);
        $event->picture = '/img/' . $imageName;

        $event->event_date = $request->event_date;
        $event->save();
        Alert::success('Event Added Successfully');
        return redirect('events');
    }

    function edit(Request $request)
    {
        $request->validate([
            'title' => ['required'],
        ]);
        $event = Event::find($request->id);
        $event->title = $request->title;
        $event->created_by = auth()->id();
        $event->description = $request->description;
        if ($request->has('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('img'), $imageName);
            $event->picture = '/img/' . $imageName;
        }
        $event->event_date = $request->event_date;
        $event->save();
        Alert::success('Event Updated Successfully');
        return redirect('events');
    }


    function all(Request $request)
    {
        if ($request->has('s')) {
            $events = Event::where('title', 'like', "%$request->s%")->orWhere('description', 'like', "%$request->s%")->orderBy('id', 'desc')->simplePaginate(5);;
        } else {
            $events = Event::orderBy('id', 'desc')->simplePaginate(5);
        }
        $recentEvents = Event::orderBy('id', 'desc')->limit(5)->get();
        return view('events.all')->with("events", $events)->with('recentEvents', $recentEvents);

    }

    function upcoming()
    {
        $events = Event::where('event_date', '>=', Carbon::now())->orderBy('event_date', 'asc')->simplePaginate(5);
        $recentEvents = Event::orderBy('id', 'desc')->limit(5)->get();
        return view('events.upcoming')->with("events", $events)->with('recentEvents', $recentEvents);

    }

    function single(Request $request)
    {
        $event = Event::find($request->id);
        $recentEvents = Event::orderBy('id', 'desc')->limit(5)->get();
        $checkLike = 0;
        if (!Auth::guest()) {
            $checkLike = Like::where("user_id", Auth::id())->where("likable_id", $event->id)->where("likable_type", "App\Models\Event")->count();
        }
        return view('events.single')->with("event", $event)->with('recentEvents', $recentEvents)->with("checkLike", $checkLike);

    }

    function like(Request $request)
    {
        $checkLike = Like::where("user_id", Auth::id())->where("likable_id", $request->id)->where("likable_type", "App\Models\Event")->count();
        if ($checkLike == 0) {
            $like = new Like();
            $like->user_id = Auth::id();
            $like->likable_id = $request->id;
            $like->likable_type = "App\Models\Event";
            $like->save();
            return 1;
        } else {
            Like::where("user_id", Auth::id())->where("likable_id", $request->id)->where("likable_type", "App\Models\Event")->delete();
            return 0;
        }


    }

    function comment(Request $request)
    {
        $request->validate([
            'comment' => ['required'],
            'event_id' => ['required'],
        ]);
        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->commentable_id = $request->event_id;
        $comment->commentable_type = "App\Models\Event";
        $comment->body = $request->comment;
        try {
            $response = Http::post('http://127.0.0.1:5000/predict/comment', ['comment' => $request->comment])->json();
            $comment->positive = $response['result'];
        }
        catch (\Exception $exception){
        }
        Alert::success('Comment added successfully');
        $comment->save();
        return back();

    }

    function delete(Request $request)
    {
        Event::destroy($request->id);
        Comment::where('commentable_type','App\Models\Event')->where('commentable_id',$request->id)->delete();
        Like::where('likable_type','App\Models\Event')->where('likable_id',$request->id)->delete();

        return 1;
    }
}
