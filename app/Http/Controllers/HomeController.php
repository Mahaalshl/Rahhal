<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Place;
use App\Models\Region;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    function index($locale = 'en')
    {
        if ($locale == 'ar' || $locale == 'en') {
            App::setLocale($locale);
        }

        $places = Place::orderBy('id','desc')->take(3)->get();
        $event = Event::where('event_date', '>=', Carbon::now())->orderBy('event_date', 'asc')->first();
        return view('home')->with("regions",Region::all())->with('places',$places)->with('event',$event);
    }
}
