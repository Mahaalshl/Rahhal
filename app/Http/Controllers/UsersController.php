<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class UsersController extends Controller
{
    function all()
    {
        if (auth()->guest() || auth()->user()->role != 'admin') {
            return back();
        }

        return view('users.all')->with('users', User::simplePaginate(10));
    }

    function delete(Request $request)
    {
        User::destroy($request->id);
        return 1;
    }

    function createPage()
    {
        if (auth()->guest() || auth()->user()->role != 'admin') {
            return back();
        }
        return view('users.create');
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'password' => ['required'],
            'c_password' => ['required', 'same:password'],
            'email' => ['required', 'email'],
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = 'admin';
        $user->image = '/img/def.png';
        $user->save();
        Alert::success('User Added Successfully');
        return redirect('/users');
    }
    public function editPage(Request $request){
        $user = User::find($request->id);
        return view('users.edit')->with('user',$user);
    }

    public function promote(Request $request)
    {
        $user = User::find($request->id);
        $user->role = 'traveler';
        Alert::success('User Updated Sucessfully');
        $user->save();
        return 1;
    }
    public function dispromote(Request $request)
    {
        $user = User::find($request->id);
        $user->role = 'visitor';
        Alert::success('User Updated Sucessfully');
        $user->save();
        return 1;
    }
    public function likeCount(Request $request)
    {
        $checkLike = Like::where("user_id", Auth::id())->where("likable_id", $request->id)->where("likable_type", "App\Models\Post")->count();
        return 1;
    }

}
