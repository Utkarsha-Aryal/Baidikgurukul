<?php


namespace App\Http\Controllers\frontpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BackPanel\Program;
use Exception;
use Illuminate\Database\QueryException;

class ProgramController extends Controller
{
    public function program()
    {
        try {
            $type = 'success';
            $message = 'Successfully fetched data';
            $programs = Program::where('status', 'Y')
                ->orderBy('id', 'desc')
                ->get();

            $data = [
                'programs' => $programs,
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
        return view('frontend.program.index', $data);
    }

    public function inner($slug)
    {
        try {
            $type = 'success';
            $message = 'Successfully fetched data';
            $data = [];
            $program = Program::where('slug', $slug)->first();
            $programs = Program::where('status', 'Y')
                ->orderBy('id', 'desc')
                ->get();


            $data = [
                'program' => $program,
                'programs' => $programs,
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
        return view('frontend.program.inner', $data);
    }
}