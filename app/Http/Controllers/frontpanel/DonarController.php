<?php

namespace App\Http\Controllers\frontpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DonarController extends Controller
{
    public function list()
    {
        // Returns the 'history' view
        return view('frontend.donar.index');
    }
}
