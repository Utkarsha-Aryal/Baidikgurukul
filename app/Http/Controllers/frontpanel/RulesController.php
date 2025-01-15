<?php

namespace App\Http\Controllers\frontpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RulesController extends Controller
{
    public function rules()
    {
        // Returns the 'history' view
        return view('frontend.rules.index');
    }
}
