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

            $programs = Program::where('status', 'Y')
                ->orderBy('id', 'desc')
                ->get();

            $message = MessageFrom::where('status', 'Y')
                ->where('display_in_home', 'Y')
                ->first();

            $events = Event::where('status', 'Y')
                ->orderBy('id', 'desc')
                ->take(3)
                ->get();


            $histories = History::where('status', 'Y')
                ->orderBy('id', 'desc')
                ->take(3)
                ->get();

            $data = [
                'sitesetting' => $sitesetting,
                'about' => $about,
                'programs' => $programs,
                'events' => $events,
                'histories' => $histories,
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