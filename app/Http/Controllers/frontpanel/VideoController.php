<?php

namespace App\Http\Controllers\frontpanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\BackPanel\Gallery;
use Exception;
use Illuminate\Database\QueryException;

class VideoController extends Controller
{
    public function index()
    {
        try {
            $galleries = Gallery::whereHas('videos', function ($q) {
                $q->where('status', 'Y');
            })->where('status', 'Y')
              ->orderBy('id', 'desc')
              ->get();

            $data = [
                'galleries' => $galleries,
            ];
            
            return view('frontend.gallery.video', $data);
        } catch (QueryException $e) {
            return view('frontend.gallery.video')->withErrors(['error' => 'Database error']);
        } catch (Exception $e) {
            return view('frontend.gallery.video')->withErrors(['error' => $e->getMessage()]);
        }
    }
}
