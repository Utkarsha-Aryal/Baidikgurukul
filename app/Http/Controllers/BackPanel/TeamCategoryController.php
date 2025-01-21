<?php

namespace App\Http\Controllers\BackPanel;

use App\Http\Controllers\Controller;
use App\Models\BackPanel\TeamCategory;
use App\Models\Common;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TeamCategoryController extends Controller
{
    // construct
    public function __construct()
    {
        parent::__construct();
    }

    //function to redirect to team category page
    public function index()
    {
        return view('backend.team-category.index');
    }

    //function to save team category 
    public function save(Request $request)
    {
        try {

            $rules = [
                'team_category' => 'required|min:3|max:255',
            ];

            $message = [
                'team_category.required' => 'Please enter team category.',
            ];

            $validation = Validator::make($request->all(), $rules, $message);

            if ($validation->fails()) {
                throw new Exception($validation->errors()->first(), 1);
            }

            $post = $request->all();
            $type = 'success';
            $message = 'Records saved successfully';

            DB::beginTransaction();

            if (!TeamCategory::saveData($post)) {
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


    //function to list team category
    public function list(Request $request)
    {
        try {
            $post = $request->all();
            $data = TeamCategory::list($post);
            $i = 0;
            $array = [];
            $filtereddata = ($data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : $data["totalrecs"]);
            $totalrecs = $data["totalrecs"];

            unset($data["totalfilteredrecs"]);
            unset($data["totalrecs"]);
            foreach ($data as $row) {
                $array[$i]["sno"] = $i + 1;
                $array[$i]["team_category"]    = $row->team_category;

                $action = '';
                if (!empty($post['type']) && $post['type'] != 'trashed') {
                    $action .= '<a href="javascript:;" class=" edit_team_category" name="Edit Data" data-id="' . $row->id . '" data-team_category="' . $row->team_category . '"><i class="fa-solid fa-pen-to-square text-primary"></i></a> ';
                } else {
                    $action .= '<a href="javascript:;" class="restore" title="Restore Data" data-id="' . $row->id . '"><i class="fa-solid fa-undo text-success"></i></a> ';
                }
                $action .= '| <a href="javascript:;" class="delete_team_category" name="Delete Data" data-id="' . $row->id . '"><i class="fa fa-trash text-danger"></i></a>';

                $array[$i]["action"]  = $action;
                $i++;
            }

            if (!$filtereddata) $filtereddata = 0;
            if (!$totalrecs) $totalrecs = 0;
        } catch (QueryException $e) {
            $array = [];
            $totalrecs = 0;
            $filtereddata = 0;
        } catch (Exception $e) {
            $array = [];
            $totalrecs = 0;
            $filtereddata = 0;
        }
        return json_encode(array("recordsFiltered" => $filtereddata, "recordsTotal" => $totalrecs, "data" => $array));
    }


    //function to delete team category
    public function delete(Request $request)
    {
        try {
            $type = 'success';
            $message = "Record deleted successfully";

            $post = $request->all();
            $class = new TeamCategory();

            DB::beginTransaction();
            if (!Common::deleteDataFileDoesnotExists($post, $class)) {
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
            $message = "Team Category restored successfully";
            DB::beginTransaction();
            $result = TeamCategory::restoreData($post);
            if (!$result) {
                throw new Exception("Could not restore Team Category. Please try again.", 1);
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
