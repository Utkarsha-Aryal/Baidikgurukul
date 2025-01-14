<?php

namespace App\Http\Controllers\BackPanel;

use App\Http\Controllers\Controller;
use App\Models\BackPanel\SiteSetting;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SiteSettingController extends Controller
{
    public function siteSetting()
    {
        $siteSettings = SiteSetting::get()->first();

        $data = [
            'siteSettings' => $siteSettings
        ];
        return view('backend.site-setting.index', $data);
    }

    public function updateSiteSetting(Request $request)
    {
        try {
            $rules = [
                'name' => 'required|min:3|max:255',
                'email' => 'nullable|min:3|max:55',
                'phone_number' => 'nullable|min:9|max:50',
                'address' => 'required|min:3|max:255',
                'link_facebook' => 'nullable|min:5|max:255',
                'link_map' => 'nullable|min:5|max:255',
                'homepage_title' => 'nullable|min:5|max:255',
                'hmaepage_description' => 'nullable|min:5|max:3000',
                'img_banner_homepage' => 'nullable|mimes:jpg,jpeg,png|max:2048',
                'img_logo' => 'nullable|mimes:jpg,jpeg,png|max:2048',
                'img_favicon' => 'nullable|mimes:jpg,jpeg,png|max:2048',
            ];

            $message = [
                'name.required' => 'please enter organization name',
                'address.required' => 'please enter address',
            ];
            $validate = Validator::make($request->all(), $rules, $message,);
            if ($validate->fails()) {
                throw new Exception($validate->errors()->first(), 1);
            }

            $post = $request->all();

            $type = "success";
            $message = "Record saved successfully";

            DB::beginTransaction();

            $result = SiteSetting::updatedata($post);
            if (!$result)
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
