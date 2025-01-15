<?php

namespace App\Http\Controllers\frontpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    public function event()
    {
        // Returns the 'history' view
        return view('frontend.event.index');
    }
    public function einner()
    {
        // Returns the 'history' view
        return view('frontend.event.inner');
    }
}
