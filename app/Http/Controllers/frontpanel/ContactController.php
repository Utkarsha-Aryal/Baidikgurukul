<?php

namespace App\Http\Controllers\frontpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BackPanel\SiteSetting;
use Exception;
use Illuminate\Database\QueryException;


class ContactController extends Controller
{
    public function contact()
    {
        try {
            $type = 'success';
            $message = 'Successfully fetched data';


            $sitesetting = SiteSetting::find(1);


            $data = [
                'sitesetting' => $sitesetting,
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
        return view('frontend.contact.index', $data);
    }
}
