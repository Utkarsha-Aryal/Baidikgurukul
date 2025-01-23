<?php

namespace App\Http\Controllers\BackPanel;

use App\Http\Controllers\Controller;
use App\Models\BackPanel\MessageFrom;
use App\Models\Common;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MessageFromController extends Controller
{
    public static function index()
    {
        if (Auth::user()->user_role == 'normal') {
            return redirect()->route('admin.dashboard')->with('error', 'You do not have permission to access this module');
        }
        return view('backend.message-from.index');
    }


    public function save(Request $request)
    {
        try {
            $rules = [
                'name' => 'required|min:3|max:50',
                'message' => 'required|min:5|max:3000',
                'designation' => 'required|min:3|max:255',
                'title' => 'required|min:3|max:100',
                'order' => 'required|max:255',
            ];
            if (empty($request->id)) {
                $rules['image'] = 'nullable|mimes:jpg,jpeg,png|max:2048';
            }
            $message = [
                'name.required' => 'Please enter the name.',
                'name.min' => 'The name must be at least 3 characters.',
                'name.max' => 'The name may not exceed 50 characters.',

                'message.required' => 'Please enter the message.',
                'message.min' => 'The message must be at least 5 characters.',
                'message.max' => 'The message may not exceed 3000 characters.',

                'designation.required' => 'Please enter the designation.',
                'designation.min' => 'The designation must be at least 3 characters.',
                'designation.max' => 'The designation may not exceed 255 characters.',

                'title.required' => 'Please enter the title.',
                'title.min' => 'The title must be at least 3 characters.',
                'title.max' => 'The title may not exceed 100 characters.',

                'order.required' => 'Please enter the order.',
                'order.max' => 'The order may not exceed 255 characters.',
            ];

            $validate = Validator::make($request->all(), $rules, $message);

            if ($validate->fails()) {
                throw new Exception($validate->errors()->first(), 1);
            }

            $post = $request->all();
            $type = 'success';
            $message = 'Record saved successfully';

            DB::beginTransaction();

            if (!MessageFrom::saveData($post)) {
                throw new Exception('Could not save record', 1);
            }
            DB::commit();
        } catch (QueryException) {
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

    //get list
    public function list(Request $request)
    {
        try {
            $post = $request->all();
            $data = MessageFrom::list($post);
            $i = 0;
            $array = [];
            $filtereddata = ($data['totalfilteredrecs'] > 0 ? $data['totalfilteredrecs'] : $data['totalrecs']);
            $totalrecs = $data['totalrecs'];

            unset($data['totalfilteredrecs']);
            unset($data['totalrecs']);
            foreach ($data as $row) {
                $array[$i]['sno'] = $i + 1;
                $array[$i]['name'] = $row->name;
                $array[$i]['title'] = Str::limit($row->title, 30, '...');
                $array[$i]['message'] = Str::limit($row->message, 50, '...');
                $array[$i]['designation'] = $row->designation;
                $array[$i]['display_in_home'] = $row->display_in_home;
                $array[$i]['order'] = $row->order;

                if (!empty($row->image)) {
                    $array[$i]["image"]  = '<img src="' . asset('/storage/message-from') . '/' . $row->image . '" class="_image" height="30px" width="30px" alt="' . ' image"/>';
                } else {
                    $array[$i]["image"]  = '<img src="' . asset('/no-image.jpg') . '" class="_image" height="30px" width="30px" alt="' . ' image"/>';
                }
                $action = '';
                if (!empty($post['type']) && $post['type'] != 'trashed') {
                    $action .= ' <a href="javascript:;" class="view" title="View Data" data-id="' . $row->id . '"><i class="fa-solid fa-eye" style="color: #008f47;"></i></a> | ';

                    $action .= '<a href="javascript:;" class="edit" title="Edit Data" data-id="' . $row->id . '"><i class="fa-solid fa-pen-to-square text-primary"></i></a> |';
                }
                $action .= ' <a href="javascript:;" class="delete" title="Delete Data" data-id="' . $row->id . '"><i class="fa fa-trash text-danger"></i></a>';
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

    //filled the form
    public function form(Request $request)
    {
        try {
            $data = [];
            if (!empty($request->id)) {
                $result = MessageFrom::where(['id' => $request->id, 'status' => 'Y'])->first();
                $data['id'] = $result->id;
                $data['name'] = $result->name;
                $data['message'] = $result->message;
                $data['title'] = $result->title;
                $data['designation'] = $result->designation;
                $data['display_in_home'] = $result->display_in_home;
                $data['order'] = $result->order;

                if ($result->image) {
                    $data['image'] = '<img src="' . asset('/storage/message-from') . '/' . $result->image . '" class="_image" width="160px" alt="' . ' No image"/>';
                } else {
                    $data['image'] = '<img src="' . asset('/no-image.jpg') . '" class="_image" width="160px" alt="' . ' No image"/>';
                }
            }
        } catch (QueryException $e) {
            $data['error'] = $this->queryMessage;
        } catch (Exception $e) {
            $data['error'] = $e->getMessage();
        }
        return view('backend.message-from.form', $data);
    }

    // Delete
    public function delete(Request $request)
    {
        try {
            $type = 'success';
            $message = "Record deleted successfully";
            $directory = storage_path('app/public/message-from');
            $post = $request->all();
            $class = new MessageFrom();

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

    //review
    public function view(Request $request)
    {
        try {
            $post = $request->all();
            $messageDetail = MessageFrom::where('id', $post['id'])
                ->where('status', 'Y')
                ->first();

            $data = [
                'messageDetail' => $messageDetail,
            ];

            $data['type'] = 'success';
            $data['message'] = 'Successfully fetched data of Message.';
        } catch (QueryException $e) {
            $data['type'] = 'error';
            $data['message'] = $this->queryMessage;
        } catch (Exception $e) {
            $data['type'] = 'error';
            $data['message'] = $e->getMessage();
        }
        return view('backend.message-from.view', $data);
    }
}
