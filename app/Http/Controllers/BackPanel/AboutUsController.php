<?php

namespace App\Http\Controllers\BackPanel;

use App\Http\Controllers\Controller;
use App\Models\BackPanel\AboutUs;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AboutUsController extends Controller
{
    public function aboutUs()

    {

        if (Auth::user()->user_role == 'normal') {
            return redirect()->route('admin.dashboard')->with('error', 'You do not have permission to access this module');
        }

        $aboutUs = AboutUs::get()->first();

        $data = [
            'aboutusData' => $aboutUs
        ];
        return view('backend.about-us.index', $data);
    }

    public function updateAboutUs(Request $request)
    {
        try {
            $rules = [
                'introduction' => 'required|min:5',
                'mission' => 'required|min:5',
                'img_introduction' => 'nullable|mimes:jpg,jpeg,png|max:2048',
                'img_mission' => 'nullable|mimes:jpg,jpeg,png|max:2048',
            ];
            $message = [
                'introduction.required' => 'Please enter introduction',
                'mission.required' => 'Please enter mission',
            ];

            $validate = Validator::make($request->all(), $rules, $message);
            if ($validate->fails()) {
                throw new Exception($validate->errors()->first(), 1);
            }

            $post = $request->all();
            $type = 'success';
            $message = 'Record saved successfully';

            DB::beginTransaction();
            $post['updated_by']=Auth::user()->id;
            if (!AboutUs::updatedata($post))
                throw new Exception("Couldn't Save Records", 1);

            DB::commit();
        } catch (QueryException $e) {
            DB::rollback();
            $type = 'error';
            $message = $this->queryMessage;
        } catch (Exception $e) {
            DB::rollback();
            $type = 'error';
            $message = $e->getMessage();
        }
        return json_encode(['type' => $type, 'message' => $message]);
    }
}
