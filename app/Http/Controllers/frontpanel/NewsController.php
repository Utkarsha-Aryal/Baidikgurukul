<?php

namespace App\Http\Controllers\frontpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function news()
    {

        return view('frontend.news.index');
    }
    public function ninner()
    {

        return view('frontend.news.inner');
    }
}
