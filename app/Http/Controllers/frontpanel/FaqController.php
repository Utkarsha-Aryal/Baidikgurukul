<?php

namespace App\Http\Controllers\frontpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BackPanel\FAQ;
use Exception;
use Illuminate\Database\QueryException;

class FaqController extends Controller
{
    public function faq()
    {
        try {
            $type = 'success';
            $message = 'Successfully fetched data';

            $faqs = FAQ::selectRaw('question, answer')
            ->where('status', 'Y')
                ->orderBy('id', 'desc')
                ->get();

            $data = [
                'faqs' => $faqs,
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
        return view('frontend.faq.index', $data);
    }
}
