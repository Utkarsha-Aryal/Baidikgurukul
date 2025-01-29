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
            $programs = Program::selectRaw('title,image,slug')
                ->where('status', 'Y')
                ->orderBy('id', 'desc')
                ->paginate(9);

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

            $program = Program::selectRaw('title, details')
                ->where('slug', $slug)
                ->first();

            $programs = Program::selectRaw('title,slug')
                ->where('status', 'Y')
                ->orderBy('id', 'desc')
                ->take(6)
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
