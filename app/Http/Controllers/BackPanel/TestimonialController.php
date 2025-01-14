<?php

namespace App\Http\Controllers\BackPanel;

use App\Http\Controllers\Controller;
use App\Models\BackPanel\Testimonial;
use App\Models\Common;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TestimonialController extends Controller
{

    public function index()
    {
        return view('backend.testimonial.index');
    }

    /* save */
    public function save(Request $request)
    {
        try {
            $rules = [
                'name' => 'required|min:5|max:255',
                'designation' => 'nullable|max:255',
                'review' => 'required|min:5|max:5000',
                'rating' => 'required',
            ];
            if (empty($request->id)) {
                $rules['image'] = 'required|mimes:jpg,jpeg,png|max:2048';
            } else {
                $rules['image'] = 'nullable|mimes:jpg,jpeg,png|max:2048';
            }

            $message = [
                'name.required' => 'Please enter name',
                'review.required' => 'Please write review',
                'rating.required' => 'Please select rating',
            ];

            $validate = Validator::make($request->all(), $rules, $message);

            if ($validate->fails()) {
                throw new Exception($validate->errors()->first(), 1);
            }

            $post = $request->all();
            $type = 'success';
            $message = 'Records saved successfully';

            DB::beginTransaction();

            if (!Testimonial::saveData($post)) {
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
            $data = Testimonial::list($post);
            $i = 0;
            $array = [];
            $filtereddata = ($data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : $data["totalrecs"]);
            $totalrecs = $data["totalrecs"];

            unset($data["totalfilteredrecs"]);
            unset($data["totalrecs"]);
            foreach ($data as $row) {
                $array[$i]["sno"] = $i + 1;
                $array[$i]["name"]    = $row->name;
                $array[$i]["designation"]    = $row->designation;
                $array[$i]["image"]    = $row->image;
                $array[$i]["review"]  =  Str::limit($row->review, 70, '...');
                $array[$i]["rating"]    = $row->rating;

                if (!empty($row->image)) {
                    $array[$i]["image"]  = '<img src="' . asset('/storage/testimonial') . '/' . $row->image . '" height="30px" width="30px" alt="' . ' image"/>';
                } else {
                    $array[$i]["image"]  = '<img src="' . asset('/no-image.jpg') . '" height="30px" width="30px" alt="' . ' image"/>';
                }

                $action = '';
                if (!empty($post['type']) && $post['type'] != 'trashed') {
                    $action .= '<a href="javascript:;" class=" editTestimonial" name="Edit Data" data-id="' . $row->id . '" data-name="' . $row->name  . '" data-designation="' . $row->designation . '" data-review="' . $row->review . '" data-rating="' . $row->rating . '" data-image="' . $row->image . '"><i class="fa-solid fa-pen-to-square text-primary"></i></a> | ';
                }
                $action .= ' <a href="javascript:;" class="deleteTestimonial" name="Delete Data" data-id="' . $row->id . '"><i class="fa fa-trash text-danger"></i></a>';
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
            $directory = storage_path('app/public/testimonial');
            $post = $request->all();
            $class = new Testimonial();

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
