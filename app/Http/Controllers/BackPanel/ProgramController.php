<?php

namespace App\Http\Controllers\BackPanel;


use App\Http\Controllers\Controller;
use App\Models\BackPanel\Program;
use App\Models\Common;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProgramController extends Controller
{
    public function index()
    {
        return view('backend.program.index');
    }

    // Image upload of post
    public function uploadImage(Request $request)
    {
        try {
            if ($request->hasFile('upload')) {
                $folder = storage_path('app/public/program/');

                if (!Storage::exists($folder))
                    Storage::makeDirectory($folder, 0775, true, true);

                $file = $request->file('upload');
                $newName = time() . '_' . rand(10, 9999999999999) . '_' . $file->getClientOriginalName();
                $file->move($folder, $newName);

                $url = asset('storage/program/' . $newName); // Public URL for the uploaded image

                return response()->json([
                    'uploaded' => 1,
                    'fileName' => $newName,
                    'url' => $url
                ]);
            } else {
                return response()->json([
                    'uploaded' => 0,
                    'error' => ['message' => 'No file uploaded.']
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'uploaded' => 0,
                'error' => ['message' => $e->getMessage()]
            ], 500);
        }
    }

    /* save */
    public function save(Request $request)
    {
        try {
            $rules = [
                'title' => 'required|min:5|max:255',
                'details' => 'required|min:5|max:5000',
            ];
            if (empty($request->id)) {
                $rules['image'] = 'required:mimes:jpg,jpeg,png:max:2048';
            }

            $message = [
                'title.required' => 'Please enter title',
                'details.required' => 'Please write in details',
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
            if (!Program::saveData($post)) {
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
        return response()->json(['type' => $type, 'message' => $message]);
    }

    // Get list
    public function list(Request $request)
    {
        try {
            $post = $request->all();
            $data = Program::list($post);
            $i = 0;
            $array = [];
            $filtereddata = ($data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : $data["totalrecs"]);
            $totalrecs = $data["totalrecs"];

            unset($data["totalfilteredrecs"]);
            unset($data["totalrecs"]);
            foreach ($data as $row) {
                $array[$i]["sno"] = $i + 1;
                $array[$i]["title"]    = Str::limit($row->title, 15, '...');
                $array[$i]["details"]  =  strip_tags(Str::limit($row->details, 30, '...'));
                $array[$i]["order_number"]  =  $row->order_number;
                $array[$i]["video_link"]  =  $row->video_link;
                $image = asset('images/no-image.jpg');
                if (!empty($row->image) && file_exists(public_path('/storage/program/' . $row->image))) {
                    $image = asset("storage/program/" . $row->image);
                }
                $array[$i]["image"] = '<img src="' . $image . '" height="30px" width="30px" alt="image"/>';
                $action = '';
                if (!empty($post['type']) && $post['type'] != 'trashed') {
                    $action .= '<a href="javascript:;" class="edit" title="Edit Data" data-id="' . $row->id . '"><i class="fa-solid fa-pen-to-square text-primary"></i></a> |';
                } else {
                    $action .= '<a href="javascript:;" class="restore" title="Restore Data" data-id="' . $row->id . '"><i class="fa-solid fa-undo text-success"></i></a> ';
                    $action .= '|';
                }
                $action .= ' <a href="javascript:;" class="delete" title="Delete Data" data-id="' . $row->id . '"><i class="fa fa-trash text-danger"></i></a>';
                $array[$i]["action"]  = $action;
                $i++;
            }

            if (!$filtereddata) $filtereddata = 0;
            if (!$totalrecs) $totalrecs = 0;
        } catch (QueryException) {
            $array = [];
            $totalrecs = 0;
            $filtereddata = 0;
        } catch (Exception) {
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
                $data = Program::where(['id' => $request->id, 'status' => 'Y'])->first();
                if ($data->image) {
                    $data['image'] = '<img src="' . asset('/storage/program') . '/' . $data->image . '" class="_image" height="160px" width="160px" alt="' . ' No image"/>';
                } else {
                    $data['image'] = '<img src="' . asset('/no-image.jpg') . '" class="_image" height="160px" width="160px" alt="' . ' No image"/>';
                }
            }
        } catch (QueryException $e) {
            $data['error'] = $this->queryMessage;
        } catch (Exception $e) {
            $data['error'] = $e->getMessage();
        }
        return view('backend.program.form', $data);
    }

    // Delete
    public function delete(Request $request)
    {
        try {
            $type = 'success';
            $message = "Record deleted successfully";
            $directory = storage_path('app/public/program');
            $post = $request->all();
            $class = new Program();

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

    //restore
    public function restore(Request $request)
    {
        try {
            $post = $request->all();
            $type = 'success';
            $message = "Program restored successfully";
            DB::beginTransaction();
            $result = Program::restoreData($post);
            if (!$result) {
                throw new Exception("Could not restore Product. Please try again.", 1);
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