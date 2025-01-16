<?php

namespace App\Http\Controllers\frontpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BackPanel\Event;
use Exception;
use Illuminate\Database\QueryException;

class EventController extends Controller
{
    public function event()
    {
        // Returns the 'history' view
        return view('frontend.event.index');
    }


    public function innerpage($slug)
    {
        try {
            $type = 'success';
            $message = 'Successfully fetched data';
            $data = [];
            $event = Event::where('slug', $slug)->first();

            $data = [
                'event' => $event,
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
        return view('frontend.event.inner', $data);
    }
}
