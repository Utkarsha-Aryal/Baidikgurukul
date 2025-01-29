<?php

namespace App\Http\Controllers\frontpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BackPanel\Post;
use Exception;
use Illuminate\Database\QueryException;

class NewsController extends Controller
{
    public function news()
    {
        try {
            $type = 'success';
            $message = 'Successfully fetched data';
            $posts = Post::where('status', 'Y')
                ->orderBy('id', 'desc')
                ->paginate(6);
            $data = [
                'posts' => $posts,
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
        return view('frontend.news.index', $data);
    }

    public function innerpage($slug)
    {
        try {
            $type = 'success';
            $message = 'Successfully fetched data';
            $data = [];
            $post = Post::where('slug', $slug)->first();
            $posts = Post::where('status', 'Y')
                ->orderBy('id', 'desc')
                ->get();


            $data = [
                'post' => $post,
                'posts' => $posts,
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
        return view('frontend.news.inner', $data);
    }
}