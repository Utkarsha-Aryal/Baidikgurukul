<?php

namespace App\Http\Controllers\frontpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BackPanel\AboutUs;
use App\Models\BackPanel\Event;
use App\Models\BackPanel\History;
use App\Models\BackPanel\Program;
use App\Models\BackPanel\SiteSetting;
use App\Models\BackPanel\MessageFrom;
use Exception;
use Illuminate\Database\QueryException;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        try {
            $type = 'success';

            $message = 'Successfully fetched data';

            $sitesetting = SiteSetting::find(1);

            $about = AboutUs::find(1);

            $programs = Program::selectRaw('title,image,slug')
                ->where('status', 'Y')
                ->latest()
                ->limit(6)
                ->get();


            $events = Event::selectRaw('title, details,image,slug,event_date,address,event_time_start,event_time_end,venue')
                ->where('status', 'Y')
                ->orderBy('id', 'desc')
                ->take(3)
                ->get();
                
            foreach ($events as $event) {
                $formattedDates[$event->id] = dayandmonth($event->event_date);
            }


            $histories = History::selectRaw('title, details,image,slug')
                ->where('status', 'Y')
                ->orderBy('id', 'desc')
                ->take(3)
                ->get();

            $message = MessageFrom::selectRaw('name,image,designation,message,slug,title')
                ->where('status', 'Y')
                ->where('display_in_home', 'Y')
                ->first();

            $eventImage = Event::where('status', 'Y')
                ->orderBy('id', 'desc')
                ->first();

            $data = [
                'sitesetting' => $sitesetting,
                'eventImage' => $eventImage,
                'about' => $about,
                'programs' => $programs,
                'events' => $events,
                'histories' => $histories,
                'formattedDates' => $formattedDates,
                'events' => $events,
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
        return view('frontend.home.index', $data);
    }
}