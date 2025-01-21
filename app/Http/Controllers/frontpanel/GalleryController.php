<?php

namespace App\Http\Controllers\frontpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BackPanel\Gallery;
use App\Models\BackPanel\GalleryImage;
use App\Models\BackPanel\GalleryVideo;
use Exception;
use Illuminate\Database\QueryException;

class GalleryController extends Controller
{
    public function gallery()
    {
        try {
        $type = 'success';
        $message = 'Successfully fetched data';

        $galleries = Gallery::with('images', 'videos')
            ->where('status', 'Y')
            ->orderBy('id', 'desc')
            ->get();

        $images = GalleryImage::with('imageGallery')
            ->where('status', 'Y')
            ->orderBy('id', 'desc')
            ->get();

        $videos = GalleryVideo::with('videoGallery')
            ->where('status', 'Y')
            ->orderBy('id', 'desc')
            ->get();

        $firstGallery = $galleries->first();

        // $videoImage = $galleries->videos->video_image->get();

        // foreach ($galleries as $gallery) {
        //     // Loop through each video in the current gallery
        //     foreach ($gallery->videos as $video) {
        //         // Access the video image
        //         $videoImage = $video->video_image; // Assuming 'video_image' is the field
        //         // dd($videoImage);
        //     }
        // }

        // $videoImage = $firstGallery->videos->first()->video_image;
        $data = [
            'images' => $images,
            // 'videoImage' => $videoImage,
            'galleries' => $galleries,
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
        return view('frontend.gallery.index', $data);
    }


    public function ginner($slug)
    {
        try {
        $type = 'success';
        $message = 'Successfully fetched data';
        $data = [];
        $galleries = Gallery::where('slug', $slug)
            ->where('status', 'Y')
            ->orderBy('id', 'desc')
            ->first();

        $galleryId = $galleries->id;

        $videos = GalleryVideo::where('gallery_id', $galleryId)
            ->where('status', 'Y')
            ->orderBy('id', 'desc')
            ->get();


        $data = [
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
        return view('frontend.gallery.video', $data);
    }

    public function imageInner($slug)
    {
        try {
            $type = 'success';
            $message = 'Successfully fetched data';
            $data = [];
            $galleries = Gallery::with('images', 'videos')
                ->where('slug', $slug)
                ->where('status', 'Y')
                ->orderBy('id', 'desc')
                ->first();

            $galleryId = $galleries->id;

            $images = GalleryImage::where('gallery_id', $galleryId)
                ->where('status', 'Y')
                ->orderBy('id', 'desc')
                ->get();

            $data = [
                'images' => $images,
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
        return view('frontend.gallery.image', $data);
    }
}