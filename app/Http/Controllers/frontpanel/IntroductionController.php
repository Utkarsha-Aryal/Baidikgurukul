<?php

namespace App\Http\Controllers\frontpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IntroductionController extends Controller
{
    public function introduction()
    {
        // Returns the 'home' view
        return view('frontend.aboutus.index');
        
    }
    public function new()
    {
        // Returns the 'home' view
        return view('frontend.aboutus.new');
        
    }
}
