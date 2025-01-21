<?php

namespace App\Http\Controllers\frontpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BackPanel\AboutUs;
use App\Models\BackPanel\MessageFrom;
use App\Models\BackPanel\Timeline;
use Exception;
use Illuminate\Database\QueryException;

class IntroductionController extends Controller
{
    public function introduction()
    {
        try {
            $type = 'success';
            $message = 'Successfully fetched data';

            $aboutus = AboutUs::find(1);

            $message = MessageFrom::where('status', 'Y')
                ->where('display_in_home', 'Y')
                ->first();

            $timelines = Timeline::where('status', 'Y')
                ->orderBy('id', 'asc')
                ->get();

            $data = [
                'aboutus' => $aboutus,
                'timelines' => $timelines,
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
        return view('frontend.aboutus.index', $data);
    }

    public function new()
    {
        // Returns the 'home' view
        return view('frontend.aboutus.new');
    }
}
