<?php

namespace App\Http\Controllers\frontpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
    public function gallery()
    {

        return view('frontend.gallery.index');
    }
    public function ginner()
    {

        return view('frontend.gallery.inner');
    }
}
