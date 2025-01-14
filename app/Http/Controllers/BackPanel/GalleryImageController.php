<?php

namespace App\Http\Controllers\BackPanel;

use App\Http\Controllers\Controller;
use App\Models\BackPanel\Gallery;
use App\Models\BackPanel\GalleryImage;
use App\Models\Common;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class GalleryImageController extends Controller
{
    // construct
    public function __construct()
    {
        parent::__construct();
    }


    // Home page
    public function index(Request $request)
    {
        try {
            $post = $request->all();
            $result = Gallery::where(['id' => $request->id, 'status' => 'Y'])->first();
            $post['title'] = $result->title;
        } catch (QueryException $e) {
            $post['error'] = $this->queryMessage;
        } catch (Exception $e) {
            $post['error'] = $e->getMessage();
        }
        return view('backend.gallery.image.index', $post);
    }

    // save
    public function save(Request $request)
    {
        try {
            $rules = [
                'image_link' => 'nullable|min:5|max:255'
            ];

            if (($request->external_link === "Y")) {

                $rules['image_link'] = 'required|min:5|max:255';
                $rules['image.*'] = 'nullable|file|mimes:jpg,jpeg,png';
            } else {
                $rules['image'] = 'required|array|min:1';
                $rules['image.*'] = 'required|file|mimes:jpeg,png,jpg|max:2048';
            }

            $message = [
                'image.array' => 'The uploaded file must be an image.',
                'image.required' => 'Please upload at least one image.',
                'image.array' => 'The uploaded file must be an image.',
                'image_link.required' => 'Please insert external image link.',
            ];
            $validation = Validator::make($request->all(), $rules, $message);
            if ($validation->fails()) {
                throw new Exception($validation->errors()->first(), 1);
            }
            $post = $request->all();
            $type = 'success';
            $message = 'Records saved successfully';

            DB::beginTransaction();

            if (!GalleryImage::saveData($post)) {
                throw new Exception("error", 1);
            }
            DB::commit();
        } catch (QueryException $e) {
            dd($e);
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
            $data = GalleryImage::list($post);
            $i = 0;
            $array = [];
            $filtereddata = ($data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : $data["totalrecs"]);
            $totalrecs = $data["totalrecs"];

            unset($data["totalfilteredrecs"]);
            unset($data["totalrecs"]);
            foreach ($data as $row) {
                $array[$i]["sno"] = $i + 1;
                $array[$i]['image_link'] = $row->image_link;
                $imageUrl = "<img src='" . asset('/storage/gallery-image') . "/" . $row->image . "' height='70px' width='70px' alt='" . $row->image . "' />";

                $array[$i]["image"]  = $row->image ? $imageUrl : '';

                $action = '';
                // $action .= '<a href="javascript:;" class="editImage" title="Edit Data" data-id="' . $row->id . '" data-image="' .  $row->image . '" data-image_link="' . $row->image_link . '"><i class="fa fa-pencil-alt text-primary"></i></a>';
                $action .= '  <a href="javascript:;" class="deleteImage" title="Delete Data" data-id="' . $row->id . '"><i class="fa fa-trash text-danger"></i></a>';
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
            $class = new GalleryImage();

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
}
