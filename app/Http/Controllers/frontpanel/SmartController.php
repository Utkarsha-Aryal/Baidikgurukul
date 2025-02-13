<?php

namespace App\Http\Controllers\frontpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SmartController extends Controller
{
    public function smart()
    {
        return view('frontend.smartschool.index');
    }
}
