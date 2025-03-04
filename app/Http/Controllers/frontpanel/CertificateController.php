<?php

namespace App\Http\Controllers\frontpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BackPanel\Certificate;
use App\Models\BackPanel\Donor;
use Exception;
use Illuminate\Database\QueryException;

class CertificateController extends Controller
{
    public function certificate()
    {
        try {
            $type = 'success';
            $message = 'Successfully fetched data';

            $certificates = Certificate::selectRaw('title,order_number,image')
                ->where('status', 'Y')
                ->orderBy('id', 'asc')
                ->paginate(12);

            $data = [
                'certificates' => $certificates,
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
        return view('frontend.certificate.index', $data);
    }
}