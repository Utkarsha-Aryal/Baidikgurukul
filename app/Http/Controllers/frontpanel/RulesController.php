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
            $ritules = Ritual::where('status', 'Y')
                ->orderBy('order_number', 'asc')
                ->get();


            $data = [
                'ritules' => $ritules,
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
        // Returns the 'history' view
        return view('frontend.rules.birth');
    }
}