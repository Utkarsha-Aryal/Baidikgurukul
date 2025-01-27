<?php

namespace App\Http\Controllers\frontpanel;


use App\Http\Controllers\Controller;
use App\Models\BackPanel\Enquiry as BackPanelEnquiry;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class EnquiryController extends Controller
{
    public function save(Request $request)
    {
        try {
            $rules = [
                'first_name' => 'required|min:2|max:50',
                'last_name' => 'required|min:2|max:50',
                'email' => 'required',
                'message' => 'required|min:5|max:255',
                'g-recaptcha-response' => 'required|captcha',
            ];

            $message = [
                'first_name.required' => 'कृपया आफ्नो नाम प्रविष्ट गर्नुहोस्।',
                'first_name.min' => 'नाम कम्तिमा २ अक्षर लामो हुनुपर्छ।',
                'first_name.max' => 'नाम ५० अक्षरभन्दा लामो हुन सक्दैन।',
                'last_name.required' => 'कृपया आफ्नो थर प्रविष्ट गर्नुहोस्।',
                'last_name.min' => 'थर कम्तिमा २ अक्षर लामो हुनुपर्छ।',
                'last_name.max' => 'थर ५० अक्षरभन्दा लामो हुन सक्दैन।',
                'email.required' => 'कृपया आफ्नो इमेल प्रविष्ट गर्नुहोस्।',
                'message.required' => 'कृपया आफ्नो सन्देश प्रविष्ट गर्नुहोस्।',
                'message.min' => 'सन्देश कम्तिमा ५ अक्षर लामो हुनुपर्छ।',
                'message.max' => 'सन्देश २५५ अक्षरभन्दा लामो हुन सक्दैन।',
                'g-recaptcha-response.required' => 'कृपया प्रमाणित गर्नुहोस् कि तपाई रोबोट होइन।',
                'g-recaptcha-response.captcha' => 'क्याप्चा प्रमाणित असफल भयो। कृपया पुन: प्रयास गर्नुहोस्।',
            ];

            $validation = Validator::make($request->all(), $rules, $message);
            if ($validation->fails()) {
                throw new Exception($validation->errors()->first(), 1);
            }

            $post = $request->all();
            $type = 'success';
            $message = 'तपाईको प्रश्न सफलतापूर्वक पठाइएको छ।';

            DB::beginTransaction();
            $result = BackPanelEnquiry::saveData($post);
            if (!$result) {
                throw new Exception("Could't sent.", 1);
            }

            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
            $type = 'error';
            $message = $this->queryMessage;
        } catch (Exception $e) {
            DB::rollBack();
            $type = 'error';
            $message = $e->getMessage();
        }
        return response()->json(['type' => $type, 'message' => $message]);
    }
}
