<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return back();
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function signup(Request $request)
    {
        $request->validate([
            'signup_name' => ['required'],
            'signup_password' => ['required'],
            'signup_email' => ['required', 'email'],
        ]);
        $users_count = User::Where('role', '!=', 'admin')->count();
        $user = new User();
        $user->name = $request->signup_name;
        $user->email = $request->signup_email;
        $user->password = bcrypt($request->signup_password);
        $user->description = $request->signup_description;
        $imageName = time() . '.' . $request->signup_image->extension();
        $request->signup_image->move(public_path('img'), $imageName);
        $user->image = '/img/' . $imageName;
        if ($users_count <= 5) {
            $user->role = 'traveler';
        } else {
            $user->role = 'visitor';
        }
        $user->save();
        Alert::success('Successful Registrartion');
        if (Auth::attempt(['email' => $request->signup_email, 'password' => $request->signup_password])) {
            $request->session()->regenerate();
            return back();
        }

    }

    public function logout()
    {
        Auth::logout();
        return redirect('home');
    }
}
