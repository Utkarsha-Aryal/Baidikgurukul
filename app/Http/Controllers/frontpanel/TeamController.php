<?php

namespace App\Http\Controllers\frontpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeamController extends Controller
{
    public function ourteam()
    {

        return view('frontend.ourteam.index');
    }
    public function teaminner()
    {

        return view('frontend.ourteam.inner');
    }
}
