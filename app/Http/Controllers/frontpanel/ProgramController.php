<?php


namespace App\Http\Controllers\frontpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProgramController extends Controller
{
    public function program()
    {

        return view('frontend.program.index');
    }
    public function pinner()
    {

        return view('frontend.program.inner');
    }
}
