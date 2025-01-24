<?php

namespace App\Http\Controllers\frontpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BackPanel\Ritual;
use Exception;
use Illuminate\Database\QueryException;

class RulesController extends Controller
{
    public function rules()
    {
        try {
            $type = 'success';
            $message = 'Successfully fetched data';
            $data = [];
            $ritules = Ritual::selectRaw('title,slug')
                ->where('status', 'Y')
                ->orderBy('order_number', 'asc')
                ->get();

            $rule = Ritual::selectRaw('title,details')
                ->where('status', 'Y')
                ->orderBy('order_number', 'asc')
                ->first();

            $data = [
                'ritules' => $ritules,
                'rule' => $rule,
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
        return view('frontend.rules.index', $data);
    }

    public function birth()
    {
        return view('frontend.rules.birth');
    }

    public function getTabContent($slug)
    {
        try {
            $type = 'success';
            $message = 'Successfully fetched data';
            $data = [];

            $rule = Ritual::selectRaw('details,title')
                ->where('slug', $slug)
                ->first();

            $html = view('frontend.rules.tabConctent', compact('rule'))->render();

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
