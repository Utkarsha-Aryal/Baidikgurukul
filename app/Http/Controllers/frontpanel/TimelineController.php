<?php


namespace App\Http\Controllers\frontpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BackPanel\Timeline;
use Exception;
use Illuminate\Database\QueryException;

class TimelineController extends Controller
{
    public function index(Request $request)
    {
        try {
            $type = 'success';
            $message = 'Successfully fetched data';

            $timelines = Timeline::selectRaw('details,year')
                ->where('status', 'Y')
                ->orderBy('id', 'desc')
                ->get();

            $data = [];

            $data = [
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
        return view('frontend.timeline.index', $data);
    }
}
