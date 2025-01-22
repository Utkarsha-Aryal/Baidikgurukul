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
        try {
            $type = 'success';
            $message = 'Successfully fetched data';
            $data = [];

            $events = Event::where('status', 'Y')
                ->orderBy('id', 'desc')
                ->paginate(3);

            $eventImage = Event::where('status', 'Y')
                ->orderBy('id', 'desc')->first();


            $data = [
                'events' => $events,
                'eventImage' => $eventImage,
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
        return view('frontend.event.index', $data);
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
