<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\contactMai;
use RealRashid\SweetAlert\Facades\Alert;

class contactController extends Controller
{
    public function contact(){
        return view('contact');
    }
    public function sendMail(Request $request){
        $request->validate([
            'name' => ['required'],
            'message' => ['required'],
            'email' => 'required|email',
            'subject' => ['required']
        ]);
        $data=[
            'name' => $request->name,
            'message' => $request->message,
            'email' => $request->email,
            'subject' => $request->subject,
        ];
        Mail::to('Rahhalteam4@gmail.com')->send(new contactMai($data));
        Alert::success('Message Send Sucessfully');
        return back();



    }
}
