<?php

namespace App\Http\Controllers\BackPanel;


use App\Http\Controllers\Controller;
use App\Models\BackPanel\Event;
use App\Models\BackPanel\History;
use App\Models\Common;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index()
    {
        return view('backend.event.index');
    }
    /* save */
    public function save(Request $request)
    {
        try {
            $rules = [
                'title' => 'required|min:2|max:255',
                'details' => 'required|min:5|max:5000',
                'order_number' => 'required',
                'event_date' => 'required',
                'event_address' => 'required|min:1|max:20',
                'event_time_end' => 'required',
                'event_time_start' => 'required',
                'event_venue' => 'required|min:1|max:40',
            ];

            if (empty($request->id)) {
                $rules['image'] = 'required:mimes:jpg,jpeg,png:max:2048';
            }

            $message = [
                'title.required' => 'Please enter a title.',
                'title.min' => 'The title must be at least 2 characters long.',
                'title.max' => 'The title may not be more than 255 characters.',

                'details.required' => 'Please provide details.',
                'details.min' => 'The details must be at least 5 characters long.',
                'details.max' => 'The details may not exceed 5000 characters.',

                'order_number.required' => 'Please provide an order number.',

                'event_date.required' => 'Please specify the event date.',

                'event_address.required' => 'Please provide an event address.',
                'event_address.min' => 'The event address must be at least 1 character long.',
                'event_address.max' => 'The event address may not exceed 20 characters.',

                'event_time_end.required' => 'Please specify the event end time.',
                'event_time_start.required' => 'Please specify the event start time.',

                'event_venue.required' => 'Please provide the event venue.',
                'event_venue.min' => 'The event venue must be at least 1 character long.',
                'event_venue.max' => 'The event venue may not exceed 40 characters.',

                'image.required' => 'Please upload an image.',
                'image.mimes' => 'The image must be in jpg, jpeg, or png format.',
                'image.max' => 'The image size may not exceed 2MB.',
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
            if (!Event::saveData($post)) {
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
            $data = Event::list($post);
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
                $array[$i]["venue"]  =  $row->venue;
                $array[$i]["address"]  =  $row->address;
                $array[$i]["event_time_start"]  =  $row->event_time_start;
                $array[$i]["event_time_end"]  =  $row->event_time_end;
                $array[$i]["order_number"]  =  $row->order_number;
                $array[$i]["event_date"]  =  $row->event_date;


                $image = asset('images/no-image.jpg');
                if (!empty($row->image) && file_exists(public_path('/storage/event/' . $row->image))) {
                    $image = asset("storage/event/" . $row->image);
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
        } catch (QueryException $e) {
            dd($e);
            $array = [];
            $totalrecs = 0;
            $filtereddata = 0;
        } catch (Exception $e) {
            dd($e);
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
                $data = Event::where(['id' => $request->id, 'status' => 'Y'])->first();
                if ($data->image) {
                    $data['image'] = '<img src="' . asset('/storage/event') . '/' . $data->image . '" class="_image" height="160px" width="160px" alt="' . ' No image"/>';
                } else {
                    $data['image'] = '<img src="' . asset('/no-image.jpg') . '" class="_image" height="160px" width="160px" alt="' . ' No image"/>';
                }
                if ($data->feature_image) {
                    $decodedFeatureImages = json_decode($data->feature_image, true);
                    $data['decodedFeatureImages'] = $decodedFeatureImages;
                    // if ($decodedFeatureImages !== null) {
                    //     $featureImagesHtml = '';
                    //     foreach ($decodedFeatureImages as $featureImage) {
                    //         // Assuming $featureImage contains the URL of each image
                    //         $featureImagesHtml .= '<img src="' . asset('/storage/post') . '/' . $featureImage . '" class="_feature-image imageThumb" alt="Feature Image"/>';
                    //     }
                    //     $data['feature_image'] = $featureImagesHtml;
                    // } else {
                    //     $data['feature_image'] = '<img src="' . asset('/no-image.jpg') . '" class="_image" height="160px" width="160px" alt="' . ' No image"/>';
                    // }
                } else {
                    $data['feature_image'] = '<img src="' . asset('/no-image.jpg') . '" class="_image" height="160px" width="160px" alt="' . ' No image"/>';
                }
            }
        } catch (QueryException $e) {
            $data['error'] = $this->queryMessage;
        } catch (Exception $e) {
            $data['error'] = $e->getMessage();
        }
        return view('backend.event.form', $data);
    }

    public function deleteFeatureImage(Request $request)
    {
        try {
            $type = "success";
            $message = "Successfully Deleted Feature Image";
            $post = $request->all();

            DB::beginTransaction();
            if (!Event::deleteFeatureImageEvent($post)) {
                throw new Exception("Couldn't Delete Feature Image. Please Try Again", 1);
            }
            // $this->form($request);

            DB::commit();
        } catch (QueryException) {
            DB::rollBack();
            $type = "error";
            $message = $this->queryMessage();
        } catch (Exception $e) {
            DB::rollBack();
            $type = "error";
            $message = $e->getMessage();
        }
        return json_encode(['type' => $type, 'message' => $message]);
    }

    // Delete
    public function delete(Request $request)
    {
        try {
            $type = 'success';
            $message = "Record deleted successfully";
            $directory = storage_path('app/public/event');
            $post = $request->all();
            $class = new Event();

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
            $message = "Event restored successfully";
            DB::beginTransaction();
            $result = Event::restoreData($post);
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
            $EventDetails = Event::where('id', $post['id'])
                ->where('status', 'Y')
                ->first();

            $data = [
                'EventDetails' => $EventDetails,
            ];

            $data['type'] = 'success';
            $data['message'] = 'Successfully fetched data of Event.';
        } catch (QueryException $e) {
            $data['type'] = 'error';
            $data['message'] = $this->queryMessage;
        } catch (Exception $e) {
            $data['type'] = 'error';
            $data['message'] = $e->getMessage();
        }
        return view('backend.event.view', $data);
    }
}