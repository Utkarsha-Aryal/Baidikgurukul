<?php

namespace App\Http\Controllers\frontpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BackPanel\GalleryImage;
use Exception;
use Illuminate\Database\QueryException;

class GalleryController extends Controller
{
    public function gallery()
    {
        try {
            $type = 'success';
            $message = 'Successfully fetched data';

            $images = GalleryImage::where('status', 'Y')
                ->orderBy('id', 'desc')
                ->get();

            $videos = GalleryImage::where('status', 'Y')
                ->orderBy('id', 'desc')
                ->get();

            $data = [
                'images' => $images,
                'videos' => $videos,
                'type' => $type,
                'message' => $message
            ];
        } catch (QueryException $e) {
            $data['type'] = 'error';
            $data['message'] = $this->queryMessage;
        } catch (Exception $e) {
            $data['type'] = 'error';
            $data['message'] = $e->getMessage();
        }
        return view('frontend.gallery.index');
    }


    public function ginner()
    {

        return view('frontend.gallery.inner');
    }
}
