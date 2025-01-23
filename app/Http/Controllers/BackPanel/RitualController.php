<?php


namespace App\Http\Controllers\BackPanel;


use App\Http\Controllers\Controller;
use App\Models\BackPanel\Ritual;
use App\Models\Common;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class RitualController extends Controller
{
    public function index()
    {
        return view('backend.ritual.index');
    }
    /* save */
    public function save(Request $request)
    {
        try {
            $rules = [
                'title' => 'required|min:5|max:255',
                'details' => 'required|min:5|max:5000',
                'order_number' => 'required',
                'video_link' => 'required|url',
            ];


            $message = [
                'title.required' => 'The title field is required.',
                'title.min' => 'The title must be at least 5 characters long.',
                'title.max' => 'The title may not exceed 255 characters.',

                'details.required' => 'Please provide details.',
                'details.min' => 'The details must be at least 5 characters long.',
                'details.max' => 'The details may not exceed 5000 characters.',

                'order_number.required' => 'The order number field is required.',

                'video_link.required' => 'A video link is required.',
                'video_link.url' => 'The video link must be a valid URL.',
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
            if (!Ritual::saveData($post)) {
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
            $data = Ritual::list($post);
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
                $array[$i]["short_bio"]  =  $row->short_bio;
                $array[$i]["order_number"]  =  $row->order_number;
                $array[$i]["video_link"]  =  $row->video_link;


                $image = asset('images/no-image.jpg');
                if (!empty($row->image) && file_exists(public_path('/storage/history/' . $row->image))) {
                    $image = asset("storage/history/" . $row->image);
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
                $data = Ritual::where(['id' => $request->id, 'status' => 'Y'])->first();
                if ($data->image) {
                    $data['image'] = '<img src="' . asset('/storage/ritual') . '/' . $data->image . '" class="_image" height="160px" width="160px" alt="' . ' No image"/>';
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
        return view('backend.ritual.form', $data);
    }

    public function deleteFeatureImage(Request $request)
    {
        try {
            $type = "success";
            $message = "Successfully Deleted Feature Image";
            $post = $request->all();

            DB::beginTransaction();
            if (!Ritual::deleteFeatureImageRitual($post)) {
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
            $directory = storage_path('app/public/ritual');
            $post = $request->all();
            $class = new Ritual();

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
            $message = "Ritual restored successfully";
            DB::beginTransaction();
            $result = Ritual::restoreData($post);
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
            $ritualDetails = Ritual::where('id', $post['id'])
                ->where('status', 'Y')
                ->first();

            $data = [
                'ritualDetails' => $ritualDetails,
            ];

            $data['type'] = 'success';
            $data['message'] = 'Successfully fetched data of History.';
        } catch (QueryException $e) {
            $data['type'] = 'error';
            $data['message'] = $this->queryMessage;
        } catch (Exception $e) {
            $data['type'] = 'error';
            $data['message'] = $e->getMessage();
        }
        return view('backend.ritual.view', $data);
    }

    //upload with image
    public function uploadImage(Request $request)
    {
        try {
            $folder = storage_path('app/public/ritual/');

            if (!Storage::exists($folder)) {
                Storage::makeDirectory($folder, 0775, true, true);
            }

            $file = $request->file('file');

            $newName = time() . '_' . rand(10, 9999999999999) . '_' . $file->getClientOriginalName();

            $file->move($folder, $newName);

            $url = asset('storage/ritual/' . $newName);
        } catch (Exception $e) {
            return response()->json([
                'uploaded' => 0,
                'error' => ['message' => $e->getMessage()]
            ], 500);
        }

        return response()->json([
            'success' => true,
            'imageUrl' => $url
        ]);
    }  


   //remove 
    public function deleteuploadImage(Request $request)
    {
        try {
            $request->validate([
                'image_path' => 'required|string',
            ]);

            $fileName = basename($request->input('image_path'));
            $filePath = public_path('storage/ritual/' . $fileName);


            if (file_exists($filePath)) {
                if (unlink($filePath)) {
                    return response()->json(['success' => true, 'message' => 'File deleted successfully.']);
                } else {
                    return response()->json(['success' => false, 'message' => 'Failed to delete the file.']);
                }
            } else {
                return response()->json(['success' => false, 'message' => 'File not found.']);
            }
        } catch (QueryException $e) {
            $data['type'] = 'error';
            $data['message'] = $this->queryMessage;
        } catch (Exception $e) {
            $data['type'] = 'error';
            $data['message'] = $e->getMessage();
        }
    }
}