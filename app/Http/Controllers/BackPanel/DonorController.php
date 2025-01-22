<?php

namespace App\Http\Controllers\BackPanel;


use App\Http\Controllers\Controller;
use App\Models\BackPanel\Donor;
use App\Models\Common;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DonorController extends Controller
{
    public function index()
    {
        return view('backend.donor.index');
    }
    /* save */
    public function save(Request $request)
    {
        try {
            $rules = [
                'name' => 'required|max:255',
                'amount' => 'required|max:255',
                'title' => 'required|max:255',
                'details' => 'nullable|max:5000',
            ];
            if (empty($request->id)) {
                $rules['image'] = 'required:mimes:jpg,jpeg,png:max:2048';
            }

            $message = [
                'name.required' => 'Please enter Donar name',
                'amount.required' => 'Please enter amount',
                'title.required' => 'Please enter donation title',
                'details.max' => 'Please enter less than 5000 character',
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
            if (!Donor::saveData($post)) {
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
            $data = Donor::list($post);
            $i = 0;
            $array = [];
            $filtereddata = ($data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : $data["totalrecs"]);
            $totalrecs = $data["totalrecs"];

            unset($data["totalfilteredrecs"]);
            unset($data["totalrecs"]);
            foreach ($data as $row) {
                $array[$i]["sno"] = $i + 1;
                $array[$i]["name"]    = $row->name;
                $array[$i]["amount"]    = $row->amount;
                $array[$i]["title"]    = Str::limit($row->title, 15, '...');
                $array[$i]["details"]  =  strip_tags(Str::limit($row->details, 30, '...'));
                $array[$i]["order_number"]  =  $row->order_number;
                $image = asset('images/no-image.jpg');
                if (!empty($row->image) && file_exists(public_path('/storage/donor/' . $row->image))) {
                    $image = asset("storage/donor/" . $row->image);
                }
                $array[$i]["image"] = '<img src="' . $image . '" height="30px" width="30px" alt="image"/>';
                $action = '';
                if (!empty($post['type']) && $post['type'] != 'trashed') {
                    $action .= ' <a href="javascript:;" class="view" title="View Data" data-id="' . $row->id . '"><i class="fa-solid fa-eye" style="color: #008f47;"></i></a> | ';
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
                $data = Donor::where(['id' => $request->id, 'status' => 'Y'])->first();
                if ($data->image) {
                    $data['image'] = '<img src="' . asset('/storage/donor') . '/' . $data->image . '" class="_image" height="160px" width="160px" alt="' . ' No image"/>';
                } else {
                    $data['image'] = '<img src="' . asset('/no-image.jpg') . '" class="_image" height="160px" width="160px" alt="' . ' No image"/>';
                }
            }
        } catch (QueryException $e) {
            $data['error'] = $this->queryMessage;
        } catch (Exception $e) {
            $data['error'] = $e->getMessage();
        }
        return view('backend.donor.form', $data);
    }

    // Delete
    public function delete(Request $request)
    {
        try {
            $type = 'success';
            $message = "Record deleted successfully";
            $directory = storage_path('app/public/donor');
            $post = $request->all();
            $class = new Donor();

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
            $message = "Donor restored successfully";
            DB::beginTransaction();
            $result = Donor::restoreData($post);
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

    //view
    public function view(Request $request)
    {
        try {
            $post = $request->all();
            $donorDetail = Donor::where('id', $post['id'])
                ->where('status', 'Y')
                ->first();

            $data = [
                'donorDetail' => $donorDetail,
            ];

            $data['type'] = 'success';
            $data['message'] = 'Successfully fetched data of Donar.';
        } catch (QueryException $e) {
            $data['type'] = 'error';
            $data['message'] = $this->queryMessage;
        } catch (Exception $e) {
            $data['type'] = 'error';
            $data['message'] = $e->getMessage();
        }
        return view('backend.donor.view', $data);
    }

    // Image upload of Donar
    public function uploadImage(Request $request)
    {
        try {
            if ($request->hasFile('upload')) {
                $folder = storage_path('app/public/donar/');

                if (!Storage::exists($folder))
                    Storage::makeDirectory($folder, 0775, true, true);

                $file = $request->file('upload');
                $newName = time() . '_' . rand(10, 9999999999999) . '_' . $file->getClientOriginalName();
                $file->move($folder, $newName);

                $url = asset('storage/program/' . $newName);

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
}
