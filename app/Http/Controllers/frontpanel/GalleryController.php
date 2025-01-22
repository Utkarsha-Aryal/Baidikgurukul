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

            $galleryVideoImages = [];

            foreach ($galleries as $gallery) {
                if ($gallery->videos->isNotEmpty()) {
                    $latestVideo = $gallery->videos->sortByDesc('created_at')->first();
                    $galleryVideoImages[$gallery->id] = $latestVideo->video_image;
                }
            }

            $data = [
                'images' => $images,
                'galleries' => $galleries,
                'galleryVideoImages' => $galleryVideoImages,
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