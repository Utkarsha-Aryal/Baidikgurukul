<?php

namespace App\Http\Controllers\BackPanel;

use App\Http\Controllers\Controller;
use App\Models\BackPanel\Service;
use App\Models\Common;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ServiceController extends Controller
{

    public function index()
    {
        return view('backend.service.index');
    }

    /* save */
    public function save(Request $request)
    {
        try {
            $rules = [
                'title' => 'required|min:5|max:255',
                'order' => 'required|max:255',
                // 'icon' => 'required|min:5|max:255',
                'details' => 'required|min:5|max:5000',
            ];
            if (empty($request->id)) {
                $rules['thumbnail_image'] = 'required|mimes:jpg,jpeg,png|max:2048';
            } else {
                $rules['thumbnail_image'] = 'nullable|mimes:jpg,jpeg,png|max:2048';
            }
            if (empty($request->id)) {
                $rules['feature_image'] = 'required|mimes:jpg,jpeg,png|max:2048';
            } else {
                $rules['feature_image'] = 'nullable|mimes:jpg,jpeg,png|max:2048';
            }

            $message = [
                'title.required' => 'Please enter title',
                'order.required' => 'Please enter Service order',
                // 'icon.required' => 'Please select icon',
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

            if (!Service::saveData($post)) {
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
            $data = Service::list($post);
            $i = 0;
            $array = [];
            $filtereddata = ($data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : $data["totalrecs"]);
            $totalrecs = $data["totalrecs"];

            unset($data["totalfilteredrecs"]);
            unset($data["totalrecs"]);
            foreach ($data as $row) {
                $array[$i]["sno"] = $i + 1;
                $array[$i]["title"]    = $row->title;
                $array[$i]["order"]    = $row->order;
                // $array[$i]["icon"]    = '<i class="' . $row->icon . '"></i>';

                $array[$i]["details"]  =  strip_tags(Str::limit($row->details, 70, '...'));

                if (!empty($row->thumbnail_image)) {
                    $array[$i]["thumbnail_image"]  = '<img src="' . asset('/storage/service') . '/' . $row->thumbnail_image . '" height="30px" width="30px" alt="' . ' image"/>';
                } else {
                    $array[$i]["thumbnail_image"]  = '<img src="' . asset('/no-image.jpg') . '" height="30px" width="30px" alt="' . ' image"/>';
                }
                if (!empty($row->feature_image)) {
                    $array[$i]["feature_image"]  = '<img src="' . asset('/storage/service') . '/' . $row->feature_image . '" height="30px" width="30px" alt="' . ' image"/>';
                } else {
                    $array[$i]["feature_image"]  = '<img src="' . asset('/no-image.jpg') . '" height="30px" width="30px" alt="' . ' image"/>';
                }

                $action = '';
                if (!empty($post['type']) && $post['type'] != 'trashed') {
                    $action .= '<a href="javascript:;" class="editService" title="Edit Data" data-id="' . $row->id . '"><i class="fa-solid fa-pen-to-square text-primary"></i></a> |';
                }
                $action .= '  <a href="javascript:;" class="deleteService" title="Delete Data" data-id="' . $row->id . '"><i class="fa fa-trash text-danger"></i></a>';
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
                $result = Service::where(['id' => $request->id, 'status' => 'Y'])->first();
                $data['id'] = $result->id;
                $data['title'] = $result->title;
                $data['order'] = $result->order;
                $data['details'] = $result->details;
                // $data['icon'] = $result->icon;

                if ($result->thumbnail_image) {
                    $data['thumbnail_image'] = '<img src="' . asset('/storage/service') . '/' . $result->thumbnail_image . '" class="_image"  width="160px" alt="' . ' No image"/>';
                } else {
                    $data['thumbnail_image'] = '<img src="' . asset('/no-image.jpg') . '" class="_image" width="130px" alt="' . ' No image"/>';
                }
                if ($result->feature_image) {
                    $data['feature_image'] = '<img src="' . asset('/storage/service') . '/' . $result->feature_image . '" class="feature_image"  width="160px" alt="' . ' No image"/>';
                } else {
                    $data['feature_image'] = '<img src="' . asset('/no-image.jpg') . '" class="feature_image" width="130px" alt="' . ' No image"/>';
                }
            }
        } catch (QueryException $e) {
            $data['error'] = $this->queryMessage;
        } catch (Exception $e) {
            $data['error'] = $e->getMessage();
        }
        return view('backend.service.form', $data);
    }

    // Delete
    public function delete(Request $request)
    {
        try {
            $type = 'success';
            $message = "Record deleted successfully";
            $directory = storage_path('app/public/service');
            $post = $request->all();
            $class = new Service;

            DB::beginTransaction();
            if (!Common::deleteSingleDataTwoImage($post, $class, $directory)) {
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
