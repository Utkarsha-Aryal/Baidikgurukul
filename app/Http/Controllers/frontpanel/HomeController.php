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
use App\Models\BackPanel\Notice;
use App\Models\BackPanel\TeamMember;
use App\Models\BackPanel\Gallery;
use App\Models\BackPanel\Post;
use Exception;

use Carbon\Carbon;

use Illuminate\Database\QueryException;

class HomeController extends Controller
{
    public function index(Request $request)
    {
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
            ->whereDate('event_date', '>=', now())
            ->orderBy('id', 'desc')
            ->take(3)
            ->get();

            $news = Post::selectRaw('title,slug,event_date,event_address,image,details')->where('status','Y')->limit(3)->get();

        $galleries = Gallery::selectRaw('name,image,slug')->where('status','Y')->limit(3)->get();

        $formattedDates = [];

        if ($events->isNotEmpty()) {
            foreach ($events as $event) {
                $formattedDates[$event->id] = dayandmonth($event->event_date);
            }
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
            

        $teamMembers = TeamMember::query()
    ->where([
        ['team_category_id', 1],
        ['time_interval_id', 1],
        ['status', 'Y']
    ])
    ->orderBy('order')
    ->limit(3)
    ->get();

        $today = Carbon::today()->toDateString();


        $notices = Notice::where('status', 'Y')
            ->whereDate('start_date', '<=', $today)
            ->whereDate('end_date', '>=', $today)
            ->orderBy('order_number', 'desc')
            ->get();

        $data = [
            'sitesetting' => $sitesetting,
            'eventImage' => $eventImage,
            'notices' => $notices,
            'about' => $about,
            'programs' => $programs,
            'events' => $events,
            'news' => $news,
            'histories' => $histories,
            'galleries' => $galleries,
            'formattedDates' => $formattedDates,
            'teamMembers' => $teamMembers,
            'type' => $type,
            'message' => $message
        ];

        return view('frontend.home.index', $data);
    }
}
