<?php

namespace App\Http\Controllers\BackPanel;

use App\Http\Controllers\Controller;
use App\Models\BackPanel\Gallery;
use App\Models\Common;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class GalleryController extends Controller
{
    // construct
    public function __construct()
    {
        parent::__construct();
    }


    // Home page
    public function index()
    {
        if (Auth::user()->user_role == 'normal') {
            return redirect()->route('admin.dashboard')->with('error', 'You do not have permission to access this module');
        }
        return view('backend.gallery.index');
    }

    // save
    public function save(Request $request)
    {
        try {

            $rules = [
                'name' => 'required|min:3|max:255',
            ];
            if (empty($request->id)) {
                $rules['image'] = 'required|mimes:jpg,jpeg,png|max:2048';
            } else {
                $rules['image'] = 'nullable|mimes:jpg,jpeg,png|max:2048';
            }

            $message = [
                'name.required' => 'Please enter album name.',
                'image.required' => 'Please upload image',
            ];

            $validation = Validator::make($request->all(), $rules, $message);

            if ($validation->fails()) {
                throw new Exception($validation->errors()->first(), 1);
            }

            $post = $request->all();
            $type = 'success';
            $message = 'Records saved successfully';

            DB::beginTransaction();

            if (!Gallery::saveData($post)) {
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
            $data = Gallery::list($post);
            $i = 0;
            $array = [];
            $filtereddata = ($data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : $data["totalrecs"]);
            $totalrecs = $data["totalrecs"];

            unset($data["totalfilteredrecs"]);
            unset($data["totalrecs"]);
            foreach ($data as $row) {
                $array[$i]["sno"] = $i + 1;
                $array[$i]["name"]    = $row->name;

                if (!empty($row->image)) {
                    $array[$i]["image"]  = '<img src="' . asset('/storage/gallery-image') . '/' . $row->image . '" height="30px" width="30px" alt="' . ' image"/>';
                } else {
                    $array[$i]["image"]  = '<img src="' . asset('/no-image.jpg') . '" height="30px" width="30px" alt="' . ' image"/>';
                }
                $action = '';

                if (!empty($post['type']) && $post['type'] != 'trashed') {
                    $action .= '<a href="javascript:;" class="addImageButton" title="Add Images" data-id="' . $row->id . '"><i class="fa-solid fa-image" style="color: #2a69d5;"></i></a> ';
                    $action .= '<span style="margin-left: 20px;"></span>'; //Space placement to sepearte from each other
                    $action .= '<a href="javascript:;" class="addVideoButton" title="Add Images" data-id="' . $row->id . '"><i class="fa-solid fa-video" style="color: #195fd7;"></i></a> ';
                    $action .= '<span style="margin-left: 20px;"></span>'; //Space placement to sepearte from each other
                    $action .= '<a href="javascript:;" class="editGallery" title="Edit Data" data-id="' . $row->id . '" data-name="' . $row->name . '" data-image="' . $row->image  . '"><i class="fa-solid fa-pencil" style="color: #1757c4;"></i></a>';
                    $action .= '<span style="margin-left: 20px;"></span>'; //Space placement to sepearte from each other
                } else {
                    $action .= '<a href="javascript:;" class="restore" title="Restore Data" data-id="' . $row->id . '"><i class="fa-solid fa-undo text-success"></i></a> | ';
                }
                $action .= '<a href="javascript:;" class="deleteGallery" title="Delete Data" data-id="' . $row->id . '"><i class="fa-solid fa-trash" style="color: #f70808;"></i></a>';
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
            $directory = storage_path('app/public/gallery-image');
            $post = $request->all();
            $class = new Gallery();

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
            $message = "Gallery restored successfully";
            DB::beginTransaction();
            $result = Gallery::restoreData($post);
            if (!$result) {
                throw new Exception("Could not restore Gallery. Please try again.", 1);
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
