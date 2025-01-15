<?php

namespace App\Http\Controllers\frontpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HistoryController extends Controller
{
    public function history()
    {
        // Returns the 'history' view
        return view('frontend.history.index');
    }
}
