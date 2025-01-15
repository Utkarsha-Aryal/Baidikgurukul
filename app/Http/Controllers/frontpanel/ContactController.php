<?php

namespace App\Http\Controllers\frontpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ContactController extends Controller
{
    public function contact()
    {
        // Returns the 'history' view
        return view('frontend.contact.index');
    }
}
