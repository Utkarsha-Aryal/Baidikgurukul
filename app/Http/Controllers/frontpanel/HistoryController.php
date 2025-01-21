<?php

namespace App\Http\Controllers\frontpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BackPanel\History;
use Exception;
use Illuminate\Database\QueryException;

class HistoryController extends Controller
{
    public function history()
    {
        try {
            $type = 'success';
            $message = 'Successfully fetched data';
            $data = [];
            $histories = History::where('status', 'Y')
                ->orderBy('id', 'desc')
                ->get();


            $data = [
                'histories' => $histories,
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
        return view('frontend.history.index', $data);
    }

    public function inner($slug)
    {
        try {
            $type = 'success';
            $message = 'Successfully fetched data';
            $data = [];
            $history = History::where('slug', $slug)->first();
            $histories = History::where('status', 'Y')
                ->orderBy('id', 'desc')
                ->get();


            $data = [
                'history' => $history,
                'histories' => $histories,
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
        return view('frontend.history.inner', $data);
    }

    public function inners($slug)
    {
        // try {
        $type = 'success';
        $message = 'Successfully fetched data';
        $data = [];

        // Fetch the single history based on the slug
        $historyDeatils = History::where('slug', $slug)->first(); // This gets the clicked (single) data

        // Fetch all histories with 'Y' status, ordered by slug
        $histories = History::where('status', 'Y')
            ->orderBy('slug', 'asc')  // Order by 'slug' in ascending order
            ->get();



        $data = [
            'historyDeatils' => $historyDeatils,
            'histories' => $histories,
            'type' => $type,
            'message' => $message
        ];
        // } catch (QueryException $e) {
        //     $data['type'] = 'error';
        //     $data['message'] = $this->queryMessage;
        // } catch (Exception $e) {
        //     $data['type'] = 'error';
        //     $data['message'] = $e->getMessage();
        // }
        return view('frontend.history.newinner', $data);
    }
}