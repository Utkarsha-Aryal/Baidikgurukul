<?php

namespace App\Http\Controllers\BackPanel;

use App\Http\Controllers\Controller;
use App\Models\BackPanel\Gallery;
use App\Models\BackPanel\GalleryVideo;
use App\Models\Common;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class GalleryVideoController extends Controller
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
        return view('backend.gallery.video.index', $post);
    }


    // save
    public function save(Request $request)
    {
        try {
            $rules = [];
            if (empty($request->gallery_video_id)) {
                $rules = [
                    'video' => 'required|url|max:250',

                    'image' => 'required',
                ];
            } else {
                $rules = [
                    'video' => 'required|url|max:250',
                ];
            }
            $message = [
                'video.required' => 'Please provide video link.',
                'video.url' => 'The video field must contain a valid URL.',
                'video_image.required' => 'Please provide video Image.',
            ];
            $validation = Validator::make($request->all(), $rules, $message);
            if ($validation->fails()) {
                throw new Exception($validation->errors()->first(), 1);
            }
            $post = $request->all();
            $type = 'success';
            $message = 'Records saved successfully';

            DB::beginTransaction();

            if (!GalleryVideo::saveData($post)) {
                throw new Exception("error", 1);
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
            $data = GalleryVideo::list($post);
            $i = 0;
            $array = [];
            $filtereddata = ($data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : $data["totalrecs"]);
            $totalrecs = $data["totalrecs"];

            unset($data["totalfilteredrecs"]);
            unset($data["totalrecs"]);
            foreach ($data as $row) {
                $array[$i]["sno"] = $i + 1;
                $array[$i]["video"]  = $row->video_url;
                $vUrl = '';
                $vUrl = "<iframe width='160' height='115' src='" . $row->video_url . " title='YouTube video player'
                    frameborder='0'
                    allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share'
                    allowfullscreen></iframe>";
                $imageUrl = "<img src='" . asset('/storage/community') . "/" . $row->video_image . "' height='70px' width='70px' alt='" . $row->image . "' />";

                $array[$i]["video_image"]  = $row->video_image ? $imageUrl : '';

                $action = '';
                if (!empty($post['type']) && $post['type'] != 'trashed') {
                    $action .= '<a href="javascript:;" class="editVideo" title="Edit Data" 
                    data-id="' . $row->gallery_video_id . '" 
                    data-video_image="' . $row->video_image . '" 
                    data-video_url="' . $row->video_url . '" 
                    ><i class="fa-solid fa-pencil" style="color: #1757c4;"></i></a> | ';
                } else {
                    $action .= '<a href="javascript:;" class="restoreVideo" title="Restore Data" data-id="' . $row->gallery_video_id . '"><i class="fa-solid fa-undo text-success"></i></a> | ';
                }
                $action .= ' <a href="javascript:;" class="deleteVideo" title="Delete Data" data-id="' . $row->gallery_video_id . '"><i class="fa fa-trash text-danger"></i></a>';
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
            $directory = storage_path('app/public/community');

            $post = $request->all();
            $class = new GalleryVideo();

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
            $message = "Video image restored successfully";
            DB::beginTransaction();
            $result = GalleryVideo::restoreData($post);
            if (!$result) {
                throw new Exception("Could not restore Gallery Video. Please try again.", 1);
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
