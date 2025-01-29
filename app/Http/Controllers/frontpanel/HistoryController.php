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
            $histories = History::selectRaw('title,slug')
                ->where('status', 'Y')
                ->orderBy('id', 'desc')
                ->take(6)
                ->get();

            $history = History::selectRaw('title,details')
                ->where('status', 'Y')
                ->orderBy('id', 'desc')
                ->first();

            $data = [
                'histories' => $histories,
                'history' => $history,
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
        try {
            $type = 'success';
            $message = 'Successfully fetched data';
            $data = [];

            $historyDeatils = History::selectRaw('title,details')
                ->where(
                    'slug',
                    $slug
                )->first();

            $histories = History::selectRaw('title, details,image,slug')
                ->where('status', 'Y')
                ->orderBy('slug', 'asc')
                ->get();

            $data = [
                'historyDeatils' => $historyDeatils,
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
        return view('frontend.history.newinner', $data);
    }

    public function getTabContent($slug)
    {
        try {
            $type = 'success';
            $message = 'Successfully fetched data';
            $data = [];

            $history = History::selectRaw('details,title')
                ->where('slug', $slug)
                ->first();

            $html = view('frontend.history.tabContent', compact('history'))->render();

            $data = [
                'type' => $type,
                'message' => $message,
                'html' => $html
            ];
        } catch (QueryException $e) {
            $data['type'] = 'error';
            $data['message'] = $this->queryMessage;
            $data['html'] = '<p>An error occurred while fetching the data.</p>';
        } catch (Exception $e) {
            $data['type'] = 'error';
            $data['message'] = $this->queryMessage;
            $data['html'] = '<p>An error occurred while processing your request.</p>';
        }
        return response()->json($data);
    }
}