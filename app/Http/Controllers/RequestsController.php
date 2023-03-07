<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Event;
use App\Models\Like;
use App\Models\Place;
use App\Models\RequestModel;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class RequestsController extends Controller
{
    function createPage()
    {
        if (auth()->guest() || auth()->user()->role != 'traveler') {
            return back();
        }
        return view('requests.create')->with("regions", Region::all());
    }

    function editPage(Request $request)
    {
        $request = RequestModel::find($request->id);
        if (auth()->guest() || auth()->user()->id != $request->created_by) {
            return back();
        }
        return view('requests.edit')->with("request", $request)->with("regions", Region::all());
    }

    function create(Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $requestObj = new RequestModel();
        $requestObj->title = $request->title;
        $requestObj->created_by = auth()->id();
        $requestObj->description = $request->description;
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('img'), $imageName);
        $requestObj->picture = '/img/' . $imageName;
        $requestObj->event_date = $request->event_date;
        $requestObj->region_id = $request->region;
        $requestObj->request_type = $request->request_type;
        $requestObj->state = "pending";
        $requestObj->save();
        Alert::success('Request Submitted Successfully');
        return redirect('requests');
    }

    function edit(Request $request)
    {
        $request->validate([
            'title' => ['required'],
        ]);
        $requestObj = RequestModel::find($request->id);
        $requestObj->title = $request->title;
        $requestObj->description = $request->description;
        $requestObj->event_date = $request->event_date;
        $requestObj->region_id = $request->region;
        if ($request->has('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('img'), $imageName);
            $requestObj->picture = '/img/' . $imageName;
        }
        $requestObj->save();
        Alert::success('Request Updated Successfully');
        return redirect('requests');
    }


    function accept(Request $request)
    {
        $requestObj = RequestModel::find($request->id);
        $requestObj->state = 'accepted';
        $requestObj->save();
        if ($requestObj->request_type == 'place') {
            $place = new Place();
            $place->title = $requestObj->title;
            $place->created_by = auth()->id();
            $place->description = $requestObj->description;
            $place->picture = $requestObj->picture;
            $place->region_id = $requestObj->region_id;
            Alert::success('Requests Accepted Successfully');
            $place->save();
        } else if ($requestObj->request_type == 'event') {
            $event = new Event();
            $event->title = $requestObj->title;
            $event->created_by = auth()->id();
            $event->description = $requestObj->description;
            $event->picture = $requestObj->picture;
            $event->event_date = $requestObj->event_date;
            $event->save();
            Alert::success('Requests Accepted Successfully');

        }


        return back();
    }

    function reject(Request $request)
    {
        $requestObj = RequestModel::find($request->id);
        $requestObj->state = 'rejected';
        $requestObj->save();
        Alert::success('Requests Rejected Successfully');
        return back();
    }

    function all(Request $request)
    {
        if ($request->has('s')) {
            $requests = RequestModel::where(function ($query) use ($request) {
                $query->where('title', 'like', "%$request->s%")->orWhere('description', 'like', "%$request->s%");
            })->orderBy('id', 'desc');
        } else {
            $requests = RequestModel::orderBy('id', 'desc');
        }
        if (Auth::user()->role == 'traveler') {
            $requests = $requests->where("created_by", Auth::id());
        }

        $requests = $requests->simplePaginate(5);

        return view('requests.all')->with("requests", $requests);

    }

    function single(Request $request)
    {
        $requestObj = RequestModel::find($request->id);
        return view('requests.single')->with("request", $requestObj);

    }

    function delete(Request $request)
    {
        RequestModel::destroy($request->id);
        return 1;
    }

    function comment(Request $request)
    {
        $request->validate([
            'comment' => ['required'],
            'request_id' => ['required'],
        ]);
        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->commentable_id = $request->request_id;
        $comment->commentable_type = "App\Models\RequestModel";
        $comment->body = $request->comment;
        $comment->save();
        Alert::success('Comment Added Successfully');
        return back();

    }
}
