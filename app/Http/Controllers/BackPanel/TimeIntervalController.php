<?php

namespace App\Http\Controllers\BackPanel;

use App\Http\Controllers\Controller;
use App\Models\BackPanel\TimeInterval;
use App\Models\Common;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TimeIntervalController extends Controller
{

    public function index()
    {
        return view('backend.timer-interval.index');
    }

    //function to save 
    public function save(Request $request)
    {
        try {

            $rules = [
                'start_date' => 'required',
                'end_date' => 'required',
            ];

            $message = [
                'start_date.required' => 'Starting date is required.',
                'end_date.required' => 'Ending data is required.',
            ];

            $validation = Validator::make($request->all(), $rules, $message);

            if ($validation->fails()) {
                throw new Exception($validation->errors()->first(), 1);
            }

            $post = $request->all();
            $type = 'success';
            $message = 'Records saved successfully';

            DB::beginTransaction();
            $post['created_by'] = $this->userid;
            if (!TimeInterval::saveData($post)) {
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


    //function to list 
    public function list(Request $request)
    {
        try {
            $post = $request->all();
            $data = TimeInterval::list($post);
            $i = 0;
            $array = [];
            $filtereddata = ($data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : $data["totalrecs"]);
            $totalrecs = $data["totalrecs"];

            unset($data["totalfilteredrecs"]);
            unset($data["totalrecs"]);
            foreach ($data as $row) {
                $array[$i]["sno"] = $i + 1;
                $array[$i]["start_date"]    = $row->start_date;
                $array[$i]["end_date"]    = $row->end_date;

                $action = '';
                if (!empty($post['type']) && $post['type'] != 'trashed') {
                    $action .= '<a href="javascript:;" class="edit" name="Edit Data" data-id="' . $row->id . '" data-start_date="' . $row->start_date . '" data-end_date="' . $row->end_date . '"><i class="fa-solid fa-pen-to-square text-primary"></i></a> ';
                } else {
                    $action .= '<a href="javascript:;" class="restore" title="Restore Data" data-id="' . $row->id . '"><i class="fa-solid fa-undo text-success"></i></a> ';
                }
                $action .= '| <a href="javascript:;" class="delete" name="Delete Data" data-id="' . $row->id . '"><i class="fa fa-trash text-danger"></i></a>';

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


    //function to delete 
    public function delete(Request $request)
    {
        try {
            $type = 'success';
            $message = "Record deleted successfully";

            $post = $request->all();
            $class = new TimeInterval();

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
            $message = "Time Interval restored successfully";
            DB::beginTransaction();
            $result = TimeInterval::restoreData($post);
            if (!$result) {
                throw new Exception("Could not restore Time Interval. Please try again.", 1);
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
