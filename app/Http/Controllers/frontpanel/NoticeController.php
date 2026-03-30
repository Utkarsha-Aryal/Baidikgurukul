<?php

namespace App\Http\Controllers\frontpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BackPanel\Notice;
use Exception;
use Illuminate\Database\QueryException;

class NoticeController extends Controller
{
    public function index()
    {
        try {
            $type = 'success';
            $message = 'Successfully fetched data';
            
            // Get current date to optionally filter active notices based on start/end date
            $now = \Carbon\Carbon::now()->format('Y-m-d');
            
            $notices = Notice::where('status', 'Y')
                // ->whereDate('start_date', '<=', $now)
                // ->whereDate('end_date', '>=', $now)
                ->orderBy('order_number', 'asc')
                ->paginate(10);
                
            $data = [
                'notices' => $notices,
                'type' => $type,
                'message' => $message
            ];
        } catch (QueryException $e) {
            $data['type'] = 'error';
            $data['message'] = 'Database error occurred';
        } catch (Exception $e) {
            $data['type'] = 'error';
            $data['message'] = $e->getMessage();
        }
        
        return view('frontend.notice.index', $data);
    }
}
