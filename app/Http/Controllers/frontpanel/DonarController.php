<?php

namespace App\Http\Controllers\frontpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BackPanel\Donor;
use Exception;
use Illuminate\Database\QueryException;

class DonarController extends Controller
{
    public function list()
    {
        try {
            $type = 'success';
            $message = 'Successfully fetched data';

            $doners = Donor::selectRaw('name, amount, title,details,image,slug')
                ->where('status', 'Y')
                ->orderBy('id', 'asc')
                ->paginate(20);

            $data = [
                'doners' => $doners,
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
        return view('frontend.donar.index', $data);
    }
}
