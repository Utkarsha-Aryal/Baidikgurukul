<?php

namespace App\Http\Controllers\BackPanel;

use App\Http\Controllers\Controller;
use App\Models\BackPanel\TeamCategory;
use App\Models\BackPanel\TeamMember;
use App\Models\BackPanel\TimeInterval;
use App\Models\Common;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class TeamMemberController extends Controller
{
    // construct
    public function __construct()
    {
        parent::__construct();
    }

    // Home page
    public function index()
    {
        return view('backend.team-member.index');
    }

    // Save
    public function save(Request $request)
    {
        try {
            $rules = [
                'name' => 'required|max:255',
                'order' => 'required|max:255',
                'photo' => 'nullable|file|mimes:jpg,jpeg,png',
                'designation' => 'required|max:255',
                'facebook_url' => 'nullable|max:255',
                'instagram_url' => 'nullable|max:255',
                'twitter_url' => 'nullable|max:255',
                'details' => 'nullable|max:5000',

            ];

            $message = [
                'name.required' => 'Please enter Name.',
                'name.max' => 'name must not be less than 255 characters long.',
                'order.required' => 'Please enter member order.',
                'designation.required' => 'Please enter Designation.',
                'designation.max' => 'designation must be less than 250 characters long.',
                'photo.mimes' => 'Supported files are (JPEG,JPG,PNG) only.'
            ];

            $validation = Validator::make($request->all(), $rules, $message);
            if ($validation->fails()) {
                throw new Exception($validation->errors()->first(), 1);
            }

            $post = $request->all();
            $post['created_by'] = ($this->userid);
            $type = 'success';
            $message = 'Records saved successfully';
            DB::beginTransaction();

            if (!TeamMember::saveData($post)) {
                throw new Exception('Could not save record', 1);
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
        return json_encode(['type' => $type, 'message' => $message]);
    }

    // Get list
    public function list(Request $request)
    {
        // try {
        $post = $request->all();
        $data = TeamMember::list($post);
        $i = 0;
        $array = [];
        $filtereddata = ($data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : $data["totalrecs"]);
        $totalrecs = $data["totalrecs"];

        unset($data["totalfilteredrecs"]);
        unset($data["totalrecs"]);
        foreach ($data as $row) {
            $array[$i]["sno"] = $i + 1;
            $array[$i]["name"] = $row->name;
            $array[$i]["order"]    = $row->order;
            $array[$i]["designation"]    = $row->designation;
            $array[$i]["facebook_url"]    = $row->facebook_url;
            $array[$i]["instagram_url"]    = $row->instagram_url;
            $array[$i]["twitter_url"]    = $row->twitter_url;

            if (!empty($row->photo)) {
                $photo = '<img src="' . asset('/storage/community')  . '/' . $row->photo . '" height="30px" width="30px" alt="' . $row->category . ' image"/>';
            } else {
                $photo = '<img src="' . asset('/no-image.jpg') . '" height="30px" width="30px" alt="image"/>';
            }
            $array[$i]["photo"]  = $photo;

            $action = '';
            if (!empty($post['type']) && $post['type'] != 'trashed') {
                $action .= '<a href="javascript:;" class="edit-our-team" name="Edit Data" data-id="' . $row->id . '"><i class="fa fa-pencil-alt text-primary"></i></a> |';
            } else {
                $action .= '<a href="javascript:;" class="restore" title="Restore Data" data-id="' . $row->id . '"><i class="fa-solid fa-undo text-success"></i></a> |';
            }
            $action .= '  <a href="javascript:;" class="delete-our-team" name="Delete Data" data-id="' . $row->id . '"><i class="fa fa-trash text-danger"></i></a>';
            $array[$i]["action"]  = $action;
            $i++;
        }

        if (!$filtereddata) $filtereddata = 0;
        if (!$totalrecs) $totalrecs = 0;
        // } catch (QueryException $e) {
        //     $array = [];
        //     $totalrecs = 0;
        //     $filtereddata = 0;
        // } catch (Exception $e) {
        //     $array = [];
        //     $totalrecs = 0;
        //     $filtereddata = 0;
        // }
        return json_encode(array("recordsFiltered" => $filtereddata, "recordsTotal" => $totalrecs, "data" => $array));
    }

    // Form
    public function form(Request $request)
    {
        try {
            $data = [];
            $categories = TeamCategory::where('status', 'Y')->get();
            $timeIntervals = TimeInterval::where('status', 'Y')->get();
            $data = [
                'categories' => $categories,
                'timeIntervals' => $timeIntervals
            ];
            if (!empty($request->id)) {
                $member = TeamMember::where(['id' => $request->id, 'status' => 'Y'])->first();
                if (!empty($member->photo)) {
                    $member['photo'] = '<img class="_image" src="' . asset('/storage/community') . '/' . $member->photo . '" width="160px" alt="' . ' image"/>';
                } else {
                    $member['photo'] = '<img src="' . asset('/no-image.jpg') . '" height="140px" width="140px" alt="image"/>';
                }
                $data = [
                    'categories' => $categories,
                    'timeIntervals' => $timeIntervals,
                    'member' => $member,
                ];
            }
        } catch (QueryException $e) {
            $data['error'] = $this->queryMessage;
        } catch (Exception $e) {
            $data['error'] = $e->getMessage();
        }
        return view('backend.team-member.form', $data);
    }

    // Delete
    public function delete(Request $request)
    {
        try {
            $type = 'success';
            $message = 'Data deleted Successfully.';
            $directory = storage_path('app/public/community');
            $post = $request->all();
            $class = new TeamMember();

            DB::beginTransaction();
            if (!Common::deleteRelationData($post, $class, $directory)) {
                throw new Exception("Record does not deleted", 1);
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
        return json_encode(['type' => $type, 'message' => $message]);
    }

    //restore
    public function restore(Request $request)
    {
        try {
            $post = $request->all();
            $type = 'success';
            $message = "Team Member restored successfully";
            DB::beginTransaction();
            $result = TeamMember::restoreData($post);
            if (!$result) {
                throw new Exception("Could not restore Team Member. Please try again.", 1);
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
