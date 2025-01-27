<?php

namespace App\Http\Controllers\BackPanel;

use App\Http\Controllers\Controller;
use App\Models\BackPanel\FAQ;
use App\Models\Common;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class FAQController extends Controller
{
    public function index()
    {
        return view('backend.faq.index');
    }

    //save
    public function save(Request $request)
    {
        try {
            $rules = [
                'question' => 'required|min:2|max:255',
                'answer' => 'required|min:2|max:255',
                'order_number' => 'required|numeric|min:1',
            ];

            $message = [
                'question.required' => 'The question field is required.',
                'question.min' => 'The question must be at least 2 character long.',
                'question.max' => 'The question may not be more than 255 characters.',

                'answer.required' => 'The answer field is required.',
                'answer.min' => 'The answer must be at least 2 characters long.',
                'answer.max' => 'The answer may not exceed 255 characters.',

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
            $post['created_by'] = $this->userid;
            $result = FAQ::saveData($post);
            if (!$result) {
                throw new Exception('Could not save record', 1);
            }
            DB::commit();
        } catch (ValidationException $e) {
            $type = 'error';
            $message = $e->getMessage();
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

    //list
    public function list(Request $request)
    {
        try {
            $post = $request->all();
            $data = FAQ::list($post);
            $i = 0;
            $array = [];
            $filtereddata = ($data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : $data["totalrecs"]);
            $totalrecs = $data["totalrecs"];
            unset($data["totalfilteredrecs"]);
            unset($data["totalrecs"]);
            foreach ($data as $row) {
                $array[$i]["sno"] = $i + 1;
                $array[$i]["question"] = Str::limit($row->question, 30, '...');
                $array[$i]["answer"] = Str::limit($row->answer, 30, '...');
                $array[$i]["order_number"] = $row->order_number;
                $action = '';

                if (!empty($post['type']) && $post['type'] != 'trashed') {
                    $action .= '<span style="margin-left: 3px;"></span>';
                    $action .= '<a href="javascript:;" class="edit" 
                     name="Edit Data" 
                     data-id="' . $row->id . '" 
                     data-question="' . $row->question . '" 
                     data-answer="' . $row->answer . '" 
                     data-order_number="' . $row->order_number . '">
                     <i class="fa-solid fa-pen-to-square text-primary"></i>
                 </a> | ';
                } else if (!empty($post['type']) && $post['type'] == 'trashed') {
                    $action .= '<a href="javascript:;" class="restore" title="Restore Data" data-id="' . $row->id . '"><i class="fa-solid fa-undo text-success"></i></a> | ';
                }
                $action .= ' <a href="javascript:;" class="delete" name="Delete Data" data-id="' . $row->id . '"><i class="fa fa-trash text-danger"></i></a>';
                $array[$i]["action"] = $action;
                $i++;
            }
            if (!$filtereddata)
                $filtereddata = 0;
            if (!$totalrecs)
                $totalrecs = 0;
        } catch (QueryException $e) {
            $array = [];
            $totalrecs = 0;
            $filtereddata = 0;
        } catch (Exception $e) {
            $array = [];
            $totalrecs = 0;
            $filtereddata = 0;
        }
        return response()->json(array("recordsFiltered" => $filtereddata, "recordsTotal" => $totalrecs, "data" => $array));
    }

    //view
    public function view(Request $request)
    {
        try {
            $post = $request->all();
            $testimonialDetails = FAQ::where('id', $post['id'])
                ->where('status', 'Y')
                ->first();
            $data = [
                'testimonialDetails' => $testimonialDetails,
            ];
            $data['type'] = 'success';
            $data['message'] = 'Successfully fetched data of Testimonial.';
        } catch (QueryException $e) {
            $data['type'] = 'error';
            $data['message'] = $this->queryMessage;
        } catch (Exception $e) {
            $data['type'] = 'error';
            $data['message'] = $e->getMessage();
        }
        return view('backend.testimonial.view', $data);
    }

    // delete
    public function delete(Request $request)
    {
        try {
            $type = 'success';
            $message = "Record deleted successfully";
            $directory = storage_path('app/public/testimonial');
            $post = $request->all();
            $class = new FAQ();
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
        return response()->json(['type' => $type, 'message' => $message]);
    }

    //restore
    public function restore(Request $request)
    {
        try {
            $post = $request->all();
            $type = 'success';
            $message = "Testimonial restored successfully";
            DB::beginTransaction();
            $result = FAQ::restoreData($post);
            if (!$result) {
                throw new Exception("Could not restore Testimonial. Please try again.", 1);
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
