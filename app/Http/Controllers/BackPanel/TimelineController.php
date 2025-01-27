<?php

namespace App\Http\Controllers\BackPanel;

use App\Http\Controllers\Controller;
use App\Models\BackPanel\Timeline;
use App\Models\Common;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TimelineController extends Controller
{
    public function index()
    {
        return view('backend.timeline.index');
    }

    /* save */
    public function save(Request $request)
    {
        try {
            $rules = [
                'year' => 'required|min:4|max:4',
                'details' => 'required|min:5|max:5000',
                'order_number' => 'required|numeric|min:1',

            ];

            $message = [
                'year.required' => 'Please enter year',
                'details.required' => 'Please write details',

                'order_number.required' => 'The order number field is required.',
                'order_number.number' => 'The order number field must be number.',
                'order_number.min' => 'The order number field must be minimun 1.',
            ];

            $validate = Validator::make($request->all(), $rules, $message);

            if ($validate->fails()) {
                throw new Exception($validate->errors()->first(), 1);
            }

            $post = $request->all();
            $type = 'success';
            $message = 'Records saved successfully';

            DB::beginTransaction();

            if (!Timeline::saveData($post)) {
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
        try {
            $post = $request->all();
            $data = Timeline::list($post);
            $i = 0;
            $array = [];
            $filtereddata = ($data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : $data["totalrecs"]);
            $totalrecs = $data["totalrecs"];

            unset($data["totalfilteredrecs"]);
            unset($data["totalrecs"]);
            foreach ($data as $row) {
                $array[$i]["sno"] = $i + 1;
                $array[$i]["year"]    = $row->year;
                $array[$i]["order_number"]    = $row->order_number;
                $array[$i]["details"]  =  Str::limit($row->details, 70, '...');


                $action = '';
                if (!empty($post['type']) && $post['type'] != 'trashed') {
                    $action .= '<a href="javascript:;" class=" edittimeline" name="Edit Data" data-id="' . $row->id . '" data-order_number="' . $row->order_number . '" data-year="' . $row->year . '" data-details="' . $row->details . '"><i class="fa-solid fa-pen-to-square text-primary"></i></a>';
                } else {
                    $action .= '<a href="javascript:;" class="restore" title="Restore Data" data-id="' . $row->id . '"><i class="fa-solid fa-undo text-success"></i></a> ';
                }
                $action .= ' | <a href="javascript:;" class="deletetimeline" name="Delete Data" data-id="' . $row->id . '"><i class="fa fa-trash text-danger"></i></a>';
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

    // Delete
    public function delete(Request $request)
    {
        try {
            $type = 'success';
            $message = "Record deleted successfully";
            $directory = '';
            $post = $request->all();
            $class = new Timeline();

            DB::beginTransaction();
            if (!Common::deleteSingleData($post, $class, $directory)) {
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

    //view
    public function view(Request $request)
    {
        try {
            $post = $request->all();
            $timelineDetails = Timeline::where('id', $post['id'])
                ->where('status', 'Y')
                ->first();

            $data = [
                'timelineDetails' => $timelineDetails,
            ];

            $data['type'] = 'success';
            $data['message'] = 'Successfully fetched data of Time Line.';
        } catch (QueryException $e) {
            $data['type'] = 'error';
            $data['message'] = $this->queryMessage;
        } catch (Exception $e) {
            $data['type'] = 'error';
            $data['message'] = $e->getMessage();
        }
        return view('backend.post.view', $data);
    }

    //restore
    public function restore(Request $request)
    {
        try {
            $post = $request->all();
            $type = 'success';
            $message = "Time line restored successfully";
            DB::beginTransaction();
            $result = Timeline::restoreData($post);
            if (!$result) {
                throw new Exception("Could not restore Timeline. Please try again.", 1);
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