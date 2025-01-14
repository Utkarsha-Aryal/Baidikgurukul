<?php

namespace App\Http\Controllers\BackPanel;


namespace App\Http\Controllers\BackPanel;

use App\Http\Controllers\Controller;
use App\Models\BackPanel\FAQ;
use App\Models\Common;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class FAQController extends Controller
{
    public function index()
    {
        return view('backend.faq.index');
    }

    //function to save testimonial
    public function save(Request $request)
    {
        try {
            $post = $request->all();
            $type = 'success';
            $message = 'Records saved successfully';
            DB::beginTransaction();
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

    //function to list testimonial
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
                $array[$i]["question"] = $row->question;
                $array[$i]["answer"] = $row->answer;
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

    //function to view testimonial
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

    // function to delete testimonial
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

    //function to restore testimonial
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