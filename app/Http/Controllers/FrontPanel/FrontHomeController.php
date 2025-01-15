<?php

namespace App\Http\Controllers\FrontPanel;

use App\Http\Controllers\Controller;
use App\Models\BackPanel\Program;
use Exception;
use Illuminate\Database\QueryException;


class FrontHomeController extends Controller
{
    public function index()
    {
        try {
            $type = 'success';
            $message = 'Successfully fetched data';

            $program = Program::where('status', 'Y')
                ->orderBy('id', 'desc')
                ->where('status', 'Y')
                ->get();
            $data = [
                'program' => $program,
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
        return view('frontend.home.index');
    }
}
