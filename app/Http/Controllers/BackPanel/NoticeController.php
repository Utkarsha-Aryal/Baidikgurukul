<?php


namespace App\Http\Controllers\BackPanel;

use App\Http\Controllers\Controller;
use App\Models\BackPanel\Notice;
use App\Models\BackPanel\TeamCategory;
use App\Models\Common;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class NoticeController extends Controller
{
    //function to redirect to team notice page
    public function index()
    {
        return view('backend.notice.index');
    }

    //function to save notice  
    public function save(Request $request)
    {
        try {
        $post = $request->all();
        if (empty($request->id)) {
            $rules['image'] = 'required:mimes:jpg,jpeg,png:max:2048';
        }
        $rules = [
            'title' => 'required|min:3|max:255',
            'order_number' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ];


        $messages = [
            'title.required' => 'Please enter notice title.',
            'order_number.required' => 'Please enter notice order.',
            'start_date.required' => 'Please select starting date.',
            'end_date.required' => 'Please select ending date.',
        ];

        $validation = Validator::make($request->all(), $rules, $messages);

        if ($validation->fails()) {
            throw new Exception($validation->errors()->first(), 1);
        }

        DB::beginTransaction();

        // Save Notice Data
        if (!Notice::saveData($post)) {
            throw new Exception('Could not save record', 1);
        }

        DB::commit();
        $type = 'success';
        $message = 'Records saved successfully';
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



    public function list(Request $request)
    {
        $post = $request->all();
        $data = Notice::list($post);
        $i = 0;
        $array = [];
        $filtereddata = ($data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : $data["totalrecs"]);
        $totalrecs = $data["totalrecs"];

        unset($data["totalfilteredrecs"]);
        unset($data["totalrecs"]);

        foreach ($data as $row) {
            $array[$i]["sno"] = $i + 1;
            $array[$i]["title"] = $row->title;
            $array[$i]["order_number"] = $row->order_number;
            $array[$i]["start_date"] = $row->start_date;
            $array[$i]["end_date"] = $row->end_date;
            // Ensure image path is correct
            $image = asset('/no-image.jpg');
            if (!empty($row->image) && file_exists(public_path('/storage/notice/' . $row->image))) {
                $image = asset('/storage/notice/' . $row->image);
            }
            $array[$i]["image"] = '<img src="' . $image . '" height="30px" width="30px" alt="Image"/>';

            $action = '';
            if (!empty($post['type']) && $post['type'] != 'trashed') {
                $action .= '<a href="javascript:;" class="edit_notice" name="Edit Data"
                    data-id="' . $row->id . '" 
                    data-title="' . $row->title . '" 
                    data-start_date="' . $row->start_date . '" 
                    data-end_date="' . $row->end_date . '" 
                    data-image="' . $row->image . '" 
                    data-order_number="' . $row->order_number . '"><i class="fa-solid fa-pen-to-square text-primary"></i></a> ';
            } else {
                $action .= '<a href="javascript:;" class="restore" title="Restore Data" data-id="' . $row->id . '"><i class="fa-solid fa-undo text-success"></i></a> ';
            }
            $action .= '| <a href="javascript:;" class="delete" name="Delete Data" data-id="' . $row->id . '"><i class="fa fa-trash text-danger"></i></a>';

            $array[$i]["action"] = $action;
            $i++;
        }

        return json_encode([
            "recordsFiltered" => $filtereddata ?: 0,
            "recordsTotal" => $totalrecs ?: 0,
            "data" => $array
        ]);
    }




    //function to delete team category
    public function delete(Request $request)
    {
        try {
            $type = 'success';
            $message = "Record deleted successfully";

            $post = $request->all();
            $class = new Notice();

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
            $message = "Notice restored successfully";
            DB::beginTransaction();
            $result = Notice::restoreData($post);
            if (!$result) {
                throw new Exception("Could not restore Notice. Please try again.", 1);
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