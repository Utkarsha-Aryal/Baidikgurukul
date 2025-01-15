<?php

namespace App\Http\Controllers\frontpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FaqController extends Controller
{
    public function faq()
    {
        // Returns the 'history' view
        return view('frontend.faq.index');
    }
}
