<?php

namespace App\Http\Controllers\frontpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BackPanel\MessageFrom;
use Exception;
use Illuminate\Database\QueryException;

class MessageFromController extends Controller
{
    public function index(Request $request)
    {
        try {
            $type = 'success';

            $message = 'Successfully fetched data';

            $message = MessageFrom::selectRaw('title,image,designation,message,slug')
                ->where('status', 'Y')
                ->where('display_in_home', 'Y')
                ->first();
                
            $data = [];
            $data = [
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
        return view('frontend.message-from.index', $data);
    }
}