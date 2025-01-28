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

            $events = Event::selectRaw('title, details, image, slug, address, venue, event_date, event_time_start, event_time_end, feature_image')
                ->where('status', 'Y')
                ->orderBy('id', 'asc')
                ->paginate(3);

            foreach ($events as $event) {
                $formattedDates[$event->id] = dayandmonth($event->event_date);
            }

            $eventImage = Event::where('status', 'Y')
                ->orderBy('id', 'desc')->first();

            $data = [
                'events' => $events,
                'eventImage' => $eventImage,
                'formattedDates' => $formattedDates,
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

            $formattedDates[$event->id] = dayandmonth($event->event_date);

            $data = [
                'event' => $event,
                'type' => $type,
                'message' => $message,
                'formattedDates' => $formattedDates,
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
